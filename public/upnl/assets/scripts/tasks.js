// Hide the button and show the countdown timer
function hideButtonShowTimer(task_id) {

    // hide the button by task id
    $('#task_' + task_id + ' a').remove();

    // adding a block with a timer
    $('#task_' + task_id + ' p').after(`
        <div class="task-timer">
            <p id="task_timer" translate="no"></p>
        </div>
    `);

    // set the time to 30 seconds
    var timeLeft = 30;
    var elem = $('#task_' + task_id + ' .task-timer #task_timer');
    var timerId = setInterval(countdown, 1000);

    // start the timer
    function countdown() {

        // if time is up
        if (timeLeft == 0) {

            // clear the timer
            clearTimeout(timerId);

            // remove the block with the timer
            $('#task_' + task_id + ' .task-timer').remove();

            // add input with task ID after fkey
            $('#task_' + task_id + ' input').after(`
                <input type="hidden" name="task_id" value="`+ task_id + `">
            `);

            // show the button to claim the reward
            $('#task_' + task_id + ' p').after(`
                <button type="submit" class="submit_ def-btn yellow-btn"><i class="fa-solid fa-coins"></i>Claim</button>
            `);

        } else {
            elem.html(timeLeft);
            timeLeft--;
        }
    }
}


// input formatting + calculation (task cost)
$('body').on('input', '#quantity', function () {

    this.value = this.value.replace(/[^\d\.]/g, "");

    if (this.value.replace(/[^.]/g, "") == "..") {
        this.value = this.value.slice(0, -1);
    }

    this.onblur = function () {
        if (this.value != '') this.value = Number($('#quantity').val());
    }

    var quantity = $('#quantity').val();
    $('#price').html(Number(quantity * 0.03).toFixed(2));
});