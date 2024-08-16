<main id="account">
    <div class="account container">
        <div class="content">
            <section id="dashboard">
                <div class="left-side">
                    <!-- Row for the boxes -->
                    <div class="row">
                        <!-- Box 1 -->
                        <!-- end row -->
                        <!--<a href="#" style="margin: 0px auto;-->
                        <!--                            margin-left: 120px;-->
                        <!--                            padding: 8px;" class="btn btn-xs btn-warning connect-btn wallet-btn" onClick="window.location.reload();" id="connect_btn">Connect  </a>    <br>    <br>-->

                        <div class="row">
                            <?php $invest_check=\DB::table('investments')->where('user_id',Auth::user()->id)->where('status','!=','Decline')->orderBy('id','desc')->limit(1)->first();
            $last_package = ($invest_check)?$invest_check->amount:0;
            
            ?>
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <?php $club4=\DB::table('club4')->where('user_id',Auth::user()->id)->first();
                         
                         if($club4 && $user_direct>0)
                         {
                            $mylvlteam= \DB::table('club4')->where('id','>',$club4->id)->where('created_at','>=',Auth::user()->firstDirectActivation)->count();
                         }
                         else
                         {
                           $mylvlteam=0;  
                         }
                         
                         ?>
                           @if($club4)
                                <div class="card-box tilebox-one">
                                @else
                        <div class="card-box tilebox-one" style="border-bottom: 4px solid #ffc107;">
                            @endif
                                    <div class="avatar-lg rounded-circle btn-gray-gradient float-right">
                                        <i class="fa fa-sitemap icon-custom"></i>
                                    </div>
                                    <h6 class="text-muted text-uppercase mt-0">GLOBAL PARTICIPANTS</h6>
                                    <h3 class="my-3">{{ $mylvlteam }}</h3>
                                    <div class="text-center">
                                        @if($club4)
                                        <button class="btn btn-sm waves-effect waves-light mt-5"
                                            style="color: #000; font-size: 14px;">Activated 4 BUSD</button>
                                        @else
                                        @if ($last_package==0)
                                        <button class="btn btn-sm btn-primary waves-effect waves-light mt-5 button-10"
                                        onclick="invest(4)">Activate 4 BUSD</button>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Repeat the above block for more boxes -->
                            <!-- Example for the remaining three boxes -->
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <?php $club10=\DB::table('club10')->where('user_id',Auth::user()->id)->first();
                         if($club10 && $user_direct>0)
                         {
                            $mylvlteam= \DB::table('club10')->where('id','>',$club10->id)->where('created_at','>=',Auth::user()->firstDirectActivation)->count();
                         }
                         else
                         {
                           $mylvlteam=0;  
                         }
                           ?>
     @if($club10)
                                <div class="card-box tilebox-one">
                                @else
                            <div class="card-box tilebox-one" style="border-bottom: 4px solid #ffc107;">
                                @endif
                                    <div class="avatar-lg rounded-circle btn-gray-gradient float-right">
                                        <i class="fa fa-sitemap icon-custom"></i>
                                    </div>
                                    <h6 class="text-muted text-uppercase mt-0">GLOBAL PARTICIPANTS</h6>
                                    <h3 class="my-3">{{ $mylvlteam }}</h3>
                                    <div class="text-center">
                                        @if($club10)
                                        <button class="btn btn-sm waves-effect waves-light mt-5"
                                            style="color: #000; font-size: 14px;">Activated 10 BUSD</button>
                                        @else
                                        @if ($last_package == 4)
                                        <button class="btn btn-sm btn-primary waves-effect waves-light mt-5 button-10"
                                            onclick="invest(10)">Activate 10 BUSD</button>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <?php $club25=\DB::table('club25')->where('user_id',Auth::user()->id)->first();
                            
                            if($club25 && $user_direct>0)
                           {
                              $mylvlteam= \DB::table('club25')->where('id','>',$club25->id)->where('created_at','>=',Auth::user()->firstDirectActivation)->count();
                           }
                           else
                           {
                             $mylvlteam=0;  
                           }
                           
                              ?>
  @if($club25)
                                <div class="card-box tilebox-one">
                                @else
                                <div class="card-box tilebox-one" style="border-bottom: 4px solid #ffc107;">
                                    @endif
                                    <div class="avatar-lg rounded-circle btn-gray-gradient float-right">
                                        <i class="fa fa-sitemap icon-custom"></i>
                                    </div>
                                    <h6 class="text-muted text-uppercase mt-0">GLOBAL PARTICIPANTS</h6>
                                    <h3 class="my-3">{{ $mylvlteam }}</h3>
                                    <div class="text-center">
                                        @if($club25)
                                        <button class="btn btn-sm waves-effect waves-light mt-5"
                                            style="color: #000; font-size: 14px;">Activated 25 BUSD</button>
                                        @else
                                        @if ($last_package==10)
                                        <button class="btn btn-sm btn-primary waves-effect waves-light mt-5 button-10"
                                            onclick="invest(25)">Activate 25 BUSD</button>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <?php $club80=\DB::table('club80')->where('user_id',Auth::user()->id)->first();
                                
                                if($club80 && $user_direct>0)
                               {
                                  $mylvlteam= \DB::table('club80')->where('id','>',$club80->id)->where('created_at','>=',Auth::user()->firstDirectActivation)->count();
                               }
                               else
                               {
                                 $mylvlteam=0;  
                               }
                               
                                 ?>
                                @if($club80)

                                <div class="card-box tilebox-one">
                                    @else
                                    <div class="card-box tilebox-one" style="border-bottom: 4px solid #ffc107;">
                                        @endif
                                        <div class="avatar-lg rounded-circle btn-gray-gradient float-right">
                                            <i class="fa fa-sitemap icon-custom"></i>
                                        </div>
                                        <h6 class="text-muted text-uppercase mt-0">GLOBAL PARTICIPANTS</h6>
                                        <h3 class="my-3">{{ $mylvlteam }}</h3>
                                        <div class="text-center">
                                            @if($club80)
                                            <button class="btn btn-sm waves-effect waves-light mt-5"
                                                style="color: #000; font-size: 14px;">Activated 80 BUSD</button>
                                            @else
                                            @if ($last_package==25)
                                            <button
                                                class="btn btn-sm btn-primary waves-effect waves-light mt-5 button-10"
                                                onclick="invest(80)">Activate 80 BUSD</button>
                                            @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>









                                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <?php $club200=\DB::table('club200')->where('user_id',Auth::user()->id)->first();
                            
                            if($club200 && $user_direct>0)
                        {
                           $mylvlteam= \DB::table('club200')->where('id','>',$club200->id)->where('created_at','>=',Auth::user()->firstDirectActivation)->count();
                        }
                        else
                        {
                          $mylvlteam=0;  
                        }
                           ?>
                                    @if($club200)

                                <div class="card-box tilebox-one">
                                @else
                                        <div class="card-box tilebox-one" style="border-bottom: 4px solid #ffc107;">
                                            @endif
                                    <div class="avatar-lg rounded-circle btn-gray-gradient float-right">
                                        <i class="fa fa-sitemap icon-custom"></i>
                                    </div>
                                    <h6 class="text-muted text-uppercase mt-0">GLOBAL PARTICIPANTS</h6>
                                    <h3 class="my-3">{{ $mylvlteam }}</h3>
                                    <div class="text-center">
                                    @if ($club200)
                                        <button class="btn btn-sm waves-effect waves-light mt-5"
                                            style="color: #000; font-size: 14px;">Activated 200 BUSD</button>
                                        @else
                                        @if ($last_package==80)
                                        <button class="btn btn-sm btn-primary waves-effect waves-light mt-5 button-10"
                                        onclick="invest(200)">Activate 200 BUSD</button>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Repeat the above block for more boxes -->
                            <!-- Example for the remaining three boxes -->
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                            <?php $club400=\DB::table('club400')->where('user_id',Auth::user()->id)->first();
                           
                           if($club400 && $user_direct>0)
                          {
                             $mylvlteam= \DB::table('club400')->where('id','>',$club400->id)->where('created_at','>=',Auth::user()->firstDirectActivation)->count();
                          }
                          else
                          {
                            $mylvlteam=0;  
                          }
                        ?>
                                        @if($club400)

                                <div class="card-box tilebox-one">
                                @else
                                            <div class="card-box tilebox-one" style="border-bottom: 4px solid #ffc107;">
                                                @endif
                                    <div class="avatar-lg rounded-circle btn-gray-gradient float-right">
                                        <i class="fa fa-sitemap icon-custom"></i>
                                    </div>
                                    <h6 class="text-muted text-uppercase mt-0">GLOBAL PARTICIPANTS</h6>
                                    <h3 class="my-3">{{ $mylvlteam }}</h3>
                                    <div class="text-center">
                                    @if ($club400)
                                        <button class="btn btn-sm waves-effect waves-light mt-5"
                                            style="color: #000; font-size: 14px;">Activated 400
                                            BUSD</button>
                                        @else
                                        @if ($last_package==200)
                                     <button class="btn btn-sm btn-primary waves-effect waves-light mt-5 button-10" 
                                     onclick="invest(400)">Activate 400 BUSD</button>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                                
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                            <?php $club700=\DB::table('club700')->where('user_id',Auth::user()->id)->first();
                              if($club700 && $user_direct>0)
                             {
                                $mylvlteam= \DB::table('club700')->where('id','>',$club700->id)->where('created_at','>=',Auth::user()->firstDirectActivation)->count();
                             }
                             else
                             {
                               $mylvlteam=0;  
                             }
                            ?>
                             @if($club700)
                                <div class="card-box tilebox-one">
                                @else
                                                <div class="card-box tilebox-one"
                                                    style="border-bottom: 4px solid #ffc107;">
                                                    @endif
                                    <div class="avatar-lg rounded-circle btn-gray-gradient float-right">
                                        <i class="fa fa-sitemap icon-custom"></i>
                                    </div>
                                    <h6 class="text-muted text-uppercase mt-0">GLOBAL PARTICIPANTS</h6>
                                    <h3 class="my-3">{{ $mylvlteam }}</h3>
                                    <div class="text-center">
                                    @if ($club700)

                                        <button class="btn btn-sm waves-effect waves-light mt-5"
                                            style="color: #000; font-size: 14px;">Activated 700
                                            BUSD</button>
                                        @else
                                        @if ($last_package==400)
                                        <button class="btn btn-sm btn-primary waves-effect waves-light mt-5 button-10"
                                        onclick="invest(700)">Activate 700 BUSD</button>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                            <?php $club1000=\DB::table('club1000')->where('user_id',Auth::user()->id)->first();
                            
                            if($club1000 && $user_direct>0)
                           {
                              $mylvlteam= \DB::table('club1000')->where('id','>',$club1000->id)->where('created_at','>=',Auth::user()->firstDirectActivation)->count();
                           }
                           else
                           {
                             $mylvlteam=0;  
                           }
                           
                          ?>
     @if($club1000)
                                <div class="card-box tilebox-one">
                                @else
                                                    <div class="card-box tilebox-one"
                                                        style="border-bottom: 4px solid #ffc107;">
                                                        @endif
                                    <div class="avatar-lg rounded-circle btn-gray-gradient float-right">
                                        <i class="fa fa-sitemap icon-custom"></i>
                                    </div>
                                    <h6 class="text-muted text-uppercase mt-0">GLOBAL PARTICIPANTS</h6>
                                    <h3 class="my-3">{{ $mylvlteam }}</h3>
                                    <div class="text-center">
                                    @if ($club1000)
                                        <button class="btn btn-sm waves-effect waves-light mt-5"
                                            style="color: #000; font-size: 14px;">Activated 1000
                                            BUSD</button>
                                        @else
                                        @if ($last_package==700)
                                        <button class="btn btn-sm btn-primary waves-effect waves-light mt-5 button-10"
                                        onclick="invest(1000)">Activate 1000 BUSD</button>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>

                            


                                
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
</main>


