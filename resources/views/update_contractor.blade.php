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
<x-navbar/>
<div class="continer-fluid">
    <div class="row">
        <x-side_navbar/>
        <div class="col-sm-10">
            <div class="card" style="margin-top :10px; height:95vh;">
                <div class="card-body overflow1 card-height" style="">
                    <h1 class="text-center">Update Contractor</h1>
                    <br>
                  
                    <form method="POST" action="{{route('confirm_contractor_update')}}" name="contractor_entry" class="py-3" enctype="multipart/form-data">
                        @csrf
                        <!-- <pre>
                            @php
                                print_r($errors->all());
                            @endphp
                        </pre> -->
                        <div class="form-group row">
                            <label for="contractor_name" class="col-sm-3 col-form-label">Contractor Name :</label>
                            <div class="col-sm-6">
                                <input type="text" name="contractor_name" class="form-control" id="contractor_name" placeholder=""  value="{{$update_details->contractor_name}}">
                                <span class="text-danger">
                                    @error('contractor_name')
                                        {{$message}}
                                    @enderror
                                </span>
                                <!-- <span class="alert alert_primary" id="check_con_name"></span> -->
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="contractor_type" class="col-sm-3 col-form-label">Contractor Type :</label>
                            <div class="col-sm-6">
                                <input type="text" name="contractor_type" class="form-control" id="contractor_type" placeholder="" value="{{$update_details->contractor_type}}">
                                <span class="text-danger">
                                    @error('contractor_type')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label">Address :</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="address" rows="3" name="address" id="address">{{$update_details->address}}</textarea>
                                <span class="text-danger">
                                    @error('address')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="contact" class="col-sm-3 col-form-label">Contact :</label>
                            <div class="col-sm-6">
                                <input type="text" name="contact" class="form-control" id="contact" placeholder="" value="{{$update_details->contact}}">
                                <span class="text-danger">
                                    @error('contact')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email :</label>
                            <div class="col-sm-6">
                                <input type="text" name="email" class="form-control" id="email" placeholder="" value="{{$update_details->email}}">
                                <span class="text-danger">
                                    @error('email')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label"></div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-danger">Update Contractor</button>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>   
    </div>
</body>
</html>