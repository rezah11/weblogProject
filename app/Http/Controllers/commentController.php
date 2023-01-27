<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Likeable;
use App\Models\Post;
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
        $comment=new Comment();
        $user=auth()->user();
        Gate::forUser($user)->authorize('create',$comment);
        $comment->newQuery()->create([
            'comment'=>$request->comment,
            'user_id'=>$request->userId,
            'post_id'=>$request->postId
        ])->save();
        return redirect()->back();
    }

    public function likeComment(Request $request)
    {
        Gate::forUser(auth()->user())->allows('create',Likeable::class);
        $existLike = Likeable::query()
            ->where([
                ['likeable_id', $request->commentId],
                ['likeable_type', 'comment'],
                ['user_id', $request->userId],
            ])->first();
        if (empty($existLike)) {
            $comment = Comment::find($request->commentId);
            $like = new Likeable([
                'user_id' => $request->userId,
            ]);
//            $like->likeable()->associate($post);
            $comment->likes()->save($like);
//            $like->save();
//            dd(true,$request->all(), $like->likeable()->associate($post));
//            dd($like);
        } elseif ($existLike->like === 0) {
            $existLike->like = true;
//            dd('inja');
            $existLike->save();
        }

        return redirect()->back();
    }

    public function disLikeComment(Request $request)
    {
//        dd($request->all());
        Gate::forUser(auth()->user())->authorize('create', Likeable::class);
        $existLike = Likeable::query()
            ->where([
                ['likeable_id', '=', $request->commentId],
                ['likeable_type', '=', 'comment'],
                ['user_id', '=', $request->userId],
            ])->first();
//        dd($existLike);
        if (empty($existLike)) {
//            dd('ooonn');
            $comment = Comment::find($request->commentId);
            $like = new Likeable([
                'like' => false,
                'user_id' => $request->userId
            ]);
            $like->likeable()->associate($comment);
            $like->save();
//            dd(true,$request->all(), $likex`x`->likeable()->associate($post));
//            dd($like);
        } else if ($existLike->like === 1) {
            $existLike->like = false;
            $existLike->save();
        }
        return redirect()->back();
    }
}
