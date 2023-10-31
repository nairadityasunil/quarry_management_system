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
                <h2>Sales - Out</h2>
            </center>
            <br>
            <table class="table table-bordered border-dark text-center">
                <tr>
                    <th>Lease</th>
                    <td colspan="2">{{$sales_out->lease}}</td>
                    <th>Customer</th>
                    <td colspan="2">{{$sales_out->customer_name}}</td>
                </tr>
                <tr>
                    <th>Vehicle No.</th>
                    <td >{{$sales_out->vehicle_no}}</td>
                    <th>Driver</th>
                    <td >{{$sales_out->driver_name}}</td>
                    <th>Item</th>
                    <td>{{$sales_out->item}}</td>
                </tr>
                <tr>
                    <th>Tare Wt.</th>
                    <td>{{$sales_out->tare_weight}}</td>
                    <th>Gross Wt.</th>
                    <td>{{$sales_out->gross_weight}}</td>
                    <th>Net Wt.</th>
                    <td>{{$sales_out->net_weight}}</td>
                </tr>
                <tr>
                    <th colspan="3">Date & Time</th>
                    <td colspan="3">{{$sales_out->created_at}}</td>
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