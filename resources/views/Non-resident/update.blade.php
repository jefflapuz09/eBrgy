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
      <p class="pull-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are needed to filled out.</p>
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
                <div class="form-group">
                        <label>Date of Registration<span style="color:red;">*</span></label>
                        <div class='input-group date' id='datetimepicker1'>
                        <input type='text' name="created_at" placeholder="YYYY-MM-DD" value="{{$post->created_at}}" id="date"  class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                        </div>
                </div>
            </div>
            <div class="col-sm-9">
                {{ csrf_field() }}
                <input type="hidden" value="{{$post->id}}" name="residentId">
                @foreach($post->Parents as $parent)
                <input type="hidden" value="{{$parent->id}}" name="parentid">
                @endforeach
                @foreach($post->Voter as $voter)
                <input type="hidden" value="{{$voter->id}}" name="vId">
                @endforeach
                <div class="" style="padding:10px; background:#252525; color:white;">
                    Personal Information
                </div>
                <div style="margin-top:10px;">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>First Name<span style="color:red;">*</span></label>
                                <input type="text" class="col-sm-6 form-control" maxlength="70" value="{{$post->firstName}}" id="exampleInputEmail1" placeholder="First Name" name="firstName">
                            </div>
                            <div class="col-sm-3">
                                <label>Middle Name<span style="color:red;"></span></label>
                                <input type="text" class="col-sm-6 form-control" maxlength="20" value="{{$post->middleName}}" id="exampleInputEmail1" placeholder="Middle Name" name="middleName">
                            </div>
                            <div class="col-sm-3">
                                <label>Last Name<span style="color:red;">*</span></label>
                                <input type="text" class="col-sm-6 form-control" maxlength="50" value="{{$post->lastName}}" id="exampleInputEmail1" placeholder="Last Name" name="lastName">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                            <div class="row">
                                <div class="col-sm-5">
                                    <label>Street<span style="color:red;">*</span></label>
                                    <input type="text" class="col-sm-6 form-control" maxlength="70" value="{{$post->street}}" id="exampleInputEmail1" placeholder="Street" name="street" >
                                </div>
                                <div class="col-sm-4">
                                    <label>Brgy.<span style="color:red;">*</span></label>
                                    <input type="text" class="col-sm-6 form-control" maxlength="50" value="{{$post->brgy}}" id="exampleInputEmail1" placeholder="Brgy" name="brgy">
                                </div>
                                <div class="col-sm-3">
                                    <label>City<span style="color:red;">*</span></label>
                                    <input type="text" class="col-sm-6 form-control" maxlength="50" value="{{$post->city}}" id="exampleInputEmail1" placeholder="City" name="city">
                                </div>
                            </div>
                    </div>
                    <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Province<span style="color:red;"></span></label>
                                    <input type="text" class="col-sm-6 form-control" maxlength="100" value="{{$post->province}}" id="exampleInputEmail1" placeholder="Province" name="province">
                                </div>
                                <div class="col-sm-3">
                                    <label>Citizenship<span style="color:red;">*</span></label>
                                    <select class="form-control select" name="citizenship">
                                        <option value="0" disabled>Please select your citizenship</option>
                                        <option value="Filipino" @if($post->citizenship == "By Filipino") selected ="selected" @endif>Filipino</option>
                                        <option value="Foreign" @if($post->citizenship == "Foreign") selected ="selected" @endif>Foreign</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Religion<span style="color:red;">*</span></label>
                                    <input type="text" class="col-sm-6 form-control" maxlength="50" value="{{$post->religion}}" id="exampleInputEmail1" placeholder="Religion" name="religion">
                                </div>
                            </div>
                    </div>
                    <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3" style="margin-top:20px;">
                                    <label class="checkbox-inline">
                                    <input type="checkbox" name="gender" @if($post->gender == 1) checked @endif id="inlineCheckbox1" value="1"> Male
                                    </label>
                                    <label class="checkbox-inline">
                                    <input type="checkbox" name="gender" @if($post->gender == 2) checked @endif id="inlineCheckbox2" value="2"> Female
                                    </label>
                                </div>
                                <div class="col-sm-3">
                                    <label>Birthdate<span style="color:red;">*</span></label>
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' name="birthdate" id="bday" placeholder="YYYY-MM-DD" value="{{$post->birthdate}}" class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label>Birthplace<span style="color:red;">*</span></label>
                                    <input type="text" name="birthPlace" maxlength="100" class="col-sm-6 form-control" value="{{$post->birthPlace}}" id="exampleInputEmail1" placeholder="Place of Birth">
                                </div>
                                <div class="col-sm-3">
                                    <label>Age<span style="color:red;"></span></label>
                                    <input type="text" value="18" id="age" class="form-control" disabled>
                                </div>
                            </div>
                    </div>
                    <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                        <label>Civil Status<span style="color:red;">*</span></label>
                                        <select class="form-control select" name="civilStatus">
                                            <option value="0" disabled>Please select your civil status</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widow/er">Widow/er</option>
                                            <option value="Legally Separated">Legally Separated</option>
                                        </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Profession/Occupation<span style="color:red;"></span></label>
                                    <input type="text" class="col-sm-6 form-control" maxlength="70" name="occupation" value="{{$post->occupation}}" id="exampleInputEmail1" placeholder="Profession/Occupation">
                                </div>
                                <div class="col-sm-3">
                                    <label>Tin No.<span style="color:red;"></span></label>
                                    <input type="text" class="col-sm-6 form-control" maxlength="50" name="tinNo" value="{{$post->tinNo}}" id="tin" placeholder="Tin No.">
                                </div>
                                <div class="col-sm-3">
                                    <label>Period of Residence<span style="color:red;">*</span></label>
                                    <input type="text" class="col-sm-6 form-control" maxlength="50" name="periodResidence" value="{{$post->periodResidence}}" id="exampleInputEmail1" placeholder="Period of Residence">
                                </div>
                            </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                    <label>Contact Number<span style="color:red;">*</span></label>
                                    <input type="text" class="col-sm-6 form-control" maxlength="50" name="contactNumber" value="{{$post->contactNumber}}" id="contactNumber" placeholder="Contact Number">
                            </div>
                           
                            <div class="col-sm-4">
                                    <label>Voter's Id No.<span style="color:red;"></span></label>
                                    <input type="text" class="col-sm-6 form-control" maxlength="50" name="voterId" @foreach($post->Voter as $voter) value='{{$voter->voterId}}' @endforeach id="voterId" placeholder="Voter's Id No.">
                            </div>
                            <div class="col-sm-4">
                                    <label>Precint Assignment No.<span style="color:red;"></span></label>
                                    <input type="text" class="col-sm-6 form-control" maxlength="50" name="precintNo" @foreach($post->Voter as $voter) value="{{$voter->precintNo}}" @endforeach id="precint" placeholder="Precint Assignment No.">
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
                                <label>First Name<span style="color:red;">*</span></label>
                                <input type="text" class="col-sm-6 form-control" maxlength="70" name="motherFirstName" value="{{$parent->motherfirstName}}" id="exampleInputEmail1" placeholder="First Name">
                            </div>
                            <div class="col-sm-3">
                                <label>Middle Name<span style="color:red;"></span></label>
                                <input type="text" class="col-sm-6 form-control" maxlength="20" name="motherMiddleName" value="{{$parent->mothermiddleName}}" id="exampleInputEmail1" placeholder="Middle Name">
                            </div>
                            <div class="col-sm-3">
                                <label>Last Name<span style="color:red;">*</span></label>
                                <input type="text" class="col-sm-6 form-control" maxlength="50" name="motherLastName" value="{{$parent->motherlastName}}" id="exampleInputEmail1" placeholder="Last Name">
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
                                <label>First Name<span style="color:red;">*</span></label>
                                <input type="text" class="col-sm-6 form-control" maxlength="70" name="fatherFirstName" value="{{$parent->fatherfirstName}}" id="exampleInputEmail1" placeholder="First Name">
                            </div>
                            <div class="col-sm-3">
                                <label>Middle Name<span style="color:red;"></span></label>
                                <input type="text" class="col-sm-6 form-control" maxlength="20" name="fatherMiddleName" value="{{$parent->fathermiddleName}}" id="exampleInputEmail1" placeholder="Middle Name">
                            </div>
                            <div class="col-sm-3">
                                <label>Last Name<span style="color:red;">*</span></label>
                                <input type="text" class="col-sm-6 form-control" maxlength="50" name="fatherLastName" value="{{$parent->fatherlastName}}" id="exampleInputEmail1" placeholder="Last Name">
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
        $(document).on('focus','#contactNumber',function(){
        $(this).popover({
            trigger: 'manual',
            content: function(){
                var content = '<button type="button" id="cp" class="btn btn-primary col-md-12">Mobile No.</button><button type="button" id="tp" class="btn btn-primary col-md-12">Telephone No.</button>';
                return content;
            },
            html: true,
            placement: function(){
                var placement = 'top';
                return placement;
            },
            template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
            title: function(){
                var title = 'Choose a format:';
                return title;
            }
        });
        $(this).popover('show');
        });
        $(document).on('focusout','#contactNumber',function(){
            $(this).popover('hide');
        });
        $(document).on('click','#cp',function(){
            $('#contactNumber').val('');
            $('#contactNumber').inputmask("9999-999-9999");
        });
        $(document).on('click','#tp',function(){
            $('#contactNumber').val('');
            $('#contactNumber').inputmask("(02) 999 9999");
        });

            $(document).ready(function(){
                $('#tin').inputmask("99-9999999");
                $('#precint').inputmask('9999a');
                $('#voterId').inputmask('9999-9999a-a999aaa99999-9');
                $('#date').inputmask('9999-99-99');

                today = new Date();
            birthDate = new Date($('#bday').val());
            age = today.getFullYear() - birthDate.getFullYear();
            m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) 
                {
                    age--;
                }
                $('#age').val(age);
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
              $('#bday').on('change',function(){
            today = new Date();
            birthDate = new Date($('#bday').val());
            age = today.getFullYear() - birthDate.getFullYear();
            m = today.getMonth() - birthDate.getMonth();
            if(birthDate >= today)
            {
                alert('Invalid Birthdate');
            }
            else
            {
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) 
                {
                    age--;
                }
                $('#age').val(age);
            }
            });

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