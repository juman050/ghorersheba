<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ghorer-Sheba | @yield('title')</title>

    <!-- Styles -->




    
    <link href="{{ asset('public/admin/select2/dist/css/select2.min.css') }}" rel="stylesheet">

    <!-- datatable -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/datatable/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/datatable/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/datatable/responsive.bootstrap.min.css')}}">

    <link href="{{ asset('public/front/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    
    <style type="text/css">
        .navbar-default {
            background-color: #38c137;
            border-color: #38c137;
            
        }
        .navbar-default .navbar-nav>li>a, .navbar-default .navbar-text ,.navbar-default .navbar-brand{
            color: #fff;
        }
        .form-control {
            border: 1px solid #6d6d6d;
            border-radius: 0px; 
            box-shadow: none;
            outline: 0;
        }
        .form-control:focus{
            outline: 0;
            border-color: none;
            box-shadow: none;
        }
        .panel-body .btn {
            border-radius: 0px;
        }
        .help-block {
            color: #ff7070;
        }
        @media (min-width: 768px) {

            .brand-pills > li > a {
                border-top-right-radius: 0px;
                border-bottom-right-radius: 0px;
            }
        }
        .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
                color: #fff;
                background-color: #38c137;
        }
        .nav-pills>li>a {
            border-radius: 4px;
            color: #38c137;
        }

        table.dataTable thead th {
        position: relative;
        background-image: none !important;
    }
  
    table.dataTable thead th.sorting:after,
    table.dataTable thead th.sorting_asc:after,
    table.dataTable thead th.sorting_desc:after {
        position: absolute !important;
        top: 12px !important;
        right: 8px !important;
        display: block !important;
        font-family: FontAwesome !important;
    }
    table.dataTable thead th.sorting:after {
        content: "\f0dc" !important;
        color: #000 !important;
        font-size: 0.8em !important;
        padding-top: 0.12em !important;
    }
    table.dataTable thead th.sorting_asc:after {
        content: "\f0de" !important;
    }
    table.dataTable thead th.sorting_desc:after {
        content: "\f0dd" !important;
    }
    .card {
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 3px;
        font-size: 18px;
        font-weight: 600;
        background: #525252;
        color: #fff;
    }

    .btn span.fa.fa-ok {               
        opacity: 0;             
    }
    .btn.active span.fa.fa-ok {                
        opacity: 1;             
    }

</style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        <!-- {{ config('app.name', 'Laravel') }} -->
                        Ghorer-Sheba
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a></li>
                            <li><a href="{{ url('/') }}" target="_blank"><i class="fa fa-eye"></i> View Site</a></li>
                           <!--  <li><a href="{{ route('register') }}">Register</a></li> -->
                        @else
                        <li class="dropdown">
                            <?php 
                                $pending_orders = count(DB::table('orders')->where('order_status',0)->get());
                            ?>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i> Orders <?php if($pending_orders>0){?><span class="badge">{{ $pending_orders }}</span><?php } ?> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    
                                    <li><a href="{{ url('/orders') }}">Orders </a></li>
                                    <li><a href="{{ url('/orders/pending') }}">Pending <?php if($pending_orders>0){?><span class="badge">{{ $pending_orders }}</span><?php } ?></a></li>
                                    <li><a href="{{ url('/orders/completed') }}">Completed</a></li>
                                    <li><a href="{{ url('/orders/cancelled') }}">Cancelled</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre><i class="fa fa-group"></i> Users <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/users') }}">Add User</a></li>
                                    <li><a href="{{ url('/users') }}">Users</a></li>
                                </ul>
                            </li>
                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre><i class="fa fa-truck"></i> Services <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/services') }}">Add Service</a></li>
                                    <li><a href="{{ url('/services') }}">Services</a></li>
                                    <li><a href="{{ url('/sub_services') }}">Add Sub Services</a></li>
                                    <li><a href="{{ url('/sub_services') }}">Sub Services</a></li>
                                </ul>
                            </li>
                       
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    <i class="fa fa-globe" aria-hidden="true"></i> City <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/cities') }}">Add City</a></li>
                                    <li><a href="{{ url('/cities') }}">Cities</a></li>
                                </ul>
                            </li>
                            <?php 
                                $pending_message = count(DB::table('contacts')->where('status',0)->get());
                            ?>
                            <li><a href="{{ url('/messages') }}"><i class="fa fa-envelope"></i> Messages <?php if($pending_message>0){?><span class="badge">{{ $pending_message }}</span><?php } ?></a></li>
                            <?php 
                                $request_calls = count(DB::table('request_calls')->where('req_status',0)->get());
                            ?>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    <i class="fa fa-help" aria-hidden="true"></i> Requests <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/requested-calls') }}">Requested Call</a></li>
                                    <li><a href="{{ url('/requested-services') }}">Requested Services</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/setting') }}"><i class="fa fa-gear"></i> Settings</a></li>
                            <li><a href="{{ url('/') }}" target="_blank"><i class="fa fa-eye"></i> View Site</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre><i class="fa fa-user" aria-hidden="true"></i> 
                                <?php $admin_name = explode(' ', Auth::user()->name); ?>
                                {{ $admin_name[0] }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('/setting') }}">
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('public/front/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/admin/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/jquery.slugify.js') }}"></script>



    <!-- datatable -->
    <script type="text/javascript" src="{{ asset('public/admin/datatable/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/datatable/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/datatable/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/datatable/responsive.bootstrap.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#datatable').DataTable( {
                responsive: true,
                order: [
                    [0, 'desc']
                ]
            } );
        } );
    </script>
    @stack('scripts')
</body>
</html>
