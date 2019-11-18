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
        <link rel="stylesheet" href="{{asset('/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('/bower_components/select2/dist/css/select2.min.css')}}">
        <style>
        tfoot{
			    display: table-header-group;
			    width:100px;
			}
		tfoot input {
	        width: 100%;
	        padding: 3px;
	        box-sizing: border-box;
   	 	}
            ::-webkit-input-placeholder {
            font-size: 25px;
            }

            :-moz-placeholder { /* Firefox 18- */
                font-size: 25px;
            }

            ::-moz-placeholder {  /* Firefox 19+ */
                font-size: 25px;
            }

            /* Overriding styles */

            ::-webkit-input-placeholder {
            font-size: 13px!important;
            }

            :-moz-placeholder { /* Firefox 18- */
                font-size: 13px!important;
            }
            ::-moz-placeholder {  /* Firefox 19+ */
                font-size: 13px!important;
            }
            #example1_filter 
            {
                display:none;
            }
        </style>
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
                    <li class="active">Departments</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                            <div class="col-xs-12">
                                <div class="box">
                            
                                    <div class="box-header">
                                        <h3 class="box-title">Departments</h3>
                                    @can('isAdmin')
                                        <button onclick="window.open('{{url('/department/add')}}')" type="button" class="btn btn-block btn-primary btn-normal" style="float:right;width:150px"><span class="fa fa-plus"></span> Add Department </button>
                                    @endcan
                                    </div>
                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered table-striped ">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Department Name</th>
                                                    <th>Management Quota</th>
                                                    <th>Open Catholic</th>
                                                    <th>Roman Catholic</th>
                                                    <th>Dalit Catholic</th>
                                                    <th>Rural / Poor</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                    
                                                <tfoot>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Department Name</th>
                                                    <th>Management Quota</th>
                                                    <th>Open Catholic</th>
                                                    <th>Roman Catholic</th>
                                                    <th>Dalit Catholic</th>
                                                    <th>Rural / Poor</th>
                                                    <th>Action</th>

                                                </tr>
                                            </tfoot>
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
        <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <script src="{{asset('/bower_components/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>

    </body>
    <script>
             $(document).ready(function(){
                        var table = $('#example1').DataTable({
                            "processing" : true,
                            "serverSide" : true,
                            paging: true,
                            bFilter: true,
                            ordering: true,
                            "ajax":{
                                "url": "{{url("department/data")}}",
                            },
                            "columnDefs": [
                                { "orderable": false, "targets":[7] },
                            ],
                            "columns":[
					            {"data":"id", "name":"id"},
                                {"data":"department_name", "name":"department_name"},
					            {"data":"total_seats_management_quota", "name":"total_seats_management_quota"},
					            {"data":"total_seats_open_catholic", "name":"total_seats_open_catholic"},
                                {"data":"total_seats_Roman_catholic", "name":"total_seats_Roman_catholic"},
					            {"data":"total_seats_Dalit_catholic", "name":"total_seats_Dalit_catholic"},
					            {"data":"total_seats_Rural_poor_students", "name":"total_seats_Rural_poor_students"},
                                {"data":null,
                                    "render":function(data,type,row)
                                    {
                                        var templateId = data.id;
                                        return'<a title="View Template" target="_blank" class="" href="{{ url("department/add") }}/'+templateId+'/view" style="color:#1E1E1E"><i class="glyphicon glyphicon-eye-open"></i> </a>@can('isAdmin')<a title="Edit Template" target="_blank" class="actionicon" href="{{ url("department/add") }}/'+templateId+'/edit" style="color:#1E1E1E"><i class="glyphicon glyphicon-edit"></i> </a></a><a title="Edit Template" class="actionicon" href="{{ url("department/add") }}/'+templateId+'/delete" style="color:#1E1E1E"><i class="glyphicon glyphicon-trash"></i> </a></a>@endcan';

                                    }
                                }
                            ]

                        });
                        $('#example1 tfoot th ').each( function () {
                            var title = $(this).text();
                            $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
			            } );
                        table.columns().every( function () {
                            var that = this;
                            $( 'input', this.footer() ).on( 'keyup change', function () {
                                if ( that.search() !== this.value ) {
                                    that
                                        .search( this.value )
                                        .draw();
                                }
                            } );
                        } );

                });

</script>

<html>
