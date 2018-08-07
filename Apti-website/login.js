function validateForm(){
  var uname = document.forms["myform"]["uname"].value;
  var pass = document.forms["myform"]["psw"].value;
  console.log(uname +" "+ pass);
  firebase.auth().signInWithEmailAndPassword(uname, pass).then(function() {
    window.location.href = "https://try1-d007.firebaseapp.com/content.html";
    // Sign-out successful.
  }).catch(function(error) {
    // Handle Errors here.
    var errorCode = error.code;
    var errorMessage = error.message;
    window.alert("Error : " + errorMessage);
    // ...
  });
}

function signo(){
  console.log("sign out");
  firebase.auth().signOut().then(function() {
    window.location.href = "https://try1-d007.firebaseapp.com/login.html";
    // Sign-out successful.
  }).catch(function(error) {
    window.alert("Error: "+error.message);
    // An error happened.
  });
}

function questionbank(){
  var bankname = document.getElementById("bankbtn1").innerHTML;
  var fireref = firebase.database().ref("https://try1-d007.firebaseio.com/" + bankname);
  
}

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
