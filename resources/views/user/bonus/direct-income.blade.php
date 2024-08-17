<main id="account">

    <div class="account container">

        <div class="content">

            <section id="referrals">

               

                <div class="recent-transactions referral-table">

                    <div class="title text-center">
                        <p>Incomes <span>list</span></p>
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
                                    <td class="empty">{{ $value->amt }}<span
                                            style="font-size: 12px">{{currency()}}</span></td>

                                    <td class="empty">{{ $value->comm }} <span
                                            style="font-size: 12px">{{currency()}}</span></td>

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

                        {{ $level_income->withQueryString()->links() }}
                    </div>
                </div>

            </section>
        </div>

    </div>

</main>
<style>
    .page-link {
       --bs-pagination-hover-color: #fafdf4;
    --bs-pagination-hover-bg: #2e2e2e;
    position: relative;
    display: block;
    padding: var(--bs-pagination-padding-y) var(--bs-pagination-padding-x);
    font-size: var(--bs-pagination-font-size);
    color: #fafdf4;
    text-decoration: none;
    background-color: #292929;
    border: var(--bs-pagination-border-width) solid #4c4545;
    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out
}

    </style>