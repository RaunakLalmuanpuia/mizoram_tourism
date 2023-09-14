<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
    <title> </title>
    <style>
        .center{
            text-align:center
        }
        table, th, td {
            border:1px solid;
        }
    </style>
</head>
<body>
    {{-- <h1> {{ $name }}</h1> --}}
    <h3 class="center">Mizoram Tourism</h3>
    <h3 class="center"><u>MONTHLY OCCUPANCY STATEMENT</u></h3>

    <div >
        <span style="margin-right:80px">
                Name of Facility: {{ $occupancy['facility_name'] }}
        </span>   
        <span>
                Location:  {{ $occupancy['location'] }}
        </span>     
    </div>


    <div>
        <span style="margin-right:80px">
            District:  {{ $occupancy['district_name'] }}
        </span>
        <span style="margin-right:80px">
            Month:  {{ $occupancy['month'] }}
        </span>
        <span style="margin-right:80px">
            Year:  {{ $occupancy['year'] }}
        </span>
    </div>

    <div>
        <span style="margin-right:80px">
            Total Rooms:  {{ $occupancy['total_rooms'] }}
        </span>
        <span style="margin-right:80px">
            Total Beds:  {{ $occupancy['total_beds'] }}
        </span>
        <span style="margin-right:80px">
            Total Beds (dormitory):  {{ $occupancy['total_beds_dormitory'] }}
        </span>
        <span style="margin-right:80px">
            Any Other Lodging:  {{ $occupancy['any_other_lodging'] }}
        </span>
    </div>
     
    <table style="margin-top:20px" class="table">
        <thead>
            <tr>
                <th scope="col">Sl No</th>
                <th scope="col">Date</th>
                <th scope="col">Suite</th>
                <th scope="col">Deluxe</th>
                <th scope="col">Double Room</th>
                <th scope="col">Single Room</th>
                <th scope="col">Dormitory</th>
                <th scope="col">Conference Hall/Others</th>
                <th scope="col">Convention Hall/Others</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($occupancy['occupancyDetails'] as $index=> $occupancy)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td style="width:100px">{{ date('d-M-y', strtotime($occupancy['date'])) }} </td>
                    <td>{{ $occupancy['suite'] }}</td>
                    <td>{{ $occupancy['deluxe'] }}</td>
                    <td>{{ $occupancy['double_room'] }}</td>
                    <td>{{ $occupancy['single_room'] }}</td>
                    <td>{{ $occupancy['dormitory'] }}</td>
                    <td>{{ $occupancy['conference_hall'] }}</td>
                    <td>{{ $occupancy['convention_hall'] }}</td>

                </tr>
            @endforeach
            
        </tbody>
    </table>
</body>
</html>