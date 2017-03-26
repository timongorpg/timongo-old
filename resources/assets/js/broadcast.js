import Echo from "laravel-echo"

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

window.Echo.private('App.User.' + Laravel.userId)
    .notification((notification) => {
        var type = notification.type;

        if (type == 'App\\Notifications\\ArenaBattleDefeat') {
            return toastr.error(notification.message);
        }

        if (type == 'App\\Notifications\\ArenaBattleVictory') {
            return toastr.success(notification.message);
        }
    });