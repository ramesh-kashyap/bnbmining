@include('layouts.mainsite.header')

<main id="main">
    <div class="main container">
        <div class="content">
            <section id="welcome">
                <div class="short-description">

                    <h3>Get 10% daily profit</h3>
                    <p>Just log in and start earning money without investment.</p>

                    <div class="tron-img animate__animated animate__pulse animate__infinite">
                        <img src="{{ asset('') }}assets/img/tron.png" alt="Tron Mining">
                    </div>

                </div>
                <div class="login-form">
 

                    <div  class="authorization">
                        <h5> Register</h5>

                        @php
                            $sponsor = @$_GET['ref'];
                            $name = \App\Models\User::where('username', $sponsor)->first();
                        @endphp
                        <input  type="text" class="def-input check_sponsor_exist"  data-response="sponsor_res" name="sponsor" placeholder="Enter Referral ID"   value="{{ $sponsor ? $sponsor : '' }}" id="referral_id">
                        <span id="sponsor_res"><?= $name ? $name->name : '' ?></span>
                        <input type="submit"  onclick="web3Login();"  name="btnsubmit" value="Registration"   id="btnsubmit" class="def-input"  style="width:100%;max-width:300px;margin-bottom:30px;border:none;padding:16px 32px;text-decoration:none;font-size:16px;transition-duration:0.3s;line-height:normal;white-space:nowrap;border-radius:10px;font-weight:600;min-width:200px;display:flex;align-items:center;justify-content:center;background-color:#f5c539;color:#262626;box-shadow:rgb(153 132 27) 0px 4px 0px 0px;outline: none !important;cursor: pointer;">
                        <input type="hidden" name="dashboard-url" id="dashboard-url" value="{{route('user.dashboard')}}">

                  
                        <div
                            style="display: flex; justify-content: space-between; margin-top: 15px; margin-bottom: 15px;">
                        
                            <a href="{{ route('Index') }}" style="color: white; margin-left: 40px;">Sign In</a>
                        </div>
</div>

                </div>

            </section>
            <section id="marketing">
            </section>
        </div>
    </div>
</main>
    <script src="https://cdn.ethers.io/lib/ethers-5.2.umd.min.js"></script>

<script>
        async function web3Login() {
            var sponsor  = $("#referral_id").val();
            if (sponsor=="") 
            {
              alert('Fill Referral ID') ;
              return false;
            }


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
            // console.log(signature);
            var DashboardUrl  = $("#dashboard-url").val();
           
            response = await fetch('/web3-login-verify', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    'isLogin': 0,
                    'sponsorID':sponsor,
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

    <style>
        .dd {
            border: 1px solid #c2baba !important;
            text-align: left !important;
        }

        .dd .ddTitle {
            font-size: 18px !important;
            color: #454240 !important;
        }
    </style>
  
    <script>
      

        $('.check_sponsor_exist').keyup(function(e) {
            
            var ths = $(this);
            var res_area = $(ths).attr('data-response');
            var sponsor = $(this).val();
            // alert(sponsor); 
            $.ajax({
                type: "POST"
                , url: "{{ route('getUserName') }}"
                , data: {
                    "user_id": sponsor
                    , "_token": "{{ csrf_token() }}"
                , }
                , success: function(response) {
                    // alert(response);      
                    if (response != 1) {
                        // alert("hh");
                        $(".submit-btn").prop("disabled", false);
                        $('#' + res_area).html(response).css('color', '#000').css('font-weight', '800')
                            .css('margin-buttom', '10px');
                    } else {
                        // alert("hi");
                        $(".submit-btn").prop("disabled", true);
                        $('#' + res_area).html("Sponsor ID Not exists!").css('color', 'red').css(
                            'margin-buttom', '10px');
                    }
                }
            });
        });

    </script>

@include('layouts.mainsite.footer')
