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
    <h2 class="center">Mizoram Tourism</h2>
    <h2 class="center"><u>MONTHLY VISITOR DATA REPORT</u></h2>

    <div >
        <span style="margin-right:80px">
                Name of Facility: {{ $report['facility_name'] }}
        </span>   
        <span>
                Location:  {{ $report['address'] }}
        </span>     
    </div>


    <div>
        <span style="margin-right:80px">
            Date:  {{ $report['date'] }}
        </span>
        
        
    </div>
     


    <h4>VISITOR DATA:</h4>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ITEM</th>
                <th scope="col">Local</th>
                <th scope="col">Domestic</th>
                <th scope="col">NRI</th>
                <th scope="col">Foreign</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Number of Guests Checked In</td>
                <td>{{ $report['check_in_local'] }}</td>
                <td>{{ $report['check_in_domestic'] }}</td>
                <td>{{ $report['check_in_nri'] }}</td>
                <td>{{ $report['check_in_foreign'] }}</td>
                <td>{{ $report[''] }}</td>
            </tr>
            <tr>
                <td>Total number of Night Spent</td>
                <td>{{ $report['night_spent_local'] }}</td>
                <td>{{ $report['night_spent_domestic'] }}</td>
                <td>{{ $report['night_spent_nri'] }}</td>
                <td>{{ $report['night_spent_foreign'] }}</td>
                <td>{{ $report[''] }}</td>
            </tr>
        </tbody>
    </table>
 
    <h4>DETAILS OF VISITORS:</h4>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Sl No</th>
                <th scope="col">Category</th>
                <th scope="col">Place of Residence</th>
                <th scope="col">No. Of Guests</th>
                <th scope="col">No. Of Night Spent</th>
                <th scope="col">Leisure</th>
                <th scope="col">Non Leisure</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($report['reportDetails'] as $index=> $report)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $report['category'] }} </td>
                    <td>{{ $report['residence'] }}</td>
                    <td>{{ $report['number_of_guest'] }}</td>
                    <td>{{ $report['number_of_nights_spent'] }}</td>
                    <td>{{ $report['leisure'] }}</td>
                    <td>{{ $report['non_leisure'] }}</td>
  
                </tr>
            @endforeach
            
        </tbody>
    </table>
</body>
</html>