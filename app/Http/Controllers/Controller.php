<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function apiReturn($code = 0, $data = [], $msg = '', $openLog = false)
    {
        $msg = $msg ? $msg : '请求成功';

        $result['code'] = $code;
        if (!empty($data)){
            $result['data'] = $data;
        }
        $result['msg'] = $msg;
        $result = json_encode($result, JSON_UNESCAPED_UNICODE);

        //记录日志
        if ($openLog){
            Log::info($result);
            //es日志
//            $this->addLog(json_decode($result, true));
        }
        $origin = \request()->headers->get('Origin');
        header("Access-Control-Allow-Origin: {$origin}");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Methods: *");
        header("Access-Control-Allow-Headers: Content-Type,Access-Token");
        header("Access-Control-Expose-Headers: *");
        return $result;
    }
}
