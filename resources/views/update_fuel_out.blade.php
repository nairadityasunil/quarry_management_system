<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quarry Management System</title>
    <link rel="icon" href="frontend/img/quarry.ico" type="icon">
    <link rel="stylesheet" href="{{URL::asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('frontend/css/dashboard_style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('frontend/css/style1.css')}}">
    <script src="{{URL::asset('dashboard.js')}}"></script>
    <script src="{{URL::asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
</head>

<body class="overflow-hidden">
    {{-- Component Navbar Being Brought To The Page --}}
<x-navbar/>
    <!-- <br> -->
<div class="continer-fluid">
    <div class="row">
        <x-side_navbar/>
        <div class="col-sm-10" >
            <div class="card" style="margin-top :10px; height:95vh;">
                <div class="card-body overflow1 card-height" style="">
                    <h1 class="text-center">Fuel Out Update</h1>
                    <br>
                    <form method="POST" action="{{route('confirm_fuel_out_update')}}" class="py-3">
                        @csrf
                        <div class="form-group row">
                            <label for="id" class="col-sm-3 col-form-label">Sr. No. :</label>
                            <div class="col-sm-6">
                                <input type="text" name="id" class="form-control" id="id" placeholder="" value="{{$fuel_name->id ?? ''}}" readonly="readonly">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="fuel_type" class="col-sm-3 col-form-label">Fuel Type :</label>
                            <div class="col-sm-6">
                                <input type="text" name="fuel_type" class="form-control" id="fuel_type" placeholder="" value="{{$fuel_name->fuel_type ?? ''}}" readonly="readonly">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="fuel_out_quantity" class="col-sm-3 col-form-label">Withdrawl Quantity :</label>
                            <div class="col-sm-6">
                                <input type="text" name="fuel_out_quantity" class="form-control" id="fuel_out_quantity" placeholder="" value="{{$fuel_name->quantity}}" readonly="readonly">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="vehicle_no" class="col-sm-3 col-form-label">Vehicle No. :</label>
                            <div class="col-sm-6">
                                <input type="text" name="vehicle_no" class="form-control" id="vehicle_no" placeholder="" value="{{$fuel_name->vehicle_no}}">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label"></div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-danger">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>   
    </div>

</body>
</html>