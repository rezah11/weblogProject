<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class commentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(CommentRequest $request)
    {
        dd($request);
        $comment=new Comment();
        $user=auth()->user();
        Gate::forUser($user)->authorize('create',$comment);
        $comment->newQuery()->create([
            'comment'=>$request->comment,
            'user_id'=>$request->userId,
            'post_id'=>$request->postId
        ])->save();
    }
}
