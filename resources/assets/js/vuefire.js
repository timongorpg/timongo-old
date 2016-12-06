var vuefire = require('vuefire')
var firebase = require('firebase')

Vue.use(vuefire);

var config = {
    apiKey: "AIzaSyDIWq_lvP5MnIAj4Liv0ZEvAKZ3-ZPkslU",
    authDomain: "timongo-31cc4.firebaseapp.com",
    databaseURL: "https://timongo-31cc4.firebaseio.com",
    storageBucket: "timongo-31cc4.appspot.com",
    messagingSenderId: "44166142369"
};

firebase.initializeApp(config);

firebase.auth().signInAnonymously().catch(function(error) {
  // Handle Errors here.
  var errorCode = error.code;
  var errorMessage = error.message;
  // ...
});

firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    // User is signed in.
    var isAnonymous = user.isAnonymous;
    var uid = user.uid;
    // ...
  } else {
    // User is signed out.
    // ...
  }
  // ...
});

module.exports = firebase.database();