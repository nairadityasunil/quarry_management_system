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
    <script src="dashboard.js"></script>
    <script src="frontend/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    {{-- Component Navbar Being Brought To The Page --}}
    <x-navbar/>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                <h1 class="text-center">Auto Purchase</h1>
                <br>
                <form method="POST" action="{{route('auto-purchase')}}">
                    @csrf
                    <div class="form-group row">
                        <label for="lease" class="col-sm-3 col-form-label">Lease :</label>
                        <div class="col-sm-6">
                            <input type="text" name="lease" class="form-control" id="lease" placeholder="">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="company" class="col-sm-3 col-form-label">Company :</label>
                        <div class="col-sm-6">
                            <input type="text" name="purch_company" class="form-control" id="company" placeholder="">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="vehicle_number" class="col-sm-3 col-form-label">Vehicle Number :</label>
                        <div class="col-sm-6">
                            <input type="text" name="vehicle_no" class="form-control" id="vehicle_number" placeholder="">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="supplier" class="col-sm-3 col-form-label">Supplier :</label>
                        <div class="col-sm-6">
                            <input type="text" name="supplier" class="form-control" id="supplier" placeholder="">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Item :</label>
                        <div class="col-sm-6">
                        <select class="form-select" aria-label="Default select example" name="item">
                            <option selected>-</option>
                            <option value="M-Sand">M-Sand</option>
                            <option value="6 mm">6 mm</option>
                            <option value="10 mm">10 mm</option>
                            <option value="20 mm">20 mm</option>
                            <option value="40 mm">40 mm</option>
                            <option value="Crushed Stone">Crushed Sand</option>
                        </select>   
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="gross_weight" class="col-sm-3 col-form-label">Gross Wt. :</label>
                        <div class="col-sm-6">
                            <input type="text" name="gross_weight" class="form-control" id="gross_weight" placeholder="">
                            <br>
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </div>
                </form>
                <br><br>
            </div>

            <div class="col-sm-5">
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
                                        {{-- The below mentioned is url method to delete --}}
                                        {{-- <a href="{{url('/delete/')}}/{{$cust_value->id}}"> --}}
                                        <a>
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
</body>

</html>