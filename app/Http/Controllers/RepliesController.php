<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function store(ReplyRequest $request, Reply $reply)
	{
		$reply->fill($request->all());
		$reply->user_id = Auth::id();
		$reply->save();
		return redirect()->route('topics.show', $reply->topic_id)->with('message', '回复成功');
	}

	public function destroy(Reply $reply)
	{
		$this->authorize('destroy', $reply);
		$reply->delete();

		return redirect()->back()->with('message', '删除成功');
	}
}