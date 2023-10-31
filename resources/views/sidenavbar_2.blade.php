<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quarry Management System</title>
    <link rel="icon" href="frontend/img/quarry.ico" type="icon">
    <!-- <link rel="stylesheet" href="{{URL::asset('frontend/css/bootstrap.min.css')}}"> -->
    <link rel="stylesheet" href="{{URL::asset('frontend/css/side_navbar.css')}}">
    <link rel="stylesheet" href="{{URL::asset('frontend/css/dashboard_style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('frontend/css/style1.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
    <script src="{{URL::asset('dashboard.js')}}"></script>
    <script src="{{URL::asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
</head>
<body>
    <nav class="sidebar">
        <div class="text">Side Menu</div>
        <ul>
            <li>
                <a href="#">Dashboard</a>
            </li>
            <li>
                <a href="#" class="feat-btn first">Features   
                    <span class="fliparrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </span>    
                </a>
                <ul class="feat-show">
                    <li><a href="#">Pages</a></li>
                    <li><a href="#">Elements</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="serv-btn second">Services
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </span>    
                </a>
                <ul class="serv-show">
                    <li><a href="#">Pages</a></li>
                    <li><a href="#">Elements</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Dashboard 2</a>
            </li>
            <li>
                <a href="#">Dashboard 3</a>
            </li>
            <li>
                <a href="#">Dashboard 4</a>
            </li>
        </ul>
    </nav>
    <script>
        $('.feat-btn').click(function(){
            $('.fliparrow').toggleClass("rotate");
            $('nav ul .feat-show').toggleClass("show");
            $('nav ul .serv-show').removeClass("show1");
        });
        $('.serv-btn').click(function(){
            $('nav ul .feat-show').removeClass("show");
            $('nav ul .serv-show').toggleClass("show1");
        });
        $('nav ul li').click(function(){
            $(this).addClass("active").siblings().removeClass('active');
        });
    </script>
</body>
</html>