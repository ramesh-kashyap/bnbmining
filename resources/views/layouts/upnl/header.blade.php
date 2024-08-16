<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title translate="no">Mine Tron X | Dashboard</title>

    <meta name="description" content="10% daily profit">
    <meta name="keywords"
        content="trx mining site, new trx mining website, trx mining, new trx mining site, trx mining app, tron mining, tron mining site, trx mining website, free trx mining" />
    <link rel="shortcut icon" href="{{ asset('') }}upnl/assets/img/icon.png" type="image/png">

    <!-- Fontawesome -->
    <script src="{{ asset('') }}upnl/assets/scripts/7c6f853135.js" crossorigin="anonymous"></script>
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="{{ asset('') }}upnl/assets/styles/libs/bootstrap.css">
    <!-- Animate Css -->
    <link rel="stylesheet" href="{{ asset('') }}upnl/assets/styles/libs/animate.css">
    <!-- Common Css -->
    <link rel="stylesheet" href="{{ asset('') }}upnl/assets/styles/common.css">
    <!-- Account Css -->
    <link rel="stylesheet" href="{{ asset('') }}upnl/assets/styles/account.css">
    <link rel="stylesheet" href="{{ asset('') }}upnl/assets/styles/tasks.css">


</head>
<style>
    /* Basic Dropdown Styles */
    /* Basic Dropdown Styles */
    .header-menu ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
    }

    .header-menu ul li {
        position: relative;
        margin-right: 20px;
    }

    .header-menu ul li a {
        text-decoration: none;
        padding: 10px 15px;
        color: #fff;
        /* Adjust color as per your theme */
        font-weight: 600;
        transition: all 0.3s ease;
        border-bottom: 2px solid transparent;
    }

    .header-menu ul li a:hover {
        /* color: #ffcc00;  */
        /* border-bottom: 2px solid #ffcc00;  */
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #333;
        min-width: 180px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        border-radius: 5px;
        z-index: 1000;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .dropdown-menu li {
        padding: 10px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .dropdown-menu li:last-child {
        border-bottom: none;
    }

    .dropdown-menu li a {
        color: #fff;
        /* White text for dropdown items */
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .dropdown-menu li a:hover {
        /* background-color: #444;  */
        color: #ffcc00;
        /* Highlight color on hover */
    }

    .dropdown-toggle::after {
        content: '\25BC';
        /* Down arrow symbol */
        margin-left: 5px;
        font-size: 10px;
        color: #fff;
        transition: transform 0.3s ease;
    }

    .dropdown:hover .dropdown-toggle::after {
        transform: rotate(180deg);
        /* Rotate arrow on hover */
    }

</style>

<body>

    <!-- <div class="preloader">
        <div class="spinner"></div>
    </div> -->
    <div class="wrapper">

        <header>

            <div class="header container">

                <div class="name">
                    <a href="" translate="no">
                        <img src="{{asset('')}}assets/img/okkkk copy.pngfgh.png" alt="Mine Tron X Logo"
                            style="height: 100px; width: auto;">
                    </a>
                    <i class="fa-solid fa-bars" onclick="showMobMenu();"></i>
                </div>


                <div class="header-menu">

                    <ul>
                        <li><a href="{{route('user.dashboard')}}">Dashboard</a></li>
                        <li><a href="{{route('user.invest')}}">Deposit</a></li>
                        <li><a href="{{route('user.withdraw')}}">Withdraw</a></li>
                        <li><a href="{{route('user.direct-income')}}">Bonus</a></li>
                        <li><a href="{{route('user.referral-team')}}">Referral</a></li>                  
                        <li>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>
</li>
                    </ul>


                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    </form>
                </div>

            </div>

        </header>
