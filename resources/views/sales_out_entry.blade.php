<!-- <!DOCTYPE html> -->
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
    <script src="{{URL::asset('dashboard.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
    <script src="{{URL::asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
</head>

<body class="overflow-hidden">
    {{-- Component Navbar Being Brought To The Page --}}
    <x-navbar/>

    <div class="container-fluid">
        <div class="row">
            <x-side_navbar />
            <div class="col-sm-6">
                <div class="card" style="margin-top : 10px;">
                    <div class="card-body overflow1 card-height">
                        <h1 class="text-center">Sales-Out Entry</h1>
                        <br>
                        <form method="POST" action="{{route('confirm_sales_out')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="ticket_no" class="col-sm-3 col-form-label">Ticket No. :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="ticket_no" class="form-control" id="ticket_no" placeholder=""  value="{{$pending_sales->id ?? $nextTransactionId ?? ''}}" readonly="readonly">
                                </div>
                            </div>
                            <br>      
                            <div class="form-group row">
                                <label for="lease" class="col-sm-3 col-form-label">Lease :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="lease" class="form-control" id="lease" placeholder=""  value="{{$pending_sales->lease ?? ''}}" readonly="readonly">
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
                                    <input type="text" name="selling_company" class="form-control" id="company" placeholder="" value="{{$pending_sales->selling_company ?? ''}}" readonly="readonly">
                                    <span class="text-danger">
                                        @error('selling_company')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="customer_name" class="col-sm-3 col-form-label">Customer :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="" value="{{$pending_sales->customer_name ?? ''}}" readonly="readonly">
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
                                    <input type="text" name="item" class="form-control" id="item" placeholder="" value="{{$pending_sales->item ?? ''}}" readonly="readonly">
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
                                    <input type="text" name="date_time" class="form-control" id="lease" placeholder="" value="{{$pending_sales->date_time ?? $current_date_time}}" readonly="readonly">
                                    <span class="text-danger">
                                        @error('date_time')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>                    
                            <div class="form-group row">
                                <label for="vehicle_number" class="col-sm-3 col-form-label">Vehicle Number :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="vehicle_no" class="form-control" id="vehicle_number" placeholder="" value="{{$pending_sales->vehicle_no ?? ''}}" readonly="readonly">
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
                                    <input type="text" name="driver_name" class="form-control" id="driver_name" placeholder="" value="{{$pending_sales->driver_name ?? ''}}" readonly="readonly">
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
                                    <input type="text" name="tare_weight" class="form-control" id="tare_weight" placeholder="" value="{{$pending_sales->tare_weight ?? ''}}" readonly="readonly">
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
                                    <input type="text" name="net_weight" class="form-control" id="net_weight" placeholder="" readonly="reaadonly">
                                    <span class="text-danger">
                                        @error('net_weight')
                                        {{$message}}
                                        @enderror
                                    </span>
                                    <br>
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <!-- <label for="loader" class="col-sm-3 col-form-label">Loader :</label> -->
                                <div class="col-sm-6">
                                    <!-- <input type="text" name="loader" class="form-control" id="loader" placeholder=""> -->
                                    <br>
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
        $('#gross_weight').change(function(){
            var tare_weight = parseFloat($('#tare_weight').val());
            var gross_weight = parseFloat($('#gross_weight').val());
            var net_weight = gross_weight-tare_weight;
            $('#net_weight').val(net_weight);
        });
    </script>
</body>
</html>