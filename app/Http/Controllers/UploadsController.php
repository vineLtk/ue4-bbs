<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handlers\ImageUploadHandler;
use Auth;

class UploadsController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function uploadImage(Request $request, ImageUploadHandler $imgHandler){
        $data = [
            'code'=>'501',
            'message'=>'上传失败',
            'success'=>false,
            'file_path'=>'',
        ];
        if($request->upload_file){
            $res = $imgHandler->save($request->upload_file, 'topics/body', Auth::id(), 500);
            if($res){
                $data['code'] = 200;
                $data['message'] = '上传成功';
                $data['success'] = true;
                $data['file_path'] = $res['path'];
            }
        }
        return $data;
    }
}
