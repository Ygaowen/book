<?php
namespace app\common\validate;

use think\Validate;

class User extends Validate{
    //规则
    protected $rule = [
        'email|邮箱' => 'require|email',
        'pass|密码' => 'require',
        'pass1|确认密码' => 'require|confirm:pass',
        'captcha|验证码' => 'require|captcha'
    ];
    //场景
    protected $scene = [
        'login' => ['email','pass'],
        'register' => ['email','pass','pass1','captcha'],
        'forget' => ['email'],
    ];
}