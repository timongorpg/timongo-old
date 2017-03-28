import Echo from "laravel-echo"

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

window.Echo.private('App.User.' + Laravel.userId)
    .notification((notification) => {
        var type = notification.type;

        window.document.getElementById('notification-audio').play();

        switch (notification.alert) {
            case 'success':
                return toastr.success(notification.message);
                break;
            case 'danger':
                return toastr.error(notification.message);
                break;
            default:
                return toastr.info(notification.message);
        }
    });