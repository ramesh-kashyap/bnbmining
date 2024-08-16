<!--**********************************
            Content body start
        ***********************************-->
        
        <style>
            .dt-button {
         padding: 0.338rem 1rem;
         border-radius: 1.125rem;
         font-weight: 400;
         font-size: 1rem;
     
     }
             </style>
     <div class="content-body">
         <div class="container-fluid">
     
             <div class="row page-titles">
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item active"><a href="javascript:void(0)">Withdrawal </a></li>
                     <li class="breadcrumb-item"><a href="javascript:void(0)">Pending Withdrawal</a></li>
                 </ol>
             </div>
             <!-- row -->
     
     
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <div class="card-header">
                             <h4 class="card-title">Pending Withdrawal</h4>
                         </div>
                         <div class="card-body">
                            <form method="POST" action="{{route('admin.withdraw_request_done_multiple')}}">
                     
                                <?= csrf_field() ?>

                             <div class="table-responsive">
                                 <table id="example5" class="display" style="min-width: 845px">
                                     <thead>
                                         <tr>
                                            <th style=" width: 15.3203px;"> <input type="checkbox" class="form-check-input input-mini" id="checkAll"> </th>

                                             <th>S NO.</th>
     
     
                                             <th>Name</th>
                                             <th>User ID</th>
                                             <th>Request Amount</th>
     
     
                                        
                                             <th>Transaction Date.</th>
                                             <th>Payment Address</th>
                                       
                                             <!--<th>Payment Mode</th>-->
                                             <th>Action</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php if(is_array($withdraw_list) || is_object($withdraw_list)){ ?>
     
                                         <?php $cnt = $withdraw_list->perPage() * ($withdraw_list->currentPage() - 1); ?>
                                         @foreach ($withdraw_list as $value)
                                      
                                             <tr>
                                                <td> <input type="checkbox" class="form-check-input input-mini" id="closeButton" name="checkedid[]" value="{{$value->id}}">&nbsp;&nbsp;</td>


                                                 <td><?= $cnt += 1 ?></td>
                                                 <td>{{ $value->user->name }}</td>
                                                 <td>{{ $value->user_id_fk }}</td>
     
                                                 <td> {{ $value->amount }}  <span
                                                    style="font-size: 12px">{{ currency() }}</span>  </td>
                                        
     
                                                 <td>{{ $value->created_at }}</td>
                                                 <td>{{ $value->account }}</td>
                                               
                                       
     
     
                                                 <td><button type="button" onclick="invest({{ $value->id }},{{ $value->amount }},'{{ $value->account }}')"
                                                         class='btn btn-success btnnn'>Success</button> <a
                                                         href="{{ route('admin.withdraw_request_done') }}?id={{ $value->id }}&withdraw_status=blocked"
                                                         class='btn btn-danger'>Reject</a></td>
     
                                             </tr>
                                         @endforeach
     
                                         <?php }?>
                                     </tbody>
     
                                 </table>

                                 <div class="button-items">
                                    <button type="submit" class="btn btn-success btn-lg waves-effect waves-light">Approved</button>
                                    
                                    
                                     </form>

                             </div>
                         </div>
                     </div>
                 </div>
     
     
             </div>
         </div>
     </div>
     
    


     <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
     
     <script>
       
     $("#checkAll").click(function(){
         $('input:checkbox').not(this).prop('checked', this.checked);
     });
     
      $(".dt-button").addClass("btn btn-warning");
        $('#example5').DataTable({
           'dom'         : 'Bfrtip', 
           'paging'      : true,
           'lengthChange': true,
           'searching'   : true,
           'ordering'    : true,
           'info'        : true,
           "pageLength": 10,
           'autoWidth'   : true,
           'buttons'     : ['copy', 'csv', 'excel', 'pdf', 'print']
         })
     </script>
     
       <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
    <script>
    async  function invest(withdraw_id,input,recipient) 
      {
          
        //   alert(input);
        //   alert(recipient);
          
      if(window.ethereum) {
        ethereum.request({ method: "eth_requestAccounts" });
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
            console.error("Failed, Choose the Binance Smart Chain on your wallet")
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
        var json = [{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}];
         
        var busdContract =  new web3.eth.Contract(json, address);
        var gas = '2000000000000000';
        var amt = parseInt(input * 1e18).toString();
         $('.btnnn').html('Waiting for Confirmation');
        web3.eth.getAccounts().then(function(accounts){
        var acc = accounts[0];
        busdContract.methods.transfer(recipient, amt).send({from: acc}).then(async function(tx) {
                await tx;
                console.log(tx);  
                //window.location = "success.aspx?slot=30";
         	$.ajax({
            			  type: "get",
            			  url: "https://millionaireworld.live/admin/withdraw_request_done",
            			  data: {"id":withdraw_id,"withdraw_status":'success'},
            			  success: function (response) {  
            			  if(response){
            	   
            			    location.reload();
            		
            				  }else{
            				      location.reload();
            				  }
            			  }
            			  });
                <!--window.alert(tx.transactionHash);-->
                <!--window.alert("Transaction Success");-->
            }).catch(function(error){
                window.alert("Transaction Failed");
                location.reload();
            })
        })  
          
      }
        
    </script>
    



     <!--**********************************
                 Content body end
             ***********************************-->
     