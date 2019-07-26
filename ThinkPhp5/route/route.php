<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use \think\facade\Route;

//  轮播图
Route::get('userapi/v1/banner_list','userapi/v1.Banner/getBannerList');

//  栏目
Route::get('userapi/v1/category_list','userapi/v1.Category/getCategory');
Route::get('userapi/v1/category_product_find','userapi/v1.Category/getCategoryProductList');

//  主题
Route::get('userapi/v1/theme_list','userapi/v1.Theme/getThemeList');
Route::get('userapi/v1/theme_product_find','userapi/v1.Theme/getThemeProductList');

//  商品详情
Route::get('userapi/v1/product_find','userapi/v1.Product/getProductFind');

//  订单
Route::get('userapi/v1/order_list','userapi/v1.Order/getOrderList');

//  wechat登陆
Route::any('userapi/v1/login','userapi/v1.Login/login');

//  用户信息接口
Route::any('userapi/v1/user/info','userapi/v1.User/info');

//  发送短信验证码
Route::any('userapi/v1/login_sms','userapi/v1.Login/sendSms');

//  注册
Route::any('userapi/v1/register','userapi/v1.Login/register');

//  修改个人资料
Route::any('userapi/v1/user/update_info','userapi/v1.User/updateUserInfo');

//  -------------------------------测试
Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

return [

];
//  -------------------------------测试
