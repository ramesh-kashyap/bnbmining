        <!--**********************************
                        Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
				
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Support</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Support Message</a></li>
					</ol>
                </div>
                <!-- row -->


                <div class="row">
                    <div class="col-12">
                        <br><br>  <br><br>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Support Message</h4>
                            </div>
                            
                            <div class="card-body">
                              
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <?php if(is_array($open_ticket_msg) || is_object($open_ticket_msg)){ ?>
                                            <?php $count= 0; ?>
                                            <?php foreach ($open_ticket_msg as $item): ?>
                                            <?php if($item->reply_by == 'user'){ }  ?>

                                            <h5 class="form-header" style="width: 233px; background:#e92266;padding: 7px;color: #fff;border-radius: 10px;"> <?= $item->category ?> (<?=$item->gen_date?>)</h5>
                                            <br>
                                           <p class="comp_bank_p" style="color:#000" ><?= $item->msg ?></p>
                                           <p class="text-right" style="margin-right: 30px;color:#000;margin-left:300px"><?=($item->reply_by == 'admin')? 'Admin' : 'You'?></p>
                                           <?php endforeach; ?>
                                           <?php } ?>
                                       
                                    </table>
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
