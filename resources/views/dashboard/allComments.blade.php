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
                        {{ __('You are logged in!') }}
                        <br/>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th>comment</th>
                                    <th>status</th>
                                    <th>created_at</th>
                                    <th>updated_at</th>
                                    <th>operation</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($comments as $comment)
                                    <tr>
                                        <td>{{$comment->comment}}</td>
                                        <td class=" @php
                                            echo $comment->status===0 ? 'bg-danger' : 'bg-success';
                                        @endphp
                                            ">{{$comment->status===0 ? 'disable' : 'enable'}}</td>
                                        <td>{{$comment->created_at}}</td>
                                        <td>{{$comment->updated_at}}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{route('changeStatusComment',['id'=>$comment->id])}}">تغییر وضعیت</a>
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
