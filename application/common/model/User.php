<?php
namespace app\common\model;

use think\Model;

class User extends Model{
    //登录
    public function login($data){
        //验证
        $validate = new \app\common\validate\User();
        if ($validate->scene('login')->check($data) == 0){
            return $validate->getError();
        }
        //数据库查找
        $res = $this->where($data)->find();
        if ($res){
            return 1;
        }else{
            return "邮箱或密码错误";
        }
    }
    //注册
    public function register($data){
        //验证
        $validate = new \app\common\validate\User();
        //判断错误
        $result = $validate->scene('register')->check($data);
        if (!$result){
            return $validate->getError();
        }
        //写入数据库,判断是否唯一
        $res = $this->where('email',$data['email'])->find();
        if ($res){
            return "注册失败，邮箱已注册";
        }
        //新增数据
        $this->create([
            'email' => $data['email'],
            'pass' => $data['pass']
        ]);
        //成功返回1
        return 1;
    }
    //忘记密码
    public function forget($data){
        //验证
        $validate = new \app\common\validate\User();
        $res = $validate->scene('forget')->check($data);
        if (!$res){
            return $validate->getError();
        }
        //查询邮箱是否存在
        $result = $this->where('email',$data['email'])->find();
        if ($result){
            //发送邮件
            $reset_code = mt_rand(1000,9999);
            $send = sendEmail($data['email'],'验证码：'.$reset_code,'找回密码');
            if ($send){
                session('reset_code',$reset_code);
                return 1;
            }else{
                return '发送失败';
            }
        }else {
            return "邮箱不存在";
        }
    }
    public function reset($data){
        //判断验证码
        if ($data['code'] != session('reset_code')){
            return "验证码错误";
        }
        //重置密码
        $res = $this->save([
            'pass' => $data['pass']
        ],['email' => $data['email']]);
        if ($res){
            return 1;
        }else{
            return '重置失败';
        }
    }
}