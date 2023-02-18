@if(auth()->user()->isAdmin())
    <a href="{{route('allUsers')}}" class="btn btn-primary">all users</a>
    <a href="{{route('allPosts')}}" class="btn btn-primary">all posts</a>
    <h1>this is admin</h1>
@elseif(auth()->user()->isManager())
    <a href="{{route('allPosts')}}" class="btn btn-primary">all posts</a>
    <a href="{{route('allComments')}}" class="btn btn-primary">all comments</a>
    <h1>this is manager</h1>
@else
    <h1>this is user</h1>
@endif
