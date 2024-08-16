<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>
    {{siteName()}} - Login User
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
                        <h3>Verify your Email</h3>
                <form method="POST" action="{{route('verifyCode')}}">

                        {{ csrf_field() }}

                        <div class="form-group position-relative clearfix">
                            <input class="form-control" type="text"  name="code" placeholder="Enter Verification Code" required="">
                            <input type="hidden"  value="{{$userID}}" class="form-control" name="userID" >
                          
                        </div>
                      

                        <div class="form-group clearfix mb-0">
                            <input type="hidden" name="hdn_country" id="hdn_country" />
                            <input type="submit" name="btnsubmit" value="Submit"
                            id="btnsubmit" class="btn btn-primary btn-lg btn-theme" />
                        </div>


                
                        </form>
                        <div class="clearfix"></div>

                        <p>Already a member? <a href="{{ asset('login') }}">Login here</a></p>
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
