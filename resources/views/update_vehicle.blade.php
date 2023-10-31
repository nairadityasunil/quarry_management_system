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
    <div class="continer-fluid">
    <div class="row">
        <x-side_navbar/>
            <div class="col-sm-10" style="">
            <div class="card" style="margin-top : 10px; height:95vh;padding-right:10px;">
                    <div class="card-body overflow-auto" style="margin-left:10px; padding:20px;">
                        <h1 class="text-center">Update Vehicle</h1>
                        <br>
                        <form method="POST" action="{{route('confirm_vehicle_update')}}">
                            @csrf
                            <!-- Vehicle Number -->
                            <div class="form-group row">
                                <label for="id" class="col-sm-3 col-form-label">Number :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="id" class="form-control" id="id" placeholder="" value="{{$vehicle_id_details->id}}">
                                    <span class="text-danger">
                                        @error('id')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            <!-- Vehicle Number -->
                            <div class="form-group row">
                                <label for="vehicle_number" class="col-sm-3 col-form-label">Vehicle No. :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="vehicle_number" class="form-control" id="vehicle_number" placeholder="" value="{{$vehicle_id_details->vehicle_no}}">
                                    <span class="text-danger">
                                        @error('vehicle_number')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            
                            <!-- Registered Owner -->
                            <div class="form-group row">
                                <label for="registered_owner" class="col-sm-3 col-form-label">Registered Owner :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="registered_owner" class="form-control" id="registered_owner" placeholder="" value="{{$vehicle_id_details->registered_owner}}">
                                    <span class="text-danger">
                                        @error('registered_owner')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            
                            <!-- Loading Capacity -->
                            <div class="form-group row">
                                <label for="loading_capacity" class="col-sm-3 col-form-label">Loading Capacity :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="loading_capacity" class="form-control" id="loading_capacity" placeholder="" value="{{$vehicle_id_details->loading_capacity}}">
                                    <span class="text-danger">
                                        @error('loading_capacity')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
        
                            <!-- Tare Weight -->
                            <div class="form-group row">
                                <label for="tare_weight" class="col-sm-3 col-form-label">Tare Wt. :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="tare_weight" class="form-control" id="tare_weight" placeholder="" value="{{$vehicle_id_details->tare_weight}}">
                                    <span class="text-danger">
                                        @error('tare_weight')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            
                            <!-- Make -->
                            <div class="form-group row">
                                <label for="make" class="col-sm-3 col-form-label">Make :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="make" class="form-control" id="make" placeholder="" value="{{$vehicle_id_details->make}}">
                                    <span class="text-danger">
                                        @error('make')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            
                            <!-- Model Number -->
                            <div class="form-group row">
                                <label for="model_no" class="col-sm-3 col-form-label">Model No. :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="model_no" class="form-control" id="model_no" placeholder="" value="{{$vehicle_id_details->model_no}}">
                                    <span class="text-danger">
                                        @error('model_no')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            
                            <!-- Engine Number -->
                            <div class="form-group row">
                                <label for="engine_no" class="col-sm-3 col-form-label">Engine No. :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="engine_no" class="form-control" id="engine_no" placeholder="" value="{{$vehicle_id_details->engine_no}}">
                                    <span class="text-danger">
                                        @error('engine_no')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            
                            <!-- Chassis Number -->
                            <div class="form-group row">
                                <label for="chassis_no" class="col-sm-3 col-form-label">Chassis No. :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="chassis_no" class="form-control" id="chassis_no" placeholder="" value="{{$vehicle_id_details->chassis_no}}">
                                    <span class="text-danger">
                                        @error('chassis_no')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            
                            <!-- Passing Territory -->
                            <div class="form-group row">
                                <label for="passing_territory" class="col-sm-3 col-form-label">Passing Territory :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="passing_territory" class="form-control" id="passing_territory" placeholder="" value="{{$vehicle_id_details->passing_territory}}">
                                    <span class="text-danger">
                                        @error('passing_territory')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
        
                            <!-- Fitness Upto -->
                            <div class="form-group row">
                                <label for="fitness_upto" class="col-sm-3 col-form-label">Fitness Upto :</label>
                                <div class="col-sm-6">
                                    <input type="date" name="fitness_upto" class="form-control" id="fitness_upto" placeholder="" value="{{$vehicle_id_details->fitness_upto}}">
                                    <span class="text-danger">
                                        @error('fitness_upto')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            
                            <!-- Permit Upto -->
                            <div class="form-group row">
                                <label for="permit_upto" class="col-sm-3 col-form-label">Permit Upto :</label>
                                <div class="col-sm-6">
                                    <input type="date" name="permit_upto" class="form-control" id="permit_upto" placeholder="" value="{{$vehicle_id_details->permit_upto}}">
                                    <span class="text-danger">
                                        @error('permit_upto')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            
                            <!-- Driver Name -->
                            <div class="form-group row">
                                <label for="driver_name" class="col-sm-3 col-form-label">Driver Name :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="driver_name" class="form-control" id="driver_name" placeholder="" value="{{$vehicle_id_details->driver_name}}">
                                    <span class="text-danger">
                                        @error('driver_name')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            
                            <!-- License Number -->
                            <div class="form-group row">
                                <label for="license_no" class="col-sm-3 col-form-label">License No :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="license_no" class="form-control" id="license_no" placeholder="" value="{{$vehicle_id_details->license_no}}">
                                    <span class="text-danger">
                                        @error('license_no')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            
                            <!-- Group (Purchase or Sales) -->
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Group :</label>
                                <div class="col-sm-6">
                                <select class="form-select" aria-label="Default select example" name="group">
                                    <option selected value="{{$vehicle_id_details->group}}">{{$vehicle_id_details->group}}</option>
                                    <option value="Purchase Group">Purchase Group</option>
                                    <option value="Sales Group">Sales Group</option>
                                </select>   
                                <span class="text-danger">
                                        @error('group')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            
                            <!-- Submit -->
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label"></div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-danger">Update Vehicle</button>
                                </div>
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="container "> -->
        <!-- <div class="row justify-content-center">
            <div class="col-sm-7">
                <h1 class="text-center">Update Vehicle</h1>
                <br>
                <form method="POST" action="{{route('confirm_vehicle_update')}}">
                    @csrf -->
                    <!-- Vehicle Number -->
                    <!-- <div class="form-group row">
                        <label for="id" class="col-sm-3 col-form-label">Number :</label>
                        <div class="col-sm-6">
                            <input type="text" name="id" class="form-control" id="id" placeholder="" value="{{$vehicle_id_details->id}}">
                        </div>
                    </div>
                    <br> -->
                    <!-- Vehicle Number -->
                    <!-- <div class="form-group row">
                        <label for="vehicle_number" class="col-sm-3 col-form-label">Vehicle No. :</label>
                        <div class="col-sm-6">
                            <input type="text" name="vehicle_number" class="form-control" id="vehicle_number" placeholder="" value="{{$vehicle_id_details->vehicle_no}}">
                        </div>
                    </div>
                    <br> -->
                    
                    <!-- Registered Owner -->
                    <!-- <div class="form-group row">
                        <label for="registered_owner" class="col-sm-3 col-form-label">Registered Owner :</label>
                        <div class="col-sm-6">
                            <input type="text" name="registered_owner" class="form-control" id="registered_owner" placeholder="" value="{{$vehicle_id_details->registered_owner}}">
                        </div>
                    </div>
                    <br> -->
                    
                    <!-- Loading Capacity -->
                    <!-- <div class="form-group row">
                        <label for="loading_capacity" class="col-sm-3 col-form-label">Loading Capacity :</label>
                        <div class="col-sm-6">
                            <input type="text" name="loading_capacity" class="form-control" id="loading_capacity" placeholder="" value="{{$vehicle_id_details->loading_capacity}}">
                        </div>
                    </div>
                    <br> -->

                    <!-- Tare Weight -->
                    <!-- <div class="form-group row">
                        <label for="tare_weight" class="col-sm-3 col-form-label">Tare Wt. :</label>
                        <div class="col-sm-6">
                            <input type="text" name="tare_weight" class="form-control" id="tare_weight" placeholder="" value="{{$vehicle_id_details->tare_weight}}">
                        </div>
                    </div>
                    <br> -->
                    
                    <!-- Make -->
                    <!-- <div class="form-group row">
                        <label for="make" class="col-sm-3 col-form-label">Make :</label>
                        <div class="col-sm-6">
                            <input type="text" name="make" class="form-control" id="make" placeholder="" value="{{$vehicle_id_details->make}}">
                        </div>
                    </div>
                    <br> -->
                    
                    <!-- Model Number -->
                    <!-- <div class="form-group row">
                        <label for="model_no" class="col-sm-3 col-form-label">Model No. :</label>
                        <div class="col-sm-6">
                            <input type="text" name="model_no" class="form-control" id="model_no" placeholder="" value="{{$vehicle_id_details->model_no}}">
                        </div>
                    </div>
                    <br> -->
                    
                    <!-- Engine Number -->
                    <!-- <div class="form-group row">
                        <label for="engine_no" class="col-sm-3 col-form-label">Engine No. :</label>
                        <div class="col-sm-6">
                            <input type="text" name="engine_no" class="form-control" id="engine_no" placeholder="" value="{{$vehicle_id_details->engine_no}}">
                        </div>
                    </div>
                    <br> -->
                    
                    <!-- Chassis Number -->
                    <!-- <div class="form-group row">
                        <label for="chassis_no" class="col-sm-3 col-form-label">Chassis No. :</label>
                        <div class="col-sm-6">
                            <input type="text" name="chassis_no" class="form-control" id="chassis_no" placeholder="" value="{{$vehicle_id_details->chassis_no}}">
                        </div>
                    </div>
                    <br> -->
                    
                    <!-- Passing Territory -->
                    <!-- <div class="form-group row">
                        <label for="passing_territory" class="col-sm-3 col-form-label">Passing Territory :</label>
                        <div class="col-sm-6">
                            <input type="text" name="passing_territory" class="form-control" id="passing_territory" placeholder="" value="{{$vehicle_id_details->passing_territory}}">
                        </div>
                    </div>
                    <br> -->

                    <!-- Fitness Upto -->
                    <!-- <div class="form-group row">
                        <label for="fitness_upto" class="col-sm-3 col-form-label">Fitness Upto :</label>
                        <div class="col-sm-6">
                            <input type="date" name="fitness_upto" class="form-control" id="fitness_upto" placeholder="" value="{{$vehicle_id_details->fitness_upto}}">
                        </div>
                    </div>
                    <br> -->
                    
                    <!-- Permit Upto -->
                    <!-- <div class="form-group row">
                        <label for="permit_upto" class="col-sm-3 col-form-label">Permit Upto :</label>
                        <div class="col-sm-6">
                            <input type="date" name="permit_upto" class="form-control" id="permit_upto" placeholder="" value="{{$vehicle_id_details->permit_upto}}">
                        </div>
                    </div>
                    <br> -->
                    
                    <!-- Driver Name -->
                    <!-- <div class="form-group row">
                        <label for="driver_name" class="col-sm-3 col-form-label">Driver Name :</label>
                        <div class="col-sm-6">
                            <input type="text" name="driver_name" class="form-control" id="driver_name" placeholder="" value="{{$vehicle_id_details->driver_name}}">
                        </div>
                    </div>
                    <br>
                     -->
                    <!-- License Number -->
                    <!-- <div class="form-group row">
                        <label for="license_no" class="col-sm-3 col-form-label">License No :</label>
                        <div class="col-sm-6">
                            <input type="text" name="license_no" class="form-control" id="license_no" placeholder="" value="{{$vehicle_id_details->license_no}}">
                        </div>
                    </div>
                    <br> -->
                    
                    <!-- Group (Purchase or Sales) -->
                    <!-- <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Group :</label>
                        <div class="col-sm-6">
                        <select class="form-select" aria-label="Default select example" name="group">
                            <option selected value="{{$vehicle_id_details->group}}">{{$vehicle_id_details->group}}</option>
                            <option value="Purchase Group">Purchase Group</option>
                            <option value="Sales Group">Sales Group</option>
                        </select>   
                        </div>
                    </div>
                    <br> -->
                    
                    <!-- Submit -->
                    <!-- <div class="form-group row">
                        <div class="col-sm-3 col-form-label"></div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-danger">Update Vehicle</button>
                        </div>
                    </div> -->
                    <br>
                </form>
                <br><br>
            </div>
        </div>
    </div>
</body>
</html>