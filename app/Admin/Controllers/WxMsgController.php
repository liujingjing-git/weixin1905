<?php

namespace App\Admin\Controllers;

use App\Model\WxUserModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use GuzzleHttp\Client;

class WxMsgController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '微信用户管理';

    public function sendMsg(){
        echo __METHOD__;

        $openid_arr = WxUserModel::select('openid','nickname','sex')->get()->toArray();
        
        // echo '<pre>';print_r($openid_arr);echo '</pre>';
        $openid = array_column($openid_arr,'openid');
        echo '<pre>';print_r($openid);echo '</pre>';

        $url = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=28_6mLI-YMfg4pMz5AUVcjFVE29wo2YiatSqav-Fj9ydM8vZosNWVdO8Hnj3VpOOsF18a47_5fOROPC4GyxG24I4mrmqAhnkje_Sk2P76uTkkNwGJJEVILYv-a0-0s_XhYLW-PGobavPM1Vcs1jFDSjAEATRG';

        $msg =date('Y-m-d H:i:s').'冬至快乐鸭!';

        $data = [
            'touser' => $openid,
            'msgtype' => 'text',
            'text' => ['content'=>$msg]
        ];

        $client = new Client();
        $response = $client->request('POST',$url,[
            'body' => json_encode($data,JSON_UNESCAPED_UNICODE)
        ]);

        echo $response->getBody();
    }

}
