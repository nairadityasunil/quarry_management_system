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
                        <form action = "{{route('search_store_status')}}">
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
                                        <a href="">
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
                       
                            <span class="text-danger">
                                {{session()->get('store_in_status')}}
                            </span>
               
                            </span>
                        </center>
                    </div>
                </div>
                <div class="card" style="margin-top: 10px;">
                    <div class="card-body overflow-auto" style="max-height:70vh;">
                        <div class="row">  
                            <div class="col-sm-5 px-5 py-4">
                                <a href="{{route('store_in_entry')}}">
                                    <button type="submit" class="btn btn-success">Store-In</button>
                                </a>
                            </div>
                            <div class="col-sm-7 py-4">
                                <h3>Store Status</h3>    
                            </div>  
                        </div>
                        <div class="container-fluid px-3 py-3" style="padding-right:10px;">
                            <table class="table table-bordered border-dark text-center">
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Item Name</th>
                                        <th>Quantity</th>  
                                        <th>Unit</th>
                                        <th>Store-In</th>
                                        <th>Store-Out</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($store_status as $store)
                                        <tr>
                                            <td>{{ $store->id }}</td>
                                            <td>{{ $store->item_name }}</td>
                                            <td>{{ $store->quantity }}</td>
                                            <td>{{ $store->unit }}</td>
                                            <td>
                                                <a href="{{url('confirm_store_in')}}/{{$store->id}}" class="btn btn-info">
                                                <!-- <button class="btn btn-success">Update</button> -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                                                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                                                    </svg>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{url('confirm_store_out')}}/{{$store->id}}" class="btn btn-danger">
                                                <!-- <button class="btn btn-danger">Delete</button> -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-dash-fill" viewBox="0 0 16 16">
                                                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1z"/>
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