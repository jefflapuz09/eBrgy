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
      <h3 class="box-title">Project Records</h3>
      <div class="box-tools pull-right">
        <a href="{{ url('/Project/Create') }}" class="btn btn-xs btn-success">New Project</a>
      </div>
    </div>
    <div class="box-body">
        <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Project</th>
                    <th>Developer</th>
                    <th>Description</th>
                    <th>Project Started</th>
                    <th>Project Ended</th>
                    <th>Officer in Charge</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($post as $posts)
                <tr>
                    <td>{{$posts->projectName}}</td>
                    <td>{{$posts->projectDev}}</td>
                    <td>{{$posts->description}}</td>                    
                    <td>{{ Carbon\Carbon::parse($posts->dateStarted)->toFormattedDateString()  }}</td>
                    <td>{{ Carbon\Carbon::parse($posts->dateEnded)->toFormattedDateString()  }}</td>
                    <td>{{$posts->officerCharge}}</td>
                    <td>
                            <a href="{{ url('/Project/Reactivate/id='.$posts->id) }}"  onclick="return reacForm()"  type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Reactivate record">
                                <i class="fa fa-recycle" aria-hidden="true"></i>
                            </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="form-group pull-right">
            <label class="checkbox-inline"><input type="checkbox"  onclick="document.location='{{ url('/Project') }}';" id="showDeactivated"> Show active records</label>
         </div>
    </div>
</div>
@endsection

@section('script')
<script>
    
        function reacForm(){
            var x = confirm("Are you sure you want to reactivate this record?");
            if (x)
              return true;
            else
              return false;
         }

</script>
@stop