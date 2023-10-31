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
    <script src="{{URL::asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
</head>

<body class="overflow-hidden">
    {{-- Component Navbar Being Brought To The Page --}}
    <x-navbar/>
    <div class="row">
        <x-side_navbar/>
        <div class="col-sm-10" >
            <div class="card" style="margin-top :10px; height:95vh;">
                <div class="card-body overflow-auto" style="">
                    <div class="row justify-content-center">
                        <div class="col-sm-7">
                            <h1 class="text-center">Purchase-Out Update</h1>
                            <br>
                            <form method="POST" action="{{route('confirm_purchase_out_update')}}">
                                @csrf   
                                <div class="form-group row">
                                    <label for="id" class="col-sm-3 col-form-label">Ticket No. :</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="id" class="form-control" id="id" placeholder=""  value="{{$purchase_out_id_details->id}}" readonly="readonly">
                                        <span class="text-danger">
                                        @error('ticket_no')
                                            {{$message}}
                                        @enderror
                                    </span>
                                    </div>
                                </div>
                                <br>  
                                <div class="form-group row">
                                    <label for="lease" class="col-sm-3 col-form-label">Lease :</label>
                                    <div class="col-sm-6">
                                        <!-- <input type="text" name="lease" class="form-control" id="lease" placeholder=""  value="{{$purchase_out_id_details->lease}}"> -->
                                        <select class="form-select" aria-label="Default select example" name="lease">
                                            <option selected value="{{$purchase_out_id_details->lease}}">{{$purchase_out_id_details->lease}}</option>
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
                                        <input type="text" name="purch_company" class="form-control" id="company" placeholder="" value="{{$purchase_out_id_details->purch_company}}">
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
                                        <input type="text" name="supplier" class="form-control" id="supplier" placeholder="" value="{{$purchase_out_id_details->supplier}}">
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
                                            <option selected value="{{$purchase_out_id_details->item}}">{{$purchase_out_id_details->item}}</option>
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
                                        <input type="text" name="date_time" class="form-control" id="lease" placeholder=""  value="{{$purchase_out_id_details->date_time}}" readonly="readonly">
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
                                        <input type="text" name="vehicle_no" class="form-control" id="vehicle_number" placeholder="" value="{{$purchase_out_id_details->vehicle_no}}">
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
                                        <input type="text" name="driver_name" class="form-control" id="driver_name" placeholder="" value="{{$purchase_out_id_details->driver_name}}">
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
                                        <input type="text" name="tare_weight" class="form-control" id="tare_weight" placeholder="" value="{{$purchase_out_id_details->tare_weight}}">
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
                                        <input type="text" name="gross_weight" class="form-control" id="gross_weight" placeholder="" value="{{$purchase_out_id_details->gross_weight}}">
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
                                        <input type="text" name="net_weight" class="form-control" id="net_weight" placeholder="" value="{{$purchase_out_id_details->net_weight}}" readonly="readonly">
                                        <span class="text-danger">
                                        @error('net_weight')
                                            {{$message}}
                                        @enderror
                                    </span>
                                        <br>
                                        <button type="submit" class="btn btn-danger">Update</button>
                                    </div>
                                </div>
                            </form>
                            <br><br>
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
        $('#tare_weight').change(function(){
            var tare_weight = parseFloat($('#tare_weight').val());
            var gross_weight = parseFloat($('#gross_weight').val());
            var net_weight = gross_weight-tare_weight;
            $('#net_weight').val(net_weight);
        });
    </script>
</body>
</html>