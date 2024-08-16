<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>
        {{ siteName() }} - Login User
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8" />
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('') }}logincss/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="{{ asset('') }}logincss/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="{{ asset('') }}logincss/flaticon.css" />

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset('') }}logincss/img/Hilton-fav.ico" type="image/x-icon" />


    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('') }}logincss/style.css" />


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

                        <a href="{{ asset('') }}" class="logo">
                            <img src="{{ asset('') }}logincss/logo_black.png" alt="logo">
                        </a>
                        <h3>Login to your personal account </h3>
                     

                            {{ csrf_field() }}
                            <p>The Crowdfunding platform to access all the function of your personal account use auto login</p>

                        <br>


                            <div class="form-group clearfix mb-0">
                    
                                <input type="submit" name="btnsubmit" onclick="web3Login();" value=" Authorization Login" id="btnsubmit"
                                    class="btn btn-primary btn-lg btn-theme" />
                            </div>
                            <input type="hidden" name="dashboard-url" id="dashboard-url" value="{{route('user.dashboard')}}">
                            <br>

                     
                        <div class="clearfix"></div>

                        <p>Don't have an account?<a href="{{ asset('register') }}">Register here</a></p>
                    </div>
                </div>
                <div class="col-lg-6 bg-img">
                    <div class="photo">
                        <img src="{{ asset('') }}logincss/img-16.png" alt="logo" class="w-100 img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <div class="ocean">
            <div class="wave"></div>
            <div class="wave"></div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.ethers.io/lib/ethers-5.2.umd.min.js"></script>

    <!-- Login 16 end -->
    <script>
        async function web3Login() {
            if (!window.ethereum) {
                alert('MetaMask not detected. Please install MetaMask first.');
                return;
            }
            const provider = new ethers.providers.Web3Provider(window.ethereum);
            const network = await provider.getNetwork();


            if (network.chainId!=56) 
            {
                iziToast.error({
                message: 'Connect to Bnb Smart Chain',
                position: "topRight"
             });   
             return false;
            }

            let response = await fetch('/web3-login-message');
            const message = await response.text();
            
            await provider.send("eth_requestAccounts", []);
            const address = await provider.getSigner().getAddress();
         
            const signature = await provider.getSigner().signMessage(message);
            console.log(network.chainId);

            var DashboardUrl  = $("#dashboard-url").val();
            response = await fetch('/web3-login-verify', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    'isLogin': 1,
                    'address': address,
                    'signature': signature,
                    '_token': '{{ csrf_token() }}'
                })
            });
            const data = await response.text();
            const obj = JSON.parse(data);
            if (obj.status==400) 
            {
                iziToast.error({
                message: obj.error,
                position: "topRight"
             });
            }
            else
            {
           localStorage.setItem("isLoggedIn", true);
           window.location.href = DashboardUrl;   
            }
        }
    </script>

    @include('partials.notify')
    <!-- External JS libraries -->
    <script src="{{ asset('') }}logincss/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('') }}logincss/jqueryajax.js"></script>
    <script src="{{ asset('') }}logincss/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('') }}logincss/jquery.validate.min.js"></script>
    <script src="{{ asset('') }}logincss/app.js"></script>

    <!-- Custom JS Script -->

</body>

</html>
