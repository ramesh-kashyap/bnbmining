<div class="wrapper">
    <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="dashboard.aspx">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">My Team</a></li>
                                <li class="breadcrumb-item active">Referrals</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Global income</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

        

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        

                        <div class="table-responsive">



                            <table id="example" class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                        <th>Sr No</th>
                                 
                                       
                                        <th>Amount</th>
                          
                                        <th>Date</th>
  
                                        <th>Level  </th>
                                        <th>From ID  </th>
                                   
  
  
                                
                                        <th>Remarks </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(is_array($level_income) || is_object($level_income)){ ?>

                                        <?php $cnt = $level_income->perPage() * ($level_income->currentPage() - 1); ?>
                                        @foreach ($level_income as $value)
                                            <tr>
                                                <td><?= $cnt += 1 ?></td>
    
    
                                      
                              
                                  
                                              
                                                <td> {{ $value->comm }} <span style="font-size: 12px">{{currency()}}</span></td>
                                                <td>{{date("D, d M Y", strtotime($value->created_at)) }} </td>
                                                <td>{{ $value->level }}</td>
                                               <td>Pool {{ $value->amt }}</td> 
                                                <td>{{ $value->remarks }}</td>
    
                                            </tr>
                                        @endforeach
    
                                        <?php }?>
    
                                </tbody>
                                
                            </table>
                            
                               <br>

                                    {{ $level_income->withQueryString()->links() }}
        
        
                        </div>

                    </div>
                </div>
            </div>



    </div>
</div>
