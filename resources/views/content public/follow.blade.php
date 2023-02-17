@extends('layouts.profile')
@section('content')
    <div class="col-md-8 col-xl-6 middle-wrapper">
        <div class="row">
            @if(request()->type=='following')
                {{--                {{dd(request()->edit)}}--}}
                @foreach(auth()->user()->followers()->get() as $value)
                    @include('content public.users content.following')
                @endforeach

            @elseif(request()->type=='followers')
{{--                {{dd(auth()->user()->following()->get())}}--}}
                @foreach(auth()->user()->following()->get() as $value)
                    @include('content public.users content.followers')
                @endforeach
            @endif
        </div>
    </div>

@endsection
