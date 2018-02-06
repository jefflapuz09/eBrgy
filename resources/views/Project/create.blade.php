@extends('dashboard')

@section('style')
<link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
@stop

@section('content')
<script src="{{  asset('js/jquery.min.js')  }}"></script>
<script src="{{  asset('js/toastr.js')  }}"></script>
@if ($errors->any())
<script type="text/javascript">
    toastr.error(' <?php echo implode('', $errors->all(':message')) ?>', "There's something wrong!")
</script>             
@endif
@if(session('error'))
<script type="text/javascript">
    toastr.error(' <?php echo session('error'); ?>', "There's something wrong!")
</script>
@endif
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">New Project</h3>

    </div>
    <div class="box-body">
      <form action="{{ url('/Project/Store') }}" method="post">
        <div class="row">
            <div class="col-sm-6">
                <div class="" style="padding:10px; background:#252525; color:white;">
                    Project Information
                </div>
                {{csrf_field()}}
                <div class="form-group" style="margin-top:20px;">
                    <input type="text" class="form-control" name="projectName" placeholder="Project Name">
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="projectDev" placeholder="Project Developer">
                    </div>
                    <div class="col-sm-6">
                        <select class="form-control select2" name="officerCharge">
                            @foreach($officer as $of)
                                <option value="{{$of->Resident->firstName}}">{{$of->Resident->firstName}} {{$of->Resident->middleName}} {{$of->Resident->lastName}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class='input-group date' id="">
                                    <input type='text' name="dateStarted" placeholder="Date Started"  class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class='input-group date' id="">
                                    <input type='text' name="dateEnded" placeholder="Date Ended"  class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
                <textarea class="form-control" rows="5" name="description" placeholder="Project Description" id="comment"></textarea>
                <div class="pull-right">
                        <button class="btn btn-primary" style="margin-right:10px; margin-top:20px;">Submit</a>
                </div>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection

@section('script')

@stop