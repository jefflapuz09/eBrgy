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
      <h3 class="box-title">Update Blotter</h3>
      <div class="box-tools pull-right">
            <p class="pull-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are needed to filled out.</p>
      </div>
    </div>
    <div class="box-body">
        <form action="{{ url('/Blotter/Update/id='.$post->id) }}" method="post">
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-6">
                    <div class="" style="padding:10px; background:#252525; color:white; margin-bottom:20px;">
                    Blotter Information
                    </div>
                    <div class="form-group">
                            <label>Date of Filing<span style="color:red;">*</span></label>
                            <div class='input-group date' id='datetimepicker1'>
                            <input type='text' name="created_at" placeholder="YYYY-MM-DD" id="date" value="{{$post->created_at}}" class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label><span style="color:red;">Case No.*</span></label>
                                    <input type="text" class="form-control" maxlength="50" value="{{$post->id}}" placeholder="Case No." name="id">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                    <div class="form-group">
                                            <label>Status<span style="color:Red;">*</span></label>
                                            <select class="form-control" name="status">
                                                <option value="1" @if($post->status == 1) selected="selected" @endif>Pending</option>
                                                <option value="2" @if($post->status == 2) selected="selected" @endif>Ongoing</option>
                                                <option value="3" @if($post->status == 3) selected="selected" @endif>Resolved Issue</option>
                                                <option value="4" @if($post->status == 4) selected="selected" @endif>File to Action</option>
                                            </select>
                                    </div>
                            </div>
                    </div>
                    <div class="form-group">
                            <label>Complainant<span style="color:Red;">*</span></label>
                            <select class="form-control select2" name="complainant">
                                @foreach($resident as $res)
                                    <option value="{{$res->id}}" @if($post->complainant == $res->id) selected="selected" @endif>{{$res->firstName}} {{$res->middleName}} {{$res->lastName}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                            <label>Complained Resident<span style="color:Red;">*</span></label>
                            <select class="form-control select2" name="complainedResident">
                                @foreach($resident2 as $res)
                                    <option value="{{$res->id}}" @if($post->complainant == $res->id) selected="selected" @endif>{{$res->firstName}} {{$res->middleName}} {{$res->lastName}}</option>
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
                    <textarea class="form-control" rows="5" maxlength="150" name="description" id="comment">{{$post->description}}</textarea>
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

{{--  modal  --}}
<div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
      
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Resident that's not registered in the Barangay.</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('/Resident/NotResident/Store') }}" method="post" files="true" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group" style="margin-top:10px; border:1px solid black; padding:10px" >
                                <center><img class="img-responsive" id="pic" src="{{ URL::asset('img/steve.jpg')}}" width="130px" style="max-width:130px; background-size: contain" /></center>
                                <b><label style="margin-top:20px;" for="exampleInputFile">Photo Upload</label></b>
                                <input type="file" class="form-control-file" name="image" onChange="readURL(this)" id="exampleInputFile" aria-describedby="fileHelp">
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="" style="padding:10px; background:#252525; color:white;">
                                Personal Information
                            </div>
                            <div style="margin-top:10px;">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" class="col-sm-6 form-control" id="exampleInputEmail1" placeholder="First Name" name="firstName">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="col-sm-6 form-control" id="exampleInputEmail1" placeholder="Middle Name" name="middleName">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="col-sm-6 form-control" id="exampleInputEmail1" placeholder="Last Name" name="lastName">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <input type="text" class="col-sm-6 form-control" id="exampleInputEmail1" placeholder="Street" name="street" >
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="col-sm-6 form-control" id="exampleInputEmail1" placeholder="Brgy" name="brgy">
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="col-sm-6 form-control" id="exampleInputEmail1" placeholder="City" name="city">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" class="col-sm-6 form-control" id="exampleInputEmail1" placeholder="Province" name="province">
                                                </div>
                                                <div class="col-sm-3">
                                                    <select class="form-control select" name="citizenship">
                                                        <option value="0" disabled>Please select your citizenship</option>
                                                        <option value="By Birth">By Birth</option>
                                                        <option value="Naturalized">Naturalized</option>
                                                        <option value="Reacquired">Reacquired</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="col-sm-6 form-control" id="exampleInputEmail1" placeholder="Religion" name="religion">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="checkbox-inline">
                                                    <input type="checkbox" checked name="gender" id="inlineCheckbox1" value="1"> Male
                                                    </label>
                                                    <label class="checkbox-inline">
                                                    <input type="checkbox" name="gender" id="inlineCheckbox2" value="2"> Female
                                                    </label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class='input-group date' id='datetimepicker1'>
                                                        <input type='text' name="birthdate" placeholder="YYYY-MM-DD"  class="form-control" />
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" name="birthPlace" class="col-sm-6 form-control" id="exampleInputEmail1" placeholder="Place of Birth">
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
                                                    <input type="text" class="col-sm-6 form-control" name="occupation" id="exampleInputEmail1" placeholder="Profession/Occupation">
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="col-sm-6 form-control" name="tinNo" id="exampleInputEmail1" placeholder="Tin No.">
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="col-sm-6 form-control" name="periodResidence" id="exampleInputEmail1" placeholder="Period of Residence">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="" style="padding:10px; background:#252525; color:white;">
                                    Mother's Information
                                    </div>
                                    <div style="margin-top:10px; margin-bottom:10px;">
                                    <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" class="col-sm-6 form-control" name="motherFirstName" id="exampleInputEmail1" placeholder="First Name">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="col-sm-6 form-control" name="motherMiddleName" id="exampleInputEmail1" placeholder="Middle Name">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="col-sm-6 form-control" name="motherLastName" id="exampleInputEmail1" placeholder="Last Name">
                                            </div>
                                    </div>
                                     </div>
                                    <div class="" style="padding:10px; background:#252525; color:white;">
                                    Father's Information
                                    </div>
                                    <div style="margin-top:10px; margin-bottom:10px;">
                                    <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" class="col-sm-6 form-control" name="fatherFirstName" id="exampleInputEmail1" placeholder="First Name">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="col-sm-6 form-control" name="fatherMiddleName" id="exampleInputEmail1" placeholder="Middle Name">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="col-sm-6 form-control" name="fatherLastName" id="exampleInputEmail1" placeholder="Last Name">
                                            </div>
                                    </div>
                                    </div>
                                    <div class="pull-right">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </form>
            </div>
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

            $(document).ready(function(){
                $('#date').inputmask('9999-99-99');
            });

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
</script>
@stop