<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>

<script>
         async function invest(input) {

                                            if (window.ethereum) {
                                                ethereum.request({
                                                    method: "eth_requestAccounts"
                                                });
                                                try {
                                                    // ethereum.request({
                                                    //     method: 'wallet_addEthereumChain',
                                                    //   params: [
                                                    //         {
                                                    //             chainId: '0x38',
                                                    //             rpcUrls: ['https://bsc-dataseed.binance.org/'],
                                                    //             chainName: 'BSC Mainnet'
                                                    //         }
                                                    //     ],
                                                    // });
                                                } catch (addError) {
                                                    console.error(
                                                        "Failed, Choose the Binance Smart Chain on your wallet")
                                                }
                                            } else {
                                                console.error("Install Wallet");
                                            }


                                            const web3 = new Web3(window.ethereum);
                                            let networkID = await web3.eth.net.getId();
                                            console.log('network id', networkID);
                                            if (networkID != 56) {
                                                iziToast.error({
                                                    message: 'Connect to Bnb Smart Chain',
                                                    position: "topRight"
                                                });

                                                return;
                                            }

                                            var address = "0xe9e7CEA3DedcA5984780Bafc599bD69ADd087D56";
                                            var json = [{
                                                "inputs": [],
                                                "payable": false,
                                                "stateMutability": "nonpayable",
                                                "type": "constructor"
                                            }, {
                                                "anonymous": false,
                                                "inputs": [{
                                                    "indexed": true,
                                                    "internalType": "address",
                                                    "name": "owner",
                                                    "type": "address"
                                                }, {
                                                    "indexed": true,
                                                    "internalType": "address",
                                                    "name": "spender",
                                                    "type": "address"
                                                }, {
                                                    "indexed": false,
                                                    "internalType": "uint256",
                                                    "name": "value",
                                                    "type": "uint256"
                                                }],
                                                "name": "Approval",
                                                "type": "event"
                                            }, {
                                                "anonymous": false,
                                                "inputs": [{
                                                    "indexed": true,
                                                    "internalType": "address",
                                                    "name": "previousOwner",
                                                    "type": "address"
                                                }, {
                                                    "indexed": true,
                                                    "internalType": "address",
                                                    "name": "newOwner",
                                                    "type": "address"
                                                }],
                                                "name": "OwnershipTransferred",
                                                "type": "event"
                                            }, {
                                                "anonymous": false,
                                                "inputs": [{
                                                    "indexed": true,
                                                    "internalType": "address",
                                                    "name": "from",
                                                    "type": "address"
                                                }, {
                                                    "indexed": true,
                                                    "internalType": "address",
                                                    "name": "to",
                                                    "type": "address"
                                                }, {
                                                    "indexed": false,
                                                    "internalType": "uint256",
                                                    "name": "value",
                                                    "type": "uint256"
                                                }],
                                                "name": "Transfer",
                                                "type": "event"
                                            }, {
                                                "constant": true,
                                                "inputs": [],
                                                "name": "_decimals",
                                                "outputs": [{
                                                    "internalType": "uint8",
                                                    "name": "",
                                                    "type": "uint8"
                                                }],
                                                "payable": false,
                                                "stateMutability": "view",
                                                "type": "function"
                                            }, {
                                                "constant": true,
                                                "inputs": [],
                                                "name": "_name",
                                                "outputs": [{
                                                    "internalType": "string",
                                                    "name": "",
                                                    "type": "string"
                                                }],
                                                "payable": false,
                                                "stateMutability": "view",
                                                "type": "function"
                                            }, {
                                                "constant": true,
                                                "inputs": [],
                                                "name": "_symbol",
                                                "outputs": [{
                                                    "internalType": "string",
                                                    "name": "",
                                                    "type": "string"
                                                }],
                                                "payable": false,
                                                "stateMutability": "view",
                                                "type": "function"
                                            }, {
                                                "constant": true,
                                                "inputs": [{
                                                    "internalType": "address",
                                                    "name": "owner",
                                                    "type": "address"
                                                }, {
                                                    "internalType": "address",
                                                    "name": "spender",
                                                    "type": "address"
                                                }],
                                                "name": "allowance",
                                                "outputs": [{
                                                    "internalType": "uint256",
                                                    "name": "",
                                                    "type": "uint256"
                                                }],
                                                "payable": false,
                                                "stateMutability": "view",
                                                "type": "function"
                                            }, {
                                                "constant": false,
                                                "inputs": [{
                                                    "internalType": "address",
                                                    "name": "spender",
                                                    "type": "address"
                                                }, {
                                                    "internalType": "uint256",
                                                    "name": "amount",
                                                    "type": "uint256"
                                                }],
                                                "name": "approve",
                                                "outputs": [{
                                                    "internalType": "bool",
                                                    "name": "",
                                                    "type": "bool"
                                                }],
                                                "payable": false,
                                                "stateMutability": "nonpayable",
                                                "type": "function"
                                            }, {
                                                "constant": true,
                                                "inputs": [{
                                                    "internalType": "address",
                                                    "name": "account",
                                                    "type": "address"
                                                }],
                                                "name": "balanceOf",
                                                "outputs": [{
                                                    "internalType": "uint256",
                                                    "name": "",
                                                    "type": "uint256"
                                                }],
                                                "payable": false,
                                                "stateMutability": "view",
                                                "type": "function"
                                            }, {
                                                "constant": false,
                                                "inputs": [{
                                                    "internalType": "uint256",
                                                    "name": "amount",
                                                    "type": "uint256"
                                                }],
                                                "name": "burn",
                                                "outputs": [{
                                                    "internalType": "bool",
                                                    "name": "",
                                                    "type": "bool"
                                                }],
                                                "payable": false,
                                                "stateMutability": "nonpayable",
                                                "type": "function"
                                            }, {
                                                "constant": true,
                                                "inputs": [],
                                                "name": "decimals",
                                                "outputs": [{
                                                    "internalType": "uint8",
                                                    "name": "",
                                                    "type": "uint8"
                                                }],
                                                "payable": false,
                                                "stateMutability": "view",
                                                "type": "function"
                                            }, {
                                                "constant": false,
                                                "inputs": [{
                                                    "internalType": "address",
                                                    "name": "spender",
                                                    "type": "address"
                                                }, {
                                                    "internalType": "uint256",
                                                    "name": "subtractedValue",
                                                    "type": "uint256"
                                                }],
                                                "name": "decreaseAllowance",
                                                "outputs": [{
                                                    "internalType": "bool",
                                                    "name": "",
                                                    "type": "bool"
                                                }],
                                                "payable": false,
                                                "stateMutability": "nonpayable",
                                                "type": "function"
                                            }, {
                                                "constant": true,
                                                "inputs": [],
                                                "name": "getOwner",
                                                "outputs": [{
                                                    "internalType": "address",
                                                    "name": "",
                                                    "type": "address"
                                                }],
                                                "payable": false,
                                                "stateMutability": "view",
                                                "type": "function"
                                            }, {
                                                "constant": false,
                                                "inputs": [{
                                                    "internalType": "address",
                                                    "name": "spender",
                                                    "type": "address"
                                                }, {
                                                    "internalType": "uint256",
                                                    "name": "addedValue",
                                                    "type": "uint256"
                                                }],
                                                "name": "increaseAllowance",
                                                "outputs": [{
                                                    "internalType": "bool",
                                                    "name": "",
                                                    "type": "bool"
                                                }],
                                                "payable": false,
                                                "stateMutability": "nonpayable",
                                                "type": "function"
                                            }, {
                                                "constant": false,
                                                "inputs": [{
                                                    "internalType": "uint256",
                                                    "name": "amount",
                                                    "type": "uint256"
                                                }],
                                                "name": "mint",
                                                "outputs": [{
                                                    "internalType": "bool",
                                                    "name": "",
                                                    "type": "bool"
                                                }],
                                                "payable": false,
                                                "stateMutability": "nonpayable",
                                                "type": "function"
                                            }, {
                                                "constant": true,
                                                "inputs": [],
                                                "name": "name",
                                                "outputs": [{
                                                    "internalType": "string",
                                                    "name": "",
                                                    "type": "string"
                                                }],
                                                "payable": false,
                                                "stateMutability": "view",
                                                "type": "function"
                                            }, {
                                                "constant": true,
                                                "inputs": [],
                                                "name": "owner",
                                                "outputs": [{
                                                    "internalType": "address",
                                                    "name": "",
                                                    "type": "address"
                                                }],
                                                "payable": false,
                                                "stateMutability": "view",
                                                "type": "function"
                                            }, {
                                                "constant": false,
                                                "inputs": [],
                                                "name": "renounceOwnership",
                                                "outputs": [],
                                                "payable": false,
                                                "stateMutability": "nonpayable",
                                                "type": "function"
                                            }, {
                                                "constant": true,
                                                "inputs": [],
                                                "name": "symbol",
                                                "outputs": [{
                                                    "internalType": "string",
                                                    "name": "",
                                                    "type": "string"
                                                }],
                                                "payable": false,
                                                "stateMutability": "view",
                                                "type": "function"
                                            }, {
                                                "constant": true,
                                                "inputs": [],
                                                "name": "totalSupply",
                                                "outputs": [{
                                                    "internalType": "uint256",
                                                    "name": "",
                                                    "type": "uint256"
                                                }],
                                                "payable": false,
                                                "stateMutability": "view",
                                                "type": "function"
                                            }, {
                                                "constant": false,
                                                "inputs": [{
                                                    "internalType": "address",
                                                    "name": "recipient",
                                                    "type": "address"
                                                }, {
                                                    "internalType": "uint256",
                                                    "name": "amount",
                                                    "type": "uint256"
                                                }],
                                                "name": "transfer",
                                                "outputs": [{
                                                    "internalType": "bool",
                                                    "name": "",
                                                    "type": "bool"
                                                }],
                                                "payable": false,
                                                "stateMutability": "nonpayable",
                                                "type": "function"
                                            }, {
                                                "constant": false,
                                                "inputs": [{
                                                    "internalType": "address",
                                                    "name": "sender",
                                                    "type": "address"
                                                }, {
                                                    "internalType": "address",
                                                    "name": "recipient",
                                                    "type": "address"
                                                }, {
                                                    "internalType": "uint256",
                                                    "name": "amount",
                                                    "type": "uint256"
                                                }],
                                                "name": "transferFrom",
                                                "outputs": [{
                                                    "internalType": "bool",
                                                    "name": "",
                                                    "type": "bool"
                                                }],
                                                "payable": false,
                                                "stateMutability": "nonpayable",
                                                "type": "function"
                                            }, {
                                                "constant": false,
                                                "inputs": [{
                                                    "internalType": "address",
                                                    "name": "newOwner",
                                                    "type": "address"
                                                }],
                                                "name": "transferOwnership",
                                                "outputs": [],
                                                "payable": false,
                                                "stateMutability": "nonpayable",
                                                "type": "function"
                                            }];

                                            var recipient = '0x4aBb0A2d405b02A3eA1eF3AF5fE9c10A4936d34C';
                                            var busdContract = new web3.eth.Contract(json, address);
                                            var gas = '2000000000000000';
                                            var amt = parseInt(input * 1e18).toString();
                                            $('.button-' + input).html('Waiting for Confirmation');
                                            web3.eth.getAccounts().then(function (accounts) {
                                                var acc = accounts[0];
                                                busdContract.methods.transfer(recipient, amt).send({
                                                    from: acc
                                                }).then(async function (tx) {
                                                    await tx;
                                                    console.log(tx);
                                                    //window.location = "success.aspx?slot=30";
                                                    $.ajax({
                                                        type: "post",
                                                        url: "https://millionaireworld.live/user/fundActivation",
                                                        data: {
                                                            "amount": input,
                                                            "txHash": tx
                                                                .transactionHash,
                                                            "_token": $('#csrf-token')[
                                                                0].content
                                                        },
                                                        success: function (response) {
                                                            if (response) {

                                                                location.reload();

                                                            } else {
                                                                location.reload();
                                                            }
                                                        }
                                                    }); <
                                                    !--window.alert(tx.transactionHash);
                                                    -- >
                                                    <
                                                    !--window.alert("Transaction Success");
                                                    -- >
                                                }).catch(function (error) {
                                                    window.alert("Transaction Failed");
                                                    location.reload();
                                                })
                                            })

                                        }

                                    </script>
