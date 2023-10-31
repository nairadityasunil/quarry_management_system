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
                    <center>
                        <div class="row">
                            <div class="col-sm-12 py-4 d-flex justify-content-center">
                                <h3>Purchase List</h3>
                            </div>  
                        </div>
                    </center>
                         
                        
                        </div>
                        <div class="container px-3 py-3" style="padding-right:10px;">
                            <table class="table table-bordered  border-dark text-center">
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Lease</th>
                                        <th>Company</th>
                                        <th>Supplier</th>
                                        <th>Date & Time (In)</th>
                                        <th>Item</th>
                                        <th>Vehicle Number</th>
                                        <th>Driver Name</th>
                                        <th>Tare Wt.</th>
                                        <th>Gross Wt.</th>
                                        <th>Net Wt.</th>
                                        <th>Date-Time</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchase_details as $purchase)
                                        <tr>
                                        <td>{{ $purchase->id }}</td>
                                        <td>{{ $purchase->lease }}</td>
                                        <td>{{ $purchase->purch_company }}</td>
                                        <td>{{ $purchase->supplier }}</td>
                                        <td>{{ $purchase->item }}</td>
                                        <td>{{ $purchase->date_time }}</td>
                                        <td>{{ $purchase->vehicle_no }}</td>
                                        <td>{{ $purchase->driver_name }}</td>
                                        <td>{{ $purchase->tare_weight }}</td>
                                        <td>{{ $purchase->gross_weight }}</td>
                                        <td>{{ $purchase->net_weight }}</td>
                                        <td>{{ $purchase->created_at }}</td>
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