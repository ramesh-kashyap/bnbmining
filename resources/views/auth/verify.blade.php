<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>
    {{siteName()}} - Register Successfully
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8" />
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{asset('')}}logincss/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="{{asset('')}}logincss/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="{{asset('')}}logincss/flaticon.css" />

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{asset('')}}logincss/img/Hilton-fav.ico" type="image/x-icon" />


    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('')}}logincss/style.css" />


    <style>
        .login-16 .form-section .form-control {

            border: 1px solid #c2baba !important;
        }

    </style>
</head>

<body id="top">
    <div class="page_loader"></div>

    <!-- Login 16 start -->
    <div class="login-16">
        <div class="container">
            <div class="row login-box">
                <div class="col-lg-6 form-section">
                    <div class="form-inner">

                        <a href="{{asset('')}}" class="logo">
                            <img src="{{asset('')}}logincss/logo_black.png" alt="logo">
                        </a>
                        <h3>Register Successfully</h3>
                <form method="POST" action="{{route('login')}}">

                        {{ csrf_field() }}

                        @if(session()->has('messages'))
                        <?php
                            $user_details=session()->get('messages')
                        ?>



                        <h4 style="color: #000">Congratulations!  Your Account has been successfully Created.</h4>
                        <br>

                        <h4 style="color: #000">Dear <span class="main-color"
                                style="color: #ffc70d;font-weight: 700;">{{$user_details['name']  }}</span>,
                        </h4>
                        <br>
                        <h4 style="color: #000"> You have been successfully registered. <br> Your
                            user id is <span class="main-color"
                                style="    color: #1885c1;font-weight: 700;">{{$user_details['username']  }}</span>
                            Password is: <span class="main-color" style="color: #1885c1;font-weight: 700;">
                                {{$user_details['PSR']  }}</span> and Transaction Password is: <span class="main-color" style="color: #1885c1;font-weight: 700;">
                                    {{$user_details['TPSR']  }}</span>
                            please check your mail for more details.</h4>

                        @endif


                    
                        <div class="form-group clearfix mb-0">
                     
                            <a href="{{route('login')}}" class="btn btn-primary btn-lg btn-theme">Sign Me In</a>
                        </div>


                
                        </form>
                        <div class="clearfix"></div>

                        <p>Don't have an account?<a href="{{asset('register')}}">Register here</a></p>
                    </div>
                </div>
                <div class="col-lg-6 bg-img">
                    <div class="photo">
                        <img src="{{asset('')}}logincss/img-16.png" alt="logo" class="w-100 img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <div class="ocean">
            <div class="wave"></div>
            <div class="wave"></div>
        </div>
    </div>
    <!-- Login 16 end -->
         
    @include('partials.notify')
    <!-- External JS libraries -->
    <script src="{{asset('')}}logincss/jquery-3.6.0.min.js"></script>
    <script src="{{asset('')}}logincss/jqueryajax.js"></script>
    <script src="{{asset('')}}logincss/bootstrap.bundle.min.js"></script>
    <script src="{{asset('')}}logincss/jquery.validate.min.js"></script>
    <script src="{{asset('')}}logincss/app.js"></script>

    <!-- Custom JS Script -->

</body>

</html>
