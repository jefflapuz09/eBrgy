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
      <h3 class="box-title">Queries</h3>
      <div class="box-tools pull-right">
        {{--  <a href="{{ url('/Household/Create') }}" class="btn btn-xs btn-success">New </a>  --}}
      </div>
    </div>
    <div class="box-body">
            <div class="input-group" style="margin-bottom:20px;">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <select id="queryId" name="queryId" class="form-control">
                        <option></option>
                        <option value="1">List of Registered Voters</option>
                        <option value="2">List of Male Residents</option>
                    </select>
                </div>
                <div class="panel panel-primary pan1 hidden">
                        <div class="panel-heading">List of Registered Voters</div>
                        <div class="panel-body">
                            <table id="list1" class="table table-striped table-bordered responsive">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Civil Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($voter as $v)
                                        <tr>
                                        <td>{{$v->Resident->firstName}} {{$v->Resident->lastName}}</td>
                                        <td>
                                            @if($v->Resident->gender == 1)
                                            Male
                                            @else
                                            Female
                                            @endif
                                            
                                        </td>
                                        <td>{{$v->Resident->civilStatus}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="panel panel-primary pan2 hidden">
                            <div class="panel-heading">List of Male Residents</div>
                            <div class="panel-body">
                                <table id="list2" class="table table-striped table-bordered responsive">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Civil Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($male as $m)
                                            <tr>
                                            <td>{{$m->firstName}} {{$m->lastName}}</td>
                                            <td>
                                                @if($m->gender == 1)
                                                Male
                                                @else
                                                Female
                                                @endif
                                                
                                            </td>
                                            <td>{{$m->civilStatus}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    
    var pan = null;
    $(document).ready(function (){
        $('#query').addClass('active');
        $('#list1').DataTable({
            responsive: true,
        });
        $('#list2').DataTable({
            responsive: true,
        });
    });

    $('#queryId').on('change', function() {          
        if(pan!=null){
            $(pan).addClass('hidden');
        }
        pan = $('.pan'+$(this).val()).removeClass('hidden');
    });

</script>
@stop