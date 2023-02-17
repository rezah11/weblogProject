<span>this is {{$value->name}}</span>
<div class="panel-heading no-border">
    <div class="pull-left half">
        <div class="media">
            <div class="media-object pull-left">
                <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="..."
                     class="img-circle img-post">
            </div>
            <div class="media-body">
                <a href="#"
                   class="media-heading block mb-0 h4 text-white">{{$value->name}}</a>
                <span class="text-white h6">{{$value->created_at}}</span>
                <a class="pull-right">
                    {{--                                            {{dd(is_null(auth()->user()->following()->get()),auth()->user()->following()->get()->isEmpty())}}--}}
{{--//=== $post->user->id--}}
{{--)--}}
{{--                    @else--}}
                        {{--                                           {{dd(auth()->user()->following()->get()[0])}}--}}
                        {{--                                            @foreach(auth()->user()->following()->get() as $value)--}}
                        {{--                                            {{dd(auth()->user()->id !== $post->user->id)}}--}}
                        @php
                            $arr=$value;
                        @endphp
{{--                    <a href=""></a>--}}
{{--                        @if(!($arr->where('id',$post->user->id)->isEmpty())  && auth()->user()->id !== $post->user->id)--}}
                    <a href="{{route('userUnfollow',['id'=>$value->id])}}" class="btn btn-danger">remove</a>
{{--                            <span>remove</span>--}}
{{--                            <input type="hidden" class="userFollower" value="{{$value->id}}"/></a>--}}
{{--                        @elseif(auth()->user()->id !== $post->user->id)--}}
{{--                            <button class="btn btn-success" name="follow" value="follow"/>--}}
{{--                            <span>follow</span><input type="hidden" class="userFollower" value="{{$post->user->id}}"/></button>--}}

{{--                        @endif--}}
                        {{--                                            @endforeach--}}
                        {{--                                                {{dd(auth()->user()->following()->id)}}--}}


                </a>
            </div>
        </div>
    </div><!-- /.pull-left -->
    <div class="pull-right">
        {{--                                <a href="#" cl ass="text-white h4"><i class="fa fa-heart"></i> 15.5K</a>--}}
    </div><!-- /.pull-right -->
    <div class="clearfix"></div>
</div>
