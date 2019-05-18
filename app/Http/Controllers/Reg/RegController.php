<?php
namespace App\Http\Controllers\Reg;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Model\RegModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class RegController extends Controller
{
    //注册
    public function reg()
    {
        //账号

        $name=trim($_POST['name']);
        //$name=$_GET['name'];
       //var_dump($name);
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
        };
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
    public function login()
    {
        $name=$_POST['name'];
        $pass=$_POST['pass'];
        if(empty($name)){
            $res_data=[
                'errcode'=>'10001',
                'msg'=>'姓名不能为空'
            ];
            return $res_data;
        }
        if(empty($pass)){
            $res_data=[
                'errcode'=>'10002',
                'msg'=>'密码不能为空'
            ];
            return $res_data;
        }
        $data=[
            'name'=>$name,
            'pass'=>$pass
        ];
        $user_data=RegModel::where($data)->first();
        $ktoken='token:u:'.$user_data['uid'];
        $token=str_random(32);
        Redis::hSet($ktoken,'app:token',$token);
        Redis::expire($ktoken,3600*24*3);
        if($user_data){
            $response=[
                'errcode'=>0,
                'msg'=>'登陆成功',
                'token'=>$token,
                'uid'=>$user_data['uid'],
                'email'=>$user_data['email'],
            ];
        }else{
            $response=[
                'errcode'=>'5011',
                'msg'=>'账号或者密码错误'
            ];
        }
        return json_encode($response);
    }

    //列表
    public function lis()
    {
        header("Access-Control-Allow-Origin: *");
        $res=DB::table('lis')->get();
        echo json_encode($res,JSON_UNESCAPED_UNICODE);
    }

    public function goodlist(Request $request)
    {
        header("Access-Control-Allow-Origin: *");
//        $id=$request->input('id');
        //echo $id;


    }
}
?>