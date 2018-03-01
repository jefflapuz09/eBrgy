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
      <h3 class="box-title">Officer Management</h3>
      <div class="box-tools pull-right">
        <a href="{{ url('/Officer/Create') }}" class="btn btn-xs btn-success">New Officer</a>
      </div>
    </div>
    <div class="box-body">
        <table id="example" class="display table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Position</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($post as $posts)
                    <tr>
                        <td>{{$posts->position}}</td>
                        <td>{{$posts->Resident->firstName}} {{$posts->Resident->middleName}} {{$posts->Resident->lastName}}</td>
                        <td>
                                @if($posts->Resident->gender == 1)
                                    Male
                                @else
                                    Female
                                @endif
                        </td>
                        <td>
                                <a href="{{ url('/Officer/Reactivate/id='.$posts->id) }}"  onclick="return reacForm()"  type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Reactivate record">
                                    <i class="fa fa-recycle" aria-hidden="true"></i>
                                </a>
                                <a href="{{ url('/Officer/Remove/id='.$posts->id) }}"  onclick="return deleteForm()"  type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete record">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="form-group pull-right">
            <label class="checkbox-inline"><input type="checkbox"  onclick="document.location='{{ url('/Officer') }}';" id="showDeactivated"> Show active records</label>
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

         function deleteForm(){
        var x = confirm("Are you sure you want to delete this record?");
        if (x)
          return true;
        else
          return false;
     }

</script>
@stop