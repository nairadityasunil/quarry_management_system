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
                <div class="card" style="margin-top : 10px;">
                    <div class="card-body my-3 ">
                        <form action = "{{route('search_store_out')}}">
                            <div class="form-row row">
                                <div class="col">
                                    <input type="text" name="item_name" class="form-control" placeholder="Item Name" value="{{$item_name ?? ''}}">
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <br>
                                        <button type="submit" class="btn btn-dark">
                                            Submit
                                        </button>
                                        <a href="{{route('store_out_list')}}">
                                            <button type="button" class="btn btn-danger">Clear</button>    
                                        </a>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <center>
                            <span class="text-danger">
                                @error('item_name')
                                    {{$message}}
                                @enderror
                            </span>
                        </center>
                    </div>
                </div>
                <div class="card" style="margin-top: 10px;">
                    <div class="card-body overflow-auto" style="max-height:70vh;">
                        <div class="row">  
                            <div class="col-sm-12 text-center py-4">
                                <h3>Store-Out List</h3>    
                            </div>  
                        </div>
                        <div class="container-fluid px-3 py-3" style="padding-right:10px;">
                            <table class="table table-bordered border-dark text-center">
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Item Name</th>
                                        <th>Unit</th>
                                        <th>Quantity</th>  
                                        <th>Date & Time</th>
                                        <th>Print</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($store_out_list as $store_out)
                                        <tr>
                                            <td>{{ $store_out->id }}</td>
                                            <td>{{ $store_out->item_name }}</td>
                                            <td>{{ $store_out->unit }}</td>
                                            <td>{{ $store_out->quantity }}</td>
                                            <td>{{ $store_out->created_at }}</td>
                                            <td>
                                            <a href="{{url('print_store_out')}}/{{$store_out->id}}" class="btn btn-warning" target="_blank" rel="noopener noreferrer">
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