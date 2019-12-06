<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

use GuzzleHttp\Client;


class TestController extends Controller
{
	//显示视图
	public function hello(){
		
		echo "hahaha";
	}

	/*redis*/
	public function redis1()
	{
		$key='weixin';
		$val='hello world';
		Redis::set($key,$val);

		echo time();echo  '</br>';
		echo date('Y-m-d H:i:s');
	}
	
	/*redis2*/
	public function redis2()
	{
		$key='weixin';
		echo Redis::get($key);
	}

	/*百度*/
	public function baidu()
	{
		$url='http://www.qstheory.cn/wp/2019-12/06/c_1125314331.htm';
		$client = new Client();
		$response = $client->request('GET');
		echo $response->getBody();
	}

}
