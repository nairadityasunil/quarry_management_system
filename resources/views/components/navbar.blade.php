<div>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark ">
        <div class="container-fluid">
            <div class="col-sm-4">
                <a href="{{route('home')}}" style="text-decoration:none;">
                    <span class="navbar-brand">Quarry Management System</span>
                </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            </div>
            <div class="col-sm-4 text-white">
             <center>
                <span id="hours">00</span>
                <span>:</span>
                <span id="minutes">00</span>
                <span>:</span>
                <span id="seconds">00</span>
                <span> </span>
                <span id="session">AM</span>
             </center>
            </div>
            <div class="col-sm-4">
                <ul class="justify-content-end navbar-nav w-100">
                    <span class="text-white my-2" style="padding-right: 2vw;">{{session()->get('username')}}</span>
                    <a href="{{route('login')}}">
                        <button class="btn btn-danger" id="logout">Logout</button>
                    </a>
                </ul>
            </div>
        </div>
    </nav>
</div>

<script>
    function displayTime()
    {
        var dateTime = new Date();
        var hrs = dateTime.getHours();
        var mins = dateTime.getMinutes();
        var sec = dateTime.getSeconds();
        var session = document.getElementById('session');
        if(hrs >= 12)
        {
            session.innerHTML = 'PM';
        }
        else
        {
            session.innerHTML = 'AM';
        }

        if (hrs > 12)
        {
            hrs = hrs - 12;
        }
        document.getElementById('hours').innerHTML = hrs;
        document.getElementById('minutes').innerHTML = mins;
        document.getElementById('seconds').innerHTML = sec;

    }
    setInterval(displayTime, 10);
</script>