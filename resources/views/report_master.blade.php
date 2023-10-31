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
    <!-- <br> -->
    <div class="container-fluid">
        <div class="row">
            <x-side_navbar/>
            <div class="col-sm-10">
                <div class="col-sm-12 d-flex flex-column overflow-auto">
                    <div class="card my-2">
                        <div class="card-body text-center bg-danger text-white font-weight-bold">
                            <h4>Report Master</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 d-flex flex-column overflow-auto" style="max-height:85vh;">
                    <div class="card my-0" style="margin-top : 10px;">
                        <div class="card-body my-2">
                        <form method="post" action="{{route('get_purchase_report')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="search_item" class="col-sm-2 col-form-label">Purchase Report :</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input type="date" name="purchase_date_from" class="form-control" id="purchase_date_from" placeholder="From" >
                                            </div>
                                            <div class="col-sm-1 text-center py-2">
                                                <label for="">to :</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="date" name="purchase_date_to" class="form-control" id="purchase_date_to" placeholder="To" >
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="form-select" aria-label="Default select example" name="email">
                                                    @foreach ($all_mails as $mail)
                                                        <option value="{{$mail->email}}">{{$mail->email}}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-dark">Submit</button>
                                        <a href="{{route('report_master')}}">
                                            <button type="button" class="btn btn-danger">Clear</button>
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <center>
                                <span class="text-danger">{{session()->get('purchase_status')}}</span>
                                <span class="text-success">{{session()->get('purchase_mail_status')}}</span>
                            </center>
                        </div>
                    </div>
                    <div class="card my-2" style="margin-top : 10px;">
                        <div class="card-body my-2">
                            <form method="post" action="{{route('get_sales_report')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="search_item" class="col-sm-2 col-form-label">Sales Report :</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input type="date" name="sales_date_from" class="form-control" id="sales_date_from" placeholder="From" >
                                            </div>
                                            <div class="col-sm-1 text-center py-2">
                                                <label for="">to :</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="date" name="sales_date_to" class="form-control" id="sales_date_to" placeholder="To" >
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="form-select" aria-label="Default select example" name="email">
                                                    @foreach ($all_mails as $mail)
                                                        <option value="{{$mail->email}}">{{$mail->email}}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-dark">Submit</button>
                                        <a href="{{route('report_master')}}">
                                            <button type="button" class="btn btn-danger">Clear</button>
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <center>
                                <span class="text-danger">{{session()->get('sales_status')}}</span>
                                <span class="text-success">{{session()->get('sale_mail_status')}}</span>
                            </center>
                        </div>
                    </div>
                    <div class="card my-2" style="margin-top : 10px;">
                        <div class="card-body my-2">
                            <form method="post" action="{{route('get_fuel_in_report')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="search_item" class="col-sm-2 col-form-label">Fuel-In Report :</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input type="date" name="fuel_in_date_from" class="form-control" id="fuel_in_date_from" placeholder="From" >
                                            </div>
                                            <div class="col-sm-1 text-center py-2">
                                                <label for="">to :</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="date" name="fuel_in_date_to" class="form-control" id="fuel_in_date_to" placeholder="To" >
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="form-select" aria-label="Default select example" name="email">
                                                    @foreach ($all_mails as $mail)
                                                        <option value="{{$mail->email}}">{{$mail->email}}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-dark">Submit</button>
                                        <a href="{{route('report_master')}}">
                                            <button type="button" class="btn btn-danger">Clear</button>
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <center>
                                <span class="text-danger">{{session()->get('fuel_in_status')}}</span>
                                <span class="text-success">{{session()->get('fuel_in_mail_status')}}</span>
                            </center>
                        </div>
                    </div>
                    <div class="card my-2" style="margin-top : 10px;">
                        <div class="card-body my-2">
                            <form method="post" action="{{route('get_fuel_out_report')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="search_item" class="col-sm-2 col-form-label">Fuel-Out Report :</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input type="date" name="fuel_out_date_from" class="form-control" id="fuel_out_date_from" placeholder="From" >
                                            </div>
                                            <div class="col-sm-1 text-center py-2">
                                                <label for="">to :</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="date" name="fuel_out_date_to" class="form-control" id="fuel_out_date_to" placeholder="To" >
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="form-select" aria-label="Default select example" name="email">
                                                    @foreach ($all_mails as $mail)
                                                        <option value="{{$mail->email}}">{{$mail->email}}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-dark">Submit</button>
                                        <a href="{{route('report_master')}}">
                                            <button type="button" class="btn btn-danger">Clear</button>
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <center>
                                <span class="text-danger">{{session()->get('fuel_out_status')}}</span>
                                <span class="text-success">{{session()->get('fuel_out_mail_status')}}</span>
                            </center>
                        </div>
                    </div>
                    <div class="card my-2" style="margin-top : 10px;">
                        <div class="card-body my-2">
                            <form method="post" action="{{route('mail_fuel_available')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="search_item" class="col-sm-2 col-form-label">Fuel Available Report :</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <select class="form-select" aria-label="Default select example" name="email">
                                                            @foreach ($all_mails as $mail)
                                                                <option value="{{$mail->email}}">{{$mail->email}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <select class="form-select" aria-label="Default select example" name="format">
                                                                <option value="pdf">PDF</option>
                                                                <option value="excel">Excel</option>
                                                        </select> 
                                                    </div>
                                                </div>
                                            </div>
                            
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-success">Mail</button>
                                        <a href="{{route('download_fuel_available_pdf')}}" class="btn btn-warning">
                                 <!-- <button > -->
                                                    Download Pdf
                                 <!-- </button> -->
                                                </a>
                                                <a href="{{route('download_fuel_available_excel')}}">
                                                    <button type="button" class="btn btn-primary">
                                                        Download Excel
                                                    </button>
                                                </a>
                                        <!-- <a href="{{route('report_master')}}">
                                            <button type="button" class="btn btn-danger">Clear</button>
                                        </a> -->
                                    </div>
                                </div>
                            </form>
                            <center>
                                <span class="text-success">{{session()->get('fuel_available_mail_status')}}</span>
                            </center>
                        </div>
                    </div>     
                    <div class="card my-2" style="margin-top : 10px;">
                        <div class="card-body my-2">
                            <form method="post" action="{{route('get_store_in_report')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="search_item" class="col-sm-2 col-form-label">Store-In Report :</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input type="date" name="store_in_date_from" class="form-control" id="store_in_date_from" placeholder="From" >
                                            </div>
                                            <div class="col-sm-1 text-center py-2">
                                                <label for="">to :</label>
                                            </div>
                                            <div class="col-sm-3">  
                                                <input type="date" name="store_in_date_to" class="form-control" id="store_in_date_to" placeholder="To" >
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="form-select" aria-label="Default select example" name="email">
                                                    @foreach ($all_mails as $mail)
                                                        <option value="{{$mail->email}}">{{$mail->email}}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-dark">Submit</button>
                                        <a href="{{route('report_master')}}">
                                            <button type="button" class="btn btn-danger">Clear</button>
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <center>
                                <span class="text-danger">{{session()->get('store_in_status')}}</span>
                                <span class="text-success">{{session()->get('store_in_mail_status')}}</span>
                            </center>
                        </div>
                    </div>
                    <div class="card my-2" style="margin-top : 10px;">
                        <div class="card-body my-2">
                            <form method="post" action="{{route('get_store_out_report')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="search_item" class="col-sm-2 col-form-label">Store-Out Report :</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input type="date" name="store_out_date_from" class="form-control" id="store_out_date_from" placeholder="From" >
                                            </div>
                                            <div class="col-sm-1 text-center py-2">
                                                <label for="">to :</label>
                                            </div>
                                            <div class="col-sm-3">  
                                                <input type="date" name="store_out_date_to" class="form-control" id="store_out_date_to" placeholder="To" >
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="form-select" aria-label="Default select example" name="email">
                                                    @foreach ($all_mails as $mail)
                                                        <option value="{{$mail->email}}">{{$mail->email}}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-dark">Submit</button>
                                        <a href="{{route('report_master')}}">
                                            <button type="button" class="btn btn-danger">Clear</button>
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <center>
                                <span class="text-danger">{{session()->get('store_out_status')}}</span>
                                <span class="text-success">{{session()->get('store_out_mail_status')}}</span>
                            </center>
                        </div>
                    </div>
                    <div class="card my-2" style="margin-top : 10px;">
                        <div class="card-body my-2">
                            <form method="post" action="{{route('mail_store_status')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="search_item" class="col-sm-2 col-form-label">Store Status Report :</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <select class="form-select" aria-label="Default select example" name="email">
                                                            @foreach ($all_mails as $mail)
                                                                <option value="{{$mail->email}}">{{$mail->email}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <select class="form-select" aria-label="Default select example" name="format">
                                                                <option value="pdf">PDF</option>
                                                                <option value="excel">Excel</option>
                                                        </select> 
                                                    </div>
                                                </div>
                                            </div>
                            
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-success">Mail</button>
                                        <a href="{{route('download_store_status_pdf')}}" class="btn btn-warning">
                                 <!-- <button > -->
                                                    Download Pdf
                                 <!-- </button> -->
                                                </a>
                                                <a href="{{route('download_store_status_excel')}}">
                                                    <button type="button" class="btn btn-primary">
                                                        Download Excel
                                                    </button>
                                                </a>
                                        <!-- <a href="{{route('report_master')}}">
                                            <button type="button" class="btn btn-danger">Clear</button>
                                        </a> -->
                                    </div>
                                </div>
                            </form>
                            <center>
                                <span class="text-danger">{{session()->get('store_out_status')}}</span>
                                <span class="text-success">{{session()->get('store_status_mail_status')}}</span>
                            </center>
                        </div>
                    </div>                
        </div>
    </div>
</div>
</body>

</html>