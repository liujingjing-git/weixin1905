<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class VoteController extends Controller
{
    /*测试使用*/
    public function delKey(){
        $key = $_GET['k'];
        echo 'Delete Key:'.$key;echo '</br>';
        Redis::del($key);
    }

    public function index(){
        // echo '<pre>';print_r($_GET);echo '</pre>';

        $code = $_GET['code'];
        //获取access_token   
        $data = $this->getAccessToken($code); 
        //获取用户信息
        $user_info = $this->getUserInfo($data['access_token'],$data['openid']); 
        //保存用户信息
        $userinfo_key = 'h:u:'.$data['openid'];
        Redis::hMset($userinfo_key,$user_info);

        //处理业务逻辑  

        $openid = $user_info['openid'];
        $key = 'ss:vote:zhangsan';

        //判断是否已经投过票
        if(Redis::zrank($key,$user_info['openid'])){
            echo "已经投过票了";
        }else{
            Redis::Zadd($key,time(),$openid);
        } 

        $total = Redis::zCard($key);
        $members = Redis::zRange($key,0,-1,true);  //获取所有投票人的openid
        foreach($members as $k=>$v){            
            $u_k = 'h:u:'.$k;
            $u = Redis::hGetAll($u_k);
            echo '<img src="'.$u['headimgurl'].'">';
        }
    }

    /*根据code获取access_token*/
    protected function getAccessToken($code){
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WX_APPID').'&secret='.env('WX_APPSECRET').'&code='.$code.'&grant_type=authorization_code';
        $json_data = file_get_contents($url);
        return json_decode($json_data,true);
    }

    //获取用户基本信息
    protected function getUserInfo($access_token,$openid){
        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
        $json_data = file_get_contents($url);
        $data = json_decode($json_data,true);
        if(isset($data['errcode'])){
            die('出错了 40001');  //40001 标识获取用户信息失败
        }
        //返回用户消息
        return $data;
    }

    /*显示用户头像*/
    public function hashTest(){
        $uid = 1000;
        $key = 'h:user_info:uid:'.$uid;
        $user_info = [
            'uid' => $uid,
            'user_name' => 'zhangsan',
            'email' => 'zhangsan@qq.com',
            'age' => 22,
            'sex' => 1
        ];
        Redis::hMset($key,$user_info);
        die;
        echo '<hr>';
        $u = Redis::hGetAll($key);
        echo '<pre>';print_r($u);echo '</pre>';


    }
}
