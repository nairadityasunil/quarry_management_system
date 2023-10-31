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
                        <form action = "search_sales_out">
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
                                        <a href="{{url('/sales_out_list')}}">
                                            <button type="button" class="btn btn-danger">Clear</button>    
                                        </a>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <center>
                            <span class="text-danger">{{session()->get('status')}}</span>
                            <span class="text-danger">
                                {{session()->get('no_record')}}
                            </span>
                        </center>
                    </div>
                </div>
                <div class="card" style="margin-top: 10px; max-height:70vh;">
                    <div class="card-body overflow-auto overflow1">
                        <div class="row">  
                            <div class="col-sm-5 px-5 py-4">
                            <a href="{{route('sales_in_entry')}}">
                                    <button type="submit" class="btn btn-success">Sales-In</button>
                                </a>
                                <a href="{{route('direct_sales')}}">
                                    <button type="submit" class="btn btn-primary">Direct Sales</button>
                                </a>
                            </div>
                            <div class="col-sm-3 py-4">
                                <h3>Sales-Out List</h3>
                            </div>  
                            <!-- <div class="col-sm-4 px-5 py-4">
                                <a href="{{route('download_sales_full_pdf')}}">
                                    <button type="submit" class="btn btn-dark">Download Full PDF</button>
                                </a>
                                <a href="{{route('download_sales_full_excel')}}">
                                    <button type="submit" class="btn btn-danger">Download Full Excel</button>
                                </a>
                            </div> -->
                        </div>
                        <div class="container-fluid px-3 py-3" style="padding-right:10px;">
                            <table class="table table-bordered  border-dark text-center">
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Lease</th>
                                        <th>Company</th>
                                        <th>Customer Name</th>
                                        <th>Item</th>
                                        <th>Date & Time (In)</th>
                                        <th>Vehicle Number</th>
                                        <th>Driver Name</th>
                                        <th>Tare Wt.</th>
                                        <th>Gross Wt.</th>
                                        <th>Net Wt.</th>
                                        <th>Date-Time</th>
                                        <th>Update</th>    
                                        <th>Delete</th>    
                                        <th>Print</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales_out as $sales)
                                        <tr>
                                        <td>{{ $sales->id }}</td>
                                        <td>{{ $sales->lease }}</td>
                                        <td>{{ $sales->selling_company }}</td>
                                        <td>{{ $sales->customer_name }}</td>
                                        <td>{{ $sales->item }}</td>
                                        <td>{{ $sales->date_time }}</td>
                                        <td>{{ $sales->vehicle_no }}</td>
                                        <td>{{ $sales->driver_name }}</td>
                                        <td>{{ $sales->tare_weight }}</td>
                                        <td>{{ $sales->gross_weight }}</td>
                                        <td>{{ $sales->net_weight }}</td>
                                        <td>{{ $sales->created_at }}</td>
                                        <td>
                                            <a href="{{url('sales_out_update')}}/{{$sales->id}}" class="btn btn-info">
                                                <!-- <button class="btn btn-success">Update</button> -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{url('sales_out_delete')}}/{{$sales->id}}" class="btn btn-danger">
                                                <!-- <button class="btn btn-danger">Delete</button> -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                </svg>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{url('print_sales_out')}}/{{$sales->id}}" class="btn btn-warning" target="_blank" rel="noopener noreferrer">
                                                <!-- <button class="btn btn-danger">Delete</button> -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                                    <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                                                    <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                                </svg>
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
    </div>
</body>

</html>