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
                    <p>District III, Barangay 378</p>
                </div>
                <hr style="position:absolute; top:65px; left:50px; opacity:0.75; width:85%;">
            </div>
            <img src="{{ asset('img/logomanila.png') }}" height="110px" style="margin-top:-50px; float:left; opacity:0.5;">
            <img src="{{ asset('img/logo.png') }}" height="120px" style="margin-top:-50px; float:right; opacity:0.5;">
        </div>
        <div class="">
            <img src="{{ asset('img/logomanila.png') }}" height="600px" style=" z-index:-999; margin-left:-45px; margin-top:170px; opacity:0.5;">
            <div class="header" style="position:absolute; left:15px; line-height: 5px; text-align: center; margin-top:150px;">
                <h2>Office of the Barangay Chairman</h2>
                <h3>Barangay Clearance</h3>
            </div>
            <div class="body" style="z-index:999;">
                <div class="content" style="position:absolute; top:-550px; margin:50px;">
                    <p>To whom it may concern:</p></br>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        This is to certify that @if($post->gender == 1)Mr. @else Ms. @if($post->civilStatus == 'Married')Mrs. @endif @endif <b>{{$post->lastName}}, {{$post->firstName}} {{$post->middleName}}</b> of Legal age, is a bonafide resident of this barangay, with postal address at
                        <b>{{$post->street}} {{$post->brgy}} {{$post->city}}</b> and known to me of good moral character.
                    </p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Certify further that as per records filled in the office, subject person, @if($post->isDerogatory == 1)has NO derogatory record @else had a derogatory record(/s) @endif as of this date of issue.</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        This certification is hereby issued upon the request of the above subject person in connection to @if($post->gender == 1)his @else her @endif application for:<p>
                        <div class="row" style="z-index:999; margin-left:60px;">
                            <div class="column" style="">
                                <li>__Local Employment</li>
                                <li>__Travel Abroad</li>
                                <li>__Loan Purpose</li>
                                <li>__Open Account</li>
                                <li>__Tricycle Franchise</li>
                            </div>
                            <div class="column" style="">
                                <li>__Local Employment</li>
                                <li>__Travel Abroad</li>
                                <li>__Loan Purpose</li>
                                <li>__Open Account</li>
                                <li>__Tricycle Franchise</li>
                            </div>
                        </div><br><br><br><br><br><br>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Given this <b>{{ Carbon\Carbon::now()->toFormattedDateString()  }}</b> at Barangay 378, city of Manila, Philippines</p>
                    <p align="center">NOT VALID WITHOUT THE BARANGAY DRY SEAL.</p>
                    <div class="footer" style="position:absolute; top:600px;">
                        <div style="float:left; line-height: 5px;">
                            <p>{{$sec->Resident->lastName}}, {{$sec->Resident->firstName}} {{$sec->Resident->middleName}}</p>
                            <p style="margin-left:50px;">{{$sec->position}}</p>
                        </div>
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