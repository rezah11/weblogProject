<div class="col-md-12 grid-margin">
    <div class="card rounded">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img class="img-xs rounded-circle"
                         src="{{asset('users/imageProfile/'.auth()->user()->image_profile)}}" alt="">
                    <div class="ml-2">
                        <p>{{auth()->user()->name}}</p>
                        <p class="tx-11 text-muted">{{$post->created_at}}</p>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="dropdownMenuButton2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-more-horizontal icon-lg pb-3px">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5" cy="12" r="1"></circle>
                        </svg>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-meh icon-sm mr-2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="8" y1="15" x2="16" y2="15"></line>
                                <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                <line x1="15" y1="9" x2="15.01" y2="9"></line>
                            </svg>
                            <span class="">Unfollow</span></a>
                        <a class="dropdown-item d-flex align-items-center" href="
                            {{route('userPost',['edit'=>$post->id])}}
{{--{{url('postUser/'.$post->id)}}--}}
                            ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-corner-right-up icon-sm mr-2">
                                <polyline points="10 9 15 4 20 9"></polyline>
                                <path d="M4 20h7a4 4 0 0 0 4-4V4"></path>
                            </svg>
                            <span class="">edit post</span></a>
                        <a class="dropdown-item d-flex align-items-center" href="{{route('deletePost',['id'=>$post->id])}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-share-2 icon-sm mr-2">
                                <circle cx="18" cy="5" r="3"></circle>
                                <circle cx="6" cy="12" r="3"></circle>
                                <circle cx="18" cy="19" r="3"></circle>
                                <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                            </svg>
                            <span class="">Delete Post</span></a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-copy icon-sm mr-2">
                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                <path
                                    d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                            </svg>
                            <span class="">Copy link</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p class="mb-3 tx-14">{{$post->title}}</p>
            <p class="mb-3 tx-14">{{$post->summary}}</p>
            <p class="mb-3 tx-14">{{$post->content}}</p>
            @if($post->images)
                @foreach($post->images as $image)
                    <img class="img-fluid" src="{{asset('postPics/'.$image->image_url)}}" alt="">

                @endforeach
            @endif
        </div>
        <div>
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
                {{$postPos}}<a href="#"> <i class="fa fa-thumbs-o-up"></i> </a>
                {{$postNeg}}<a href="#"> <i class="fa fa-thumbs-o-down"></i> </a>
            @endif
        </div>
        <div class="card-footer">
            <div class="d-flex post-actions">
                <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-heart icon-md">
                        <path
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                    <p class="d-none d-md-block ml-2">Like</p>
                </a>
                <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-message-square icon-md">
                        <path
                            d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <p class="d-none d-md-block ml-2">Comment</p>
                </a>
                <a href="javascript:;" class="d-flex align-items-center text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-share icon-md">
                        <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                        <polyline points="16 6 12 2 8 6"></polyline>
                        <line x1="12" y1="2" x2="12" y2="15"></line>
                    </svg>
                    <p class="d-none d-md-block ml-2">Share</p>
                </a>
            </div>

            @foreach($post->comments as $comment)
                <div class="media inner-all no-margin">
                    <div class="pull-left">
                        <img src="{{asset('users/imageProfile/'.$comment->user->image_profile)}}"
                             alt="..."
                             class="img-post2">
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
                        <a href="#" class="">{{$comment->user->name}}</a>
                        <small class="block">{{$comment->comment}}</small>
                        <br />
                        <small class="text-xs text-muted">on <span
                                class="">{{$comment->created_at}}</span></small>
                        <br/>
                        {{$pos}} <a href="#"> <i class="fa fa-thumbs-o-up"></i> </a>
                        {{$neg}} <a href="#"> <i class="fa fa-thumbs-o-down"></i> </a>
                    </div><!-- /.media-body -->
                </div><!-- /.media -->
                <div class="line no-margin"></div>
            @endforeach
        </div>
    </div>
</div>
