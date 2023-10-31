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
        <div class="col-sm-10">
            <div class="card" style="margin-top :10px; height:95vh;">
                <div class="card-body overflow1 card-height" style="">
                    <h1 class="text-center">Update Employee</h1>
                    <br>
                    <form method="POST" action="{{route('update_employee')}}" class="py-3" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="id" class="col-sm-3 col-form-label">Id :</label>
                            <div class="col-sm-6">
                                <input type="text" name="id" class="form-control" id="id" placeholder="" value="{{$employee_details->id}}" readonly>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="employee_name" class="col-sm-3 col-form-label">Emp Name :</label>
                            <div class="col-sm-6">
                                <input type="text" name="employee_name" class="form-control" id="employee_name" placeholder="" value="{{$employee_details->emp_name}}">
                                <span class="text-danger">
                                    @error('employee_name')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="gender" class="col-sm-3 col-form-label">Gender :</label>
                            <div class="col-sm-6">
                                <select class="form-select" aria-label="Default select example" name="gender">
                                    <option selected value="{{$employee_details->gender}}">{{$employee_details->gender}}</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <span class="text-danger">
                                    @error('gender')
                                        {{$message}}
                                    @enderror
                                </span>   
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label">Address :</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="address" rows="3" name="address" id="address">{{$employee_details->address}}</textarea>
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
                                <input type="text" name="contact" class="form-control" id="contact" placeholder="" value="{{$employee_details->contact_no}}">
                                <span class="text-danger">
                                    @error('contact')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="designation" class="col-sm-3 col-form-label">Designation :</label>
                            <div class="col-sm-6">
                                <input type="text" name="designation" class="form-control" id="designation" placeholder="" value="{{$employee_details->designation}}">
                                <span class="text-danger">
                                    @error('designation')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="joining_date" class="col-sm-3 col-form-label">Joining Date :</label>
                            <div class="col-sm-6">
                                <input type="date" name="joining_date" class="form-control" id="joining_date" placeholder="" value="{{$employee_details->joining_date}}">
                                <span class="text-danger">
                                    @error('joining_date')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="old_photo" class="col-sm-3 col-form-label">Old Photo :</label>
                            <div class="col-sm-6">
                                <div class="img-thumbnail img-fluid">
                                    <img style="max-width:30vw;" src="{{asset('uploads/employee_photos/'.$employee_details->emp_photo)}}">
                                    <br><br>
                                    <input type="text" readonly class="form-control-plaintext" id="old_photo" name="old_photo" value="{{$employee_details->emp_photo}}">
                                    <span class="text-danger">
                                        @error('old_photo')
                                            {{$message}}
                                        @enderror
                                    </span>
                                    <!-- <input type="text" name="old_photo" class="form-control" id="old_photo" placeholder="" value="{{$employee_details->emp_photo}}"> -->
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="emp_photo" class="col-sm-3 col-form-label">New Photo :</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="file" id="emp_photo" name="emp_photo" value="{{$employee_details->emp_photo}}">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label"></div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-danger">Update Employee</button>
                                <!-- <a href="{{url('print_employee_details')}}/{{$employee_details->id}}" target="_blank" rel="noopener">
                                    <button type="button" class="btn btn-secondary">Print Details</button>
                                </a> -->
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>   
    </div>
</div>
</body>
</html>