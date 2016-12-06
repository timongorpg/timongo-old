<template>
    <div id="chat" class="hidden-sm hidden-xs">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <div class="col-md-6 text-left">
                    Global Chat
                </div>
                <div class="col-md-6 text-right">
                    <button class="btn btn-primary toggleChatButton">Maximize</button>
                </div>
            </div>

            <div class="panel-body messages">
                <div class="message-box" v-for="message in messages">
                    <span class="sender">{{ message.sender }}</span><span class="badge">{{message.senderLv}}</span>
                    <div class="body">{{ message.message }}</div>
                </div>

            </div>
            <div class="row inputRow">
                <div class="col-md-9 col-lg-10" >
                    <input type="text" class="form-control message-input" maxlength="50" v-model="message" placeholder="Send a message to everybody">
                </div>
                <div class="col-md-3 col-lg-2">
                    <button class="btn btn-primary sendMessageButton" @click="sendMessage">Send</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let db = require('../vuefire');
    var Chat = require('../chat-bindings');

    export default {
        mounted() {
            this.$firebaseRefs.messages.on('value', function(){
                Vue.nextTick(function () {
                    $('.messages')[0].scrollTop = $('.messages')[0].scrollHeight;
                })
            });
        },
        data(){
            return {
                message: ''
            };
        },
        firebase: {
            messages: db.ref('/messages').limitToLast(25)
        },
        methods: {
            sendMessage(){
                if (this.message.length == 0) { return; }

                this.$firebaseRefs.messages.push({
                    message: this.message,
                    sender: $('#profile-nickname').html(),
                    senderLv: $('#profile-level').html()
                });

                this.message = '';

                Chat.focus();
            }
        }
    }
</script>
