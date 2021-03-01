<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NotificationsController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    //
    public function index(){
        $user = Auth::user();
        //清空消息未读数
        $user->markAsRead();
        $list = $user->notifications()->paginate(10);
        return view('users.notifications', compact('list'));
    }
}
