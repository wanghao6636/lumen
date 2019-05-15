<?php
namespace App\Http\Controllers\reg;
use App\Http\Controllers\Controller;
use App\Model\RegModel;
class RegController extends Controller
{
    public function reg()
    {
        //echo 111;
        // header('Access-Control-Allow-Origin: *');
        $email=trim($_POST['email']);
        $pass=trim($_POST['pass']);
        $pass2=trim($_POST['pass2']);
        if($pass!==$pass2){
            $response=[
                'error'=>50002,
                'msg'=>'两次密码输入不一致'
            ];
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        }
        //数据库中取
        $regi=NetModel::where(['email'=>$email])->first();
        if($email){
            $response=[
                'error'=>60003,
                'msg'=>'邮箱不存在'
            ];
            die(json_encode($response,JSON_UNESCAPED_UNICODE));
        }
        //存入数据库
        $ou=NetModel::insertGetId($data);

        return view('reg.reg');
    }

}
?>