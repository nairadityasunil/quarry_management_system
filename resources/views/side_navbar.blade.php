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

<body>
  <x-navbar/>
  <div class="container-fluid">
      <div class="row">
        <x-side_navbar />
        <div class="col-sm-6">
            <div class="card" style="margin-top : 10px;">
                <div class="card-body">
                    <h1 class="text-center">Sales In Entry</h1>
                    <br>
                    <form method="POST" class="px-3">
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
                                <input type="text" name="selling_company" class="form-control" id="company" placeholder="">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="vehicle_no" class="col-sm-3 col-form-label">Vehicle Number :</label>
                            <div class="col-sm-6">
                                <input type="text" name="vehicle_no" class="form-control" id="vehicle_no" placeholder="">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="driver_name" class="col-sm-3 col-form-label">Driver Name :</label>
                            <div class="col-sm-6">
                                <input type="text" name="driver_name" class="form-control" id="driver_name" placeholder="">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="customer_name" class="col-sm-3 col-form-label">Customer Name :</label>
                            <div class="col-sm-6">
                                <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group row">
                            <label for="gross_weight" class="col-sm-3 col-form-label">Tare Wt. :</label>
                            <div class="col-sm-6">
                                <input type="text" name="tare_weight" class="form-control" id="tare_weight" placeholder="">
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
                                </table>
                            </div>
                    </div>
                </div>
            </div>
    </div>
  </div>
</body>
</html>