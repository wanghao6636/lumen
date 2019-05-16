<?php
namespace App\Http\Controllers\reg;
use App\Http\Controllers\Controller;
use App\Model\RegModel;
class RegController extends Controller
{
    public function reg()
    {
        //账号
        $name=trim($_POST['name']);
        if(empty($name)){
            $data=[
                'error'=>60002,
                'msg'=>'用户名不能为空'
            ];
            return $data;
        }elseif(strlen($name)>10){
            $data=[
                'error'=>60001,
                'msg'=>'用户名不能超过10'
            ];
            return $data;
        }
        $info=RegModel::where(['name'=>$name])->first();
        if($info){
            $data=[
                'error'=>60003,
                'msg'=>'此账号已被注册'
            ];
            return $data;
        }
        //密码
        $pass=$_POST['pass'];
        if(empty($pass)){
            $data=[
                'error'=>60004,
                'msg'=>'密码不能为空'
            ];
            return $data;
        }
        $pass2=$_POST['pass2'];
        if($pass!=$pass2){
            $data=[
                'error'=>60005,
                'msg'=>'密码不一致'
            ];
            return $data;
        }
        //邮箱
        $email=trim($_POST['email']);
        if(empty($email)){
            $data=[
                'error'=>60006,
                'msg'=>'邮箱不能为空'
            ];
            return $data;
        }elseif(substr_count($email,'@')==0){
            $data=[
                'error'=>60007,
                'msg'=>'邮箱格式不对'
            ];
            return $data;
        }
        $info_str=[
            'name'=>$name,
            'email'=>$email,
            'pass'=>$pass,
        ];
        $str=RegModel::insert($info_str);
        if($str){
            $data=[
                'error'=>60008,
                'msg'=>'注册成功'
            ];
        }else{
            $data=[
                'error'=>60009,
                'msg'=>'注册失败'
            ];
        }
        return json_encode($data);
    }
    //登录

    

}
?>