<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Licet | Admission</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{asset('/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('/bower_components/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('/bower_components/Ionicons/css/ionicons.min.css')}}">
        <link rel="stylesheet" href="{{asset('/bower_components/jvectormap/jquery-jvectormap.css')}}">
        <link rel="stylesheet" href="https:/fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="{{asset('/bower_components/admin-lte/dist/css/AdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{asset('/bower_components/admin-lte/dist/css/skins/_all-skins.min.css')}}">
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
                                    <span>Users</span>
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
                            <li class="">
                                <a href="{{url('/department')}}">
                                    <i class="fa fa-dashboard"></i> 
                                    <span>Department</span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="{{url('/admission')}}">
                                    <i class="fa fa-dashboard"></i> 
                                    <span>Admission</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{url('/selectionList')}}">
                                    <i class="fa fa-dashboard"></i> 
                                    <span>Selection List</span>
                                </a>
                            </li>
                            <li class="">
                                    <a href="{{url('/sms')}}">
                                        <i class="fa fa-dashboard"></i> 
                                        <span>Sms</span>
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
                        <li class="active">Admission</li>
                        <li class="active">View User</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="box box-success">
                    <div style="margin-top: 10px; margin-right: 10px;margin-bottom: 10px">
                           
                                </div>
                        <div class="box-body">
                            <table id="temaplate_table" width="100%" cellspacing="10" cellpadding="" class="table table-striped">
                                <tr class="form-group">
                                    <td >Id </td>
                                    <td>:</td>
                                    <td>
                                        {{ $department->id }}
                                    </td>
                                </tr>
                                
                                <tr class="form-group">
                                    <td >Register Number </td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->application_no }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Name</td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->student_name }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Year of Addmission</td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->year_of_addmission }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Catholic or Non - Catholic </td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->catholic_or_non_catholic }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Dalith or Non - Dalith </td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->calit_or_non_dalit }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Maths </td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->maths }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Physics </td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->physics }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Chemistry </td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->chemistry }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Cut - Off </td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->cut_off }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Choice 1 </td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->choice_1 }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Choice 2 </td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->choice_2 }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Religion </td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->religion }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Community </td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->community }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Caste </td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->caste }}
                                    </td>
                                </tr> <tr class="form-group">
                                    <td >Board </td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->board }}
                                    </td>
                                </tr>

                                <tr class="form-group">
                                    <td >Year of Passing </td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->year_of_passing }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Father's Name </td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->father_name }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Father's designation </td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->father_designation }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Mother's Name </td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->mother_name }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Mother's Designation </td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->mother_designation }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Montly Income</td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->monthly_income }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Father's Mobile Number</td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->father_mobile_no }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Mother's Mobile Number</td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->mother_mobile_no }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Created At</td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->created_at }}
                                    </td>
                                </tr>
                                <tr class="form-group">
                                    <td >Updated At</td>
                                    <td>:</td>
                                    <td>
                                    {{ $department->updated_at }}
                                    </td>
                                </tr>
                            </table>
                            <div class="box-footer clearfix remove-border-top">
                                <div>
                                    <table width="100%">
                                        <tr>
                                            <td align="center">
                                                <a href="{{url('/admission')}}"><input type="button" value="Back" title="Back"  class="btn btn-danger"></a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
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
    </body>
<html>