<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quarry Management System</title>
    <link rel="icon" href="frontend/img/quarry.ico" type="icon">
    <link rel="stylesheet" href="frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="frontend/css/style1.css"
    <script src="dashboard.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
    <script src="frontend/js/bootstrap.bundle.min.js"></script>
</head>

<body class="overflow-hidden">
    {{-- Component Navbar Being Brought To The Page --}}
    <x-navbar/>
    <div class="container-fluid">
        <div class="row">
            <x-side_navbar />
            <div class="col-sm-6">
                <div class="card" style="margin-top : 10px;">
                    <div class="card-body">
                        <h1 class="text-center">Purchase-In Entry</h1>
                        <br>
                        <form method="POST" action="{{route('purchase_in_entry')}}">
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
                                    <input type="text" name="purch_company" class="form-control" id="company" placeholder="">
                                    <span class="text-danger">
                                        @error('purch_company')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="vehicle_number" class="col-sm-3 col-form-label">Vehicle Number :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="vehicle_no" class="form-control" id="vehicle_number" placeholder="">
                                    <span class="text-danger">
                                        @error('vehicle_no')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="supplier" class="col-sm-3 col-form-label">Supplier :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="supplier" class="form-control" id="supplier" placeholder="">
                                    <span class="text-danger">
                                        @error('supplier')
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
                                        <!-- <option selected>-</option> -->
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
                                        <!-- <br> -->
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
                            <div class="container">
                                <h3 class="text-center">Pending Purchases</h3>
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
                                        @foreach ($pending_p as $pending_purch)
                                            <tr>
                                                <td>{{ $pending_purch->id }}</td>
                                                <td>{{ $pending_purch->vehicle_no }}</td>
                                                <td>{{ $pending_purch->item }}</td>
                                                <td>
                                                    <a href="{{url('purchase_out_entry')}}/{{$pending_purch->id}}">
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
    </div>

<script>
     $('document').ready(function(){
        $('#vehicle_number').change(function()
        {
            var vehicle_number = $('#vehicle_number').val();
            if (vehicle_number == "")
            {
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
                        var tare_weight = arr[veh].tare_weight;
                        $('#tare_weight').val(tare_weight);
                    }
                }
            }
        });
    });
</script>
</body>
</html>