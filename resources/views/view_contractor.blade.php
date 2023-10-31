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
        <h1>Contractor Details</h1>
    </center>
    <center>
            <div class="row">
            <center>
                    <br><br>
                    <table>
                        <tr>
                            <td><b>Contractor Name</b></td>
                            <td> </td>
                            <td> </td>
                            <td>:</td>
                            <td> </td>
                            <td> </td>
                            <td>{{$print_details->contractor_name}}</td>
                        </tr>
                        <tr>

                        </tr>
                        <tr>
                            <td><b>Contractor Type</b></td>
                            <td></td>
                            <td></td>
                            <td>:</td>
                            <td></td>
                            <td></td>
                            <td>{{$print_details->contractor_type}}</td>
                        </tr>
                        <tr>
                            <td><b>Address</b></td>
                            <td></td>
                            <td></td>
                            <td>:</td>
                            <td></td>
                            <td></td>
                            <td>{{$print_details->address}}</td>
                        </tr>
                        <tr>
                            <td><b>Contact</b></td>
                            <td></td>
                            <td></td>
                            <td>:</td>
                            <td></td>
                            <td></td>
                            <td>{{$print_details->contact}}</td>
                        </tr>
                        <tr>
                            <td><b>Email</b></td>
                            <td></td>
                            <td></td>
                            <td>:</td>
                            <td></td>
                            <td></td>
                            <td>{{$print_details->email}}</td>
                        </tr>
                    </table>
                    <br>
                    <button class="btn btn-danger" id="print_page">Print Contractor Details</button>
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