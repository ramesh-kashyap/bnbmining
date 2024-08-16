   <!--**********************************
            Content body start
        ***********************************-->
   <div class="content-body">
       <div class="container-fluid">
           <div class="row page-titles">
               <ol class="breadcrumb">
                   <li class="breadcrumb-item active"><a href="javascript:void(0)">fund</a></li>
                   <li class="breadcrumb-item"><a href="javascript:void(0)">Add Fund</a></li>
               </ol>
           </div>
           <!-- row -->
           <div class="row">
            <div class="col-xl-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">PAY HERE - TRON</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">


                             <br>
                                <div class="row">

                                    <img style="width: 200px;    margin: 0px auto;"
                                                src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=TYZDjwiBscSvpkem27HexrqERdCFTYYfAL">
                                <div class="copy-tooltip text-center">
                                    <h6 id="wallet-add1" class="wallet-address">  <input type="text" style="    width: 55%;
                                        border: navajowhite;" readonly id="wallet-address" value="TYZDjwiBscSvpkem27HexrqERdCFTYYfAL"></h6>

                                    <a  class="btn btn-success copyToClipboard" onclick="copyFunctionwallet('wallet-address')">Copy Text</a>
                                </div>



                                </div>




                        </div>
                    </div>
                </div>
            </div>


               <div class="col-xl-6 col-lg-12">
                   <div class="card">
                       <div class="card-header">
                           <h4 class="card-title">Add Fund</h4>
                       </div>
                       <div class="card-body">
                           <div class="basic-form">
                               <form action="{{ route('user.SubmitBuyFund') }}" method="POST" enctype="multipart/form-data">

                                   {{ csrf_field() }}
                                   <div class="row">
                                       <div class="mb-3 col-md-12">
                                           <label class="form-label">Deposit (TRX) <span class="tx-danger">*</span></label>
                                           <input type="number" min="1" class="form-control" name="amount" required="true" placeholder="Enter amount ">
                                       </div>
                                       <div class="mb-3 col-md-12">
                                           <label class="form-label">Transaction ID<span class="tx-danger">*</span></label>
                                           <input type="text" class="form-control " name="transaction_hash" placeholder="Transaction ID " required="true">
                                       </div>
                                       <div class="mb-3 col-md-12">
                                           <label class="form-label">Upload Reciept <span class="tx-danger">*</span></label>
                                           <input type="file" class="form-control " name="icon_image" required="true">
                                       </div>

                                   </div>
                                   <button type="submit" class="btn btn-primary">Submit</button>
                               </form>
                           </div>
                       </div>
                   </div>
               </div>



           </div>
       </div>
   </div>
   <!--**********************************
                 Content body end
             ***********************************-->
   <script src="https://code.jquery.com//jquery-3.3.1.min.js"> </script>
   <script>
       function copyFunctionwallet(inputID) {

           var copyText = document.getElementById("wallet-address");

           copyText.select();

           document.execCommand("copy");
           $(".copyToClipboard").html("Copied");

           /* Alert the copied text */
           alert("copied: " + copyText.value)

       }

   </script>
