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
                                    <th>title</th>
                                    <th>summary</th>
                                    <th>content</th>
                                    <th>status</th>
                                    <th>created_at</th>
                                    <th>updated_at</th>
                                    <th>operation</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->summary}}</td>
                                        <td>{{$post->content}}</td>
                                        <td class=" @php
                                            echo $post->status===0 ? 'bg-danger' : 'bg-success';
                                        @endphp
                                            ">{{$post->status===0 ? 'disable' : 'enable'}}</td>
                                        <td>{{$post->created_at}}</td>
                                        <td>{{$post->updated_at}}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{route('changeStatus',['id'=>$post->id])}}">تغییر وضعیت</a>
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
