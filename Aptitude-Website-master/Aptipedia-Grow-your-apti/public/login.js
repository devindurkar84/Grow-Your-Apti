function validateForm(){
  var uname = document.forms["myform"]["uname"].value;
  var pass = document.forms["myform"]["psw"].value;
  console.log(uname +" "+ pass);
  firebase.auth().signInWithEmailAndPassword(uname, pass).then(function() {
    window.location.href = "https://aptipediasite.firebaseapp.com/content.html";
    // Sign-out successful.
  }).catch(function(error) {
    // Handle Errors here.
    var errorCode = error.code;
    var errorMessage = error.message;
    window.alert("Error : " + errorMessage);
    // ...
  });
}

function cancelbutton(){
  window.location.href = "https://aptipediasite.firebaseapp.com/intro.html";
}

function forget(){
  var auth = firebase.auth();
  var emailAddress = "aptipedia2018@gmail.com";

  auth.sendPasswordResetEmail(emailAddress).then(function() {
    // Email sent.
  }).catch(function(error) {
    window.alert("Error :"+ error.message);
    // An error happened.
  });
}

/* functions defination over */


firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    // User is signed in.
    var displayName = user.displayName;
    var email = user.email;
    var emailVerified = user.emailVerified;
    var photoURL = user.photoURL;
    var isAnonymous = user.isAnonymous;
    var uid = user.uid;
    var providerData = user.providerData;
    console.log(displayName+" "+email+" "+emailVerified+" "+photoURL+" "+isAnonymous+" "+uid+" "+providerData);
    // ...
  } else {
    // User is signed out.
    // ...
  }
});
