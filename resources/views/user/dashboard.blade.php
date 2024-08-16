<main id="account">

    <div class="account container">

        <div class="content">

            <section id="dashboard">

                <div class="left-side">

                    <div class="title text-center">
                        <p translate="no">Mining <span>panel</span></p>
                    </div>

                    <div class="main-balance">
                        <div>
                            <img src="{{ asset('') }}upnl/assets/img/account/main_balance.png" alt="balance for withdrawal">
                            <p translate="no">0.00<span>TRX</span></p>
                        </div>
                        <div>
                            <a href="{{route('user.withdraw')}}" class="def-btn yellow-btn"><i
                                    class="fa-solid fa-minus"></i></a>
                        </div>
                    </div>

                    <div class="accumulated-income">
                        <img src="{{ asset('') }}upnl/assets/img/account/tron.png" alt="accumulated-income">
                        <span translate="no" class="profit" id="profit" data-prc="5.787037037037E-6" data-tm="1059"
                            data-sum="0">0.0061284</span> </div>

                    <div class="collect-or-increase">
                        <form action="/dashboard" method="post" class="income-collection">
                            <input type="hidden" name="fkey"
                                value="3053439a093b7d7d13de53d704827c122d41d7bc18d26f3771eb06d4110480d1154696d4">
                            <button type="submit" class="submit_ def-btn yellow-btn"><i
                                    class="fa-solid fa-coins"></i>Collect Income</button>
                        </form>

                        <div class="increase-speed">
                            <a href="{{route('user.invest')}}" class="def-btn yellow-btn"><i
                                    class="fa-solid fa-arrow-trend-up"></i>Increase a speed</a>
                        </div>
                    </div>

                </div>

                <div class="right-side">

                    <div class="title text-center">
                        <p>My <span>statistics</span></p>
                    </div>

                    <div class="statistics">
                        <p>
                            <span>PARTICIPANTS HAVE EARNED:</span>
                            <span translate="no"><span>{{ number_format((\App\Models\Income::sum('comm')), 2) }}
                            </span>{{currency()}}</span>
                        </p>
                        <p>
                            <span>TOTAL DIRECT:</span>
                            <span translate="no"><span>{{$user_direct}}
                                    </span></span>
                        </p>
                    </div>

                    <div class="statistics">
                        <p>
                            <span>TOTAL TEAM:</span>
                            <span
                                translate="no"><span>{{$total_team}}</span></span>
                        </p>
                        <p>
                            <span>TEAM BUILD INCOME:</span>
                            <span
                                translate="no"><span>{{ number_format(Auth::user()->level_bonus->sum('comm'), 2) }}</span>{{currency()}}</span>
                        </p>
                    </div>

                    <div class="statistics">
                        <p>
                            <span>GLOBAL INCOME </span>
                            <span
                                translate="no"><span>{{ number_format(Auth::user()->pool_bonus->sum('comm'), 2) }}</span>{{currency()}}</span>
                        </p>
                        <p>
                <span>TOTAl WITHDRAWAL:</span>
                <span translate="no">{{ number_format(Auth::user()->withdraw(), 2) }} <span>{{currency()}}</span></span>
            </p>
            <p>
                <span>Profit per month:</span>
                <span translate="no">15.00<span>TRX</span></span>
            </p>
                    </div>

                </div>

            </section>
        </div>

    </div>

</main>
