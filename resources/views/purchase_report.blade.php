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
    <!-- <link rel="stylesheet" href="frontend/css/style1.css"> -->
    <script src="dashboard.js"></script>
    <script src="frontend/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
</head>

<body>
<div class="container">
        <div class="row">
            <div class="col-sm-12 d-flex flex-column">
                     <div class="row">
                         <div class="col-sm-7 py-4 d-flex justify-content-end">
                            <div class="col-sm-6">
                                <label>Email : </label>    
                                <label class="text-danger">{{session()->get('email')}}</label>    
                            </div>
                            <div class="col-sm-2">

                            </div>
                            <div class="col-sm-4">
                                <h3>Purchase List</h3>
                            </div>
                         </div>  
                         <div class="col-sm-5 py-4">
                             <a href="{{route('download_purchase_pdf')}}" class="btn btn-primary">
                                 <!-- <button > -->
                                    Download Pdf
                                 <!-- </button> -->
                             </a>
                             <a href="{{route('download_purchase_excel')}}">
                                <button class="btn btn-danger">
                                    Download Excel
                                </button>
                             </a>
                             <a href="{{route('mail_purchase_pdf')}}">
                                <button class="btn btn-success">
                                    Mail Pdf
                                </button>
                             </a>
                             <a href="{{route('mail_purchase_excel')}}">
                                <button class="btn btn-warning">
                                    Mail Excel
                                </button>
                             </a>
                         </div>
                     </div>
                        
                        </div>
                        <div class="container px-3 py-3" style="padding-right:10px;">
                            <table class="table table-bordered table-hover border-dark text-center">
                                <thead class="thead-dark">
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
                                    @foreach ($purchase_details as $purch)
                                        <tr>
                                            <td>{{ $purch->id }}</td>
                                            <td>{{ $purch->lease }}</td>
                                            <td>{{ $purch->purch_company }}</td>
                                            <td>{{ $purch->supplier }}</td>
                                            <td>{{ $purch->date_time }}</td>
                                            <td>{{ $purch->item }}</td>
                                            <td>{{ $purch->vehicle_no }}</td>
                                            <td>{{ $purch->driver_name }}</td>
                                            <td>{{ $purch->tare_weight }}</td>
                                            <td>{{ $purch->gross_weight }}</td>
                                            <td>{{ $purch->net_weight }}</td>
                                            <td>{{ $purch->created_at }}</td>
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