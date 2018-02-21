<html>
    <head>
        <style>
                .column {
                    float: left;
                    width: 50%;
                    padding: 10px;
                 
                }
                
                /* Clear floats after the columns */
                .row:after {
                    content: "";
                    display: table;
                    clear: both;
                    
                }

                li
                {
                    list-style-type:none;
                }
        </style>
    </head>
    <body>
        <div>
            <div style="position:absolute; left:15px; line-height: 5px; text-align: center; margin-top:20px;">
                <div style="position:absolute; top:-30px;">
                    <p>Republic of the Philippines</p></br>
                    <p>City of Manila</p></br>
                    <p>OFFICE OF THE PUNONG BARANGAY</p></br>
                    <p>Barangay 378 Zone 38, District III</p>
                </div>
                <hr style="position:absolute; top:65px; left:50px; opacity:0.75; width:85%;">
            </div>
            <img src="{{ asset('img/logo.png') }}" height="120px" style="margin-top:-50px; float:left; opacity:0.5;">
            <img src="{{ asset('img/logomanila.png') }}" height="110px" style="margin-top:-50px; float:right; opacity:0.5;">
        </div>
        <div class="">
            <div class="header" style="line-height: 5px; float:left; margin-top:150px;">
                <p>{{$cman->Resident->lastName}}, {{$cman->Resident->firstName}} {{$cman->Resident->middleName}}</p>
                <p style="margin-left:60px;">{{$cman->position}}</p>
            </div>
            
            <div class="body" style="z-index:999;">
                <div class="content" style="position:absolute; top:-600px; margin:50px; line-height:40px;">
                    <div style="position: absolute; top:600px; left:230px;">
                        <?php $caseNo = str_pad($post->id, 5, '0', STR_PAD_LEFT); ?>
                        <p>Barangay Case No.<span style="color:Red;">{{$caseNo}}</span></p>
                    </div> 
                    <div style="position:absolute; top: 700px; left:-150px; text-align:center; line-height:20px;">
                        {{$post->com->lastName}}, {{$post->com->firstName}}<br>
                        Complainant
                    </div>
                    <div style="position:absolute; top: 800px; left:-750px; text-align:center; line-height:5px;">
                        {{$post->officerCharge}}<br>
                        <p style="margin-left:160px;">Respondent</p>
                    </div>
                    <div style="position: absolute; top:850px; left:150px;">
                        <h3>CERTIFICATION TO FILE ACTION</h3>
                    </div>
                    <div style="position: absolute; top:950px; line-height:25px;">
                        <p>THIS IS TO CERTIFY THAT:</p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No settlement/conciliation was reached by both parties and therefore the responding complaint may now be filed in court.</p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Issued on <b>{{ Carbon\Carbon::now()->toFormattedDateString()  }}</b> at Barangay 378, city of Manila, Philippines</p></p>
                    </div>
                    <div class="foot2nd" style="position:absolute; top:1300px; left:100px;">
                        <small>*This certification is not valid without the official seal of this barangay.</small>
                    </div>
                    <div class="footer" style="position:absolute; top:1200px;">
                        {{--  <div style="float:left; line-height: 5px;">
                            <p>{{$sec->Resident->lastName}}, {{$sec->Resident->firstName}} {{$sec->Resident->middleName}}</p>
                            <p style="margin-left:50px;">{{$sec->position}}</p>
                        </div>  --}}
                        <div style="float:right; line-height: 5px;">
                            <p>{{$cman->Resident->lastName}}, {{$cman->Resident->firstName}} {{$cman->Resident->middleName}}</p>
                            <p style="margin-left:60px;">{{$cman->position}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>