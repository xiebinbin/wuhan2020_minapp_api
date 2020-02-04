<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class UploaderController extends Controller{
    public function index(Request $request){
        // 上传到阿里云
        $path = $request->file('file')->store($request->input('path','common'));
        $domain = 'http://'.env('OSS_ACCESS_BUCKET').'.'.env('OSS_ACCESS_ENDPOINT').'/';
        //http://wuhan2.oss-cn-shanghai.aliyuncs.com/common/Bjjo4l0FNnrzuEBUP8k1VkiEbiVEgIhDNKzVKFKR.png?x-oss-process=image/resize,m_fill,h_100,w_100
        return [
            'code'=>200,
            'msg'=>'成功',
            'data'=>[
                'file_url'=>$domain.$path,
            ]
        ];
    }
}