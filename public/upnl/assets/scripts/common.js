// preloader
window.onload = function () {
    $('html').addClass('loaded_hiding');
    window.setTimeout(function () {
        $('html').addClass('loaded');
        $('html').removeClass('loaded_hiding');
    }, 500);
}

// show/hide header mobile menu
function showMobMenu() {

    let menu = $('.header .header-menu');
    let i = $('.header .name i');

    if (menu.is(":visible")) {
        menu.hide();
        i.removeClass('fa-xmark').addClass('fa-bars');
    }

    else {
        menu.show();
        i.removeClass('fa-bars').addClass('fa-xmark');
    }

}

// hide/show "faq" answer
function showFaqAnswer(questionNumber) {

    let answer = $('#question_' + questionNumber + ' .answer');
    let i = $('#question_' + questionNumber + ' .question i');

    if (answer.is(":visible")) {
        answer.hide();
        i.removeClass('fa-angles-up').addClass('fa-angles-down');
    }

    else {
        answer.show();
        i.removeClass('fa-angles-down').addClass('fa-angles-up');
    }

}