<?php
$emailError = "";
$passwordError = "";
if(isset($_POST["submit"]))
{
	$email = $_POST["uname"];
	$pass1 = $_POST["psw"];

	$con=mysqli_connect("localhost","root","","trial1");
	if(!$con)
	{	
		die("could not connect".mysqli_error());
	}

	//mysql_select_db("trial1",$con);
						
	$execute = mysqli_query($con,"Select * from userdata");
	
	while($datarow = mysqli_fetch_assoc($execute))
	{
		if($datarow["email"]==$email && $datarow["password1"]==$pass1)
		{
			header('Location: page1.html');
		}
		else
		{
			$emailError = "Maybe Email Address is incorrect.";
			$passwordError = "Maybe password is incorrect.";
		}
		
	}
	
}
?>



<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
    width: 25%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 15%;
	align:center;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 12px 0 12px 0;
}

img.avatar {
    width: 20%;
    border-radius: 20%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 50%;
    }
}
</style>
</head>
<body>

<h2>Login Form</h2>

<form action="login.php" method="post">
  <div class="imgcontainer">
    <img src="img_avatar2.png" alt="Avatar" class="avatar">
  </div>

  <div class="container" align="center">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required> <?php echo $emailError; ?><br>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required> <?php echo $passwordError; ?><br>
        
    <button type="submit" name="submit">Login</button><br>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>

</body>
</html>
