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
    <link rel="stylesheet" type="text/css"
          href="{{asset('css/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.css')}}">
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
                                     src="{{asset('users/imageProfile/'.auth()->user()->image_profile)}}"
                                     alt="John Doe">
                            </li>
                            <li class="text-center">
                                <h4 class="text-capitalize">{{auth()->user()->name}}</h>
                                    <p class="text-muted text-capitalize">{{auth()->user()->type}}</p>
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
                                                class="fa fa-sign-out pull-right"></i>Logout
                                        </button>

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
                                <li class="active"><a href="sadf"><i class="fa fa-fw fa-clock-o"></i>
                                        <span>Timeline</span></a>
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
                        <li class="active"><a href="{{route('userPost')}}"><i class="fa fa-fw fa-clock-o"></i> <span>Timeline</span></a>
                        </li>
                        <li><a href="#"><i class="fa fa-fw fa-user"></i> <span>following</span></a></li>
                        <li><a href="#"><i class="fa fa-fw fa-users"></i><span>followers</span><small>(23)</small></a>
                        </li>
                        <li><a href="#"><i class="fa fa-fw fa-photo"></i> <span>Photos</span> <small>(98)</small></a>
                        </li>


                    </ul>
                </div><!-- /.cover -->
            </div><!-- /.profile-cover -->
            <div class="divider"></div>
            @yield('content')

            {{-- !!!!posts end!!!!           --}}

        </div>
    </div>
</div>
</div>
<script src="{{asset('js/follow.js')}}" type="text/javascript">

</script>
</body>
</html>
