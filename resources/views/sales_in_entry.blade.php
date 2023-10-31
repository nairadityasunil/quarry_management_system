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
    <!-- <br> -->
    <div class="container-fluid">
        <div class="row">
            <x-side_navbar />
            <div class="col-sm-6">
                <div class="card" style="margin-top : 10px;">
                    <div class="card-body">
                        <h1 class="text-center">Sales In Entry</h1>
                        <br>
                        <form method="POST" action="{{route('sales_in_entry')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="lease" class="col-sm-3 col-form-label">Lease :</label>
                                <div class="col-sm-6">
                                    <!-- <input type="text" name="lease" class="form-control" id="lease" placeholder=""> -->
                                    <select class="form-select" aria-label="Default select example" name="lease">
                                        <!-- <option selected value="-">-</option> -->
                                        @foreach ($lease as $l)
                                            <option value="{{$l->lease_no}}">{{$l->lease_no}}</option>
                                        @endforeach
                                    </select> 
                                    <span class="text-danger">
                                        @error('lease')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="company" class="col-sm-3 col-form-label">Company :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="selling_company" class="form-control" id="company" placeholder="">
                                    <span class="text-danger">
                                        @error('selling_company')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="vehicle_no" class="col-sm-3 col-form-label">Vehicle Number :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="vehicle_no" class="form-control" id="vehicle_no" placeholder="">
                                    <span class="text-danger">
                                        @error('vehicle_no')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="driver_name" class="col-sm-3 col-form-label">Driver Name :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="driver_name" class="form-control" id="driver_name" placeholder="">
                                    <span class="text-danger">
                                        @error('driver_name')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="customer_name" class="col-sm-3 col-form-label">Customer Name :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="">
                                    <span class="text-danger">
                                        @error('customer_name')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Item :</label>
                                <div class="col-sm-6">
                                    <select class="form-select" aria-label="Default select example" name="item">
                                        <option selected>-</option>
                                        @foreach ($item as $it)
                                            <option value="{{$it->item_name}}">{{$it->item_name}}</option>
                                        @endforeach
                                    </select>   
                                    <span class="text-danger">
                                        @error('item')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="gross_weight" class="col-sm-3 col-form-label">Tare Wt. :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="tare_weight" class="form-control" id="tare_weight" placeholder="">
                                    <span class="text-danger">
                                        @error('tare_weight')
                                            {{$message}}
                                        @enderror
                                    </span>
                                    <br>
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card" style="margin-top : 10px;">
                    <div class="card-body">
                        <div class="container">
                            <h3 class="text-center">Pending Sales</h3>
                            <br>
                            <table class="table table-striped  border-dark text-center">
                                <thead>
                                    <tr>
                                        <th>Ticket No.</th>
                                        <th>Vehicle Number</th>
                                        <th>Item</th>
                                        <th>Confirm</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pending_s as $pending_sales)
                                        <tr>
                                            <td>{{ $pending_sales->id }}</td>
                                            <td>{{ $pending_sales->vehicle_no }}</td>
                                            <td>{{ $pending_sales->item }}</td>
                                            <td>
                                                <a href="{{url('sales_out_entry')}}/{{$pending_sales->id}}}}">
                                                    <button class="btn btn-success">Confirm</button>
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
    <script>
    $('document').ready(function(){
        $('#vehicle_no').change(function()
        {
            var vehicle_number = $('#vehicle_no').val();
            if (vehicle_number == "")
            {
                $('#driver_name').val("");
                $('#tare_weight').val("");
            }
            else
            {
                var arr = <?php echo json_encode($all_vehicles); ?>;
                for (let veh in arr)
                {
                    let vehicle = arr[veh].vehicle_no;
                    if (vehicle_number == vehicle)
                    {
                        var driver_name = arr[veh].driver_name; 
                        var tare_weight = arr[veh].tare_weight;
                        $('#driver_name').val(driver_name);
                        $('#tare_weight').val(tare_weight);
                    }
                }
            }
        });
    });
</script>
</body>

</html>