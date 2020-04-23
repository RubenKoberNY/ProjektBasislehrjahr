$(document).ready(function () {
    $('.modal').modal();
});

function cookieNotification() {
    var cookieNotificationEl = jQuery('.cookieNotification');
    if (cookieNotificationEl.length > 0) {
        var hasSeenCookieNotification = localStorage.getItem('hasSeenCookieNotification');
        if (hasSeenCookieNotification === null) {
            cookieNotificationEl.show();
            localStorage.setItem('hasSeenCookieNotification', '1');
        }
    }
}

jQuery(document).ready(cookieNotification);