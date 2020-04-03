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

use think\Route;

Route::group('admin',function (){
    //登录
    Route::rule('login','admin/user/login','get|post');
    //注册
    Route::rule('register','admin/user/register','get|post');
    //忘记密码
    Route::rule('forget','admin/user/forget','get|post');
    //重置密码
    Route::rule('reset','admin/user/reset','get|post');
});
