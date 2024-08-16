// SweetAlert Toast
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    showCloseButton: true,
    timer: 3000,
    timerProgressBar: true,
    background: '#262626',
    color: '#e6e6e6',
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

// function to show SweetAlert Toast
function toastFire(t_icon, t_title) {
    Toast.fire({ icon: t_icon, title: t_title });
}

// ajax | while the last submit has a child, set a class for it
function addSubmit(event) {

    // Fix page reload when clicking on icon
    if (event.target.tagName == 'I') {
        $('form button i').addClass('submit_');
    }

    // Fix page reload from translator
    if (event.target.tagName == 'FONT') {
        $('form button font').addClass('submit_');
    }

    // Set the submit class for elements that should respond to clicks in the form
    while ($('.submit_:last').children().length > 0) {
        $('.submit_').children().addClass('submit_');
    }

}

// Ajax requests
$(document).ready(function () {
    $(document).on('click', 'form', function (event) {
        addSubmit(event);
        if (event.target.classList.contains("submit_")) {
            event.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (result) {
                    if (result) {
                        var json = jQuery.parseJSON(result);

                        if (json.redirect) {
                            if (json.icon && json.title) toastFire(json.icon, json.title);
                            setTimeout((function () { window.location.replace(json.redirect) }), 1000);
                        }

                        else if (!json.icon && !json.title) {
                            update(json[0], json);
                        }

                        else {
                            toastFire(json.icon, json.title);
                            // captcha render
                            renderCaptcha();
                        }

                    }
                }
            });
        }
    });
});

// render cloudflaer captcha after clicking the button
function renderCaptcha() {
    if ($('.cf-turnstile').length > 0) {
        turnstile.render('.cf-turnstile', {
            sitekey: '0x4AAAAAAAeHuNH9fVfnn_qP',
        });
    }
}

// launch action on the page
function update(page, json) {

    // dashboard page
    if (page == 'dashboard') {

        toastFire(json[1], json[2]);

        $("#account .content").load("/" + page + " #account .content");

    }

    // withdraw page
    if (page == 'withdraw') {

        toastFire(json[1], json[2]);

        $("#account .content").load("/" + page + " #account .content");

    }

    // bonus page
    if (page == 'bonus') {

        toastFire(json[1], json[2]);

        $("#account .content").load("/" + page + " #account .content");

        // remove the form and show the timer div.timer
        $('#bonus form').remove();

        // add div.timer
        $('#bonus .progressive-bonus').after(`
            <div class="timer">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <p id="timer" translate="no"></p>
            </div>
        `);

        // showing a timer on the page
        $('#timer').countdown(json[3] + ' UTC', function (event) {
            $(this).html(event.strftime('%H:%M:%S'));
        });

    }

    // tasks/list page
    if (page == 'tasks/list') {

        toastFire(json[1], json[2]);

        // Changing the main balance value
        $('#task_menu .main-balance p').html(json[3]);

        // Removing the "claim" button
        $('#task_' + json[4] + ' button').remove();

        // We put a picture instead of a button
        $('#task_' + json[4] + ' p').after(`
            <img src="/public/img/tasks/success.png" alt="Success">
        `);

    }

    // tasks/own page
    if (page == 'tasks/own') {

        toastFire(json[1], json[2]);

        $("#tasks .content").load("/" + page + " #tasks .content");

    }

    // admin/blacklist page
    if (page == 'admin/blacklist') {

        toastFire(json[1], json[2]);

        $("#admin .content").load("/" + page + " #admin .content");

    }

}

