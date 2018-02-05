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
      <h3 class="box-title">Update Officer</h3>

    </div>
    <div class="box-body">
        <div class="row" style="padding:20px;">
        <form action="{{ url('/Officer/Update/id='.$post->id) }}" method="post" files="true" enctype="multipart/form-data">
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Position:</label>
                    <select class="form-control" name="position">
                        <option value="Chairman" @if($post->position == 'Chairman') selected @endif>Chairman</option>
                        <option value="Kagawad" @if($post->position == 'Kagawad') selected @endif>Kagawad</option>
                        <option value="Secretary" @if($post->position == 'Secretary') selected @endif>Secretary</option>
                        <option value="Tanod" @if($post->position == 'Tanod') selected @endif>Tanod</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Resident:</label>
                    <select class="form-control select2" name="residentId">
                        @foreach($resident as $res)
                            <option value="{{$res->id}}" @if($res->id == $post->residentId) selected @endif)>{{$res->firstName}} {{$res->middleName}} {{$res->lastName}}</option>
                        @endforeach
                    </select>
                </div>
                
            </div>
            <div class="col-sm-9">
                {{ csrf_field() }}
                @foreach($post->User as $user)
                <input type="hidden" value="{{$user->id}}" name="userId">
                <input type="hidden" value="{{$user->officerId}}" name="officerId">
                @endforeach
                <div class="" style="padding:10px; background:#252525; color:white; margin-bottom:20px;">
                    Account Information
                </div>
                <div class="form-group">
                    <label>Email Address:</label>
                   @foreach($post->User as $user) <input type="text" class="form-control" value="{{$user->email}}" name="email" placeholder="Email Address"> @endforeach
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label>Confirm Password:</label>
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