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
      <h3 class="box-title">Update Non-Resident</h3>

    </div>
    <div class="box-body">
        <div class="row" style="padding:20px;">
            <form action="{{ url('/Resident/NotResident/Update/id='.$post->id) }}" method="post" files="true" enctype="multipart/form-data">
            <div class="col-sm-3 bg-primary">
                <div class="form-group" style="margin-top:10px; border:1px solid black; padding:10px" >
                    <center><img class="img-responsive" id="pic" src="{{ URL::asset($post->image)}}" width="300px" style="max-width:200px; background-size: contain" /></center>
                    <b><label style="margin-top:20px;" for="exampleInputFile">Photo Upload</label></b>
                    <input type="file" class="form-control-file" name="image" onChange="readURL(this)" id="exampleInputFile" aria-describedby="fileHelp">
                </div>
            </div>
            <div class="col-sm-9">
                {{ csrf_field() }}
                <input type="hidden" value="{{$post->id}}" name="residentId">
                @foreach($post->Parents as $parent)
                <input type="hidden" value="{{$parent->id}}" name="parentid">
                @endforeach
                <div class="" style="padding:10px; background:#252525; color:white;">
                    Personal Information
                </div>
                <div style="margin-top:10px;">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="col-sm-6 form-control" value="{{$post->firstName}}" id="exampleInputEmail1" placeholder="First Name" name="firstName">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="col-sm-6 form-control" value="{{$post->middleName}}" id="exampleInputEmail1" placeholder="Middle Name" name="middleName">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="col-sm-6 form-control" value="{{$post->lastName}}" id="exampleInputEmail1" placeholder="Last Name" name="lastName">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                            <div class="row">
                                <div class="col-sm-5">
                                    <input type="text" class="col-sm-6 form-control" value="{{$post->street}}" id="exampleInputEmail1" placeholder="Street" name="street" >
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="col-sm-6 form-control" value="{{$post->brgy}}" id="exampleInputEmail1" placeholder="Brgy" name="brgy">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="col-sm-6 form-control" value="{{$post->city}}" id="exampleInputEmail1" placeholder="City" name="city">
                                </div>
                            </div>
                    </div>
                    <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="col-sm-6 form-control" value="{{$post->province}}" id="exampleInputEmail1" placeholder="Province" name="province">
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control select" name="citizenship">
                                        <option value="0" disabled>Please select your citizenship</option>
                                        <option value="By Birth" @if($post->citizenship == "By Birth") selected ="selected" @endif>By Birth</option>
                                        <option value="Naturalized" @if($post->citizenship == "Naturalized") selected ="selected" @endif>Naturalized</option>
                                        <option value="Reacquired" @if($post->citizenship == "Reacquired") selected ="selected" @endif>Reacquired</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="col-sm-6 form-control" value="{{$post->religion}}" id="exampleInputEmail1" placeholder="Religion" name="religion">
                                </div>
                            </div>
                    </div>
                    <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="checkbox-inline">
                                    <input type="checkbox" name="gender" @if($post->gender == 1) checked @endif id="inlineCheckbox1" value="1"> Male
                                    </label>
                                    <label class="checkbox-inline">
                                    <input type="checkbox" name="gender" @if($post->gender == 2) checked @endif id="inlineCheckbox2" value="2"> Female
                                    </label>
                                </div>
                                <div class="col-sm-3">
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' name="birthdate" placeholder="YYYY-MM-DD" value="{{$post->birthdate}}" class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" name="birthPlace" class="col-sm-6 form-control" value="{{$post->birthPlace}}" id="exampleInputEmail1" placeholder="Place of Birth">
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control select" name="civilStatus">
                                        <option value="0" disabled>Please select your civil status</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widow/er">Widow/er</option>
                                        <option value="Legally Separated">Legally Separated</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="col-sm-6 form-control" name="occupation" value="{{$post->occupation}}" id="exampleInputEmail1" placeholder="Profession/Occupation">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="col-sm-6 form-control" name="tinNo" value="{{$post->tinNo}}" id="exampleInputEmail1" placeholder="Tin No.">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="col-sm-6 form-control" name="periodResidence" value="{{$post->periodResidence}}" id="exampleInputEmail1" placeholder="Period of Residence">
                                </div>
                            </div>
                    </div>
                    <div class="" style="padding:10px; background:#252525; color:white;">
                    Mother's Information
                    </div>
                    <div style="margin-top:10px; margin-bottom:10px;">
                    <div class="row">
                        @foreach($post->Parents as $parent)
                            <div class="col-sm-6">
                                <input type="text" class="col-sm-6 form-control" name="motherFirstName" value="{{$parent->motherfirstName}}" id="exampleInputEmail1" placeholder="First Name">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="col-sm-6 form-control" name="motherMiddleName" value="{{$parent->mothermiddleName}}" id="exampleInputEmail1" placeholder="Middle Name">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="col-sm-6 form-control" name="motherLastName" value="{{$parent->motherlastName}}" id="exampleInputEmail1" placeholder="Last Name">
                            </div>
                        @endforeach
                    </div>
                     </div>
                    <div class="" style="padding:10px; background:#252525; color:white;">
                    Father's Information
                    </div>
                    <div style="margin-top:10px; margin-bottom:10px;">
                    <div class="row">
                            @foreach($post->Parents as $parent)
                            <div class="col-sm-6">
                                <input type="text" class="col-sm-6 form-control" name="fatherFirstName" value="{{$parent->fatherfirstName}}" id="exampleInputEmail1" placeholder="First Name">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="col-sm-6 form-control" name="fatherMiddleName" value="{{$parent->fathermiddleName}}" id="exampleInputEmail1" placeholder="Middle Name">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="col-sm-6 form-control" name="fatherLastName" value="{{$parent->fatherlastName}}" id="exampleInputEmail1" placeholder="Last Name">
                            </div>
                            @endforeach
                    </div>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
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