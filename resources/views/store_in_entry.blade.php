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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
</head>

<body class="overflow-hidden">
    {{-- Component Navbar Being Brought To The Page --}}
<x-navbar/>
    <!-- <br> -->
<div class="continer-fluid">
    <div class="row">
        <x-side_navbar/>
        <div class="col-sm-10" >
            <div class="card" style="margin-top :10px; height:95vh;">
                <div class="card-body overflow1 card-height" style="">
                    <h1 class="text-center">Store In</h1>
                    <br>
                    <form method="POST" action="{{route('save_store_in')}}" class="py-3">
                        @csrf
                        <div class="form-group row">
                            <label for="item_name" class="col-sm-3 col-form-label">Item Name :</label>
                            <div class="col-sm-6">
                                <input type="text" name="item_name" class="form-control" id="item_name" placeholder="" value="{{$item_name ?? ''}}">
                                <span class="text-danger">
                                    @error('item_name')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="seller" class="col-sm-3 col-form-label">Seller :</label>
                            <div class="col-sm-6">
                                <input type="text" name="seller" class="form-control" id="seller" placeholder="" value="">
                                <span class="text-danger">
                                    @error('seller')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Unit :</label>
                            <div class="col-sm-6">
                                <select class="form-select" aria-label="Default select example" name="unit">
                                    <option selected value="{{$unit ?? ''}}">{{$unit ?? '-'}}</option>
                                    <option value="Litre">Litre</option>
                                    <option value="Metre">Metre</option>
                                    <option value="Feet">Feet</option>
                                    <option value="Piece">Piece</option>
                                    <option value="Set">Set</option>
                                    <option value="Kilogram">Kilogram</option>
                                    <!-- <option value="Box">Box</option> -->
                                </select>   
                                <span class="text-danger">
                                    @error('unit')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="quantity" class="col-sm-3 col-form-label">Quantity :</label>
                            <div class="col-sm-6">
                                <input type="text" name="quantity" class="form-control" id="quantity" placeholder="" value="">
                                <span class="text-danger">
                                    @error('quantity')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="price_per_unit" class="col-sm-3 col-form-label">Price :</label>
                            <div class="col-sm-6">
                                <input type="text" name="price_per_unit" class="form-control" id="price_per_unit" placeholder="" value="">
                                <span class="text-danger">
                                    @error('price_per_unit')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="total_value" class="col-sm-3 col-form-label">Total Value(₹) :</label>
                            <div class="col-sm-6">
                                <input type="text" name="total_value" class="form-control" id="total_value" placeholder="" value="">
                                <span class="text-danger">
                                    @error('total_value')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label"></div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-danger">Add Item</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>   
    </div>
<script>
    $('document').ready(function(){
        $('#price_per_unit').change(function(){
            var quantity =parseFloat($('#quantity').val());
            var price_per_unit = parseFloat($('#price_per_unit').val());
            var total_value = quantity * price_per_unit;
            $('#total_value').val(total_value);
        });
        $('#quantity').change(function(){
            var quantity =parseFloat($('#quantity').val());
            var price_per_unit = parseFloat($('#price_per_unit').val());
            var total_value = quantity * price_per_unit;
            $('#total_value').val(total_value);
        });
    });
</script>
</body>
</html>