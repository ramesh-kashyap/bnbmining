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

                  
                    <form class="authorization">
                        <h3>Login</h3>
                        {{ csrf_field() }}

                        <h3>Login to your personal account</h3>
                        <p>The Crowdfunding platform to access all the function of your personal account use auto login</p>
                        <input type="submit" name="btnsubmit" onclick="web3Login();" value=" Authorization Login" id="btnsubmit" class="def-input" style="background-color:#f5c539;color:#262626;">
                        <input type="hidden" name="dashboard-url" id="dashboard-url" value="{{route('user.dashboard')}}">

                

                        <div
                            style="display: flex; justify-content: space-between; margin-top: 15px; margin-bottom: 15px;">
                          
                            <a href="{{ route('register') }}"
                                style="color: white; margin-left: 40px;">Register Here</a>
                        </div>

                    </form>


                </div>
               
            </section>

            <section id="marketing">

                <!-- for mobile -->
                <h3><i class="fa-solid fa-chart-line"></i>Marketing</h3>

                <div class="advantages">

                    <div>
                        <img src="{{ asset('') }}assets/img/main/bonus_deposit.png"
                            alt="Bonus deposit">
                        <h5>Bonus deposit <span>5 TRX</span></h5>
                    </div>

                    <div>
                        <img src="{{ asset('') }}assets/img/main/daily_profit.png" alt="Daily profit">
                        <h5>Daily profit <span>10%</span></h5>
                    </div>

                    <div>
                        <img src="{{ asset('') }}assets/img/main/min_wd.png" alt="Payouts">
                        <h5>Payouts from <span>10 TRX</span></h5>
                    </div>

                </div>

            </section>

            <section id="referral">

                <div class="referral-percentage">

                    <div>
                        <h5>10%</h5>
                        <p>from deposits</p>
                    </div>

                    <div>
                        <h5>100%</h5>
                        <p>from completed tasks</p>
                    </div>

                </div>

                <div class="referral-description">

                    <h5><i class="fa-solid fa-users-rectangle"></i>Referral program</h5>
                    <p>Our referral program is generous and gives you the opportunity to earn money from
                        deposits and completed tasks (more details below). You will receive <span>10%</span> of
                        each deposit your friend makes and <span>100%</span> of the amount he received for
                        completing a task on the site.</p>

                </div>

            </section>

            <section id="tasks">

                <div class="example-tasks">

                    <div>
                        <p><i class="fa-brands fa-telegram"></i>Subscribe to "Mine Tron x"</p>
                        <button class="def-btn yellow-btn"><i class="fa-solid fa-right-long"></i></button>
                    </div>

                    <div>
                        <p><i class="fa-brands fa-youtube"></i>Like "How to make money online"</p>
                        <button class="def-btn yellow-btn"><i class="fa-solid fa-right-long"></i></button>
                    </div>

                    <div>
                        <p><i class="fa-brands fa-twitter"></i>Subscribe to "Elon Mask"</p>
                        <button class="def-btn yellow-btn"><i class="fa-solid fa-right-long"></i></button>
                    </div>

                </div>

                <div class="description-tasks">

                    <h5><i class="fa-solid fa-list-ul"></i>Tasks</h5>
                    <p>Complete tasks for viewing the site, subscribing to telegram and YouTube and many others.
                        Receive a fixed reward of <span>0.01 TRX</span> for each completion. The number of
                        completed tasks per day is <span>not limited</span>. For advertisers: the cost of
                        <span>1000</span> task completions is only <span>30 TRX</span>. Each user can complete
                        your task once.</p>

                </div>

            </section>

            <section id="other">

                <div class="start-earning">

                    <p>What are you waiting for? Start earning money now!</p>


                    <a href="{{ route('Index') }}" class="def-btn yellow-btn"><i
                            class="fa-solid fa-up-long"></i>Login to
                        dashboard</a>


                </div>

                <div class="more-info">

                    <h5><i class="fa-solid fa-compress"></i>More information</h5>

                    <ul>
                        <li><a href="{{ route('Statistics') }}">Statistics</a></li>
                        <li><a href="{{ route('faq') }}" translate="no">FAQ</a></li>
                        <li><a href="{{ route('Bounty') }}">Bounty</a></li>
                        <li><a href="{{ route('contact') }}">Contacts</a></li>
                    </ul>

                </div>

            </section>
        </div>

    </div>

</main>
<script src="https://cdn.ethers.io/lib/ethers-5.2.umd.min.js"></script>

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
    <style>
        /* Style for h3 tags */
#main h3 {
    font-size: 24px; /* Adjusts the font size */
    font-weight: 600; /* Makes the text bold */
    margin-bottom: 15px; /* Adds space below the heading */
    text-align: center; /* Centers the text */
    line-height: 1.4; /* Adjusts the line height for better readability */
}

/* Style for p tags */
#main p {
    font-size: 16px; /* Sets a comfortable font size */
    margin-bottom: 15px; /* Adds space below the paragraph */
    text-align: center; /* Centers the text */
    line-height: 1.6; /* Increases line spacing for better readability */
}

/* Additional styling for specific sections */
#main .short-description p {
    font-size: 18px; /* Slightly larger text for the short description */
}

#main .login-form h5 {
    font-size: 20px; /* Adjusts the font size */
    margin-bottom: 10px; /* Adds space below the heading */
    text-align: left; /* Aligns text to the left */
}

#main .referral-description h5,
#main .description-tasks h5 {
    font-size: 22px; /* Adjusts the font size for section headings */
    font-weight: 700; /* Bolder text */
    margin-bottom: 10px; /* Adds space below the heading */
    text-align: center; /* Centers the text */
}

#main .referral-description p,
#main .description-tasks p {
    font-size: 16px; /* Sets a comfortable font size */
    line-height: 1.5; /* Adjusts line spacing for readability */
    margin-bottom: 20px; /* Adds space below the paragraph */
}

/* Responsive adjustments */
@media (max-width: 768px) {
    #main h3 {
        font-size: 22px; /* Slightly reduces font size on smaller screens */
    }
    #main p {
        font-size: 15px; /* Slightly reduces font size on smaller screens */
    }
}

        </style>
@include('partials.notify')

@include('layouts.mainsite.footer')
