<? php


$name=$_POST['name'];



$con=mysql_connect("localhost","root","")
if(!con)
	{	
		die("could not connect".mysql_error());
	}

	mysql_select_db("apti_register",$con);


	$query="insert into users(id,username,email,password)values('$')