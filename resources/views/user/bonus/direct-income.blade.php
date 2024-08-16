<main id="account">

    <div class="account container">

        <div class="content">

            <section id="referrals">

                <!-- <div class="referrals"> -->

                <!-- <div class="title text-center">
<p>Referral <span>program</span></p>
</div> -->
                <!-- 
<div class="referral-link">
<input class="def-input" type="text" value="https://minetronx.net/i/3167" id="copied_text" readonly>
<i class="fa-solid fa-copy" onclick="CopiedText()"></i>
</div> -->

                <!-- <div class="description">
<i class="fa-solid fa-info"></i>
<p>Invite your friends and receive <span>10%</span> of their deposit amount and <span>100%</span> of their earnings on tasks.</p>
</div> -->

                <!-- <div class="statistics">
<p>
    <span>Referrals:</span>
    <span><span>0</span></span>
</p>
<p>
    <span>Earned:</span>
    <span translate="no">0.00<span>TRX</span></span>
</p>
</div> -->

                <!-- </div> -->

                <div class="recent-transactions referral-table">

                    <div class="title text-center">
                        <p>Referral <span>list</span></p>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" translate="no">Sr No</th>
                                    <th scope="col">Package</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">From ID</th>
                                    <th scope="col">Remarks</th>


                                </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($level_income) || is_object($level_income)){ ?>

<?php $cnt = $level_income->perPage() * ($level_income->currentPage() - 1); ?>
@foreach ($level_income as $value)

                                <tr>
                                    <td class="empty"><?= $cnt += 1 ?></td>
                                    <td class="empty">{{ $value->amt }}<span style="font-size: 12px">{{currency()}}</span></td>

                                    <td class="empty">{{ $value->comm }} <span style="font-size: 12px">{{currency()}}</span></td>

                                    <td class="empty">{{date("D, d M Y", strtotime($value->created_at)) }}</td>

                                    <td class="empty">{{ $value->level }}</td>
                                    <td class="empty">{{ $value->rname }}</td>

                                    <td class="empty">
                                    {{ $value->remarks }}
                                    </td>


                                </tr>
                                @endforeach

                                <?php }?>

                            </tbody>
                        </table>
                        <br>

                        {{ $level_income->withQueryString()->links() }}                    </div>


            </section>
        </div>

    </div>

</main>
