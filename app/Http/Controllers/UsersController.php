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
}
