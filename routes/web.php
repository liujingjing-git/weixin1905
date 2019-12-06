<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/info',function(){
   phpinfo();
});
Route::any('test/hello','Test\TestController@hello');
Route::any('test/adduser','User\LoginController@adduser');
Route::any('test/redis1','Test\TestController@redis1');
Route::any('test/redis2','Test\TestController@redis2');
Route::any('/test/baidu','Test\TestController@baidu');


/*微信开发*/
Route::get('/wx','WeiXin\WxController@wechat');