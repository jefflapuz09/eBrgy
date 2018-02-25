@extends('dashboard')

@section('style')
<link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
@stop

@section('content')
<script src="{{  asset('js/jquery.min.js')  }}"></script>
<script src="{{  asset('js/toastr.js')  }}"></script>
@if(session('success'))
<script type="text/javascript">
    toastr.success(' <?php echo session('success'); ?>', 'Success!')
</script>
@endif
@if(session('error'))
<script type="text/javascript">
    toastr.error(' <?php echo session('error'); ?>', "There's something wrong!")
</script>
@endif
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Report</h3>
      <div class="box-tools pull-right">
        {{--  <a href="{{ url('/Household/Create') }}" class="btn btn-xs btn-success">New </a>  --}}
      </div>
    </div>
    <div class="box-body">
          <div class="form-group">
              <div class="row">
              
                {{csrf_field()}}
                    <div class="col-sm-5">
                        <label>Date Started</label>
                        <div class='input-group date' id='datetimepicker1'>
                                <input type='text' name="start" id="start" value="{{ old('date') }}" placeholder="YYYY-MM-DD"  class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                    </div>
                    <div class="col-sm-5">
                            <label>Date Ended</label>
                            <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' name="end" id="end" value="{{ old('date') }}" placeholder="YYYY-MM-DD"  class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <button type="submit" id="gen" class="btn btn-success" style="margin-top:25px;">Generate</button>
                        </div>
                        <div class="col-sm-1">
                            <a id="pdf" target="_blank" class="btn btn-success" style="margin-top:25px;">Pdf</a>
                        </div>
              
              </div>
              <div class="panel panel-primary pan1" style="margin-top:20px;">
                    <div class="panel-heading">List of Registered Voters</div>
                    <div class="panel-body">
                        <table id="list1" class="table table-striped table-bordered responsive">
                            <thead>
                                <tr>
                                    <th>CaseNo</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
          </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#list1').DataTable({
            responsive: true,
        });

        $('#gen').on('click',function(){
           var start = $('#start').val();
           var end = $('#end').val();

           $.ajax({   
            type: "get",
            url: "/Report/Table/"+start+"/"+end,             
            contentType: "application/json; charset=utf-8",
            dataType: "json",                  
            success: function(data)
                {   
                    $('#list1').DataTable( {
                        columns: [{
                            "data" : "data.firstName"
                        }]
                    
                    });
                }
            });
        });

        $('#pdf').on('click',function(){
            var start = $('#start').val();
            var end = $('#end').val();

            $.ajax({   
            type: "get",
            url: "/Report/Pdf/"+start+"/"+end,             
            contentType: "application/json; charset=utf-8",
            dataType: "json",                  
            success: function(data)
                {   
                   console.log('success');
                }
            });
        });
</script>
@stop