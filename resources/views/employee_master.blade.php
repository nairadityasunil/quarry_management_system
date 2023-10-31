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
    <script src="dashboard.js"></script>
    <script src="frontend/js/bootstrap.bundle.min.js"></script>
</head>

<body class="overflow-hidden">
    {{-- Component Navbar Being Brought To The Page --}}
    <x-navbar />
    <div class="container-fluid">
        <div class="row">
            <x-side_navbar />
            <div class="col-sm-10 d-flex flex-column">
                <div class="card" style="margin-top : 10px;">
                    <div class="card-body my-3">
                        <form action="{{route('search_employee')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="search_item" class="col-sm-2 col-form-label">Employee Name :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="search_item" class="form-control" id="search_item"
                                        placeholder="Search Emplopyee Name" value="{{$search_item ?? ''}}">
                                    <br>
                                    <button type="submit" class="btn btn-dark">Submit</button>
                                    <a href="{{url('/employee_master')}}">
                                        <button type="button" class="btn btn-danger">Clear</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                        <center>
                            <span class="text-danger">{{session()->get('status')}}</span>
                        </center>
                    </div>
                </div>
                <div class="card overflow1" style="margin-top: 10px; max-height:70vh;">
                    <div class="card-body overflow1" >
                        <div class="row">
                            <div class="col-sm-5 px-5 py-4">
                                <a href="{{route('add_employee')}}">
                                    <button type="submit" class="btn btn-success">Create</button>
                                </a>
                    
                            </div>
                            <div class="col-sm-7 py-4">
                                <h3>Employee Master</h3>
                            </div>
                        </div>
                        <div class="container-fluid px-3 py-3 overflow-auto" style="padding-right:10px;">
                            <table class="table table-bordered table-hover border-dark text-center">
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Designation</th>
                                        <th>Joiing Date</th>
                                        <!-- <th>View</th> -->
                                        <th>Update</th>
                                        <th>Delete</th>
                                        <th>Print</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($employee_details as $employee)
                                    <tr>
                                        <td>{{ $employee->id }}</td>
                                        <td>{{ $employee->emp_name }}</td>
                                        <td>{{ $employee->gender }}</td>
                                        <td>{{ $employee->address }}</td>
                                        <td>{{ $employee->contact_no }}</td>
                                        <td>{{ $employee->designation }}</td>
                                        <td>{{ $employee->joining_date }}</td>
                                        <td>
                                            <a href="{{url('confirm_employee_details')}}/{{$employee->id}}" class="btn btn-info">
                                                <!-- <button class="btn btn-success">Update</button> -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{url('delete_employee')}}/{{$employee->id}}" class="btn btn-danger">
                                                <!-- <button class="btn btn-danger">Delete</button> -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td>
                                                <a href="{{url('print_employee_details')}}/{{$employee->id}}" class="btn btn-warning" target="_blank" rel="noopener noreferrer">
                                                <!-- <button class="btn btn-danger">Delete</button> -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                                        <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                                                        <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
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