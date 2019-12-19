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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','Index\IndexController@index');  //网站首页

Route::get('/info',function(){
   phpinfo();
});
Route::any('test/hello','Test\TestController@hello');
Route::any('test/adduser','User\LoginController@adduser');
Route::any('test/redis1','Test\TestController@redis1');
Route::any('test/redis2','Test\TestController@redis2');
Route::any('/test/baidu','Test\TestController@baidu');
Route::get('/test/xml','Test\TestController@xmlTest');

Route::get('/wx/test','WeiXin\WxController@test');

Route::get('/dev/redis/del','VoteController@delKey');

/*微信开发*/
Route::get('/wx','WeiXin\WxController@wechat');
/*接收用户的推送事件*/
Route::post('/wx','WeiXin\WxController@receiv');
/*获取临时素材*/
Route::get('/wx/media','WeiXin\WxController@getMedia');
/*自定义菜单栏*/
Route::get('/wx/flush/access_token','WeiXin\WxController@flushAccessToken');
Route::get('/wx/menu','WeiXin\WxController@createMenu');  //创建菜单



/*微信公众号*/
Route::get('/vote','VoteController@index');  //微信投票
