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
</head>

<body >
    <div class="container">
        <div class="row">
            <div class="col-sm-12 d-flex flex-column">
                     <div class="row">
                         <div class="col-sm-7 py-4 d-flex justify-content-end">
                                <h3>Sales-Out List</h3>
                         </div>  
                         <div class="col-sm-5 py-4">
                             <a href="{{route('download_sales_pdf')}}" class="btn btn-primary">
                                 <!-- <button > -->
                                    Download Pdf
                                 <!-- </button> -->
                             </a>
                             <a href="{{route('download_sales_excel')}}">
                                <button class="btn btn-danger">
                                    Download Excel
                                </button>
                             </a>
                             <a href="{{route('mail_sales_pdf')}}">
                                <button class="btn btn-success">
                                    Mail Pdf
                                </button>
                             </a>
                             <a href="{{route('mail_sales_excel')}}">
                                <button class="btn btn-warning">
                                    Mail Excel
                                </button>
                             </a>
                         </div>
                     </div>
                        
                        </div>
                        <div class="container px-3 py-3" style="padding-right:10px;">
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
                                        <th>Loader</th>
                                        <th>Date-Time</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales_details as $sales)
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
                                        <td>{{ $sales->loader }}</td>
                                        <td>{{ $sales->created_at }}</td>
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