<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quarry Management System</title>
    <link rel="icon" href="frontend/img/quarry.ico" type="icon">
    <link rel="stylesheet" href="{{URL::asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('frontend/css/dashboard_style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('frontend/css/style1.css')}}">
    <script src="{{URL::asset('dashboard.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
    <script src="{{URL::asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
</head>
<body>
    <div class="container">
        <br>
            <center>
                <h2>Fuel - In </h2>
            </center>
            <br>
            <table class="table table-bordered border-dark text-center">
                <tr>
                    <th>Bill No.</th>
                    <td>{{$fuel_in->bill_no}}</td>
                    <th>Seller</th>
                    <td>{{$fuel_in->seller}}</td> 
                    <th>Fuel Type</th>
                    <td>{{$fuel_in->fuel_type}}</td>
                </tr>
                <tr>
                    <th>Quantity</th>
                    <td>{{$fuel_in->quantity}}</td>
                    <th>Rate</th>
                    <td>{{$fuel_in->rate}}</td>
                    <th>Amount</th>
                    <td>{{$fuel_in->amount}}</td>
                </tr>
                <tr>
                    <th>Vehicle No.</th>
                    <td>{{$fuel_in->vehicle_no}}</td>
                    <th>Driver</th>
                    <td>{{$fuel_in->driver_name}}</td>
                    <th>Date & Time</th>
                    <td>{{$fuel_in->created_at}}</td>
                </tr>
            </table>
            <br>
            <center>
                <button class="btn btn-danger" id="print_page">
                    Print
                </button>
            </center>
    </div>
    <script>
        $('#print_page').click(function(){
        $('#print_page').hide();
        if(window.print())
        {
            $('#print_page').show();
        }
        else
        {
            $('#print_page').show();
        }
    });
    </script>
</body>
</html>