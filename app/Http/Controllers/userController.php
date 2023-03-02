<?php

namespace App\Http\Controllers;

use App\Http\Requests\userRequest;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\Likeable;
use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use App\Policies\userPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class userController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.home');
    }

    public function userFollow()
    {
        $user = auth()->user();
        $userFollower = User::find(\request()->id);
        Gate::forUser(auth()->user())->authorize('follow', auth()->user());
        $user->following()->attach($userFollower);
        return redirect()->back();
//        dd('this is test');
    }

    public function userUnfollow()
    {
        $user = auth()->user();
        $userFollower = User::find(\request()->id);
        Gate::forUser(auth()->user())->authorize('follow', auth()->user());
        $user->following()->detach($userFollower);
        return redirect()->back();
    }

    public function unfollowFollowingUser()
    {
        $user = auth()->user();
        $userFollower = User::find(\request()->id);
        Gate::forUser(auth()->user())->authorize('follow', auth()->user());
        $user->followers()->detach($userFollower);
        return redirect()->back();
    }

    public function allUsers()
    {
        Gate::forUser(auth()->user())->authorize('allUsers', auth()->user());
//        dd(true);
        $users = User::all();
        return view('dashboard/allUsers')->with(compact('users'));
    }

    public function allPosts()
    {
//        dd('true') ;
        Gate::forUser(auth()->user())->authorize('allPosts', auth()->user());
        $posts = Post::all();
        return view('dashboard.allPosts')->with(compact('posts'));
    }

    public function changeStatus()
    {
        Gate::forUser(auth()->user())->authorize('allPosts', auth()->user());
        $post = Post::findOrFail(\request()->id);
        $post->status = !($post->status);
//        dd($post->status);
        $post->save();
        return redirect()->back();
    }

    public function allComments()
    {
        Gate::forUser(auth()->user())->authorize('allPosts', auth()->user());
        $comments = Comment::all();
        return view('dashboard/allComments')->with(compact('comments'));
    }

    public function changeStatusComment()
    {
        Gate::forUser(auth()->user())->authorize('allPosts', auth()->user());
        $comment = Comment::findOrFail(\request()->id);
        $comment->status = !($comment->status);
        $comment->save();
        return redirect()->back();

    }

    /** api codes  **/
    public function allUsersApi()
    {
        return response(User::all());
    }

    public function userApi(Request $request)
    {
//        dd($request->id);
//        try {
//        $a = 5 / 0;
        $user = User::findOrFail($request->id);
        return response($user);
//        }catch (\Exception $exception){
//            return response(['messege'=>$exception->getMessage()]);
//        }
    }

    public function createUsersApi(userRequest $request)
    {
//        dd($request->name);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'password' => bcrypt($request->password),
//            'type' => $request->type,
            'image_profile' => $request->image_profile,
        ]);
        $user->save();
        $this->createProfileUser($user, $request->age, $request->tel, $request->city);
        return response($user,201);
    }

    private function createProfileUser(User $user, $age, $tel, $city)
    {
        $profile = new Profile([
            'age' => $age,
            'tel' => $tel,
            'city' => $city,
        ]);
        $profile->user()->associate($user);
        $profile->save();
    }

    public function updateUsersApi($id, userRequest $request)
    {
//        dd($request);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->password = $request->password;
        $user->image_profile = $request->image_profile;
        $user->save();
        $this->updateProfileApi($id, $request->age, $request->tel, $request->city);
        return response($user,202);
    }

    private function updateProfileApi($id, $age, $tel, $city)
    {
        $profile = Profile::query()->where('user_id',$id)->first();
//        dd($age,$tel,$city,$profile);
        $profile->age = $age;
        $profile->tel = $tel;
        $profile->city = $city;
        $profile->save();
    }
}
