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
                            <h1 class="text-center">Add Lease</h1>
                            <br>
                            <form method="POST" action="store_lease">
                                @csrf
                                <div class="form-group row">
                                    <label for="lease_no" class="col-sm-3 col-form-label">Lease No. :</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="lease_no" class="form-control" id="lease_no" placeholder="" value="">
                                        <span class="text-danger">
                                            @error('lease_no')
                                                {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 col-form-label">Address :</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="address" id="address"></textarea>
                                        <span class="text-danger">
                                            @error('address')
                                                {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="lease_area" class="col-sm-3 col-form-label">Lease Area :</label>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <input type="text" name="lease_area" class="form-control" id="lease_area" placeholder="" value="">
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="form-select" aria-label="Default select example" name="measure">
                                                    <!-- <option>-</option> -->
                                                    <option value="Hectare">Hectare</option>
                                                    <option value="Sq. Yards">Sq. Yards</option>
                                                    <option value="Yards">Yards</option>
                                                    <option value="Metre">Metre</option>
                                                    <option value="Sq. Metre">Sq. Metre</option>
                                                </select>
                                            </div>
                                            <span class="text-danger">
                                                    @error('measure')
                                                        {{$message}}
                                                    @enderror
                                            </span>
                                            <span class="text-danger">
                                                    @error('lease_area')
                                                        {{$message}}
                                                    @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="leaseholder" class="col-sm-3 col-form-label">Leaseholder :</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="leaseholder" class="form-control" id="leaseholder" placeholder="" value="">
                                        <span class="text-danger">
                                            @error('leaseholder')
                                                {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="lease_ton_limit" class="col-sm-3 col-form-label">Lease Ton Limit :</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="lease_ton_limit" class="form-control" id="lease_ton_limit" placeholder="" value="0">
                                        <span class="text-danger">
                                            @error('lease_ton_limit')
                                                {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label"></div>
                                    <div class="col-sm-6">
                                       <button type="submit" class="btn btn-danger">Add Lease</button>
                                    </div>
                                </div>
                                <br>
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