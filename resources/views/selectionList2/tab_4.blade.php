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
                                    <div class="box-body">
                                        <table id="example4" class="table table-bordered table-striped ">
                                            <thead>
                                                <tr>
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
