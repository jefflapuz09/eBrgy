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
      <h3 class="box-title">Business Management</h3>
      <div class="box-tools pull-right">
        <a href="{{ url('/Business/Create') }}" class="btn btn-xs btn-success">New Business</a>
      </div>
    </div>
    <div class="box-body">
        <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Business</th>
                    <th>Address</th>
                    <th>Owner</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($post as $posts)
                <tr>
                    <td>{{$posts->name}}</td>
                    <td>{{$posts->street}} {{$posts->brgy}} {{$posts->city}}</td>
                    <td>{{$posts->Resident->firstName}} {{$posts->Resident->lastName}}</td>
                    <td>
                        <a href="{{ url('/Business/Edit/id='.$posts->id) }}" onclick="return updateForm()" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Update record">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </a>
                        <a href="{{ url('/Business/Deactivate/id='.$posts->id) }}"  onclick="return deleteForm()" type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Deactivate record">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                        <a href="{{ url('/BusinessPermit/Print/'.$posts->id) }}"  target="_blank" type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Print">
                            <i class="fa fa-print" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="form-group pull-right">
            <label class="checkbox-inline"><input type="checkbox"  onclick="document.location='{{ url('/Business/Soft') }}';" id="showDeactivated"> Show deactivated records</label>
         </div>
    </div>
</div>
@endsection

@section('script')
<script>
    
    function updateForm(){
        var x = confirm("Are you sure you want to modify this record?");
        if (x)
          return true;
        else
          return false;
     }

     function deleteForm(){
        var x = confirm("Are you sure you want to deactivate this record? All items included in this record will also be deactivated.");
        if (x)
          return true;
        else
          return false;
     }

</script>
@stop