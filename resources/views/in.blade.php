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
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    
@stop