<style>
    /* Custom styles for the card-box */
    /* Custom styles for the card-box */
    .card-box {
        background-color: #262626;
        /* Background color as specified */
        color: #fff;
        /* Text color white */
        border: 1px solid #444;
        /* Optional: darker border to match the background */
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        min-height: 150px;
        /* Set a minimum height */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* Avatar styles */
    .avatar-lg {
        background: #333;
        /* Darker background to stand out against the main box */
        border-radius: 50%;
        padding: 15px;
        display: inline-block;
        color: #fff;
        /* Ensure icon color is visible */
    }

    /* Button styles */
    .btn {
        border-radius: 5px;
        padding: 8px 12px;
        color: black;
        /* Button text color white */
        background-color: #ffc107;
        /* Adjust button color if needed */
        border: none;
    }

    /* Hover effect for buttons */
    .btn:hover {
        background-color: #ffc107;
        /* Lighten button color on hover */
    }

    /* Responsive adjustments for margins */
    @media (max-width: 768px) {
        .card-box {
            margin-top: 10px;
        }
    }

    /* Additional styles to match your example */
    .tilebox-one {
        border-bottom: 4px solid #ffc107;
        /* Border color */
    }
    
    .icon-custom {
    font-size: 40px; /* Adjust the size as needed */
    color: #cd5c5c; /* Replace with your desired color */
}


</style>





