@php
    $postEdit=\App\Models\Post::findOrFail(request()->edit);
@endphp
<div class="col-md-12 grid-margin">
    <div class="card rounded">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img class="img-xs rounded-circle" src="{{asset('users/imageProfile/'.auth()->user()->image_profile)}}" alt="">
                    <div class="ml-2">
                        <p>{{auth()->user()->name}}</p>
                        <p class="tx-11 text-muted">{{$postEdit->created_at}}</p>
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
                        <a class="dropdown-item d-flex align-items-center" href="{{route('deletePost',['id'=>$postEdit->id])}}">
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
{{--                        {{dd($postEdit->id)}}--}}
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
            <form action="{{route('updatePost',['id'=>$postEdit->id])}}" method="post" enctype="multipart/form-data">
                @csrf
{{--                {{var_dump($postEdit->content)}}--}}
                <input class="form-control" type="text" placeholder="title" value="{{$postEdit->title}}" name="title">
                <input class="form-control" type="text" placeholder="summary" value="{{$postEdit->summary}}" name="summary">
                <input class="form-control" type="text" placeholder="content" value="{{$postEdit->content}}" name="content">
                <br>
                @if($postEdit->images)
                    @foreach($postEdit->images as $image)

                        <div style="position:relative;" class="image" id="123">
                            <button class="close AClass">
                                <span id="{{$image->id}}" class="test">&times;</span>
                            </button>
                            <img class="img-fluid" src="{{asset('postPics/'.$image->image_url)}}" alt="">
                        </div>
                    @endforeach
                @endif
                <input class="form-control" type="file" accept=".jpg" name="images[]" multiple/>
                <br />
                <button type="submit" class="btn btn-success">Post</button>
            </form>
            {{--            this is test --}}

            {{--            this is test --}}

        </div>

    </div>
</div>
</div>
