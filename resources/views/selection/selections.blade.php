<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Licet | Admission</title>
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
                    </ol>
                </section>
                <section class="content">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Selection Process</h3>
                        </div>
                        <div class="box-body">
                            @can('isAdmin')
                            <div style="margin-bottom:30px">
                            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- <input type="file" name="file" accept=".csv" style="float:right;width:170px;"> -->
                                    <br>
                                    <!-- <button class="btn btn-success" style="float:right;margin-right:25px;margin-top:10px">Import User Data</button> -->
                                    <button type="button" class="btn btn-success" style="float:right;margin-right:25px;margin-top:10px" data-toggle="modal" data-target="#myModal">Import Admission file</button>
                            </form>
                                <button type="button" class="btn btn-success selectionList" id="buttonSelectionList1" style="float:right;margin-right:25px;margin-top:10px">Generate Selection List</button>
                                @yield('csv_data')
                                <select name="yearofselection" id="yearofselection" class="selectpicker" title="Select year" data-actions-box="true" data-live-search="true" >
                                    @foreach ($year as $years)
                                        <option value="{{$years->year}}" selected>{{$years->year}}</option>
                                    @endforeach         
                                </select>
                               
                            </div>
                            @endCan
                            <table id="example1" class="table table-bordered table-striped" style="margin-top:10px">
                                            <thead>
                                                <tr>
                                                    <th>Application Number</th>
                                                    <th>Year</th>
                                                    <th>Student Name</th>
                                                    <th>Cut off</th>
                                                    <th>Roman Catholic</th>
                                                    <th>Religion</th>
                                                    <th>Board</th>
                                                    <th>Caste</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Application Number</th>
                                                    <th>Year</th>
                                                    <th>Student Name</th>
                                                    <th>Cut off</th>
                                                    <th>Roman Catholic</th>
                                                    <th>Religion</th>
                                                    <th>Board</th>
                                                    <th>Caste</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
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
            <!-- start Modal dialog box for importing the admission list -->
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Import File</h4>
                </div>
                <div class="modal-body">
                                                
                            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                                <div class="col-xs-6 form-input">
                                                    <input name="year_of_joining" id="year_of_joining" type="text" required='required'  placeholder="Year of Joining" class="validate[required] text-input form-control" />
                                                </div><br>
                                    <input type="file" name="file" accept=".csv" style="float:right">
                                    <br>
                                    <button class="btn btn-success" style="margin-top:10px;margin-right: 3px">Import User Data</button>
                            </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>

            </div>
            </div>
            <!-- End of Modal dialog box for importing the admission list -->
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
         <script typetype="text/javascript">
           $('.date-own').datepicker({
                minViewMode: 2,
                format: 'yyyy'
            });
            $(".selectpicker").selectpicker();
            $(document).ready(function(){
                        var table = $('#example1').DataTable({
                            "processing" : true,
                            "serverSide" : true,
                            "ajax":{
                                "url": "{{url("admission/data")}}",
                                type: 'GET',
                                data: function ( d ){
                                    d.yearofadmission = $('#yearofselection').val();
                                }
                            },
                            "columnDefs": [
                                { "orderable": false, "targets":[0] },
                                { "orderable": false, "targets":[1] },
                                { "orderable": false, "targets":[2] },
                                { "orderable": false, "targets":[3] },
                                { "orderable": false, "targets":[4] },
                                { "orderable": false, "targets":[5] },
                                { "orderable": false, "targets":[6] },
                                { "orderable": false, "targets":[7] },
                                { "orderable": false, "targets":[8] },
                            ],
                            "columns":[
                                {"data":"application_no", "name":"application_no"},
					            {"data":"year_of_addmission", "name":"year_of_addmission"},
					            {"data":"student_name", "name":"student_name"},
                                {"data":"cut_off", "name":"cut_off"},
					            {"data":"catholic_or_non_catholic", "name":"catholic_or_non_catholic"},
					            {"data":"religion", "name":"religion"},
					            {"data":"board", "name":"board"},
					            {"data":"caste", "name":"caste"},
                                {"data":null,
                                    "render":function(data,type,row)
                                    {
                                        var templateId = data.id;
                                        return'<a title="View Template" target="_blank" class="" href="{{ url("admission/selection") }}/'+templateId+'/view" style="color:#1E1E1E"><i class="glyphicon glyphicon-eye-open"></i> </a>@can('isAdmin')<a title="Edit Template" target="_blank" class="actionicon" href="{{ url("admission/selection") }}/'+templateId+'/edit" style="color:#1E1E1E"><i class="glyphicon glyphicon-edit"></i> </a></a></a>@endcan';

                                    }
                                }
                            ]

                        });
                        $('#example1 tfoot th ').each( function () {
                            var title = $(this).text();
                            $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
			            });
                        $('#yearofselection').on('change', function(){
                            var myTable = $('#example1').DataTable();  
                            myTable.ajax.reload();
                            myTable.ajax.reload( null, false );
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
                });

                $(document).ready(function(){
                    $('.selectionList').click(function(){
                       var yearofselection =  $('#yearofselection').val();
                        $.ajax({
                            type : 'POST',
                            url : '{{url("/admission/selection/selectionList1")}}',
                             data : {
                                yearofselection : yearofselection,
                                _token        : '{!! csrf_token() !!}'

                             },
                             dataType: 'json',
                             encode: true
                        })
                        .done(function(response){
                            swal({
                                title : 'success',
                                type : 'success',
                                text : response.message,
                                allowEscapeKey : false
                            }),
                            function(){
                                window.location.href  = "{!!url('/admission')!!}";
                            }
                        })
                        .fail(function (jqXHR, textStatus, errorThrown) {
                            enableButton();
                            console.log(jqXHR);
                            swal({
                                title : 'error',
                                type : 'error',
                                text : errorThrown,
                                allowEscapeKey : false
                            }),
                            function(){
                                window.location.href  = "{!!url('/admission')!!}";
                            }
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