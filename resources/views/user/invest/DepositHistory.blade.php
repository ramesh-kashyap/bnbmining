<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="wrapper">
    <div class="container-fluid">
     <br>
            <div class="breadcrumb-header justify-content-between">
                <div class="my-auto">
                    <div class="d-flex">
                        <br>
                        <h4 class="content-title mb-0 my-auto">Activation</h4>
                        <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Activation details</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">


                    <div id="ctl00_ContentPlaceHolder1_Panel1" class="card">

                        <div class="card-header">
                            My Investment
                        </div>

                        <div class="card-body min-h-350">

                            <div class="table-responsive">

                                <table id="example" class="table tab-border mb-0">
                                    <thead>
                                        <tr>
                                            <th>#S.NO</th>
                                            <th>User ID</th>
                                            <th>Amount</th>
                                            <th>Transaction Date</th>
                                            <th>Transaction ID</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(is_array($deposit_list) || is_object($deposit_list)){ ?>

                                        <?php $cnt = 0; ?>
                                        @foreach ($deposit_list as $value)
                                            <tr>
                                                <td><?= $cnt += 1 ?></td>
                                                <td>{{ $value->user_id_fk }}</td>

                                                <td> {{ $value->amount }} <span
                                                        style="font-size: 12px">{{ currency() }}</span></td>
                                                <td>{{ date('D, d M Y', strtotime($value->created_at)) }} </td>
                                                <td>{{ $value->transaction_id }}</td>
                                                <td><span
                                                        class="badge badge-{{ $value->status == 'Active' ? 'success' : 'danger' }}">{{ $value->status }}</span>
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




        </form>
    </div>
</div>


<!-- end wrapper -->
<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->
