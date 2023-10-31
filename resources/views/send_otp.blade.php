<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quarry Management System</title>
  <link rel="icon" href="frontend/img/quarry.ico" type="icon">
  <link rel="stylesheet" href="frontend/css/bootstrap.min.css">
  <link rel="stylesheet" href="frontend/css/login_page.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
</head>

<body>
  <section class="Form mx-5">
    <div class="container">
      <div class="col-lg-12">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <img src="frontend/img/quarry.png" alt="" class="img-fluid" width="600" height="600">
        </div>
        <div class="col-lg-7 px-5 set_border">
          <h1 class="py-3 text-center">Login</h1>
          <form method="post" action="{{route('send_login_otp')}}">
            @csrf
            <center>
                <div class="col-sm-6">
                    <div class="form-floating mb-3 ">
                      <input type="text" name="username" class="form-control text-center" id="username" placeholder="Username" style="font-weight:600;" required>
                      <label for="username">Username</label>
                    </div>
                </div>
            </center>
            <center>
                <div class="col-sm-6">
                    <button type="submit" name="submit" class="btn btn-dark" style="width:100%;">Send OTP</button>
                </div>
            </center>
              <br>
              <center>
                <span class="text-danger">{{session()->get('status')}}</span>
              </center>
          </form>
          </div>
        </div>
      </div>
      </div>
</section>

</body>
</html>