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
    <div class="container">
    <div class="card" style="margin-top :10px; height:80vh;">
                <div class="card-body overflow1 card-height" style="">
                    <h1 class="text-center">Register User</h1>
                    <br>
                    <form method="POST" action="{{route('register_user')}}" class="py-3" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">Username :</label>
                            <div class="col-sm-6">
                                <input type="text" name="username" class="form-control" id="username" placeholder="" value="">
                                <span class="text-danger">
                                    @error('username')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email :</label>
                            <div class="col-sm-6">
                                <input type="text" name="email" class="form-control" id="email" placeholder="" value="">
                                <span class="text-danger">
                                    @error('email')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="password1" class="col-sm-3 col-form-label">Password :</label>
                            <div class="col-sm-6">
                                <input type="password" name="password1" class="form-control" id="password1" placeholder="" value="">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="confirm_password" class="col-sm-3 col-form-label">Password Confirm :</label>
                            <div class="col-sm-6">
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="" value="">
                                <span class="text-danger">
                                    @error('confirm_password')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="admin_password1" class="col-sm-3 col-form-label">Admin Password :</label>
                            <div class="col-sm-6">
                                <input type="password" name="admin_password1" class="form-control" id="admin_password1" placeholder="" value="">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="confirm_admin_password" class="col-sm-3 col-form-label">Confirm Admin Password :</label>
                            <div class="col-sm-6">
                                <input type="password" name="confirm_admin_password" class="form-control" id="confirm_admin_password" placeholder="" value="">
                                <span class="text-danger">
                                    @error('confirm_admin_password')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label"></div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-danger">Register User</button>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
    </div>
</body>


</html>