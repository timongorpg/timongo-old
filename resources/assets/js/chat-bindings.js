var Chat = {
    minimize: function(){
        console.log('minimize called');
        $('#chat').css('bottom', $('#chat .panel-heading').outerHeight() - $('#chat').height());
        $('.toggleChatButton').html('Maximize');
    },

    maximize: function(){
        console.log('maximize called');
        $('#chat').css('bottom', 0);
        $('.toggleChatButton').html('Minimize');

        this.focus();
    },

    toggle: function(isMaximized){
        window.localStorage.setItem('Maximized', isMaximized == 1 ? 0 : 1);

        if (isMaximized == 1) {
            this.minimize();
            return;
        }

        this.maximize();
    },

    focus: function(){
        $('#chat .message-input').focus();
    }
};

$(function(){
    var isMaximized = window.localStorage.getItem('Maximized') ? window.localStorage.getItem('Maximized') : 1;

    isMaximized == 1 ? Chat.maximize() : Chat.minimize();

    $('#chat .toggleChatButton').click(function(){
        var isMaximized = window.localStorage.getItem('Maximized');

        Chat.toggle(isMaximized);
    });

    $('#chat').on('keydown', '.message-input', function(event){
        if (event.keyCode == 13) {
            $('#chat .sendMessageButton').click();
        }

        console.log('ae');
    });

    Chat.focus();
});

module.exports = Chat;