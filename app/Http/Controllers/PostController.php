<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Image;
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
        $post=$post->newQuery()->create(array(
            'user_id' => $user->id,
            'title' => $request->title,
            'summary' => $request->summary,
            'content' => $request->content,
        ));
//        dd($post->id);
      $request->all()->images ?? $this->savaPostPics($request->file('images'),$post->id);
        return redirect()->back()->with('success', 'sent data successfully');
    }

    private function savaPostPics($images,$postId)
    {
        foreach ($images as $image){
            $name=Str::random(10).$image->getClientOriginalName().Str::random(10);
             $image->move('postPics',$name);
             Image::query()->create([
                 'image_url'=>$name,
                 'post_id'=>$postId
             ]);
//            dd($name);
        }
    }
}
