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
//闭包路由
//Route::get('/lists','StudentController@lists');

Route::get('/add', function () {
    return '<form method="post" action="add_do">' . csrf_field() . '<input type="text" name="name"><button>提交</button></form>';
    //return '<form method="post" action="add_do"><input type="hidden" name="_token" value='.csrf_token().'><input type="text" name="name"><button>提交</button></form>';
});

//post
//Route::post('add_do',function(){
//    dd(request()->all());
//});

//支持多种路由
//Route::match(['post','get'],'add_do',function(){
//    dd(request()->all());
//});

//支持多种路由
//Route::any('add_do',function(){
//    dd(request()->all());
//});


//Route::get('goods_id/{id}',function($id){
//    echo 'id是'.$id;
//});

//Route::get('/goods/{id}','StudentController@goods');

//Route::get('goods_id/{id}',function($id){
//    echo $id;
//})->where('id','\d+');
//
//Route::get('goods_name/{name}',function($name){
//    echo $name;
//})->where('name','\w+');
//
//Route::get('goods_id/{id}/{name}',function($id,$name){
//    echo $id;
//    echo $name;
//})->where(['id'=>'\d+','name'=>'\w+']);

//商品品牌
Route::prefix('/brand')->group(function () {
    Route::get('add', function () {
        return view('brand.add');
    });
});
Route::post('/brand/add_do', 'BrandController@add_do')->name('adddo');
Route::get('/brand/list', 'BrandController@lists');
Route::get('/brand/edit/{id}', 'BrandController@edit');
Route::post('/brand/update/{id}', 'BrandController@update');
Route::get('/brand/delete/{id}', 'BrandController@delete');

//管理员
Route::prefix('/admin')->middleware('checklogin')->group(function () {
    Route::get('/create', 'Admin\AdminController@create');
    Route::post('/store', 'Admin\AdminController@store');
    Route::post('/name_do', 'Admin\AdminController@name_do');
    Route::get('/index', 'Admin\AdminController@index');
    Route::get('/edit/{id}', 'Admin\AdminController@edit');
    Route::post('/update/{id}', 'Admin\AdminController@update');
    Route::get('/destroy/{id}', 'Admin\AdminController@destroy');
});

//分类
Route::prefix('/category')->group(function () {
    Route::get('/create', 'Admin\CategoryController@create');
    Route::post('/store', 'Admin\CategoryController@store');
    Route::post('/name_do', 'Admin\CategoryController@name_do');
    Route::get('/index', 'Admin\CategoryController@index');
    Route::get('/edit/{id}', 'Admin\CategoryController@edit');
    Route::post('/update/{id}', 'Admin\CategoryController@update');
    Route::get('/destroy/{id}','Admin\CategoryController@destroy');
});


Route::prefix('/url')->middleware('auth')->group(function () {
    Route::get('/create', 'UrlController@create');
    Route::post('/store', 'UrlController@store');
    Route::post('/name_do', 'UrlController@name_do');
    Route::get('/index', 'UrlController@index');
    Route::get('/edit/{id}', 'UrlController@edit');
    Route::post('/update/{id}', 'UrlController@update');
    Route::get('/destroy/{id}', 'UrlController@destroy');
});

//商品
Route::prefix('/goods')->group(function () {
    Route::get('/create', 'Admin\GoodsController@create');
    Route::post('/store', 'Admin\GoodsController@store');
    Route::post('/name_do', 'Admin\GoodsController@name_do');
    Route::get('/index', 'Admin\GoodsController@index');
    Route::get('/edit/{id}', 'Admin\GoodsController@edit');
    Route::post('/update/{id}', 'Admin\GoodsController@update');
    Route::get('/destroy/{id}', 'Admin\GoodsController@destroy');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//前台登陆
Route::get('/login', 'index\LoginController@index')->name('login');
Route::post('/login_do', 'index\LoginController@login_do');
Route::get('/login/test','Index\IndexController@test');

Route::get('/','Index\IndexController@index');//前台首页

Route::get('/reg','Index\LoginController@reg');//前台注册

Route::post('/send','Index\LoginController@send');//发送邮箱

Route::post('/reg_do','Index\LoginController@reg_do');//注册

Route::get('/index/prolist/','Index\IndexController@prolist');//注册

Route::get('/index/proindex/{id}','Index\IndexController@proindex');

Route::get('/index/proinfo/{id}','Index\IndexController@proinfo');

Route::get('/index/car','Index\IndexController@car');

Route::post('/index/car_do','Index\IndexController@car_do');

Route::get('/index/pay','Index\IndexController@pay');

Route::post('/index/change','Index\IndexController@change');//数据库中的购买数量为文本框的值

Route::post('/index/total','Index\IndexController@total');//获取小计

Route::post('/index/getCount','Index\IndexController@getCount');//获取总价

Route::get('/index/confirmSettlement','Index\IndexController@confirmSettlement');//点击结算

Route::post('/index/Order','Index\IndexController@Order');//点击确认结算

Route::get('/index/payMoney','Index\IndexController@payMoney');

Route::get('/goods/index','Index\Goods@index');
Route::get('/goods/xq/{id}','Index\Goods@xq');

//支付宝支付处理路由
//Route::get('alipay','AlipayController@Alipay');  // 发起支付请求
//Route::any('notify','AlipayController@AliPayNotify'); //服务器异步通知页面路径
//Route::any('return','AlipayController@AliPayReturn');  //页面跳转同步通知页面路径

Route::get('wapalipay/{id}','wapAlipayController@Alipay');  // 发起支付请求
Route::any('wapnotify','wapAlipayController@AliPayNotify'); //服务器异步通知页面路径
Route::any('wapreturn','wapAlipayController@AliPayReturn');  //页面跳转同步通知页面路径
