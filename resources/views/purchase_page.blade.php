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
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <span class="navbar-brand" href="#">Quarry Management System</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav w-100 justify-content-end">
                    <li class="nav-item">
                        <a href="" class="nav-link" style="color:grey;" onMouseOver="this.style.color='white'"
                            onMouseLeave="this.style.color='grey'">Home</a>
                    </li>
                    <li class="nav-item">
                        <!-- <a href="" class="nav-link" style="color:grey;" onMouseOver="this.style.color='white'" onMouseLeave="this.style.color='grey'">Purchase</a> -->
                    </li>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" style="color:grey;" onMouseOver="this.style.color='white'"
                            onMouseLeave="this.style.color='grey'" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Purchase</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{route('make-purchase')}}" class="dropdown-item">Make Purchase</a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item">View Purchases</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" style="color:grey;" onMouseOver="this.style.color='white'"
                            onMouseLeave="this.style.color='grey'" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Sales</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{route('sales-in')}}" class="dropdown-item">Sales-In</a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item">Sales-Out</a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item">View Sales</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" style="color:grey;" onMouseOver="this.style.color='white'"
                            onMouseLeave="this.style.color='grey'" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Lease</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="" class="dropdown-item">Add Lease</a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item">View Lease</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" style="color:grey;" onMouseOver="this.style.color='white'"
                            onMouseLeave="this.style.color='grey'" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Vehicle</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="" class="dropdown-item">Add Vehicle</a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item">View Vehicle</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" style="color:grey;" onMouseOver="this.style.color='white'"
                            onMouseLeave="this.style.color='grey'" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Employees</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="" class="dropdown-item">Add Employee</a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item">View Employee</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" style="color:grey;" onMouseOver="this.style.color='white'"
                            onMouseLeave="this.style.color='grey'" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Users</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="" class="dropdown-item">Add User</a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item">View Users</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                <h1 class="text-center">Purchase</h1>
                <form>
                    <div class="form-group row">
                        <label for="lease-number" class="col-sm-3 col-form-label">Lease Number :</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="lease-number" placeholder="">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="leaseholder" class="col-sm-3 col-form-label">Leaseholder :</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="leaseholder" placeholder="">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="customer-name" class="col-sm-3 col-form-label">Customer Name :</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="customer-name" placeholder="">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="vehicle-number" class="col-sm-3 col-form-label">Vehicle Number :</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="vehicle-number" placeholder="">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="vehicle-tare-weight" class="col-sm-3 col-form-label">Vehicle Tare Weight :</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="vehicle-tare-weight" placeholder="">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="vehicle-gross-weight" class="col-sm-3 col-form-label">Vehicle Gross Weight :</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="vehicle-gross-weight" placeholder="">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="vehicle-net-weight" class="col-sm-3 col-form-label">Vehicle Net Weight:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="vehicle-net-weight" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <br><br>
                            <button type="submit" class="btn btn-dark">Make Purchase</button>
                        </div>
                    </div>
                </form>
                <br><br>
            </div>

            <div class="col-sm-5">
                <div class="container">
                    <h3 class="text-center">Pending Sales</h3>
                    <br>
                    <table class="table table-striped table-bordered border-dark text-center">
                        <thead>
                            <tr>
                                <th>Ticket No.</th>
                                <th>Vehicle Number</th>
                                <th>Item</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>100</td>
                                <td>Ab12CD1234</td>
                                <td>10mm</td>
                            </tr>
                            <tr>
                                <td>100</td>
                                <td>Ab12CD1234</td>
                                <td>10mm</td>
                            </tr>
                            <tr>
                                <td>100</td>
                                <td>Ab12CD1234</td>
                                <td>10mm</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>