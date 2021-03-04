<?php

namespace App\Handlers;

use Image;
use Illuminate\Support\Str;

class ImageUploadHandler{

    protected $allowed_ext=['png', 'jpg', 'jpeg', 'gif'];

    public function save($file, $folder, $file_prefix, $max_width = false, $need_cut = false, $cut_data=""){
        // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        // 文件夹切割能让查找效率更高。
        $folder_name = "uploads/images/$folder/" . date("Ym/d", time());

        // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
        // 值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/
        $upload_path = public_path() . '/' . $folder_name;

        //获取文件后缀，默认png
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
        // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID 
        // 值如：1_1493521050_7BVc9v9ujP.png
        $filename = $file_prefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        if(! in_array($extension, $this->allowed_ext)){
            return false;
        }

        $file->move($upload_path, $filename);

        //对图片进行裁剪
        if($need_cut && $extension!='gif' && $cut_data){
            $this->cutPhoto($upload_path."/$filename", $cut_data);
        }

        if($max_width && $extension!='gif'){
            $this->reduceSize($upload_path."/$filename", $max_width);
        }

        return [
            'path'=> config('app.url')."/$folder_name/$filename"
        ];
    }

    public function reduceSize($file_path, $max_width)
    {
        // 先实例化，传参是文件的磁盘物理路径
        $image = Image::make($file_path);

        // 进行大小调整的操作
        $image->resize($max_width, null, function ($constraint) {

            // 设定宽度是 $max_width，高度等比例缩放
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });

        // 对图片修改后进行保存
        $image->save();
    }

    /**
     * 裁剪图片
     */
    public function cutPhoto($file_path, $cut_data){
        $image = Image::make($file_path);

        // 获取用户对文件进行处理的数据
        $avatarInfo  = json_decode($cut_data);
        $cropX  = floor($avatarInfo->x);
        $cropY  = floor($avatarInfo->y);
        $cropW  = floor($avatarInfo->width);
        $cropH  = floor($avatarInfo->height);
        $rotate = $avatarInfo->rotate;

        $image->rotate(-$rotate)
        ->crop($cropW, $cropH, $cropX, $cropY)
        ->save();

    }
}