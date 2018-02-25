<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    table, th, td {
    border: 1px solid black;
    }
    </style>
</head>
<body>
        <div style="line-height:5px;" align="center">
                <p>Republic of the Philippines</p></br>
                <p>City of Manila</p></br>
                <p>District III, Barangay 378</p>
                <p>Period covered {{ Carbon\Carbon::parse($start)->toFormattedDateString()  }} - {{ Carbon\Carbon::parse($end)->toFormattedDateString()  }}</p>
        </div>
    <table>
        <thead>
            <tr>
                    <th>Case No.</th>
                    <th>Complainant</th>
                    <th>Complained Resident</th>
                    <th>Date of Filing</th>
                    <th>Person-in-charge</th>
                    <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($post as $posts)
            <tr>
                    <?php $caseNo = str_pad($posts->id, 5, '0', STR_PAD_LEFT); ?>
                    <td><span style="color:red;">{{$caseNo}}</span></td>
                    <td>{{$posts->com->firstName}} {{$posts->com->middleName}} {{$posts->com->lastName}}</td>
                    <td>{{$posts->comRes->firstName}} {{$posts->comRes->middleName}} {{$posts->comRes->lastName}}</td>                    
                    <td>{{ Carbon\Carbon::parse($posts->created_at)->toFormattedDateString()  }}</td>
                    <td>{{$posts->officerCharge}}</td>
                    <td>
                        @if($posts->status == 1)
                        Pending
                        @elseif($posts->status == 2)
                        Ongoing
                        @elseif($posts->status == 3)
                        Resolved Issue
                        @else
                        File to Action 
                        @endif
                    </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</body>
</html>