@extends('dashboard')

@section('content')
<div class="col-sm-12" style="background:white; box-shadow: 0 10px 6px -6px #777;">
    <div class="">
      <h3 class="text-center">Dashboard</h3>
    </div>
        <div class="">
            <div class="row">
                <div class="col-sm-8">
                        <div class="box box-solid box-primary">
                                <div class="box-header">
                                        <h3 class="box-title">Pending Cases</h3>
                                </div>
                            <div class="box-body">
                                    <table id="example" class="display" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Case No.</th>
                                                    <th>Complainant</th>
                                                    <th>Complained Resident</th>
                                                    <th>Date of Filing</th>
                                                    <th>Person-in-charge</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($post as $posts)
                                                <tr>
                                                    <td><span style="color:red;">000{{$posts->id}}</span></td>
                                                    <td>{{$posts->com->firstName}} {{$posts->com->middleName}} {{$posts->com->lastName}}</td>
                                                    <td>{{$posts->comRes->firstName}} {{$posts->comRes->middleName}} {{$posts->comRes->lastName}}</td>                    
                                                    <td>{{ Carbon\Carbon::parse($posts->created_at)->toFormattedDateString()  }}</td>
                                                    <td>{{$posts->officerCharge}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                            </div>
                        </div>

                        <div class="box box-solid box-primary">
                            <div class="box-header">
                                    <h3 class="box-title">Filed Cases as of this year {{Carbon\Carbon::now()->year}}</h3>
                            </div>
                        <div class="box-body">
                                <div id="line-example"></div>
                            </div>
                        </div>
                </div>
                 <div class="col-sm-4">
                        <div class="info-box bg-green">
                                <!-- Apply any bg-* class to to the icon to color it -->
                                <span class="info-box-icon bg-white"><i class="fa fa-star-o"></i></span>
                                <div class="info-box-content">
                                  <span class="info-box-text">No. of Registered Voters</span>
                                  <span class="info-box-number">{{count($voter)}}</span>
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <div class="info-box bg-red">
                                    <!-- Apply any bg-* class to to the icon to color it -->
                                    <span class="info-box-icon bg-white"><i class="fa fa-star-o"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">No. of Pending Cases</span>
                                      <span class="info-box-number">{{count($blotter)}}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                            </div>
                            <div class="info-box bg-blue">
                                    <!-- Apply any bg-* class to to the icon to color it -->
                                    <span class="info-box-icon bg-white"><i class="fa fa-star-o"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">No. of Male Residents</span>
                                      <span class="info-box-number">{{count($male)}}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                            </div>
                            <div class="info-box bg-blue">
                                    <!-- Apply any bg-* class to to the icon to color it -->
                                    <span class="info-box-icon bg-white"><i class="fa fa-star-o"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">No. of Female Residents</span>
                                      <span class="info-box-number">{{count($female)}}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                            </div>
                            <div class="info-box bg-blue">
                                    <!-- Apply any bg-* class to to the icon to color it -->
                                    <span class="info-box-icon bg-white"><i class="fa fa-star-o"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">No. of Residents with Record</span>
                                      <span class="info-box-number">{{count($record)}}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                            </div>
                            <div class="info-box bg-blue">
                                    <!-- Apply any bg-* class to to the icon to color it -->
                                    <span class="info-box-icon bg-white"><i class="fa fa-star-o"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">No. of Businesses within the Barangay</span>
                                      <span class="info-box-number">{{count($business)}}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                            </div>
                            <div class="info-box bg-blue">
                                <!-- Apply any bg-* class to to the icon to color it -->
                                <span class="info-box-icon bg-white"><i class="fa fa-star-o"></i></span>
                                <div class="info-box-content">
                                  <span class="info-box-text">Population</span>
                                  <span class="info-box-number">{{count($po)}}</span>
                                </div>
                                <!-- /.info-box-content -->
                        </div>
                            
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
        $(document).ready(function(){
        $.ajax({   
            type: "GET",
            url: "/month",             
            contentType: "application/json; charset=utf-8",
            dataType: "json",                  
            success: function(response){                    
            console.log(response);
            var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var currentYear = (new Date).getFullYear();
            Morris.Line({
            element: 'line-example',
            data: [{
                m: '2015-01', // <-- valid timestamp strings
                a: response.jan
            }, {
                m: '2015-02',
                a: response.feb
            }, {
                m: '2015-03',
                a: response.mar
            }, {
                m: '2015-04',
                a: response.apr
            }, {
                m: '2015-05',
                a: response.may
            }, {
                m: '2015-06',
                a: response.jun
            }, {
                m: '2015-07',
                a: response.jul
            }, {
                m: '2015-08',
                a: response.aug
            }, {
                m: '2015-09',
                a: response.sep
            }, {
                m: '2015-10',
                a: response.oct
            }, {
                m: '2015-11',
                a: response.nov
            }, {
                m: '2015-12',
                a: response.dec
            }, ],
            xkey: 'm',
            ykeys: ['a'],
            labels: [currentYear],
            xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
                var month = months[x.getMonth()];
                return month;
            },
            dateFormat: function(x) {
                var month = months[new Date(x).getMonth()];
                return month;
            },
            });
            }

        });
    });
       



    </script>
@stop