<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\Image;
use App\Models\Likeable;
use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use App\Policies\imagePolicy;
use App\Policies\postPolicy;
use App\Policies\userPolicy;
use App\Rules\postRules;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
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
            'content' => $request->get('content'),
        ));
//        dd($post->id);
        $request->all()->images ?? $this->savaPostPics($request->file('images'), $post->id);
        return redirect()->back()->with('success', 'sent data successfully');
    }

    private function savaPostPics($images, $postId)
    {
        foreach ($images as $image) {
            $name = Str::random(20) . $image->getClientOriginalName();
            $image->move('postPics', $name);
//            dd('first');
            Image::query()->create([
                'image_url' => $name,
                'post_id' => $postId
            ]);
        }
    }

    public function likePost(Request $request)
    {

        \Illuminate\Support\Facades\Gate::forUser(auth()->user())->authorize('create', Likeable::class);
        $existLike = Likeable::query()
            ->where([
                ['likeable_id', $request->postId],
                ['likeable_type', 'post'],
                ['user_id', $request->userId],
            ])->first();
        if (empty($existLike)) {
            $post = Post::find($request->postId);
            $like = new Likeable([
                'user_id' => $request->userId,
            ]);
//            $like->likeable()->associate($post);
            $post->likes()->save($like);
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

    public function disLikePost(Request $request)
    {

        \Illuminate\Support\Facades\Gate::forUser(auth()->user())->authorize('create', Likeable::class);
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
            $like = new Likeable([
                'like' => false,
                'user_id' => $request->userId
            ]);

//            dd($like, $post);
            $like->likeable()->associate($post);
            $like->save();
//            dd(true,$request->all(), $likex`x`->likeable()->associate($post));
//            dd($like);
        } else if ($existLike->like === 1) {
            $existLike->like = false;
            $existLike->save();
        }
        return redirect()->back();
    }

    public function deleteImages(Request $request)
    {
        \Illuminate\Support\Facades\Gate::forUser(auth()->user())->allows('delete', imagePolicy::class);
//dd($request->id);
        try {
            Image::query()->where('id', $request->id)->delete();
            return true;

        } catch (\Exception $exception) {
            return false;
        }
    }

    public function updatePost(PostRequest $request)
    {
        \Illuminate\Support\Facades\Gate::forUser(auth()->user())->allows('create', postPolicy::class);
//        dd($request->id);
        $post = Post::findOrFail($request->id);
//        dd(isset($request->images));
//        dd($request->all());
        $post->title = $request->title;
        $post->summary = $request->summary;
        $post->content = $request->get('content');
//        dd($request->all(),);
        $post->save();
        if (isset($request->images)) {
//            $request->all()->images ?? $this->savaPostPics($request->file('images'), $post->id);
            $this->savaPostPics($request->file('images'), $post->id);
        }
        return redirect(\route('userPost'));
    }

    public function deletePost($id)
    {
        \Illuminate\Support\Facades\Gate::forUser(auth()->user())->allows('delete' , postPolicy::class);
//        $comments=Comment::query()->where('post_id',$id);
        $images=Image::query()->where('post_id',$id);
//        dd($comment->get()->toArray(),empty($comment->get()->toArray()));
//        if (!empty($commeDDnts->get()->toArray())){
//            $comments->delete();
//            $this->deleteImageFiles($comments->get()->toArray());
////            dd($comment);
//        }
        Post::query()->findOrFail($id)->delete();
        if (!empty($images->pluck('image_url')->toArray())){

            $this->deleteImageFiles($images->pluck('image_url')->toArray());

            $images->forceDelete();
        }
        return redirect()->back();
    }

    private function deleteImageFiles(array $toArray)
    {
        foreach ($toArray as $value){
            File::delete('postPics/'.$value);
        }
    }

    public function removeUser()
    {
        \Illuminate\Support\Facades\Gate::forUser(auth()->user())->authorize('allUsers', auth()->user());
        $user=User::findOrFail(\request()->id);
        $postIds=Post::query()->where('user_id',\request()->id)->pluck('id');

//        dd($user,$postIds);
        Follow::query()->where('following_user_id',\request()->id)->orWhere('followers_user_id',\request()->id)->delete();
        Likeable::query()->where('user_id',\request()->id)->delete();
        Comment::query()->where('user_id',\request()->id)->delete();
        Profile::query()->where('user_id',\request()->id)->delete();
        if (isset($postIds)){
            foreach ($postIds as $id){
                $this->deletePost($id);
            }
        }
        $user->delete();
        return redirect()->back();
    }
}
