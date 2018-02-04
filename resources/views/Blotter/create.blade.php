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
    </div>
    <div class="box-body">
        <form action="{{ url('/Household/Store') }}" method="post">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                            <label>Complainant</label>
                            <select class="form-control select2" name="complainant">
                                @foreach($resident as $res)
                                    <option value="{{$res->id}}">{{$res->firstName}} {{$res->middleName}} {{$res->lastName}}</option>
                                @endforeach
                            </select>
                    </div>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
    <script>

    </script>
@stop