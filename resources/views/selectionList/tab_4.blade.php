<section class="content">
                    <div class="row">
                            <div class="col-xs-12">
                            
                                    <div class="box-header">
                                        <h3 class="box-title">Rural and Poor</h3>
                                    </div>
                                    <select name="department_selec3" id="department_selec3" class="selectpicker" title="Select department" data-actions-box="true" data-live-search="true" >
                                        @foreach ($department_name as $dep)
                                            <option value="{{$dep->department_name}}" selected>{{$dep->department_name}}</option>
                                        @endforeach         
                                    </select>
                                    <select name="year_of_selection3" id="year_of_selection3" class="selectpicker" title="Year" data-actions-box="true" data-live-search="true" >
                                        @foreach ($year as $years)
                                            <option value="{{$years->year}}" selected>{{$years->year}}</option>
                                        @endforeach         
                                    </select>
                                    <button type="button" class="btn btn-success selectionList" id="buttonSelectionList1" onclick="window.open('{{url('/selectionList/selectionlist1RP/')}}')" style="float:right;margin-right:25px;margin-top:10px"><span class="fa  fa-level-down"></span>Export Selected</button>
                                    <select name="paidornotpaind3" id="paidornotpaind3" class="selectpicker" title="Paid Status Update" data-actions-box="true" >
                                            <option value="Paid" selected>Paid</option>
                                            <option value="Not_paid" selected>Not Paid</option>
                                </select>
                                    <button type="button" id="selectionListView4" class="btn btn-primary" style="float:right;margin-right:25px;margin-top:10px" ><span class="fa fa-exchange"></span> Change paid Status</button>

                                    <div class="box-body">
                                        <table id="example4" class="table table-bordered table-striped ">
                                            <thead>
                                                <tr>
                                                        <th><div class="pretty p-icon p-jelly" style="margin-left: 40%"><input type="checkbox" name="select_all" value="1" id="example-select-all4"><div class="state p-primary"><i class="icon mdi mdi-check"></i><label></label></div></div></th>
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

@section('scripts')

@stop
