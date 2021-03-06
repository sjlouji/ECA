<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Licet | SelectionList</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{asset('/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('/bower_components/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('/bower_components/Ionicons/css/ionicons.min.css')}}">
        <link rel="stylesheet" href="{{asset('/bower_components/jvectormap/jquery-jvectormap.css')}}">
        <link rel="stylesheet" href="https:/fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="{{asset('/bower_components/admin-lte/dist/css/AdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{asset('/bower_components/admin-lte/dist/css/skins/_all-skins.min.css')}}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />


        <style>
            .btn{
                margin-left:10px;
            }
            tfoot{
			    display: table-header-group;
			    width:100px;
			}
		tfoot input {
	        width: 100%;
	        padding: 3px;
	        box-sizing: border-box;
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
                            <li class="">
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
                            <li class="active">
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
                        <li class="active">Selection List</li>
                    </ol>
                </section>
                <div class="nav-tabs-custom">
                        <button onclick="window.open('{{url('/department/add')}}')" type="button" class="btn btn-block btn-primary btn-normal" style="float:right;width:150px;margin-top: 10px;margin-bottom: 10px"><span class="fa  fa-level-down"></span> Export All Data </button>
                        <button onclick="window.open('{{url('/department/add')}}')" type="button" class="btn btn-block btn-primary btn-normal" style="float:right;width:200px;margin-top: 10px;margin-bottom: 10px"> Generate selection list 2 </button>

            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Open Quota</a></li>
              <li><a href="#tab_2" data-toggle="tab">Roman Catholic</a></li>
              <li><a href="#tab_3" data-toggle="tab">Dalith Catholic</a></li>
              <li><a href="#tab_4" data-toggle="tab">Rural and Poor </a></li>
            </ul>
            <div class="tab-content" >
                <div class="tab-pane active" id="tab_1" >
                    @include('selectionList.tab_1');
                </div>
                <div class="tab-pane" id="tab_2">
                    @include('selectionList.tab_2');
                </div>
                <div class="tab-pane" id="tab_3">
                    @include('selectionList.tab_3');
                </div>
                <div class="tab-pane" id="tab_4">
                    @include('selectionList.tab_4');
                </div>
            </div>
          </div>
        </div>
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
        
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>       
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
        <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

        <script>
             $(document).ready(function(){
               var table = $('#example1').DataTable({
                   "processing" : true,
                   "serverSide" : true,
                   "bAutoWidth": false,
                   "bFilter": false,
                   
                   "ajax":{
                       "url": "{{url("selectionList/selectionlist1OQ/data")}}",
                       type: 'GET',
                        data: function ( d ){
                            d.department_name = $('#department_select').val();
                            d.year_of_selection = $('#year_of_selection').val();
                        }
                   },
                   "columnDefs": [
                                { "orderable": false, "targets":[0] },
                                { "orderable": false, "targets":[1] },
                                { "orderable": false, "targets":[2] },
                                { "orderable": false, "targets":[3] },
                                { "orderable": false, "targets":[4] },
                                { "orderable": false, "targets":[5] },
                        
                            ],
                   "columns":[
                       {"data":"student_id", "name":"id"},
                       {"data":"student_name", "name":"application_id"},
                       {"data":"department", "name":"department"},
                       {"data":"mode_choice", "name":"mode_choice"},
                       {"data":"cut_off", "name":"cut_off"},
                       {"data":"cut_off", "name":"cut_off"},
                   ]

               });
               $('#example1 tfoot th ').each( function () {
                            var title = $(this).text();
                            $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
                });
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
               
                $('#department_select').on('change', function(){
                    var myTable = $('#example1').DataTable();  
                    myTable.ajax.reload();
                    myTable.ajax.reload( null, false );
                });
                $('#year_of_selection').on('change', function(){
                    var myTable = $('#example1').DataTable();  
                    myTable.ajax.reload();
                    myTable.ajax.reload( null, false );
                });
            });
            // For the next Tab 2
            $(document).ready(function(){
               var table = $('#example2').DataTable({
                   "processing" : true,
                   "serverSide" : true,
                   "bAutoWidth": false,
                   "bFilter": false,
                   "ajax":{
                       "url": "{{url("selectionList/selectionlist1RC/data")}}",
                       type: 'GET',
                        data: function ( d ){
                            d.department_name = $('#department_select1').val();
                            d.year_of_selection = $('#year_of_selection1').val();
                        }
                   },
                   "columns":[
                       {"data":"student_id", "name":"id"},
                       {"data":"student_name", "name":"application_id"},
                       {"data":"department", "name":"department"},
                       {"data":"mode_choice", "name":"mode_choice"},
                       {"data":"cut_off", "name":"cut_off"},
                       {"data":"cut_off", "name":"cut_off"},
                   ]

               });
               $('#example2 tfoot th ').each( function () {
                            var title = $(this).text();
                            $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
                });
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
           
                $('#department_select1').on('change', function(){
                    var myTable = $('#example2').DataTable();  
                    myTable.ajax.reload();
                    myTable.ajax.reload( null, false );
                });
                $('#year_of_selection1').on('change', function(){
                    var myTable = $('#example2').DataTable();  
                    myTable.ajax.reload();
                    myTable.ajax.reload( null, false );
                });
            });
            //for the tab 3
            $(document).ready(function(){
               var table = $('#example3').DataTable({
                   "processing" : true,
                   "serverSide" : true,
                   "bAutoWidth": false,
                   "bFilter": false,
                   "ajax":{
                       "url": "{{url("selectionList/selectionlist1DC/data")}}",
                       type: 'GET',
                        data: function ( d ){
                            d.department_name = $('#department_selec2').val();
                            d.year_of_selection = $('#year_of_selection2').val();

                        }
                   },
                   "columnDefs": [
                                { "orderable": false, "targets":[0] },
                                { "orderable": false, "targets":[1] },
                                { "orderable": false, "targets":[2] },
                                { "orderable": false, "targets":[3] },
                                { "orderable": false, "targets":[4] },
                                { "orderable": false, "targets":[5] },
                        
                            ],
                   "columns":[
                       {"data":"student_id", "name":"id"},
                       {"data":"student_name", "name":"application_id"},
                       {"data":"department", "name":"department"},
                       {"data":"mode_choice", "name":"mode_choice"},
                       {"data":"cut_off", "name":"cut_off"},
                       {"data":"cut_off", "name":"cut_off"},
                   ]

               });
               $('#example3 tfoot th ').each( function () {
                            var title = $(this).text();
                            $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
                });
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
           
                $('#department_selec2').on('change', function(){
                    var myTable = $('#example3').DataTable();  
                    myTable.ajax.reload();
                    myTable.ajax.reload( null, false );
                });
                $('#year_of_selection2').on('change', function(){
                    var myTable = $('#example3').DataTable();  
                    myTable.ajax.reload();
                    myTable.ajax.reload( null, false );
                });
            });
            //For tab 4
            $(document).ready(function(){
               var table = $('#example4').DataTable({
                   "processing" : true,
                   "serverSide" : true,
                   "bAutoWidth": false,
                   "bFilter": false,
                   "ajax":{
                       "url": "{{url("selectionList/selectionlist1RP/data")}}",
                       type: 'GET',
                        data: function ( d ){
                            d.department_name = $('#department_selec3').val();
                            d.year_of_selection = $('#year_of_selection3').val();

                        }
                   },
                   "columnDefs": [
                                { "orderable": false, "targets":[0] },
                                { "orderable": false, "targets":[1] },
                                { "orderable": false, "targets":[2] },
                                { "orderable": false, "targets":[3] },
                                { "orderable": false, "targets":[4] },
                                { "orderable": false, "targets":[5] },
                        
                            ],
                   "columns":[
                       {"data":"student_id", "name":"id"},
                       {"data":"student_name", "name":"application_id"},
                       {"data":"department", "name":"department"},
                       {"data":"mode_choice", "name":"mode_choice"},
                       {"data":"cut_off", "name":"cut_off"},
                       {"data":"cut_off", "name":"cut_off"},
                   ]

               });
               $('#example4 tfoot th ').each( function () {
                            var title = $(this).text();
                            $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
                });
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
              
                $('#department_selec3').on('change', function(){
                    var myTable = $('#example4').DataTable();  
                    myTable.ajax.reload();
                    myTable.ajax.reload( null, false );
                });
                $('#year_of_selection3').on('change', function(){
                    var myTable = $('#example4').DataTable();  
                    myTable.ajax.reload();
                    myTable.ajax.reload( null, false );
                });
            });
        </script>

    </body>
<html>