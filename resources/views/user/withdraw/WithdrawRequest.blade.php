<main id="account">
    <div class="account container">
        <div class="content">
            <section id="withdraw">
                <div class="withdraw-or-reinvest">
                    <div class="withdraw">
                        <div class="title text-center">
                            <p>Withdraw</p>
                        </div>

                        <form onsubmit="return amtValue()" method="post" action="{{ route('user.Withdraw-Request') }}">
                            {{ csrf_field() }}


                            <p style="margin-bottom:10px;">Balance</p>
                            <input type="text" name="balance"
                                value="{{ number_format(Auth::user()->available_balance(), 2) }}" disabled="disabled"
                                class="def-input" />
                            <p style="margin-top:17px;">Withdrawal Address</p>
                            <input type="text" style="margin-top:15px;" name="trx_address"
                                value="{{Auth::user()->walletAddress}}" disabled="disabled" class="def-input" />
                            <p style="margin-top:17px;">Withdrawal Amount</p>
                            <input type="text" style="margin-top:15px;" name="amount" id="PACKAGE_AMT" required
                                class="def-input" placeholder="Withdrawal Amount" />






                            <!-- Withdrawal Amount Field with Label and Currency -->


                            <!-- Submit Button -->
                            <button type="submit" style="margin-top:25px;"
                                class="btn btn-primary def-btn">Withdraw</button>
                        </form>
                    </div>

                    <!-- Include Notification Partial -->
                    @include('partials.notify')
                </div>



                <div class="recent-transactions">
                    <div class="title text-center">
                        <p>Withdraw <span>history</span></p>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="wd-15p">#S.NO</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">User Id</th>

                                    <th scope="col">Transaction Id</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php if(is_array($withdraw_report) || is_object($withdraw_report)){ ?>

                                <?php $cnt = $withdraw_report->perPage() * ($withdraw_report->currentPage() - 1); ?>
                                @foreach($withdraw_report as $value)
                                <tr>
                                    <td><?= $cnt += 1 ?></td>
                                    <td class="empty">{{ $value->created_at }}</td>
                                    <td class="empty">{{ ($value->amount) }} <span>
                                    <td>{{ ($value->user_id_fk) }}</td>

                                  
                                            style="font-size: 12px">{{currency()}}</span></td>

                                    <td class="empty">{{ $value->txn_id }}</td>

                                    <!-- <td  class="empty"><span
                                    class="badge badge-{{ ($value->status=='Active')?'success':'danger' }}">{{ $value->status }}</span></td>

                                    <td  class="empty">USDT</td> -->

                                </tr>
                                @endforeach

                                <?php }?>
                            </tbody>
                        </table>
                        <br>

                        {{ $withdraw_report->withQueryString()->links() }}                  
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<!-- JavaScript Function for Validation -->
<script>
    function amtValue() {
        var amt = document.getElementById('PACKAGE_AMT').value;
        if (amt % 1 === 0) {
            confirm("Are You Sure You Want to Withdraw " + amt);
            $('#btn1').hide();
            $('#btn2').show();
            return true;
        } else {
            alert('Please enter a valid amount (multiple of 1 BUSD)');
            return false;
        }
    }

</script>
<style>
    .def-input {
        padding: 10px;
        border-radius: 4px;
        width: 100%;
    }

    .def-btn {
        padding: 10px 20px;
        background-color: #f5c539;
        color: black;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .def-btn:hover {
        background-color: #0056b3;
    }

</style>
