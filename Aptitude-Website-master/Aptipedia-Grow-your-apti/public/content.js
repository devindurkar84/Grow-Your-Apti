function signo(){
  console.log("sign out");
  firebase.auth().signOut().then(function() {
    window.alert("successfully logged out!!!!");
    window.location.href = "https://aptipediasite.firebaseapp.com/intro.html";
    // Sign-out successful.
  }).catch(function(error) {
    window.alert("Error: "+error.message);
    // An error happened.
  });
  //window.alert("successfully logged out!!!!");
}

var bankno;
var timer;
function questionbank(w){
  console.log("hey");
  var i;
  bankno = "Bank" + w;
  for(i=1;i<=10;i++){
    var text = "q" + i;
    var sb = "startbtn" + i;
    document.getElementById(sb).style.display = "none";
    document.getElementById(text).style.display = "block";
    document.getElementById('sub1').style.display="block";
    document.getElementById('carouselExampleControls').style.display = "none";
  }
  var fireref = firebase.database().ref(bankno);
  i = 0;

    fireref.once("value",function(snap){
      snap.forEach(function(childsnap) {
        var childKey = childsnap.key;
        console.log(childKey);
        var qt = document.getElementById(childKey);
        var t_head = qt.tHead;
        var t_body = document.getElementsByTagName("tbody")[i];
        i++;
        t_head.children[0].children[0].innerHTML = snap.child(childKey+"/Question").val();
        t_body.rows[0].cells[1].innerHTML = snap.child(childKey+"/Options/0").val();
        t_body.rows[1].cells[1].innerHTML = snap.child(childKey+"/Options/1").val();
        t_body.rows[2].cells[1].innerHTML = snap.child(childKey+"/Options/2").val();
        t_body.rows[3].cells[1].innerHTML = snap.child(childKey+"/Options/3").val();
      });
    });

    SetTimer( 2*60 + 30);
}

function SetTimer(number_of_seconds){
  var mod_sec = number_of_seconds % 60;
  var mod_min = Math.floor(number_of_seconds / 60);
  var mod_hour = Math.floor(number_of_seconds / (60*60));

  if(number_of_seconds <0){
    alert("Time up");
    clearTimeout(timer);
    document.getElementById('sub1').click();
  }
  else {
    document.getElementById("timer").innerHTML = "Time Remaining - "+ mod_hour.toString().padStart(2,"0") +":"+ mod_min.toString().padStart(2,"0") +":"+ mod_sec.toString().padStart(2,"0");

    number_of_seconds--;

    timer = setTimeout("SetTimer("+number_of_seconds+")",1000);
  }
}

document.getElementById('sub1').onclick = function answer(){

    var bankn = bankno;
    var i =1;
    var fireref = firebase.database().ref(bankn);
    fireref.once("value",function(snap){
      snap.forEach(function(childsnap) {
        var childKey = childsnap.key;
        document.getElementById("txt"+i).style.display="block";
        document.getElementById("txt"+i).readOnly = true;
        document.getElementById("txt"+i).value=snap.child(childKey+"/Answer").val();
        i++;
      });
    });
    clearTimeout(timer);
};

/* functions defination over */

for(i=1;i<=10;i++){
  var text = "q" + i;
  document.getElementById(text).style.display = "none";
}

firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    // User is signed in.
    //var displayName = user.displayName;
    var email = user.email;
    //var emailVerified = user.emailVerified;
   // var photoURL = user.photoURL;
    //var isAnonymous = user.isAnonymous;
    //var uid = user.uid;
    //var providerData = user.providerData;
    console.log(email);
    // ...
  } else {
    window.alert("Error :"+ error.message);
    // User is signed out.
    // ...
  }
});
