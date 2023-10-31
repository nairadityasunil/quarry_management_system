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
                            <h1 class="text-center">Add Mail</h1>
                            <br>
                            <form method="POST" action="store_mail">
                                @csrf
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email :</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="email" class="form-control" id="email" placeholder="" value="{{old('email')}}">
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
                                            <button type="submit" class="btn btn-danger">Add Mail</button>
                                        </div>
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