<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">

        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Admin </a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Payment Ledgers</a></li>
            </ol>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Payment Ledgers</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.payment-ledgers') }}" method="GET">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="form-group mb-3">
                                        <input type="text" style="height: 3rem;" Placeholder="Search Users"
                                            name="search" class="form-control" value="{{ @$search }}">
                                    </div>
                                </div>
                                <div class="col-xl-2">
                                    <div class="form-group mb-3">
                                        <select name="limit" style="height: 3rem;" class="form-control">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-2">
                                    <div class="form-group mb-3">
                                        <input type="submit" style="padding: 0.6rem 2rem;" name="submit"
                                            class="btn btn-outline-theme btn-lg d-block w-100 btn-primary"
                                            value="Search" />
                                    </div>
                                </div>
                                <div class="col-xl-2">
                                    <div class="form-group mb-3">
                                        <a href="{{ route('admin.payment-ledgers') }}" style="padding: 0.6rem 2rem;"
                                            name="reset"
                                            class="btn btn-outline-theme btn-lg d-block w-100 btn-primary"
                                            value="Reset">Reset</a>
                                    </div>
                                </div>


                            </div>
                        </form>

                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Created At</th>
                                       <th>Growth Bonus</th>
                                       <th>Level Bonus</th>
                                       <th>Reward Bonus</th>
                                       
                                       <th>Total</th>
                                       <th>Deduction</th>
                                      
                                       <th>Payable Amount</th>
                                      
                                      
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(is_array($withdraw_list) || is_object($withdraw_list)){ ?>

                                    <?php $cnt = $withdraw_list->perPage() * ($withdraw_list->currentPage() - 1); ?>
                                    @foreach ($withdraw_list as $value)
                                        <tr>
                                            <td><?= $cnt += 1 ?></td>
                                            <td>{{$value->ttime}}</td>
                                        <td>{{currency()}}  {{$value->growth_bonus}}</td>
                                        <td>{{currency()}}  {{$value->level_bonus}}</td>
                                        <td>{{currency()}}  {{$value->reward_bonus}}</td>
                                        
                                        <td>{{currency()}}  {{$value->total}}</td>
                                        <td>{{currency()}}  {{$value->deduction}}</td>                                                         
                                        <td>{{currency()}}  {{$value->payable_amt}}</td>
                                                           
                                                           
                                                            
                                                           
                                        </tr>
                                    @endforeach

                                    <?php }?>
                                </tbody>

                            </table>

                            <br>

                            {{ $withdraw_list->withQueryString()->links() }}

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
