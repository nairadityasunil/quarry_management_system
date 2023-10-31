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
                <h2>Fuel - Out </h2>
            </center>
            <br>
            <table class="table table-bordered border-dark text-center">
                <tr>
                    <th>Fuel Type</th>
                    <td>{{$fuel_out->fuel_type}}</td>
                    <th>Quantity</th>
                    <td>{{$fuel_out->quantity}}</td> 
                </tr>
                <tr>
                    <th>Vehicle No.</th>
                    <td>{{$fuel_out->vehicle_no}}</td>
                    <th>Date & Time</th>
                    <td>{{$fuel_out->created_at}}</td>
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