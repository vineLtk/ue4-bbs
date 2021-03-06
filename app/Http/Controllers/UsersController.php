<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
use App\Models\User;
use Auth;

class UsersController extends Controller
{

    public function __construct(){
        $this->middleware('auth', ['except'=>['show']]);
    }
    
    /**
     * 查看用户详情
     */
    public function show(User $user){
        return view('users/show', compact('user'));
    }

    /**
     * 编辑用户信息
     */
    public function edit(User $user){
        $this->authorize('update', $user);
        return view('users/edit', compact('user'));
    }

    /**
     * 更新用户信息
     */
    public function update(User $user, UserRequest $request, ImageUploadHandler $uploader){
        $this->authorize('update', $user);
        $data = $request->all();

        if($request->avatar){
            $res = $uploader->save($request->avatar, 'avatar', $user->id, '400');
            if ($res) {
                $data['avatar'] = $res['path'];
            }
        }
        
        $user->update($data);
        return redirect()->route('users.show', $user)->with('success', '个人资料更新成功!~');
    }

    public function updateAvatar(User $user, Request $request, ImageUploadHandler $uploader){
        $this->authorize('update', $user);

        $data = [
            'code'=>'501',
            'message'=>'上传失败',
            'success'=>false,
            'file_path'=>'',
        ];

        // dd($request->avatar_input);
        if($request->avatar_input){
            $res = $uploader->save($request->avatar_input, 'avatar', $user->id, '400', true, $request->avatar_data);
            if ($res) {
                $user->update(['avatar'=>$res['path']]);
                $data['code'] = 200;
                $data['message'] = '上传成功';
                $data['success'] = true;
                $data['file_path'] = $res['path'];
            }
        }
        
        return $data;
    }
}
