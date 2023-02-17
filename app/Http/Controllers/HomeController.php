<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        $user=auth()->user();
        $userFollower=User::find(\request()->id);
        Gate::forUser(auth()->user())->authorize('follow',$user);
        $user->following()->attach($userFollower);
        return redirect()->back();
//        dd('this is test');
    }

    public function userUnfollow()
    {
        $user=auth()->user();
        $userFollower=User::find(\request()->id);
        Gate::forUser(auth()->user())->authorize('follow',$user);
        $user->following()->detach($userFollower);
        return redirect()->back();
}

    public function unfollowFollowingUser()
    {
        $user=auth()->user();
        $userFollower=User::find(\request()->id);
        Gate::forUser(auth()->user())->authorize('follow',$user);
        $user->followers()->detach($userFollower);
        return redirect()->back();
}

}
