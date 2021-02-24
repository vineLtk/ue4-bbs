<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Topic;

class CategoriesController extends Controller
{
    //
    public function show(Request $request, Category $category){
        $topics = Topic::with(['user', 'category'])->where('category_id', $category->id)->ofOrder($request->order)->paginate(10);
        return view('topics/index', compact('topics', 'category'));
    }
}
