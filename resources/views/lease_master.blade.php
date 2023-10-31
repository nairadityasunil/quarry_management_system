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
                                <a href="{{route('add_lease')}}">
                                    <button type="submit" class="btn btn-primary">Add Lease</button>
                                </a>
                            </div>
                            <div class="col-sm-7 py-4">
                                <h3>Lease Master</h3>    
                            </div>  
                        </div>
                        <div class="container-fluid px-3 py-3" style="padding-right:10px;">
                            <table class="table table-bordered border-dark text-center">
                                <thead>
                                    <tr>
                                        <th>Lease no.</th>
                                        <th>Address</th>
                                        <th>Lease Area</th>
                                        <th>Measure</th>
                                        <th>Leaseholder</th>
                                        <th>Limit</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($get_lease as $lease)
                                        <tr>
                                            <td>{{ $lease->lease_no }}</td>
                                            <td>{{ $lease->address }}</td>
                                            <td>{{ $lease->lease_area }}</td>
                                            <td>{{ $lease->measure }}</td>
                                            <td>{{ $lease->leaseholder }}</td>
                                            <td>{{ $lease->lease_ton_limit }}</td>
                                            <td>
                                                <a href="{{url('confirm_lease_update_id')}}/{{$lease->id}}}}" class="btn btn-info">
                                                <!-- <button class="btn btn-success">Update</button> -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                    </svg>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{url('confirm_lease_delete_id')}}/{{$lease->id}}}}" class="btn btn-danger">
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
