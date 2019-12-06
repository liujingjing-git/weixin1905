<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;


class TestController extends Controller
{
	//显示视图
	public function hello(){
		
		echo "hahaha";
	}

	    /*redis*/
		public function redis1(){
			$key='1905';
			$val='hello world';
			Redis::set($key,$val);

			echo time();echo  '</br>';
			echo date('Y-m-d H:i:s');
		}
	

}
