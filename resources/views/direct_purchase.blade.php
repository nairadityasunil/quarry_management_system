<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quarry Management System</title>
    <link rel="icon" href="frontend/img/quarry.ico" type="icon">
    <link rel="stylesheet" href="{{URL::asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('frontend/css/dashboard_style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('frontend/css/style1.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
    <script src="{{URL::asset('dashboard.js')}}"></script>
    <script src="{{URL::asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
</head>

<body class="overflow-hidden">
    {{-- Component Navbar Being Brought To The Page --}}
    <x-navbar/>
    <div class="container-fluid">
        <div class="row">
            <x-side_navbar />
            <div class="col-sm-6">
                <div class="card" style="margin-top : 10px; max-height:93vh;">
                    <div class="card-body overflow-auto">
                        <h1 class="text-center">Direct Purchase Entry</h1>
                        <br>
                        <form method="POST" action="confirm_direct_purchase">
                            @csrf 
                            <div class="form-group row">
                                <label for="lease" class="col-sm-3 col-form-label">Lease :</label>
                                <div class="col-sm-6">
                                    <!-- <input type="text" name="lease" class="form-control" id="lease" placeholder=""  value="{{$pending_purchase->lease ?? ''}}"> -->
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
                                    <input type="text" name="purch_company" class="form-control" id="company" placeholder="" value="{{$pending_purchase->purch_company ?? ''}}">
                                    <span class="text-danger">
                                        @error('purch_company')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="supplier" class="col-sm-3 col-form-label">Supplier :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="supplier" class="form-control" id="supplier" placeholder="" value="{{$pending_purchase->supplier ?? ''}}">
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
                                        <!-- <option selected value="{{$pending_purchase->item ?? '-'}}">{{$pending_purchase->item ?? '-'}}</option> -->
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
                                <label for="date_time" class="col-sm-3 col-form-label">Date & Time :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="date_time" class="form-control" id="date_time" placeholder=""  value="{{$pending_purchase->created_at ?? $current_date_time}}">
                                    <span class="text-danger">
                                        @error('date_time')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>                    
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Vehicle No :</label>
                                <div class="col-sm-6">
                                    <select class="form-select" aria-label="Default select example" name="vehicle_no" id="vehicle_no">
                                        <option selected value="-">-</option>
                                        @foreach ($all_vehicles as $vehicle)
                                            <option value="{{$vehicle->vehicle_no}}" id="vehicle_no">{{$vehicle->vehicle_no}}</option>
                                        @endforeach
                                    </select>   
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
                                <label for="tare_weight" class="col-sm-3 col-form-label">Tare Wt. :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="tare_weight" class="form-control" id="tare_weight" placeholder="" value="{{$pending_purchase->tare_weight ?? ''}}" readonly="readonly">
                                    <span class="text-danger">
                                        @error('tare_weight')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="gross_weight" class="col-sm-3 col-form-label">Gross Wt. :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="gross_weight" class="form-control" id="gross_weight" placeholder="" >
                                    <span class="text-danger">
                                        @error('gross_weight')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="net_weight" class="col-sm-3 col-form-label">Net Wt. :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="net_weight" class="form-control" id="net_weight" placeholder="" readonly="readonly">
                                    <span class="text-danger">
                                        @error('net_weight')
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
                            <h3 class="text-center">Pending Purchase</h3>
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
    
<script>
    $('document').ready(function(){
        $('#vehicle_no').change(function()
        {
            var vehicle_number = $('#vehicle_no').val();
            if (vehicle_number == "")
            {
                $('#driver_name').val("");
                $('#tare_weight').val("");
                $('#net_weight').val("");
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
                        $('#gross_weight').val("");
                        $('#net_weight').val("");
                    }
                }
            }
        });


        $('#gross_weight').change(function(){
            var tare_weight = parseFloat($('#tare_weight').val());
            var gross_weight = parseFloat($('#gross_weight').val());
            var net_weight = gross_weight-tare_weight;
            $('#net_weight').val(net_weight);
        });
    });
 
</script>
</body>
</html>

<!-- Some Optional Elements -->

             <!-- <div class="col-sm-2">
                                <button type="button" class="btn btn-primary" id = "btn" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="21   " fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg>
                                </button>
                        </div> -->


                        <!-- <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Vehicle No :</label>
                        <div class="col-sm-6">
                        <select class="form-select" aria-label="Default select example" name="vehicle_no" id="vehicle_no">
                            <option selected value="-">-</option>
                            @foreach ($all_vehicles as $vehicle)
                                <option value="{{$vehicle->vehicle_no}}" id="vehicle_no">{{$vehicle->vehicle_no}}</option>
                            @endforeach
                        </select>   
                        </div>
           
                    </div> -->

                                     <!-- <div class="form-group row">
                        <label for="vehicle_no" class="col-sm-3 col-form-label">Vehicle No :</label>
                        <div class="col-sm-6">
                            <input name="vehicle_no" class="form-control" id="vehicle_no" list="vehicle_list">
                            <datalist id="vehicle_list">
                                @foreach ($all_vehicles as $vehicle)
                                    <option value="{{$vehicle->vehicle_no}}">{{$vehicle->vehicle_no}}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div> -->