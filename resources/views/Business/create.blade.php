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
                <form action="{{ url('/Business/Store') }}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Business Name<span style="color:red;">*</span></label>
                                <input type="text" maxlength="70" class="form-control" placeholder="Business Name" name="name">
                            </div>
                            <div class="col-sm-6">
                                <label>Owner<span style="color:red;">*</span></label>
                                <select class="form-control select2" name="residentId">
                                    @foreach($resident as $res)
                                        <option value="{{$res->id}}">{{$res->firstName}} {{$res->lastName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-5">
                                <label>Street<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" maxlength="70" placeholder="Street" name="street">
                            </div>
                            <div class="col-sm-3">
                                <label>Brgy<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" maxlength="50" placeholder="Brgy" name="brgy">
                            </div>
                            <div class="col-sm-4">
                                <label>City<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" maxlength="50" placeholder="City" name="city">
                            </div>
                        </div>
                    </div>
                    <label>Description</label>
                    <textarea class="form-control" name="description" maxlength="150" rows="5" placeholder="description"></textarea>
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

@stop