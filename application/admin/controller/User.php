<?php
namespace app\admin\controller;

use think\Controller;

class User extends Controller{
    //登录
    public function login(){
        //如果提交的方法是ajax
        if (request()->isAjax()){
            $data = [
                'email' => input('email'),
                'pass' => input('password')
            ];
            //交给model处理
            $res = model('User')->login($data);
            if ($res == 1){
                $this->success('登录成功');
            }else{
                $this->error($res);
            }
        }
        return view();
    }
    //注册
    public function register(){
        //获取数据
        if (request()->isAjax()){
            $data = [
                'email' => input('email'),
                'pass' => input('password'),
                'pass1' => input('password1'),
                'captcha' => input('captcha')
            ];
            //交给model处理
            $res = model('User')->register($data);
            if ($res == 1){
                $this->success('注册成功','admin/user/login');
            }else{
                $this->error($res);
            }
        }
        return view();
    }
    //忘记密码
    public function forget(){
        //判断是否Ajax提交
        if (request()->isAjax()){
            $data = [
              'email' => input('email')
            ];
            //model处理
            $res = model('User')->forget($data);
            if ($res == 1){
                $this->success('发送成功');
            }else {
                $this->error($res);
            }
        }
        return view();
    }
    //重置
    public function reset(){
        //接收数据
        $data = [
            'email' => input('email'),
            'code' => input('code'),
            'pass' => input('password')
        ];
        $res = model('User')->reset($data);
        if ($res == 1){
            return $this->success('重置成功','admin/user/login');
        }else{
            return $res;
        }
    }
}