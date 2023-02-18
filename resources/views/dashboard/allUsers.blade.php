@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
{{--                        {{ __('You are logged in!') }}--}}
                        <br/>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>gender</th>
                                    <th>type</th>
                                    <th>image_profile</th>
                                    <th>created_at</th>
                                    <th>updated_at</th>
                                    <th>operation</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->gender}}</td>
                                        <td>{{$user->type}}</td>
                                        <td><img src="{{asset('users/imageProfile/'.$user->image_profile)}}" width="100%" height="100%">{{$user->image_profile}}</td>
                                        <td>{{$user->created_at}}</td>
                                        <td>{{$user->updated_at}}</td>
                                        <td>
                                            <a class="btn btn-danger" href="{{route('removeUser',['id'=>$user->id])}}">حذف کاربر</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
