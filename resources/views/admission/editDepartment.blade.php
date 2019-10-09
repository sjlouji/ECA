<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Licet | Department</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{asset('/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('/bower_components/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('/bower_components/Ionicons/css/ionicons.min.css')}}">
        <link rel="stylesheet" href="{{asset('/bower_components/jvectormap/jquery-jvectormap.css')}}">
        <link rel="stylesheet" href="https:/fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="{{asset('/bower_components/admin-lte/dist/css/AdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{asset('/bower_components/admin-lte/dist/css/skins/_all-skins.min.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

    </head>
    <body class="skin-blue fixed sidebar-mini sidebar-mini-expand-feature">
        <div class="wrapper">
            <!-- Start of header -->
            <header class="main-header">
                <a href="index2.html" class="logo">
                    <span class="logo-mini"><b>LI</b>CET</span>
                    <span class="logo-lg"><b>LIC</b>ET</span>
                </a>
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="https://user-images.githubusercontent.com/38372696/64544767-32344000-d345-11e9-9daa-f25bc3cb8cdd.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                    <img src="https://user-images.githubusercontent.com/38372696/64544767-32344000-d345-11e9-9daa-f25bc3cb8cdd.png" class="img-circle" alt="User Image">
                                    <p>
                                        {{ Auth::user()->name }}
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a class="dropdown-item btn btn-default btn-flat" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- End of header -->
            <!-- Start of Sidebar -->
            <aside class="main-sidebar">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="https://user-images.githubusercontent.com/38372696/64544767-32344000-d345-11e9-9daa-f25bc3cb8cdd.png" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>{{ Auth::user()->name }}</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                                    <i class="fa fa-search"></i>
                                </button>
                                </span>
                        </div>
                    </form>
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header"></li>
                            <li class="">
                                <a href="{{url('/home')}}">
                                    <i class="fa fa-dashboard"></i> 
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            @can('isAdmin')
                            <li class="">
                                <a href="{{url('/user')}}">
                                    <i class="fa fa-users"></i> 
                                    <span>Users</span>
                                </a>
                            </li>
                            @endcan
                            <li class="active">
                                <a href="{{url('/department')}}">
                                    <i class="fa fa-dashboard"></i> 
                                    <span>Department</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{url('/admission')}}">
                                    <i class="fa fa-dashboard"></i> 
                                    <span>Admission</span>
                                </a>
                            </li>
                        </li>
                    </ul>
                </section>
            </aside>
            <!-- End of SideBar -->
            <!-- Start of Content -->
 <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        STACK
                        <small>Version 1.0</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Department</li>
                        <li class="active">Edit Department</li>

                    </ol>
                </section>
                <section class="content">
                    <div class="box box-success">
                        <div class="box-body">
                        <form id="temaplate_form" name="temaplate_form" method="post">
                            <table id="temaplate_table" width="100%" cellspacing="10" cellpadding="10" class="table table-striped">
                                    <tr class="form-group">
                                        <td >Department Name <sup class="mandatory">*</sup></td>
                                        <td>:</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-xs-6 form-input">
                                                    <input name="department_name" id="department_name" type="text" required='required' value="{{$user->department_name}}" placeholder="Enter Name" class="validate[required] text-input form-control" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="form-group">
                                        <td >Total Seats in Management Quota <sup class="mandatory">*</sup></td>
                                        <td>:</td>
                                        <td>
                                            <div class="row" >
                                                <div class="col-xs-6 form-input">
                                                <div class="form-group">
                                                <input name="total_seats_management_quota" id="total_seats_management_quota" type="text" required='required' value="{{$user->total_seats_management_quota}}" placeholder="Enter Name" class="validate[required] text-input form-control" />
                                                </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="form-group">
                                        <td >Total Seats in Open Catholic <sup class="mandatory">*</sup></td>
                                        <td>:</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-xs-6 form-input">
                                                <input name="total_seats_Roman_catholic" id="total_seats_Roman_catholic" type="text" required='required' value="{{$user->total_seats_Roman_catholic}}" placeholder="Enter Name" class="validate[required] text-input form-control" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="form-group">
                                        <td >Total Seats in Open Catholic <sup class="mandatory">*</sup></td>
                                        <td>:</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-xs-6 form-input">
                                                    <input name="total_seats_Dalit_catholic" id="total_seats_Dalit_catholic" type="text" required='required' value="{{$user->total_seats_Dalit_catholic}}" placeholder="Enter Name" class="validate[required] text-input form-control" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="form-group">
                                        <td >Total Seats in Dalit Catholic <sup class="mandatory">*</sup></td>
                                        <td>:</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-xs-6 form-input">
                                                    <input name="total_seats_Rural_poor_students" id="total_seats_Rural_poor_students" type="text" required='required' value="{{$user->total_seats_Rural_poor_students}}" placeholder="Enter Name" class="validate[required] text-input form-control" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="form-group">
                                        <td >Total Seats in Open Catholic <sup class="mandatory">*</sup></td>
                                        <td>:</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-xs-6 form-input">
                                                    <input name="total_seats_open_catholic" id="total_seats_open_catholic" type="text" required='required' value="{{$user->total_seats_open_catholic}}" placeholder="Enter Name" class="validate[required] text-input form-control" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div>
                                        <table width="100%">
                                            <tr>
                                                <td align="center">
                                                    <input type="submit" value="Save and Continue" class="btn btn-primary" title="Save" id="save">
                                                    <input type="button" value="Cancel" class="btn btn-secondary" title="Cancel" id="cancel" onclick="window.location='{{url('/department')}}'">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-4 col-md-offset-4" id="error_message" style="margin-top: 25px;"> </div>                                    
                                </div>
                                <div class="col-md-4 col-md-offset-4" id="error_message" style="margin-top: 25px;"> </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </section>
            </div>
            <!-- End of Content -->
            <!-- Start of footer -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Made  by<b><a href="https://www.loujibrotherstest.me">Joan Louji</a>
                </div>
                <strong>Copyright &copy; 2019 <a href="https://www.licet.ac.in">LICET</a>.</strong> All rights
                reserved. 
            </footer>
            <!-- End of Footer -->

        </div>
        <script src="{{asset('/bower_components/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/bower_components/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/bower_components/fastclick/lib/fastclick.js')}}" type="text/javascript"></script>
        <script src="{{asset('/bower_components/admin-lte/dist/js/adminlte.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}" type="text/javascript"></script>
        <script src="{{asset('/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/bower_components/chart.js/Chart.js')}}" type="text/javascript"></script>

        <script>
        $(document).ready(function(){
                $('#temaplate_form').submit(function (event) {
                    event.preventDefault();
                    var department_name = $('#department_name').val();
                    var total_seats = $('#total_seats').val();
                    var total_seats_management_quota = $('#total_seats_management_quota').val();
                    var total_seats_open_catholic  = $('#total_seats_open_catholic').val();
                    var alertDiv = $('#error_message');
                    var total_seats_Roman_catholic = $('#total_seats_Roman_catholic').val();
                    var total_seats_Dalit_catholic = $('#total_seats_Dalit_catholic').val();
                    var total_seats_Rural_poor_students = $('#total_seats_Rural_poor_students').val();
                    var id = {{ $user->id }};
                    disableButton();
                        $.ajax({
                            type: 'POST',
                            url: '{{ url("/user/add/storeUpdate") }}',
                            data: {
                                department_name : department_name,
                                total_seats          : total_seats,
                                total_seats_management_quota          : total_seats_management_quota,
                                total_seats_open_catholic          : total_seats_open_catholic,
                                total_seats_Roman_catholic          : total_seats_Roman_catholic,
                                total_seats_Dalit_catholic          : total_seats_Dalit_catholic,
                                total_seats_Rural_poor_students          : total_seats_Rural_poor_students,
                                id              : id,
                                _token        : '{!! csrf_token() !!}'
                            },
                            dataType: 'json',
                            encode: true
                        })
                        .done(function (response) {
                            enableButton();
                            swal({
                                title: "Success",
                                text: response.message,
                                type: "success",
                                allowEscapeKey: false
                            },
                            function() {
                                window.location.href="{!! url('/department') !!}";
                            });
                        })
                        .fail(function (jqXHR, textStatus, errorThrown) {
                            enableButton();
                            var errors = errorThrown;
                            console.log(errorThrown);
                                var parentDiv = '<div class="alert alert-error alert-dismissible  col-md-12"><ul>  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                                        parentDiv += '<li>' + errorThrown + '. User name Exits it seems'+'</li>';
                                parentDiv += '</ul></div>';
                                alertDiv.html(parentDiv);
                        });
                });
                function disableButton() {
                    $("#save").val("Processing...");
                    $('#cancel').bind('click', function(e){
                        e.preventDefault();
                    });
                }
                function enableButton() {
                    $("#save").val("Save and Continue");
                    $('#cancel').unbind('click');
                }
        });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    </body>
<html>