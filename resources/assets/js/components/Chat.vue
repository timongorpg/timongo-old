<template>
    <div id="chat" class="hidden-sm hidden-xs">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <div class="col-md-6 text-left">
                    Chat Global
                </div>
                <div class="col-md-6 text-right">
                    <button class="btn btn-primary toggleChatButton">Maximizar</button>
                </div>
            </div>

            <div class="panel-body messages">
                <div class="message-box" v-for="message in messages">
                    <span class="label label-info">{{ message.createdAt | date }}</span> <span class="sender">{{ message.sender }} </span><span class="label label-success">{{message.senderLv}}</span>
                    <div class="body">{{ message.message }}</div>
                </div>

            </div>
            <div class="row inputRow">
                <div class="col-md-9 col-lg-9" >
                    <input type="text" class="form-control message-input" v-model="message" placeholder="Envie mensagem pra todos">
                </div>
                <div class="col-md-3 col-lg-2">
                    <button class="btn btn-primary sendMessageButton" @click="sendMessage">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let vuefire = require('../vuefire');
    let db = vuefire.database;
    let firebase = require('firebase');
    let timestamp = firebase.database.ServerValue.TIMESTAMP;
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
            messages: db.ref('/chat').limitToLast(25)
        },
        methods: {
            sendMessage(){
                if (this.message.length == 0) { return; }

                console.log(db);
                this.$firebaseRefs.messages.push({
                    message: this.message,
                    sender: $('#profile-nickname').html(),
                    senderLv: $('#profile-level').html(),
                    createdAt: timestamp
                });

                this.message = '';

                Chat.focus();
            }
        }
    }
</script>
