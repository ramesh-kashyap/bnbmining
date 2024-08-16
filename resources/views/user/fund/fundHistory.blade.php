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
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Fund History</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Amount</th>
                                        <th>UTR Number</th>
                                        <th>Request Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(is_array($level_income) || is_object($level_income)){ ?>

                                    <?php $cnt =$level_income->perPage() * ($level_income->currentPage() - 1); ?>
                                    @foreach($level_income as $value)
                                    <tr>
                                        <td>
                                            <?= $cnt += 1?>
                                        </td>


                                        <td>{{currency()}} {{$value->amount}}</td>
                                        <td>{{$value->txn_no}}</td>
                                        <td>{{date("D, d M Y h:i:s a", strtotime($value->created_at));}} </td>
                                        <td class="btn-success btn-sm"><span
                                                class="badge badge-{{($value->status=='Approved')?'success':'danger'}}">{{$value->status}}</span>
                                        </td>


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
</div>


