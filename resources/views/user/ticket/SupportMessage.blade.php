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
                        <h4 class="page-title">Ticket details</h4>
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
                                                <th>Ticket No</th>
                                                <th>Category</th>
                                                <th>Request Date</th>
                                                <!--<th>Closing Date</th>-->
                                                <th>Status</th>
                                                <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(is_array($level_income) || is_object($level_income)){ ?>

                                        <?php $cnt =$level_income->perPage() * ($level_income->currentPage() - 1); ?>
                                        @foreach($level_income as $value)
                                            <tr>
                                                <td><?= $cnt += 1?></td>

                                                <!--<td>{{ $value->user_id_fk }}</td>-->
                                                <td>{{ $value->ticket_no }}</td>
                                                <td>{{ $value->category }}</td>
                                                <td>{{ $value->gen_date }}</td>
                                                <!--<td>{{ $value->closing_date }}</td>-->
                                                <?php if($value->status=="1"){$color="red";}else{$color="green";}?>
                                                <td style="color:<?=@$color?>;font-weight:700">
                                                    {{ ($value->status)?"Closed":"Open" }}
                                                </td>
                                                <td><a
                                                        href="{{ route('user.ViewMessage') }}?ticket_no={{ $value->ticket_no }}"><button
                                                            style="color:#000;border:1px solid #000;padding:8px;border-radius:15px">View
                                                            all message</button></a></td>

                                            </tr>
                                        @endforeach

                                        <?php }?>
    
                                </tbody>
                                
                            </table>
                        </div>

                    </div>
                </div>
            </div>



    </div>
</div>
