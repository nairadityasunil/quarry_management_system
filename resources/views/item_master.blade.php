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
    <x-navbar/>
    <!-- <br> -->
    <div class="container-fluid">
        <div class="row">
            <x-side_navbar/>
            <div class="col-sm-10 d-flex flex-column">
                <div class="card" style="margin-top : 10px;">
                    <div class="card-body my-3">
                        <form action="{{route('search_items')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="item" class="col-sm-2 col-form-label">Item Name :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="item" class="form-control" id="item" placeholder="Search Item Name" value="{{$search_item ?? ''}}">
                                    <br>
                                    <button type="submit" class="btn btn-dark">Submit</button>
                                    <a href="{{url('/item_master')}}">
                                        <button type="button" class="btn btn-danger">Clear</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                        <center>
                            <span class="text-danger">{{session()->get('status')}}</span>
                            <span class="text-danger">
                                @error('search_item')
                                    {{$message}}
                                @enderror
                            </span>
                        </center>
                    </div>
                </div>
                <div class="card" style="margin-top: 10px;">
                    <div class="row">  
                        <div class="col-sm-5 px-5 py-4">
                            <a href="{{route('add_item')}}">
                                <button type="submit" class="btn btn-success">Create</button>
                            </a>
                        </div>
                        <div class="col-sm-7 py-4">
                            <h3>Item Master</h3>
                        </div>  
                    </div>
                    <div class="container-fluid px-3 py-3">
                        <table class="table table-bordered border-dark text-center">
                            <thead>
                                <tr>
                                    <th>Sr no.</th>
                                    <th>Item Name</th>
                                    <!-- <th>Order No.</th> -->
                                    <th>Hsn Code</th>
                                    <th>Unit Type</th>
                                    <th>Update</td>
                                    <th>Delete</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item as $it)
                                    <tr>
                                        <td>{{ $it->id }}</td>
                                        <td>{{ $it->item_name }}</td>
                                        <!-- <td>{{ $it->order_no }}</td> -->
                                        <td>{{ $it->hsn_code }}</td>
                                        <td>{{ $it->unit_type }}</td>
                                        <td>
                                            <a href="{{url('update_item')}}/{{$it->id}}" class="btn btn-info">
                                                <!-- <button class="btn btn-success">Update</button> -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{url('item_delete')}}/{{$it->id}}" class="btn btn-danger">
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
</body>

</html>