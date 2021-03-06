<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Licet | SmS</title>
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
                                    {{-- <span class="hidden-xs">{{ Auth::user()->name }}</span> --}}
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
                            <li class="">
                                <a href="{{url('/selectionList')}}">
                                    <i class="fa fa-dashboard"></i> 
                                    <span>Selection List</span>
                                </a>
                            </li>
                            <li class="active">
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
                        <li class="">Sms</li>
                        <li class="active">Add Sms Template</li>

                    </ol>
                </section>
                <section class="content">
                        <div class="box box-success">
                            <div class="box-body">
                                <form id="temaplate_form" name="temaplate_form" method="post">
                                    <table id="temaplate_table" width="100%" cellspacing="10" cellpadding="10" class="table table-striped">
                                       
                                        <tr class="form-group">
                                            <td >Sms Template Name <sup class="mandatory">*</sup></td>
                                            <td>:</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-xs-6 form-input">
                                                        <input name="template_name" id="template_name" type="text" required='required' placeholder="Enter Department Name" class="validate[required] text-input form-control" />
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="form-group">
                                            <td >Place Holder <sup class="mandatory">*</sup></td>
                                            <td>:</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-xs-6 form-input">
                                                        <select name="placeholder" id="placeholder"  class="placeholder" title="Select year" data-actions-box="true" data-live-search="true" >
                                                                <option value="%%Father's Name%%" selected>%%Father's Name%%</option>
                                                                <option value="%%Student Name%%" selected>%%Student Name%%</option>
                                                                <option value="%%Father's Mobile Number%%" selected>%%Father's Mobile Number%%</option>
                                                                <option value="%%Student Mobile Number%%" selected>%%Student Mobile Number%%</option>
                                                        </select>                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="form-group">
                                            <td >Message <sup class="mandatory">*</sup></td>
                                            <td>:</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-xs-6 form-input">
                                                            <textarea rows="10" cols="30" name="placeholder_text" id="placeholder_text" class="validate[required] text-input form-control"></textarea>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>         
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                    </table>
                                    <div class="box-footer clearfix remove-border-top">
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
                $(document).ready(function(){
                    $('#temaplate_form').submit(function (event) {
                            event.preventDefault();
                            var template_name =  $('#template_name').val();
                            var placeholder_text =  $('#placeholder_text').val();
                            disableButton();
                                $.ajax({
                                    type: 'POST',
                                    url : '{{url("/sms/addtemplate/")}}',
                                    data: {
                                        template_name : template_name,
                                        placeholder_text          : placeholder_text,
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
                                        window.location.href="{!! url('/sms') !!}";
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
                        $("#placeholder").on("change", function(){
                            var vale = $("#placeholder option:selected").text();
                            insertAtCaret('placeholder_text', vale)
                        });   
                });

                function insertAtCaret(areaId, text) {
                    var txtarea = document.getElementById(areaId);
                    if (!txtarea) {
                        return;
                    }

                    var scrollPos = txtarea.scrollTop;
                    var strPos = 0;
                    var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ?
                        "ff" : (document.selection ? "ie" : false));
                    if (br == "ie") {
                        txtarea.focus();
                        var range = document.selection.createRange();
                        range.moveStart('character', -txtarea.value.length);
                        strPos = range.text.length;
                    } else if (br == "ff") {
                        strPos = txtarea.selectionStart;
                    }

                    var front = (txtarea.value).substring(0, strPos);
                    var back = (txtarea.value).substring(strPos, txtarea.value.length);
                    txtarea.value = front + text + back;
                    strPos = strPos + text.length;
                    if (br == "ie") {
                        txtarea.focus();
                        var ieRange = document.selection.createRange();
                        ieRange.moveStart('character', -txtarea.value.length);
                        ieRange.moveStart('character', strPos);
                        ieRange.moveEnd('character', 0);
                        ieRange.select();
                    } else if (br == "ff") {
                        txtarea.selectionStart = strPos;
                        txtarea.selectionEnd = strPos;
                        txtarea.focus();
                    }

                    txtarea.scrollTop = scrollPos;
                }
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    </body>
<html>


    