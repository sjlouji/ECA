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
                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered table-striped ">
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
<script>
   

</script>
@stop
