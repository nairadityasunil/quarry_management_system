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
    <link rel="stylesheet" href="frontend/css/style1.css">
    <link rel="stylesheet" href="frontend/css/home_page.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
    <script src="dashboard.js"></script>
    <script src="frontend/js/bootstrap.bundle.min.js"></script>
    <style>
        body:{
            print-color-adjust: exact;
        }
    </style>
</head>

<body class="overflow-hidden">
    {{-- Component Navbar Being Brought To The Page --}}
    <x-navbar/>
    <div class="container-fluid">
        <div class="row">
            <x-side_navbar/>
            <div class="col-sm-10" style="overflow-y: scroll; height:90vh;">
            <!-- Cards -->
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card card-height bg-danger text-white" style="margin-top : 10px;">
                            <div class="card-body">
                                <div class="container">
                                    <h5 class="text-center">Total Purchase</h5>
                                </div>
                                <br>
                                <div class="container">
                                    <h2 class="text-center">{{$total_purchase_quantity}} kg</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card card-height bg-warning" style="margin-top : 10px;">
                            <div class="card-body">
                                <div class="container">
                                    <h5 class="text-center">Total Sales</h5>
                                </div>
                                <br>
                                <div class="container">
                                    <h2 class="text-center">{{$total_sales_quantity}} kg</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card card-height bg-primary text-white" style="margin-top : 10px;">
                            <div class="card-body">
                                <div class="container">
                                    <h5 class="text-center">Vehicles</h5>
                                </div>
                                <br>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-6" style="border-right: 1px solid white; border-top: 1px solid white">
                                            <center>
                                                Purchase
                                            </center>
                                           <div class="text-center">
                                              <h4>{{$total_purchase_vehicles}}</h4>
                                           </div>
                                        </div>
                                        <div class="col-sm-6" style="border-left: 1px solid white; border-top: 1px solid white">
                                            <center>
                                                Sales
                                            </center>
                                           <div class="text-center">
                                              <h4>{{$total_sales_vehicles}}</h4>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card card-height bg-success text-white" style="margin-top : 10px;">
                            <div class="card-body">
                                <div class="container">
                                    <h5 class="text-center">Employees</h5>
                                </div>
                                <br>
                                <div class="container">
                                    <h1 class="text-center">{{$total_employees}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card" style="margin-top : 10px; height:40vh;">
                            <div class="card-body">
                                <div class="container">
                                    <div>
                                        <h3 class="text-center">Total Purchase (Today)</h3>
                                    </div>
                                    <br>
                                    <div class="overflow-auto" style="height: 21vh">
                                        <table class="table table-striped  border-dark text-center">
                                            <thead>
                                                <tr>
                                                    <th>Vehicle Number</th>
                                                    <th>Item</th>
                                                    <th>Net Weight</th>    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($purchase_out_details as $purchase)
                                                    <tr>
                                                        <td>{{ $purchase->vehicle_no }}</td>
                                                        <td>{{ $purchase->item }}</td>
                                                        <td>{{ $purchase->net_weight }} kg</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>    
                                    </div>
                                    <hr>
                                    <div style="height: 5vh">
                                        <div class="row">
                                            <div class="col-sm-4 text-center text-danger">
                                                <h5>Trips : {{$purchase_today_trips}}</h5>
                                            </div>
                                            <div class="col-sm-4 text-center">
                                                
                                            </div>
                                            <div class="col-sm-4 text-center text-success">
                                                <h5>Total : {{$total_purchase_today}} kg</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card" style="margin-top : 10px; height:40vh;">
                            <div class="card-body">
                                <div class="container">
                                    <div>
                                        <h3 class="text-center">Total Sales (Today)</h3>
                                    </div>
                                    <br>
                                    <div class="overflow-auto" style="height: 21vh">
                                        <table class="table table-striped  border-dark text-center">
                                            <thead>
                                                <tr>
                                                    <th>Customer</th>
                                                    <th>Vehicle Number</th>
                                                    <th>Item</th>
                                                    <th>Net Weight</th>    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sales_out_details as $sales)
                                                    <tr>
                                                        <td>{{ $sales->customer_name }}</td>
                                                        <td>{{ $sales->vehicle_no }}</td>
                                                        <td>{{ $sales->item }}</td>
                                                        <td>{{ $sales->net_weight }} kg</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div style="height: 5vh">
                                        <div class="row">
                                            <div class="col-sm-4 text-center text-danger">
                                                <h5>Trips : {{$sales_today_trips}}</h5>
                                            </div>
                                            <div class="col-sm-4 text-center">
                                                
                                            </div>
                                            <div class="col-sm-4 text-center text-success">
                                                <h5>Total : {{$total_sales_today}} kg</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card" style="margin-top : 10px; height:40vh;">
                            <div class="card-body">
                                <div class="container">
                                    <div>
                                        <h3 class="text-center">Pending Purchase</h3>
                                    </div>
                                    <br>
                                    <div class="overflow-auto" style="height: 21vh">
                                        <table class="table table-striped  border-dark text-center">
                                            <thead>
                                                <tr>
                                                    <th>Ticket No.</th>
                                                    <th>Vehicle Number</th>
                                                    <th>Item</th>
                                                    <th>Confirm</th>    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pending_purchase as $pending_purch)
                                                    <tr>
                                                        <td>{{ $pending_purch->id }}</td>
                                                        <td>{{ $pending_purch->vehicle_no }}</td>
                                                        <td>{{ $pending_purch->item }}</td>
                                                        <td>
                                                            <a href="{{url('purchase_out_entry')}}/{{$pending_purch->id}}">
                                                                <button class="btn btn-success">Confirm</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>    
                                    </div>
                                    <hr>
                                    <div style="height: 5vh">
                                        <div class="row">
                                            <div class="col-sm-12 text-center text-success">
                                               <h5>Total Pending Purchase : {{$total_pending_purchase}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card" style="margin-top : 10px; height:40vh;">
                            <div class="card-body">
                                <div class="container">
                                    <div>
                                        <h3 class="text-center">Pending Sales</h3>
                                    </div>
                                    <br>
                                    <div class="overflow-auto" style="height: 21vh">
                                        <table class="table table-striped  border-dark text-center">
                                            <thead>
                                                <tr>
                                                    <th>Ticket No.</th>
                                                    <th>Vehicle Number</th>
                                                    <th>Item</th>
                                                    <th>Confirm</th>    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pending_sales as $pending_s)
                                                    <tr>
                                                        <td>{{ $pending_s->id }}</td>
                                                        <td>{{ $pending_s->vehicle_no }}</td>
                                                        <td>{{ $pending_s->item }}</td>
                                                        <td>
                                                            <a href="{{url('sales_out_entry')}}/{{$pending_s->id}}}}">
                                                                <button class="btn btn-success">Confirm</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div style="height: 5vh">
                                        <div class="row">
                                            <div class="col-sm-12 text-center text-success">
                                               <h5>Total Pending Sales : {{$total_pending_sales}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>           
            </div>
        </div>
    </div>
</body>

</html>