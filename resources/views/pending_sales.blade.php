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
    <script src="dashboard.js"></script>
    <script src="frontend/js/bootstrap.bundle.min.js"></script>
</head>

<body class="overflow-hidden">
    {{-- Component Navbar Being Brought To The Page --}}
    <x-navbar/>
    <div class="container-fluid">
        <div class="row">
            <x-side_navbar/>
            <div class="col-sm-10 d-flex flex-column">
                <div class="card" style="margin-top : 10px;">
                    <div class="card-body my-3">
                        <form action = "search_pending_sales">
                            <div class="form-row row">
                                <div class="col">
                                    <input type="text" name="customer_name" class="form-control" placeholder="Cutomer Name" value="{{$customer_name ?? ''}}">
                                </div>
                                <div class="col">
                                    <input type="text" name="item" class="form-control" placeholder="Item" value="{{$item ?? ''}}">
                                </div>
                                <div class="col">
                                    <input type="text" name="vehicle_no" class="form-control" placeholder="Vehicle Number" value="{{$vehicle_no ?? ''}}">
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <br>
                                        <button type="submit" class="btn btn-dark">Search</button>
                                        <a href="{{url('/pending_sales_list')}}">
                                            <button type="button" class="btn btn-danger">Clear</button>    
                                        </a>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <center>
                            <span class="text-danger">
                                {{session()->get('no_record')}}
                            </span>
                        </center>
                    </div>
                </div>
                <div class="card" style="margin-top: 10px;">
                    <div class="row">  
                        <div class="col-sm-5 px-5 py-4">
                            <a href="{{route('sales_in_entry')}}">
                                <button type="submit" class="btn btn-success">Sales-In Entry</button>
                            </a>
                        </div>
                        <div class="col-sm-7 py-4">
                            <h3>Pending List (Sales)</h3>   
                        </div>  
                    </div>
                    <div class="container-fluid px-3 py-3 overflow-auto" style="padding-right:10px;">
                        <table class="table table-bordered  border-dark text-center">
                            <thead>
                                <tr>
                                    <th>Sr no.</th>
                                    <th>Lease</th>
                                    <th>Company</th>
                                    <th>Vehicle Number</th>
                                    <th>Driver Name</th>
                                    <th>Customer Name</th>
                                    <th>Item</th>
                                    <th>Tare Wt.</th>
                                    <th>Date-Time</th>
                                    <th>Confirm</th>    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pending_s as $sales)
                                    <tr>
                                        <td>{{ $sales->id }}</td>
                                        <td>{{ $sales->lease }}</td>
                                        <td>{{ $sales->selling_company }}</td>
                                        <td>{{ $sales->vehicle_no }}</td>
                                        <td>{{ $sales->driver_name }}</td>
                                        <td>{{ $sales->customer_name }}</td>
                                        <td>{{ $sales->item }}</td>
                                        <td>{{ $sales->tare_weight }}</td>
                                        <td>{{ $sales->created_at }}</td>
                                        <td>
                                            <a href="{{url('sales_out_entry')}}/{{$sales->id}}}}">
                                                <button class="btn btn-success">Confirm</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>