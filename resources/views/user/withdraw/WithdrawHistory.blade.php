<div class="wrapper">
    <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="dashboard.aspx">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Withdrawal</a></li>
                                <li class="breadcrumb-item active">Withdrawal Reports</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Withdrawal Reports</h4>
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
                                        <th class="wd-15p">#S.NO</th>
                                        <th class="wd-15p">User ID</th>
                                        <th class="wd-15p">Amount</th>
                                      
                                        <th class="wd-15p">Date </th>
                                        <th class="wd-15p">Payment Mode </th>
                                        <th class="wd-15p">Transaction ID</th>
                                        <th class="wd-15p">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(is_array($withdraw_report) || is_object($withdraw_report)){ ?>

                                    <?php $cnt = $withdraw_report->perPage() * ($withdraw_report->currentPage() - 1); ?>
                                    @foreach($withdraw_report as $value)
                                        <tr>
                                            <td><?= $cnt += 1 ?></td>
                                            <td>{{ ($value->user_id_fk) }}</td>
                                            <td> {{ ($value->amount) }} <span style="font-size: 12px">{{currency()}}</span></td>
                                            
                                            <td>{{ $value->created_at }}</td>
                                            <td>{{ $value->payment_mode }}</td>
                                            <td>{{ $value->txn_id }}</td>
                                            <td><span
                                                class="badge badge-{{ ($value->status=='Approved')?'success':'danger' }}">{{ $value->status }}</span></td>

                                        </tr>
                                    @endforeach

                                    <?php }?>
    
                                </tbody>
                                
                            </table>
                            
                            <br>

                                    {{ $withdraw_report->withQueryString()->links() }}
                        </div>

                    </div>
                </div>
            </div>



    </div>
</div>
