@extends('layouts.main')
@section('content')
    @if(auth()->user()->isUser())
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
        @if(session('success'))
            <div class="alert-success">
                {{session('success')}}
            </div>
        @endif
        <div class="panel rounded shadow">
            <form method="post" action="{{route('createPost')}}" enctype="multipart/form-data">
                {{--                <form action="...">--}}
                @csrf
                <input class="form-control" placeholder="title" name="title"/>
                <input class="form-control" placeholder="summary" name="summary">

                <textarea class="form-control input-lg no-border" rows="2" placeholder="What are you doing?..."
                          name="content"></textarea>
                {{--                </form>--}}
                <div class="panel-footer">


                    <button class="btn btn-success pull-right mt-5">POST</button>
                    <ul class="nav nav-pills">
                        <li><a href="#"><i class="fa fa-user"></i></a></li>
                        <li><a href="#"><i class="fa fa-map-marker"></i></a></li>
                        <li><input class="form-control" type="file" accept=".jpg" name="images[]" multiple/>
                        </li>
                        <li><a href="#"><i class="fa fa-smile-o"></i></a></li>
                    </ul><!-- /.nav nav-pills -->
            </form>
        </div><!-- /.panel-footer -->
        </div><!-- /.panel -->
    @endif
    <div class="row">

        {{--    !!!!posts start!!!!        --}}
        @foreach($posts as $post)
            <div class="col-xs-12">
                <div class="panel panel-success rounded shadow">
                    <div class="panel-heading no-border">
                        <div class="pull-left half">
                            <div class="media">
                                <div class="media-object pull-left">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="..."
                                         class="img-circle img-post">
                                </div>
                                <div class="media-body">
                                    <a href="#"
                                       class="media-heading block mb-0 h4 text-white">{{$post->user->name}}</a>
                                    <span class="text-white h6">{{$post->created_at}}</span>
                                </div>
                            </div>
                        </div><!-- /.pull-left -->
                        <div class="pull-right">
                            {{--                                <a href="#" class="text-white h4"><i class="fa fa-heart"></i> 15.5K</a>--}}
                        </div><!-- /.pull-right -->
                        <div class="clearfix"></div>
                    </div><!-- /.panel-heading -->
                    <div class="panel-body no-padding">
                        <p>{{$post->title}}</p>
                        <p>{{$post->summary}}</p>
                        <p>{{$post->content}}</p>
                        @if($post->images)
                            @foreach($post->images as $value)
                                <img src="{{asset('postPics/'.$value->image_url)}}" alt="..."
                                     class="img-responsive full-width">
                            @endforeach
                        @else
                            <img src="{{asset('postPics/download.png')}}" alt="..."
                                 class="img-responsive full-width">
                        @endif
                        @php
                            $postPos=0;
                            $postNeg=0;
                        @endphp
                        @if($post->likes)
                            @foreach($post->likes as $like)
                                @php
                                    $like->like ===0 ? $postNeg-- : $postPos++;
                                @endphp
                            @endforeach
                            <br>
                            <span class="pull-left">{{$postPos}}</span>
                                <form method="post" action="{{route('likePost')}}" class="pull-left">
                                    @csrf
                                    <input type="hidden" value="{{$post->id}}" name="postId">
                                    <input type="hidden" value="{{auth()->user()->id}}" name="userId">
                                    <button type="submit"><i class="fa fa-thumbs-o-up"></i></button>
                                </form>
{{--                                <a href="#">  </a>--}}
{{--                            {{var_dump($postNeg)}}--}}
                            <span class="pull-left">{{$postNeg}}</span>
                                <form method="post" action="{{route('disLikePost')}}" class="">
                                    @csrf
                                    <input type="hidden" value="{{$post->id}}" name="postId">
                                    <input type="hidden" value="{{auth()->user()->id}}" name="userId">
                                    <button type="submit"><i class="fa fa-thumbs-o-down"></i></button>
                                </form>
{{--                                <a href="#">  </a>--}}
                        @endif
                        <div class="inner-all block">
                            @if(count($post->comments))
                                <br>
                                view all <a href="#">{{count($post->comments)}} comments</a>
                            @endif
                        </div><!-- /.inner-all -->
                        <div class="line no-margin"></div><!-- /.line -->
                        @foreach($post->comments as $comment)
                            <div class="media inner-all no-margin">
                                <div class="pull-left">
                                    <form action=""  method="post">
                                       <input type="hidden" name>

                                    <img src="{{asset('users/imageProfile/'.$comment->user->image_profile)}}"
                                         alt="..."
                                         class="img-post2">
                                    </form>
                                </div><!-- /.pull-left -->
                                <div>
                                    @if($comment->likes)

                                        @php
                                            $pos=0;
                                            $neg=0;
                                                foreach ($comment->likes as $like){
                                                     $like->like===0 ? --$neg : ++$pos;
                                                    }
                                        @endphp

                                    @endif
                                </div>
                                <div class="media-body">
                                    <a href="#" class="h4">{{$comment->user->name}}</a>
                                    <small class="block text-muted">{{$comment->comment}}. </small>
                                    <em class="text-xs text-muted">on <span
                                            class="text-danger">{{$comment->created_at}}</span></em>
                                    <br/>
                                    {{$pos}}
                                    <form method="post" action="{{route('likeComment')}}" class="">
                                        @csrf
                                        <input type="hidden" value="{{$comment->id}}" name="commentId">
                                        <input type="hidden" value="{{auth()->user()->id}}" name="userId">
                                        <button type="submit"><i class="fa fa-thumbs-o-up"></i></button>
                                    </form>
                                    {{$neg}}
                                    <form method="post" action="{{route('disLikeComment')}}" class="">
                                        @csrf
                                        <input type="hidden" value="{{$comment->id}}" name="commentId">
                                        <input type="hidden" value="{{auth()->user()->id}}" name="userId">
                                        <button type="submit"><i class="fa fa-thumbs-o-down"></i></button>
                                    </form>
                                </div><!-- /.media-body -->
                            </div><!-- /.media -->
                            <div class="line no-margin"></div>
                        @endforeach
                    </div><!-- /.panel-body -->
                    <div class="panel-footer">
                        <form action="{{route('createComment')}}" class="form-horizontal" method="post">
                            @csrf
                            <div class="form-group has-feedback no-margin">
                                <input type="hidden" value="{{auth()->user()->id}}" name="userId">
                                <input type="hidden" value="{{$post->id}}" name="postId">
                                <input class="form-control" type="text" placeholder="Your comment here..." name="comment">
                                <br/>
                                <button type="submit"
                                        class="btn btn-theme btn-primary form-control"> send
                                </button>
                            </div>
                        </form>
                    </div><!-- /.panel-footer -->
                </div><!-- /.panel -->
            </div>
    @endforeach
@endsection
