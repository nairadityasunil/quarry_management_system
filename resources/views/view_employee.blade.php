<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quarry Management System</title>
    <link rel="icon" href="frontend/img/quarry.ico" type="icon">
    <link rel="stylesheet" href="{{URL::asset('frontend/css/bootstrap.min.css')}}">
    <!-- <link rel="stylesheet" href="{{URL::asset('frontend/css/dashboard_style.css')}}"> -->
    <!-- <link rel="stylesheet" href="{{URL::asset('frontend/css/style1.css')}}"> -->
    <script src="{{URL::asset('dashboard.js')}}"></script>
    <script src="{{URL::asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
</head>

<body class="" style="background:white;">
    {{-- Component Navbar Being Brought To The Page --}}
<div class="container">
    <center>
        <h1>Employee Details</h1>
    </center>
    <br><br>
    <center>
        <img style="max-width:30vw;" src="{{asset('uploads/employee_photos/'.$print_details->emp_photo)}}" alt="">
            <div class="row">
            <center>
                    <!-- <div class="col-sm-2 text-center">
                        <b><label>Employee Name : </label></b>
                        <label for=""> {{$print_details->emp_name}}</label>
                    </div>
                    <div class="col-sm-2 text-center">
                        <b><label>Genter : </label></b>
                        <label for=""> {{$print_details->emp_name}}</label>
                    </div> -->
                    <br><br>
                    <table>
                        <tr>
                            <td><b>Employee Name : </b></td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{$print_details->emp_name}}</td>
                        </tr>
                        <tr>

                        </tr>
                        <tr>
                            <td><b>Gender : </b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{$print_details->gender}}</td>
                        </tr>
                        <tr>
                            <td><b>Address : </b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{$print_details->address}}</td>
                        </tr>
                        <tr>
                            <td><b>Contact : </b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{$print_details->contact_no}}</td>
                        </tr>
                        <tr>
                            <td><b>Designation : </b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{$print_details->designation}}</td>
                        </tr>
                        <tr>
                            <td><b>Joining Date : </b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{$print_details->joining_date}}</td>
                        </tr>
                    </table>
                    <br>
                    <button class="btn btn-danger" id="print_page">Print Employee Details</button>
            </center>
            </div>
    </center>
</div>
</body>
<script>
    $('#print_page').click(function(){
        $('#print_page').hide();
        if(window.print())
        {
            $('#print_page').show();
        }
        else
        {
            $('#print_page').show();
        }
    });
</script>
</html>