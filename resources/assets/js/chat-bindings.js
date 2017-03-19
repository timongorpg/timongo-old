var Chat = {
    minimize: function(){
        $('#chat').css('bottom', $('#chat .panel-heading').outerHeight() - $('#chat').height());
        $('.toggleChatButton').html('Maximizar');
    },

    maximize: function(){
        $('#chat').css('bottom', 0);
        $('.toggleChatButton').html('Minimizar');

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
    });

    Chat.focus();
});

module.exports = Chat;