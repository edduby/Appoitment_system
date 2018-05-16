<?php
session_start();
if (isset($_POST['surname'])){
	$all_ok=true;
	$login=$_POST['login'];
	$password1=$_POST['password1'];
	$name=$_POST['name'];
	$surname=$_POST['surname'];
	
	//nick lenght
if(( strlen($login)<3||strlen($login)>20))
{
	$all_ok=false;
	$_SESSION['e_login']="Error - correct data";
}

if(ctype_alnum($login)==false)
{	
	$all_ok=false;
	$_SESSION['e_login']="Dont use special sign !@!#$%^&*( etc";
	
}	
	require_once "connect.php";
	
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	try 
	{
	$connect = new mysqli($host,$db_user,$db_password,$db_name);
	
	if($connect->connect_errno!=0)
{
	
	
	throw new Exception(mysqli_connect_errno());
}
else
{
	$result = $connect->query("SELECT id FROM user WHERE login='$login'");
	
	if(!$result) throw new Exception($connect->error);
	$how_many_mail = $result->num_rows;
	if($how_many_mail>0)
	{
		$all_ok=false;
	$_SESSION['e_login']="Nick allready in data base";
		
	}
	if($all_ok==true){
		
		//insert 
		echo "Good Register dupa"; 
		if($connect->query("INSERT INTO user VALUES(NULL,'$login','$password1','$name','$surname','user')"))
		{			
		$_SESSION['correctregister']=true;
		header('Location: index.php');			
		}
	else{
		
		throw new Exception($connect->error);
	}
		
	}
	$connect->close();
	
}	
	}
	catch(Exception $e)
	{
		echo "Good Register duiuiuiuiuuipa"; 
		$all_ok=false;
		echo '<span style="color:red;">Error server</span>';
		
	}	
}
?>
<!DOCTYPE HTML>
<html>
 <head>
 <meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome,firefox=1" />
<link href="arkusz.css" rel="stylesheet" type="text/css">
 <title>Registration panel</title>
 </head>
 <body>
 <?php
if(isset($_SESSION['e_login']))
{
	echo'<div class="error">'.$_SESSION['e_login'].'</div>';
	unset($_SESSION['e_login']);
}
?>
<form method="post">
Login:<br/> <input type="text" name="login"/> 
<br/>
Name:<br/> <input type="text" name="name"/> <br/>
Surname:<br/> <input type="text" name="surname"/> <br/>
Password:<br/> <input type="password" name="password1"/> <br/>
Confirm password:<br/> <input type="password" name="password2"/> <br/>
<br/>
<input type="submit" value="Register" /> 
</form>
 </body>
</html>

