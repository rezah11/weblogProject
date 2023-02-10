@extends('layouts.profile')
@section('content')
    <div class="col-md-8 col-xl-6 middle-wrapper">
        <div class="row">
            @if(!empty(request()->edit))
{{--                {{dd(request()->edit)}}--}}
                @include('content public.users content.edit')
            @else
            @foreach(auth()->user()->posts as $post)
                @include('content public.users content.post')
            @endforeach
            @endif
        </div>
    </div>

@endsection
