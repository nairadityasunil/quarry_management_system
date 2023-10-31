<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quarry Management System</title>
    <link rel="icon" href="frontend/img/quarry.ico" type="icon">
    <link rel="stylesheet" href="frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="frontend/css/dashboard_style.css">
    <link rel="stylesheet" href="frontend/css/style1.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
    <script src="dashboard.js"></script>
    <script src="frontend/js/bootstrap.bundle.min.js"></script>
</head>

<body class="overflow-hidden">
    {{-- Component Navbar Being Brought To The Page --}}
    <x-navbar/>
    <div class="container-fluid">
        <div class="row">
            <x-side_navbar/>
            <div class="col-sm-10 d-flex flex-column">
                
                <div class="card" style="margin-top: 10px;">
                    <div class="card-body overflow-auto" style="max-height:70vh;">
                        <center>
                            <span class="text-danger">{{session()->get('status')}}</span>
                        </center>
                        <div class="row">  
                        <div class="col-sm-5 px-5 py-4">
                                <a href="{{route('fuel_type_entry')}}">
                                    <button type="submit" class="btn btn-success">Create</button>
                                </a>
                            </div>
                            <div class="col-sm-7 py-4">
                                <h3>Fuel Type List</h3>    
                            </div>  
                        </div>
                        <div class="container-fluid px-3 py-3" style="padding-right:10px;">
                            <table class="table table-bordered border-dark text-center">
                                <thead>
                                    <tr>
                                        <th>Fuel Type</th>
                                        <th>Date & Time</th>
                                        <th>Delete</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fuel_type as $fuel)
                                        <tr>
                                            <td>{{ $fuel->fuel_type }}</td>
                                            <td>{{ $fuel->created_at }}</td>

                                            <td>
                                                <a href="{{url('delete_fuel_type')}}/{{$fuel->id}}}}" class="btn btn-danger">
                                                <!-- <button class="btn btn-danger">Delete</button> -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>