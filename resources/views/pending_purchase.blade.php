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
    <script src="dashboard.js"></script>
    <script src="frontend/js/bootstrap.bundle.min.js"></script>
</head>

<body class="overflow-hidden">
    {{-- Component Navbar Being Brought To The Page --}}
    <x-navbar />
    <div class="container-fluid">
        <div class="row">
            <x-side_navbar />
            <div class="col-sm-10 d-flex flex-column">
                <div class="card" style="margin-top : 10px;">
                    <div class="card-body my-3">
                        <form action="{{route('search_pending_purchase')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="search_item" class="col-sm-2 col-form-label">Vehicle No. :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="search_item" class="form-control" id="search_item"
                                        placeholder="Search Vehicle Number" value="{{$search_item ?? ''}}">
                                    <br>
                                    <button type="submit" class="btn btn-dark">Submit</button>
                                    <a href="{{url('/pending_purchase_list')}}">
                                        <button type="button" class="btn btn-danger">Clear</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card overflow1" style="margin-top: 10px; max-height:74vh;">
                    <div class="card-body overflow">
                        <div class="row">
                            <div class="col-sm-5 px-5 py-4">
                                <a href="{{route('purchase_in_entry')}}">
                                    <button type="submit" class="btn btn-success">Purchase-In</button>
                                </a>
                                <a href="{{route('direct_purchase')}}">
                                    <button type="submit" class="btn btn-primary">Direct Purchase</button>
                                </a>
                            </div>
                            <div class="col-sm-7 py-4">
                                <h3>Pending List (Purchase)</h3>
                            </div>
                        </div>
                        <div class="container-fluid px-3 py-3 overflow-auto" style="padding-right:10px;">
                            <table class="table table-bordered table-hover border-dark text-center">
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Lease</th>
                                        <th>Company</th>
                                        <th>Vehicle Number</th>
                                        <th>Supplier</th>
                                        <th>Item</th>
                                        <th>Gross Wt.</th>
                                        <th>Date-Time</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pending_p as $purch)
                                    <tr>
                                        <td>{{ $purch->id }}</td>
                                        <td>{{ $purch->lease }}</td>
                                        <td>{{ $purch->purch_company }}</td>
                                        <td>{{ $purch->vehicle_no }}</td>
                                        <td>{{ $purch->supplier }}</td>
                                        <td>{{ $purch->item }}</td>
                                        <td>{{ $purch->tare_weight }}</td>
                                        <td>{{ $purch->created_at }}</td>
                                        <td>
                                            <a href="{{url('purchase_out_entry')}}/{{$purch->id}}">
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
</body>

</html>