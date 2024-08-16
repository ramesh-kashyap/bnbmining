// Mining
$(document).ready(function () {
    setInterval(function () {
        $("#profit").each(function () {
            var totime = parseInt($(this).attr("data-tm")) + 1;
            var balance = totime * ($(this).attr("data-prc"));
            $(this).attr("data-tm", totime);
            var a = balance + parseFloat($(this).attr("data-sum"));
            $(this).html(a.toFixed(7));
        });
    }, 1000);
});

// actions performed at intervals
setInterval(() => {

    /* 1. show timer in bonus (if there is a spinner) */

    let loading = $('#bonus .loading-wave');

    if (loading.length) {

        loading.remove();

        $('#bonus .progressive-bonus').after(`
            <div class="timer">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <p id="timer" translate="no"></p>
            </div>
        `);

        let timeLeft = $('#time_left').val();

        $('#timer').countdown(timeLeft + ' UTC', function (event) {
            $(this).html(event.strftime('%H:%M:%S'));
        });

    }

    /* 2. show bonus form (if time expired) */

    let timer = $('#bonus #timer');

    if (timer.length) {
        if (timer.text() == '00:00:00') {
            $('#bonus .timer').remove();
            $.ajax({
                type: "POST",
                url: '/ajax/bonusform',
                success: function (data) {
                    $('#bonus .progressive-bonus').after(data);
                }
            });
        }
    }

    /* 3. render cloudflaer captcha */

    if ($('.cf-turnstile').length > 0) {
        if ($('.cf-turnstile').children().length == 0) {
            turnstile.render('.cf-turnstile', {
                sitekey: '0x4AAAAAAAeHuNH9fVfnn_qP',
            });
        }
    }

}, 1000);

// Copied text
function CopiedText() {
    var copyText = $("#copied_text");
    copyText.select();
    document.execCommand('copy');
    toastFire('success', 'Copied');
}

// pagination of the list of referrals
function ShowPageWithReferrals(page) {

    // remove the stroke from all elements
    $('#pagination p').css('border', 'none');

    // remove the active class from all elements
    $('#pagination p').removeClass('active');

    // add a stroke to the clicked element
    $('#page_' + page).addClass('active');

    // change the content to blinking dots in the table
    $('.referral-table td').html('<span class="animated-dots">â€¢â€¢â€¢â€¢â€¢</span>');

    // send ajax request
    $.ajax({
        type: "POST",
        url: '/ajax/referraltable',
        data: {
            "page": page
        },
        success: function (data) {
            $(".referral-table tbody").html(data);
        }
    });
}