<section class="content">
                    <div class="row">
                            <div class="col-xs-12">
                            
                                    <div class="box-header">
                                        <h3 class="box-title">Open Quota</h3>
                                    </div>
                                    <select name="department_select" id="department_select" class="selectpicker" title="Select department" data-actions-box="true" data-live-search="true" >
                                        @foreach ($department_name as $dep)
                                            <option value="{{$dep->department_name}}" selected>{{$dep->department_name}}</option>
                                        @endforeach         
                                    </select>
                                    <select name="year_of_selection" id="year_of_selection" class="selectpicker" title="Year" data-actions-box="true" data-live-search="true" >
                                        @foreach ($year as $years)
                                            <option value="{{$years->year}}" selected>{{$years->year}}</option>
                                        @endforeach         
                                    </select>
                                    <button type="button" class="btn btn-success selectionList" onclick="window.open('{{url('/selectionList/selectionlist1OQ')}}')" id="buttonSelectionList1" style="float:right;margin-right:25px;margin-top:10px"><span class="fa  fa-level-down"></span>Export Selected</button>
                                    <button type="button" id="selectionListView1" class="btn btn-primary" style="float:right;margin-right:25px;margin-top:10px" ><span class="fa fa-exchange"></span> Change paid Status</button>
                                   
                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered table-striped ">
                                            <thead>
                                                <tr>
                                                    <th><div class="pretty p-icon p-jelly" style="margin-left: 40%"><input type="checkbox" name="select_all" value="1" id="example-select-all1"><div class="state p-primary"><i class="icon mdi mdi-check"></i><label></label></div></div></th>
                                                    <th>Application Number</th>
                                                    <th>Student Name</th>
                                                    <th>Department Name</th>
                                                    <th>Mode of Choice</th>
                                                    <th>Year of joining</th>
                                                    <th>Cut off</th>
                                                </tr>   
                                                </thead>          
                                                <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>Application Number</th>
                                                    <th>Student Name</th>
                                                    <th>Department Name</th>
                                                    <th>Mode of Choice</th>
                                                    <th>Year of joining</th>
                                                    <th>Cut off</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                            </div>
                    </div>
                </section>
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
@section('scripts')
<script>
   

</script>
@stop
