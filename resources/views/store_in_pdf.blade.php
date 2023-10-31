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
                    <!-- <center>
                        <div class="row">
                            <div class="col-sm-12 py-4 d-flex justify-content-center">
                                <h3>Fuel-In Report</h3>
                            </div>  
                        </div>
                    </center> -->
                    
                    <div class="col-sm-12">
                                <center>
                                    <h3>Store-In Report</h3>
                                    <span><b>From:</b> <u>{{session()->get('store_in_from')}}</u><b> To:</b> <u>{{session()->get('store_in_to')}}</u></span>
                                </center>
                    </div>
                    
                        </div>
                        <div class="container px-3 py-3" style="padding-right:10px;">
                        <table class="table table-bordered border-dark text-center">
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Item Name</th>
                                        <th>Seller</th>
                                        <th>Unit</th>
                                        <th>Quantity</th>  
                                        <th>Price</th>
                                        <th>Value</th>
                                        <th>Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($store_in_details as $store_in)
                                        <tr>
                                            <td>{{ $store_in->id }}</td>
                                            <td>{{ $store_in->item_name }}</td>
                                            <td>{{ $store_in->seller }}</td>
                                            <td>{{ $store_in->unit }}</td>
                                            <td>{{ $store_in->quantity }}</td>
                                            <td>{{ $store_in->price_per_unit }}</td>
                                            <td>{{ $store_in->total_value }}</td>
                                            <td>{{ $store_in->created_at }}</td>
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