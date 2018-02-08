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
      <h3 class="box-title">New Blotter</h3>
      <div class="box-tools pull-right">
            <p class="pull-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are needed to filled out.</p>
      </div>
    </div>
    <div class="box-body">
        <form action="{{ url('/Blotter/Store') }}" method="post">
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-6">
                    <div class="" style="padding:10px; background:#252525; color:white; margin-bottom:20px;">
                    Blotter Information
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label><span style="color:red;">Case No.*</span></label>
                                <input type="text" class="form-control" placeholder="Case No." name="id">
                            </div>
                        </div>
                        <div class="col-sm-4">
                                <div class="form-group">
                                        <label>Status<span style="color:Red;">*</span></label>
                                        <select class="form-control" disabled name="status">
                                            <option value="1">Pending</option>
                                            <option value="2">Ongoing</option>
                                            <option value="3">Resolved Issue</option>
                                            <option value="4">File to Action</option>
                                        </select>
                                </div>
                        </div>
                    </div>
                    <div class="form-group">
                            <label>Complainant<span style="color:Red;">*</span></label>
                            <select class="form-control select2" name="complainant">
                                @foreach($resident as $res)
                                    <option value="{{$res->id}}">{{$res->firstName}} {{$res->middleName}} {{$res->lastName}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                            <label>Complained Resident<span style="color:Red;">*</span></label>
                            <select class="form-control select2" name="complainedResident">
                                @foreach($resident2 as $res)
                                    <option value="{{$res->id}}">{{$res->firstName}} {{$res->middleName}} {{$res->lastName}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label>Officer-in-charge<span style="color:Red;">*</span></label>
                        <select class="form-control select2" name="officerCharge">
                                @foreach($resident2 as $res)
                                    <option value="{{$res->firstName}} {{$res->middleName}} {{$res->lastName}}">{{$res->firstName}} {{$res->middleName}} {{$res->lastName}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="comment">Description<span style="color:Red;">*</span></label>
                    <textarea class="form-control" rows="5" name="description" id="comment"></textarea>
                </div>
                <div class="form-group">
                    <div class="pull-right">
                        <button class="btn btn-primary" style="margin-right:20px; margin-top:20px;">Submit</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#pic')
                        .attr('src', e.target.result)
                        .width(300);
                    };
                reader.readAsDataURL(input.files[0]);
            }
            }
</script>
@stop