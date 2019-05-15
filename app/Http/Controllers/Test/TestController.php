<?php
    namespace App\Http\Controllers\Test;
    use App\Http\Controllers\Controller;
    class TestController extends Controller
    {
        //对称减密
        public function test()
        {
            //接收数据
            $se_str=file_get_contents('php://input');
            echo $se_str;echo '<hr>';
            //解密
            $method='AES-256-CBC';
            $key='qweasd';
            $iv='12345q123456q123';
            $base64=base64_decode($se_str);
            $de_code=openssl_decrypt($base64,$method,$key,OPENSSL_RAW_DATA,$iv);
            echo $de_code;die;
        }
        //非对称减密
        public function innt()
        {
            $int=file_get_contents('php://input');
            echo $int;echo '<hr>';
            //解密
            $oo=openssl_get_publickey('file://'.storage_path('app/keys/public.pem'));
            openssl_public_decrypt($int,$daco,$oo);
            echo '<hr>';
            echo $daco;
        }
        //验签
        public function sign()
        {
            //echo '<pre>': print_r($_GET); echo '</pre>';
            $str=file_get_contents('php://input');
            //echo '<pre>': $str; echo '</pre>';
            $rr_sign=$_GET['sign'];
            $obk=openssl_get_publickey('file://'.storage_path('app/keys/public.pem'));
            $rr=openssl_verify($str,base64_decode($rr_sign),$obk);
            var_dump($rr);
        }
    }
?>