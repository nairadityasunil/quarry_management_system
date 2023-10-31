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
    <script src="{{URL::asset('dashboard.js')}}"></script>
    <script src="{{URL::asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
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
                            <h1 class="text-center">Update Item</h1>
                            <br>
                            <form method="POST" action="{{route('confirm_update_item')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="id" class="col-sm-3 col-form-label">Number :</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="id" class="form-control" id="id" placeholder="" value="{{$item_id_details->id ?? ''}}" readonly="readonly">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="item_name" class="col-sm-3 col-form-label">Item Name :</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="item_name" class="form-control" id="item_name" placeholder="" value="{{$item_id_details->item_name}}">
                                        <span class="text-danger">
                                            @error('item_name')
                                                {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <!-- <br>
                                <div class="form-group row">
                                    <label for="order_no" class="col-sm-3 col-form-label">Order No :</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="order_no" class="form-control" id="order_no" placeholder="" value="{{$item_id_details->order_no}}">
                                    </div>
                                </div> -->
                                <br>
                                <div class="form-group row">
                                    <label for="hsn_code" class="col-sm-3 col-form-label">HSN Code :</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="hsn_code" class="form-control" id="hsn_code" placeholder="" value="{{$item_id_details->hsn_code}}">
                                        <span class="text-danger">
                                            @error('hsn_code')
                                                {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Unit Type :</label>
                                    <div class="col-sm-6">
                                        <select class="form-select" aria-label="Default select example" name="unit_type">
                                            <option selected value="{{$item_id_details->unit_type}}">{{$item_id_details->unit_type}}</option>
                                            <option value="Ton">Ton</option>
                                            <option value="Number">Number</option>
                                            <option value="Cubic Feet">Cubic Feet</option>
                                            <option value="Cubic Meter">Cubic Meter</option>
                                            <option value="Bag">Bag</option>
                                            <option value="Kilogram">Kilogram</option>
                                            <option value="Gram">Gram</option>
                                            <option value="Quintal">Quintal</option>
                                        </select>   
                                        <span class="text-danger">
                                            @error('unit_type')
                                                {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label"></div>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-danger">Update Item</button>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </form>
                            <br><br>
                        </div>
                     </div>
                </div>
            </div>
        </div>   
    </div>
</body>
</html>