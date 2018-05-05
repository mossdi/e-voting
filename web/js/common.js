/**
 * Load modal form
 *
 * @param url_request
 * @param title
 * @param id
 * @param dismiss
 */
function formLoad(url_request, title, id = null, dismiss = true) {
    let headerInner = '<span>' + title + '</span>';

    if (id != null) url_request += '?id=' + id;
    if (dismiss) headerInner += '<button type="button" class="close" data-dismiss="modal" onclick="formClean()" aria-hidden="true">×</button>'

    $('#modalForm').find('.modal-body').load(url_request);
    $('#modalForm').find('.modal-header').html(headerInner);
}

/**
 * @param url_request
 * @param title
 */
function criterionTopLoad(url_request, title) {
    let criterion = {
        efficiency:  'ЭФФЕКТИВНОСТЬ',
        newness:     'НОВИЗНА',
        originality: 'ОРИГИНАЛЬНОСТЬ',
        reliability: 'НАДЁЖНОСТЬ',
        acceptance:  'ОБЩЕСТВЕННОЕ ПРИЗНАНИЕ',
    };

    $('#modalForm').find('.modal-body').load(url_request);
    $('#modalForm').find('.modal-header').html('<span class="top-title">СПИСОК ЛИДЕРОВ ПО КРИТЕРИЮ - ' + criterion[title] + '</span>');
}

/**
 * Modal show
 */
function formShow() {
    $('#modalForm').modal('show');
}

/**
 * Modal hide
 */
function formHide() {
    $('#modalForm').modal('hide');
    formClean();
}

/**
 * Clean modal body
 */
function formClean() {
    $('#modalForm').find('.modal-body').html('');
}

/**
 * Title rewrite
 * @param title
 */
function titleRewrite(title = null) {
    $('#nowTitle').html(title)
}

/**
 * Count online
 * @param count
 */
function usersOnline(count = '0') {
    $('#countOnline').html(count)
}

/**
 * Statistic reload
 */
function statisticReload() {
    $.pjax.reload({
        container: '#statistic'
    });
}

/**
 * Voting timer
 */
let timerVoting = null;

function timerStart(votingStart) {
    timerVoting = window.setInterval(() => {
        let secInterval = Math.floor(Date.now()/1000) - votingStart;
        let time = {
            minutes: ('0' + Math.floor(secInterval / 60)).substr(-2),
            seconds: ('0' + Math.floor(secInterval % 60)).substr(-2),
        };
        $('#votingTimer').html(time.minutes + ':' + time.seconds);
    }, 1000);
    $('.timer').css('display', 'block')
}
function timerStop() {
    $('.timer').css('display', 'none');
    $('#votingTimer').html('');
    window.clearInterval(timerVoting);
}
