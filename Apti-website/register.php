<?php
$emailError = "";
$passwordError = "";
$confirmError = "";
if(isset($_POST['signup']))
{

	$email=$_POST["email"];
	$pass1=$_POST['psw'];
	$pass2=$_POST['psw-repeat'];



	if (!empty($email))
	{
		if(!preg_match("/^([a-zA-Z0-9_\-\.]{4,30})@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/",$email))
			{
				$emailError = "Email Address is invalid.";
			}
			
		if (!empty($pass1))
		{
			if(!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,8}$/",$pass1))
			{
				$passwordError = "Password is invalid.";
			}

			if(!empty($pass2))
			{
				if($pass1!=$pass2)
				{
					$confirmError = "Password is not matching.";
				}
				else
				{
						$con=mysqli_connect("localhost","root","","trial1");
						if(!$con)
							{	
								die("could not connect".mysqli_error());
							}

						//mysql_select_db("trial1",$con);
						
						$execute = mysqli_query($con,"Select * from userdata");
						while($datarow = mysqli_fetch_assoc($execute))
						{
							if($datarow["email"]==$email)
							{
								$emailError = "Email Address is already taken.";
								break;
							}
							elseif($datarow["password1"]==$pass1)
							{
								$passwordError = "Password is already taken.";
							}
						}
				}
					
					if(empty($emailError) && empty($passwordError) && empty($confirmError))
					{
						$query="INSERT INTO userdata(email,password1,password2) VALUE('$email','$pass1','$pass2')";
						if(!mysqli_query($con,$query))
						{
							die(mysqli_error());
						}
						else
						{
							header( 'Location: register.html' );
						}
					}
				
			}
			else
			{
				$confirmError= "Password Confirmation is required.";
			}


		}
		else
		{
			$passwordError = "Password field should not be empty.";
		}


	}
	else
	{
		$emailError = "Email field should not be empty.";
	}

}
?>
<html>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing:screen-width}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 25%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
   // background-color: #4CAF50;
   background-color: black;
    color: white;
    padding: 14px 20px;
    margin: 2px 0;
    border: none;
    cursor: pointer;
    width: 50%;
    opacity: 0.9;
   text-align:center;
   align:center;
}

button:hover {
    opacity:1;
}

/* Extra styles for the cancel button 
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}
*/
/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 10%;
  //align:center;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>
<body>

<form style="border:1px solid #ccc" action="register.php" method="post">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>  <?php echo $emailError; ?><br><br>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>  <?php echo $passwordError; ?><br><br>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>  <?php echo $confirmError; ?><br><br>
    
    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>
    
    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix" >
      <!--<button type="button" class="cancelbtn" align="center">Cancel</button>-->
      <button type="submit"  class="signupbtn" name="signup" >Sign Up</button>
    </div>
  </div>
</form>

</body>
</html>
