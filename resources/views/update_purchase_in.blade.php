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
</head>

<body class="overflow-hidden">
    {{-- Component Navbar Being Brought To The Page --}}
    <x-navbar/>
    <div class="row">
        <x-side_navbar/>
        <div class="col-sm-10" >
            <div class="card" style="margin-top :10px; height:95vh;">
                <div class="card-body overflow-auto" style="">
                    <div class="row justify-content-center">
                        <div class="col-sm-7">
                            <h1 class="text-center">Purchase-In Update</h1>
                            <br>
                            <form method="POST" action="{{route('confirm_purchase_in_update')}}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="id" class="col-sm-3 col-form-label">Number :</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="id" class="form-control" id="id" placeholder="" value="{{$purchase_id_details->id ?? ''}}">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="lease" class="col-sm-3 col-form-label">Lease :</label>
                                        <div class="col-sm-6">
                                            <!-- <input type="text" name="lease" class="form-control" id="lease" placeholder="" value="{{$purchase_id_details->lease ?? ''}}"> -->
                                            <select class="form-select" aria-label="Default select example" name="lease">
                                                <option selected value="{{$purchase_id_details->lease ?? ''}}">{{$purchase_id_details->lease ?? ''}}</option>
                                                @foreach ($lease as $l)
                                                    <option value="{{$l->lease_no}}">{{$l->lease_no}}</option>
                                                @endforeach
                                            </select> 
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="company" class="col-sm-3 col-form-label">Company :</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="purch_company" class="form-control" id="company" placeholder="" value="{{$purchase_id_details->purch_company ?? ''}}">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="vehicle_number" class="col-sm-3 col-form-label">Vehicle Number :</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="vehicle_no" class="form-control" id="vehicle_number" placeholder="" value="{{$purchase_id_details->vehicle_no ?? ''}}">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="supplier" class="col-sm-3 col-form-label">Supplier :</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="supplier" class="form-control" id="supplier" placeholder="" value="{{$purchase_id_details->supplier ?? ''}}">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Item :</label>
                                        <div class="col-sm-6">
                                            <select class="form-select" aria-label="Default select example" name="item">
                                                <option selected value="{{$purchase_id_details->item ?? ''}}">{{$purchase_id_details->item ?? ''}}</option>
                                                @foreach ($item as $it)
                                                    <option value="{{$it->item_name}}">{{$it->item_name}}</option>
                                                @endforeach
                                            </select>   
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="tare_weight" class="col-sm-3 col-form-label">Tare Wt. :</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="tare_weight" class="form-control" id="tare_weight" placeholder="" value="{{$purchase_id_details->tare_weight ?? ''}}">
                                            <br>
                                            <button type="submit" class="btn btn-danger">Update</button>
                                            <!-- <input type="submit" value="Submit" class="btn btn-danger"> -->
                                        </div>
                                    </div>
                            </form>
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
