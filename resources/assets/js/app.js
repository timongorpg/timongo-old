
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

require('./moment');
require('./blink-title');
require('./form-functions');

var db = require('./vuefire');

Vue.filter('date', function(value) {
    if (value) {
        return window.moment(new Date(value)).fromNow();
    }
});

Vue.component('example', require('./components/Example.vue'));
Vue.component('chat', require('./components/Chat.vue'));

const app = new Vue({
    el: '#app'
});
