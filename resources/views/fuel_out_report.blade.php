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
                            <div class="col-sm-6">
                                <label>Email : </label>    
                                <label class="text-danger">{{session()->get('email')}}</label>    
                            </div>
                            <div class="col-sm-1">

                            </div>
                            <div class="col-sm-5">
                                <center>
                                    <h3>Fuel-Out Report</h3>
                                    <span><b>From:</b> <u>{{session()->get('fuel_out_from')}}</u><b> To:</b> <u>{{session()->get('fuel_out_to')}}</u></span>
                                </center>
                            </div>
                         </div>  
                         <div class="col-sm-5 py-4">
                             <a href="{{route('download_fuel_out_pdf')}}" class="btn btn-primary">
                                 <!-- <button > -->
                                    Download Pdf
                                 <!-- </button> -->
                             </a>
                             <a href="{{route('download_fuel_out_excel')}}">
                                <button class="btn btn-danger">
                                    Download Excel
                                </button>
                             </a>
                             <a href="{{route('mail_fuel_out_pdf')}}">
                                <button class="btn btn-success">
                                    Mail Pdf
                                </button>
                             </a>
                             <a href="{{route('mail_fuel_out_excel')}}">
                                <button class="btn btn-warning">
                                    Mail Excel
                                </button>
                             </a>
                        </div>
                    </div>
                        
                        </div>
                        <div class="container px-3 py-3" style="padding-right:10px;">
                        <table class="table table-bordered border-dark text-center">
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Fuel Type</th>
                                        <th>Quantity</th>
                                        <th>Vehicle No.</th>
                                        <th>Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fuel_out_details as $fuel)
                                        <tr>
                                            <td>{{ $fuel->id }}</td>
                                            <td>{{ $fuel->fuel_type }}</td>
                                            <td>{{ $fuel->quantity }}</td>
                                            <td>{{ $fuel->vehicle_no }}</td>
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