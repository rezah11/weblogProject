<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Image;
use App\Models\Likeable;
use App\Models\Post;
use App\Rules\postRules;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createPost(PostRequest $request)
    {

        $post = new Post();
        $user = auth()->user();
        \Illuminate\Support\Facades\Gate::forUser($user)->authorize('create', $post);

//        $request->file('images')->getO
//        dd($request->file('images')->storeAs(asset('css'),'a.jpg'));
        $post = $post->newQuery()->create(array(
            'user_id' => $user->id,
            'title' => $request->title,
            'summary' => $request->summary,
            'content' => $request->content,
        ));
//        dd($post->id);
        $request->all()->images ?? $this->savaPostPics($request->file('images'), $post->id);
        return redirect()->back()->with('success', 'sent data successfully');
    }

    private function savaPostPics($images, $postId)
    {
        foreach ($images as $image) {
            $name = Str::random(10) . $image->getClientOriginalName() . Str::random(10);
            $image->move('postPics', $name);
            Image::query()->create([
                'image_url' => $name,
                'post_id' => $postId
            ]);
//            dd($name);
        }
    }

    public function likePost(Request $request)
    {
        $like = new Likeable();
        \Illuminate\Support\Facades\Gate::forUser(auth()->user())->authorize('create', $like);
        $existLike = Likeable::query()
            ->where([
                ['likeable_id', $request->postId],
                ['likeable_type', 'post'],
                ['user_id', $request->userId],
            ])->first();
        if (empty($existLike)) {
            $post = Post::find($request->postId);
            $like = [
                'user_id' => $request->userId,
            ];
            $like->likeable()->associate($post);
            $like->save();
//            dd(true,$request->all(), $like->likeable()->associate($post));
//            dd($like);
        } elseif ($existLike->like === 0) {
            $existLike->like = true;
//            dd('inja');
            $existLike->save();
        }

        return redirect()->back();
    }

    public function disLikePost(Request $request)
    {
        $like = new Likeable();
        \Illuminate\Support\Facades\Gate::forUser(auth()->user())->authorize('create', $like);
        $existLike = Likeable::query()
            ->where([
                ['likeable_id', '=', $request->postId],
                ['likeable_type', '=', 'post'],
                ['user_id', '=', $request->userId],
            ])->first();
//        dd($existLike);
        if (empty($existLike)) {
//            dd('ooonn');
            $post = Post::find($request->postId);
            $like = [
                'like' => false,
                'user_id' => $request->userId
            ];
            $like->likeable()->associate($post);
            $like->save();
//            dd(true,$request->all(), $like->likeable()->associate($post));
//            dd($like);
        } else if ($existLike->like === 1) {
            $existLike->like = false;
            $existLike->save();
        }
        return redirect()->back();
    }
}
