<?php
session_start();

if((isset($_SESSION['logged']))&&($_SESSION['logged']==true)&&($_SESSION['role']=='user'))
{
header('Location: hospital.php');
exit();

}
if((isset($_SESSION['logged']))&&($_SESSION['logged']==true)&&($_SESSION['role']=='admin'))
{
header('Location: hospitaladmin.php');
exit();

}

?>

<!DOCTYPE HTML>
<html>
 <head>
 <meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome,firefox=1" />
<link href="arkusz.css" rel="stylesheet" type="text/css">
 <title>Hospital system register</title>
 </head>
 <body>
 <center><h1>Wgraj zdjecie</h1></center>
 <div class="center">
<div id="panel">
<form action="login.php" method="post">

<label for="username">User name:</label>
 	<br /> <input type="text" name="login" id="username"/> <br />
	<label for="password">Password:</label>
  	<br /> <input type="password" name="password" id="password" /> <br /> 
 	
	 <div id="lower">
	 
	<br /> 
	<a href="register.php">Registration</a>
	<input type="submit" value="Login" />

	<br /> 
	</div>
	
</form> 

 <?php
if(isset($_SESSION['error'])) {	echo $_SESSION['error'];}
 ?>
 
 </div>
 </div>
 </body>
</html>

