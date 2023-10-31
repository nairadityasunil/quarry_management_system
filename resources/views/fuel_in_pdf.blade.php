<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quarry Management System</title>
    <link rel="icon" href="frontend/img/quarry.ico" type="icon">
    <link rel="stylesheet" href="frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="frontend/css/dashboard_style.css">
    <script src="dashboard.js"></script>
    <script src="frontend/js/bootstrap.bundle.min.js"></script>
    <style>
        table, th, td{
            border: 1px solid;
        }
    </style>
</head>

<body >
    <div class="container">
        <div class="row">
            <div class="col-sm-12 d-flex flex-column">
                    <div class="col-sm-12">
                                <center>
                                    <h3>Fuel-In Report</h3>
                                    <span><b>From:</b> <u>{{session()->get('fuel_in_from')}}</u><b> To:</b> <u>{{session()->get('fuel_in_to')}}</u></span>
                                </center>
                    </div>
                         
                        
                        </div>
                        <div class="container px-3 py-3" style="padding-right:10px;">
                        <table class="table table-bordered border-dark text-center">
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Bill No.</th>
                                        <th>Seller</th>
                                        <th>Fuel Type</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                        <th>Vehicle No.</th>
                                        <th>Driver Name</th>
                                        <th>Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fuel_in_details as $fuel)
                                        <tr>
                                            <td>{{ $fuel->id }}</td>
                                            <td>{{ $fuel->bill_no  }}</td>
                                            <td>{{ $fuel->seller }}</td>
                                            <td>{{ $fuel->fuel_type }}</td>
                                            <td>{{ $fuel->quantity }}</td>
                                            <td>{{ $fuel->rate }}</td>
                                            <td>{{ $fuel->amount }}</td>
                                            <td>{{ $fuel->vehicle_no }}</td>
                                            <td>{{ $fuel->driver_name }}</td>
                                            <td>{{ $fuel->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>