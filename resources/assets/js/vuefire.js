var vuefire = require('vuefire');
var firebase = require('firebase');

Vue.use(vuefire);

var config = {
    apiKey: "AIzaSyDouFSHAKEbdGF5PvBrPjJ2U27LflbeojY",
    authDomain: "timongo-b53d2.firebaseapp.com",
    databaseURL: "https://timongo-b53d2.firebaseio.com",
    storageBucket: "timongo-b53d2.appspot.com",
    messagingSenderId: "101328686022"
};

firebase.initializeApp(config);

module.exports = {
  firebase: firebase,
  database: firebase.database()
};