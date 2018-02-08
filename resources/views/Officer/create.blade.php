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
      <h3 class="box-title">New Officer</h3>
      <p class="pull-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are needed to filled out.</p>
    </div>
    <div class="box-body">
        <div class="row" style="padding:20px;">
        <form action="{{ url('/Officer/Store') }}" method="post" files="true" enctype="multipart/form-data">
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Position<span style="color:Red;">*</span></label>
                    <select class="form-control" name="position">
                        <option value="Chairman">Chairman</option>
                        <option value="Kagawad">Kagawad</option>
                        <option value="Secretary">Secretary</option>
                        <option value="Tanod">Tanod</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Resident<span style="color:Red;">*</span></label>
                    <select class="form-control select2" name="residentId">
                        @foreach($resident as $res)
                            <option value="{{$res->id}}">{{$res->firstName}} {{$res->middleName}} {{$res->lastName}}</option>
                        @endforeach
                    </select>
                </div>
                
            </div>
            <div class="col-sm-9">
                {{ csrf_field() }}
                <div class="" style="padding:10px; background:#252525; color:white; margin-bottom:20px;">
                    Account Information
                </div>
                <div class="form-group">
                    <label>Email Address<span style="color:Red;">*</span></label>
                    <input type="text" class="form-control" name="email" placeholder="Email Address">
                </div>
                <div class="form-group">
                    <label>Password<span style="color:Red;">*</span></label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label>Confirm Password<span style="color:Red;">*</span></label>
                    <input type="password" class="form-control" name="conpassword" placeholder="Confirm Password">
                </div>
                    <div class="pull-right">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
            </div>
           
         
        </form>
        </div>
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