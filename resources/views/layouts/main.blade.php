<!DOCTYPE html>
<html lang="en">
{{--{{var_dump($errors->all())}}--}}
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <!--  If you want to help us go here https://www.bootdey.com/help-us -->
    <title>Profile with tabs like facebook page - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container bootstrap snippets bootdeys">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4">
            <div class="panel rounded shadow">
                <div class="panel-body">
                    <div class="inner-all">
                        <ul class="list-unstyled">
                            <li class="text-center">
                                <img data-no-retina="" class="img-circle img-responsive img-bordered-primary"
                                     src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="John Doe">
                            </li>
                            <li class="text-center">
                                <h4 class="text-capitalize">John Doe</h4>
                                <p class="text-muted text-capitalize">web designer</p>
                            </li>
                            <li>
                                <a href="" class="btn btn-success text-center btn-block">PRO Account</a>
                            </li>
                            <li><br></li>
                            <li>
                                <div class="btn-group-vertical btn-block">
                                    <a href="" class="btn btn-default"><i class="fa fa-cog pull-right"></i>Edit Account</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                            <button class="form-control"><i
                                                    class="fa fa-sign-out pull-right"></i>Logout</button>

                                        </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- /.panel -->

            <div class="panel panel-theme rounded shadow">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h3 class="panel-title">Contact</h3>
                    </div>
                    <div class="pull-right">
                        <a href="#" class="btn btn-sm btn-success"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="btn btn-sm btn-success"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="btn btn-sm btn-success"><i class="fa fa-google-plus"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body no-padding rounded">
                    <ul class="list-group no-margin">
                        <li class="list-group-item"><i class="fa fa-envelope mr-5"></i> support@bootdey.com</li>
                        <li class="list-group-item"><i class="fa fa-globe mr-5"></i> www.bootdey.com</li>
                        <li class="list-group-item"><i class="fa fa-phone mr-5"></i> +6281 903 xxx xxx</li>
                    </ul>
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->

        </div>
        <div class="col-lg-9 col-md-9 col-sm-8">

            <div class="profile-cover">
                <div class="cover rounded shadow no-overflow">
                    <div class="inner-cover">
                        <!-- Start offcanvas btn group menu: This menu will take position at the top of profile cover (mobile only). -->
                        <div class="btn-group cover-menu-mobile hidden-lg hidden-md">
                            <button type="button" class="btn btn-theme btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bars"></i>
                            </button>
                            <ul class="dropdown-menu pull-right no-border" role="menu">
                                <li class="active"><a href="#"><i class="fa fa-fw fa-clock-o"></i> <span>Timeline</span></a>
                                </li>
                                <li><a href="#"><i class="fa fa-fw fa-user"></i> <span>About</span></a></li>
                                <li><a href="#"><i class="fa fa-fw fa-photo"></i> <span>Photos</span>
                                        <small>(98)</small></a></li>
                                <li><a href="#"><i
                                            class="fa fa-fw fa-users"></i><span> Friends </span><small>(23)</small></a>
                                </li>
                                <li><a href="#"><i class="fa fa-fw fa-envelope"></i> <span>Messages</span> <small>(7
                                            new)</small></a></li>
                            </ul>
                        </div>
                        <img src="https://bootdey.com/img/Content/flores-amarillas-wallpaper.jpeg"
                             class="img-responsive full-width" alt="cover" style="max-height:200px;">
                    </div>
                    <ul class="list-unstyled no-padding hidden-sm hidden-xs cover-menu">
                        <li class="active"><a href="#"><i class="fa fa-fw fa-clock-o"></i> <span>Timeline</span></a>
                        </li>
                        <li><a href="#"><i class="fa fa-fw fa-user"></i> <span>About</span></a></li>
                        <li><a href="#"><i class="fa fa-fw fa-photo"></i> <span>Photos</span> <small>(98)</small></a>
                        </li>
                        <li><a href="#"><i class="fa fa-fw fa-users"></i><span> Friends </span><small>(23)</small></a>
                        </li>

                    </ul>
                </div><!-- /.cover -->
            </div><!-- /.profile-cover -->
            <div class="divider"></div>
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

                    <textarea class="form-control input-lg no-border" rows="2" placeholder="What are you doing?..." name="content"></textarea>
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
            <div class="col-md-6">
                <div class="panel panel-success rounded shadow">
                    <div class="panel-heading no-border">
                        <div class="pull-left half">
                            <div class="media">
                                <div class="media-object pull-left">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="..."
                                         class="img-circle img-post">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="media-heading block mb-0 h4 text-white">John Doe</a>
                                    <span class="text-white h6">on 8th June, 2014</span>
                                </div>
                            </div>
                        </div><!-- /.pull-left -->
                        <div class="pull-right">
                            <a href="#" class="text-white h4"><i class="fa fa-heart"></i> 15.5K</a>
                        </div><!-- /.pull-right -->
                        <div class="clearfix"></div>
                    </div><!-- /.panel-heading -->
                    <div class="panel-body no-padding">
                        <img src="https://www.bootdey.com/image/340x210/" alt="..."
                             class="img-responsive full-width">
                        <div class="inner-all block">
                            view all <a href="#">7 comments</a>
                        </div><!-- /.inner-all -->
                        <div class="line no-margin"></div><!-- /.line -->
                        <div class="media inner-all no-margin">
                            <div class="pull-left">
                                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="..."
                                     class="img-post2">
                            </div><!-- /.pull-left -->
                            <div class="media-body">
                                <a href="#" class="h4">John Doe</a>
                                <small class="block text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit. </small>
                                <em class="text-xs text-muted">Posted on <span
                                        class="text-danger">Dec 08, 2014</span></em>
                            </div><!-- /.media-body -->
                        </div><!-- /.media -->
                        <div class="line no-margin"></div><!-- /.line -->
                        <div class="media inner-all no-margin">
                            <div class="pull-left">
                                <img src="https://bootdey.com/img/Content/avatar/avatar4.png" alt="..."
                                     class="img-post2">
                            </div><!-- /.pull-left -->
                            <div class="media-body">
                                <a href="#" class="h4">John Doe</a>
                                <small class="block text-muted">Quaerat, impedit minus non commodi facere doloribus
                                    nemo ea voluptate nesciunt deleniti.</small>
                                <em class="text-xs text-muted">Posted on <span
                                        class="text-danger">Dec 08, 2014</span></em>
                            </div><!-- /.media-body -->
                        </div><!-- /.media -->
                    </div><!-- /.panel-body -->
                    <div class="panel-footer">
                        <form action="#" class="form-horizontal">
                            <div class="form-group has-feedback no-margin">
                                <input class="form-control" type="text" placeholder="Your comment here...">
                                <button type="submit"
                                        class="btn btn-theme fa fa-search form-control-feedback"></button>
                            </div>
                        </form>
                    </div><!-- /.panel-footer -->
                </div><!-- /.panel -->
            </div>
            <div class="col-md-6">
                <div class="panel panel-success rounded shadow">
                    <div class="panel-heading no-border">
                        <div class="pull-left half">
                            <div class="media">
                                <div class="media-object pull-left">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="..."
                                         class="img-circle img-post">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="media-heading block mb-0 h4 text-white">John Doe</a>
                                    <span class="text-white h6">on 8th June, 2014</span>
                                </div>
                            </div>
                        </div><!-- /.pull-left -->
                        <div class="pull-right">
                            <a href="#" class="text-white h4"><i class="fa fa-heart"></i> 15.5K</a>
                        </div><!-- /.pull-right -->
                        <div class="clearfix"></div>
                    </div><!-- /.panel-heading -->
                    <div class="panel-body no-padding">
                        <div class="inner-all block">
                            <h4>Upload on my album :D</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita, iste omnis
                                fugiat porro consequuntur ratione iure error reprehenderit cum est ab similique
                                magnam molestias aperiam voluptatibus quia aliquid! Sed, minima.
                            </p>
                            <blockquote class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A,
                                delectus!
                            </blockquote>

                            <img data-no-retina="" src="https://www.bootdey.com/image/340x210/" alt="..."
                                 width="100">
                            <img data-no-retina="" src="https://www.bootdey.com/image/340x210/" alt="..."
                                 width="100">
                            <img data-no-retina="" src="https://www.bootdey.com/image/340x210/" alt="..."
                                 width="100">
                        </div><!-- /.inner-all -->
                        <div class="inner-all bg-success">
                            view all <a href="#">7 comments</a>
                        </div>
                    </div><!-- /.panel-body -->
                    <div class="panel-footer no-padding no-border">
                        <div class="media inner-all no-margin">
                            <div class="pull-left">
                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="..."
                                     class="img-post2">
                            </div><!-- /.pull-left -->
                            <div class="media-body">
                                <a href="#" class="h4">John Doe</a>
                                <small class="block text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit. </small>
                                <em class="text-xs text-muted">Posted on <span
                                        class="text-danger">Dec 08, 2014</span></em>
                            </div><!-- /.media-body -->
                        </div><!-- /.media -->
                        <div class="line no-margin"></div><!-- /.line -->
                        <div class="media inner-all no-margin">
                            <div class="pull-left">
                                <img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="..."
                                     class="img-post2">
                            </div><!-- /.pull-left -->
                            <div class="media-body">
                                <a href="#" class="h4">John Doe</a>
                                <small class="block text-muted">Quaerat, impedit minus non commodi facere doloribus
                                    nemo ea voluptate nesciunt deleniti.</small>
                                <em class="text-xs text-muted">Posted on <span
                                        class="text-danger">Dec 08, 2014</span></em>
                            </div><!-- /.media-body -->
                        </div><!-- /.media -->
                        <div class="line no-margin"></div><!-- /.line -->
                        <form action="#" class="form-horizontal inner-all">
                            <div class="form-group has-feedback no-margin">
                                <input class="form-control" type="text" placeholder="Your comment here...">
                                <button type="submit"
                                        class="btn btn-theme fa fa-search form-control-feedback"></button>
                            </div>
                        </form><!-- /.form-horizontal -->
                    </div><!-- /.panel-footer -->
                </div><!-- /.panel -->
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">

</script>
</body>
</html>
