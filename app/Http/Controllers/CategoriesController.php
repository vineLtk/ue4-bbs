<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category, Topic, User};

class CategoriesController extends Controller
{
    //
    public function show(Request $request, $key){
        $user = new User();
		$active_users = $user->getActiveUser();//获取活跃用户
        $category = Category::where(['des_key'=>$key])->first();
        $topics = Topic::with(['user', 'category'])->where('category_id', $category->id)->ofOrder($request->order)->paginate(10);
        return view('topics/index', compact('topics', 'category', 'active_users'));
    }
}
