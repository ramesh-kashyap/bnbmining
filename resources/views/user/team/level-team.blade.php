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
                        <p>My Level <span>Team</span></p>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" translate="no">ID</th>
                                    <th scope="col">User ID</th>
                                    {{-- <th scope="col">Mobile No</th> --}}
                                    <th scope="col">Level</th>
                                    <th scope="col">Joining Date</th>
                                    <th scope="col">Sponsor ID</th>
                                    <th scope="col">Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($direct_team) || is_object($direct_team)){ ?>

                                <?php $cnt = $direct_team->perPage() * ($direct_team->currentPage() - 1); ?>
                                @foreach ($direct_team as $value)

                                <tr>
                                    <td class="empty"><?= $cnt += 1 ?></td>

                                    <td class="empty">{{ $value->username }}</td>

                                    {{-- <td class="empty">{{ $value->phone }}</td> --}}

                                    <td class="empty">{{ $value->level - Auth::user()->level }}</td>
                                    <td class="empty">{{ date('D, d M Y', strtotime($value->created_at)) }} </td>
                                    <td class="empty">{{ $value->sponsor_detail->username }}</td>
                                    <td class="empty"> <span
                                            class="{{ $value->active_status == 'Active' ? 'green' : 'red' }}-tag">{{ $value->active_status }}</span>
                                    </td>


                                </tr>
                                @endforeach

                                <?php }?>

                            </tbody>
                        </table>
                        <br>

                        {{ $direct_team->withQueryString()->links() }}
                    </div>


            </section>
        </div>

    </div>

</main>
