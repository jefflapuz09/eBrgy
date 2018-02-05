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
      <h3 class="box-title">Blotter Records</h3>
      <div class="box-tools pull-right">
        <a href="{{ url('/Blotter/Create') }}" class="btn btn-xs btn-success">New Blotter</a>
      </div>
    </div>
    <div class="box-body">
        <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Case No.</th>
                    <th>Complainant</th>
                    <th>Complained Resident</th>
                    <th>Date of Filing</th>
                    <th>Person-in-charge</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($post as $posts)
                <tr>
                    <td><span style="color:red;">000{{$posts->id}}</span></td>
                    <td>{{$posts->com->firstName}} {{$posts->com->middleName}} {{$posts->com->lastName}}</td>
                    <td>{{$posts->comRes->firstName}} {{$posts->comRes->middleName}} {{$posts->comRes->lastName}}</td>                    
                    <td>{{ Carbon\Carbon::parse($posts->created_at)->toFormattedDateString()  }}</td>
                    <td>{{$posts->officerCharge}}</td>
                    <td>{{$posts->description}}</td>
                    <td>
                        <a href="{{ url('/Blotter/Edit/id='.$posts->id) }}" onclick="return updateForm()" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Update record">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <a href="{{ url('/Blotter/Deactivate/id='.$posts->id) }}"  onclick="return deleteForm()" type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Deactivate record">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="form-group pull-right">
            <label class="checkbox-inline"><input type="checkbox"  onclick="document.location='{{ url('/Blotter/Soft') }}';" id="showDeactivated"> Show deactivated records</label>
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