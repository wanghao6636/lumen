<?php
    namespace App\Http\Controllers\Test;
    use App\Http\Controllers\Controller;
    class QqController extends Controller
    {
        public function niu()
        {
            //ajax请求
            return view('niu.niu');
        }
    }