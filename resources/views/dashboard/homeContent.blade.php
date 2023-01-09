@if(auth()->user()->isAdmin())
    <div class="btn btn-primary">all users</div>
    <div class="btn btn-primary">all posts</div>
    <div class="btn btn-primary">all users</div>
    <h1>
        this is admin
    </h1>
@elseif(auth()->user()->isManager())
    <h1>this is manager</h1>
@else
    <h1>this is user</h1>
@endif
