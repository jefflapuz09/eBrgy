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
<div class="row">
    <div class="col-sm-6">
        <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">New Schedule</h3>
            <p class="pull-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are needed to filled out.</p>
            </div>
            <div class="box-body">
                <div class="" style="padding:10px; background:#252525; margin-bottom:20px; color:white;">
                    Schedule Information
                </div>
                <form action="{{ url('/Schedule/Update/id='.$post->id) }}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                            <label>Resident<span style="color:red;">*</span></label>
                            <select class="form-control select2" style="width:100%;" name="residentId">
                                @foreach($resident as $res)
                                  <option value="{{$res->id}}"  @if($post->residentId == $res->id) selected ="selected" @endif>{{$res->firstName}} {{$res->middleName}} {{$res->lastName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date<span style="color:red;">*</span></label>
                              <div class='input-group date' id='datetimepicker1'>
                                      <input type='text' name="date" value="{{$post->date}}" placeholder="YYYY-MM-DD"  class="form-control" />
                                      <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                  </div>
                          </div>
                        <div class="form-group">
                            <label>Start<span style="color:red;">*</span></label>
                              <div class="input-group clockpicker">
                                    <input type="text" name="start" value="{{$post->start}}" class="form-control">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                          </div>
                          <div class="form-group">
                              <label>End<span style="color:red;">*</span></label>
                            <div class="input-group clockpicker">
                                  <input type="text" class="form-control" value="{{$post->end}}" name="end">
                                  <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-time"></span>
                                  </span>
                              </div>
                        </div>
                        <div class="form-group">
                            <label>Officer-in-Charge<span style="color:red;">*</span></label>
                            <select class="form-control select2" name="officerId" style="width:100%;">
                                @foreach($officer as $of)
                                  <option value="{{$of->id}}" @if($post->officerId == $of->id) selected ="selected" @endif>{{$of->Resident->firstName}} {{$of->Resident->middleName}} {{$of->Resident->lastName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="pull-right">
                              <button class="btn btn-primary" type="submit">Submit</button>
                          </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@stop