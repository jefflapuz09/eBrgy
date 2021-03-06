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
            <h3 class="box-title">New Business</h3>
            <p class="pull-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are needed to filled out.</p>
            </div>
            <div class="box-body">
                <div class="" style="padding:10px; background:#252525; margin-bottom:20px; color:white;">
                    Business Information
                </div>
                <form action="{{ url('/Business/Update/id='.$post->id) }}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                            <label>Date of Registration<span style="color:red;">*</span></label>
                            <div class='input-group date' id='datetimepicker1'>
                            <input type='text' name="created_at" value="{{$post->created_at}}" placeholder="YYYY-MM-DD" id="date"  class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                            </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Business Name<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" maxlength="70" value="{{$post->name}}" placeholder="Business Name" name="name">
                            </div>
                            <div class="col-sm-6">
                                <label>Owner<span style="color:red;">*</span></label>
                                <select class="form-control select2" name="residentId">
                                    @foreach($resident as $res)
                                        <option value="{{$res->id}}" @if($res->id == $post->id) selected @endif>{{$res->firstName}} {{$res->lastName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-5">
                                <label>Street<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{$post->street}}" maxlength="70" placeholder="Street" name="street">
                            </div>
                            <div class="col-sm-3">
                                <label>Brgy<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{$post->brgy}}" maxlength="50" placeholder="Brgy" name="brgy">
                            </div>
                            <div class="col-sm-4">
                                <label>City<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{$post->city}}" maxlength="50" placeholder="City" name="city">
                            </div>
                        </div>
                    </div>
                    <label>Description</label>
                    <textarea class="form-control" name="description" maxlength="150" rows="5" placeholder="description">{{$post->description}}</textarea>
                    <div class="pull-right">
                        <button class="btn btn-primary" style="margin-right:10px; margin-top:20px;">Submit</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
        $('#date').on('change',function(){
                today = new Date();
                date = new Date($('#date').val());
                age = today.getFullYear() - date.getFullYear();
                m = today.getMonth() - date.getMonth();
                if(date >= today)
                {
                    alert('Invalid Date');
                }
            });

            $(document).ready(function(){
                $('#date').inputmask('9999-99-99');
            });
    </script>
@stop