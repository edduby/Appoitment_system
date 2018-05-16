<?php
session_start();

if((!isset($_POST['login']))||(!isset($_POST['password'])))
{
	header('Location: index.php');
	exit();	
}

require_once "connect.php"; //tutaj zatrzyma
//lub include to pojdzie dalej
//@ wyciszanie komunikatow mysql
$connect = @new mysqli($host,$db_user,$db_password,$db_name);
if($connect->connect_errno!=0)
{
	echo "Error:".$connect->connect_errno."Info".$connect->connect_error;
	
}
else
{

$login=$_POST['login'];
$password=$_POST['password'];
$login = htmlentities($login, ENT_QUOTES, "UFT-8");
$password = htmlentities($password, ENT_QUOTES, "UFT-8")

$sql= "SELECT* FROM user WHERE login='$login' AND password='$password'";

	if($result = @$connect->query(sprintf("SELECT* FROM user WHERE login='%s' AND password='%s'",
	mysqli_real_escape_string($connect,$login),
	mysqli_real_escape_string($connect,$password))))
	{
	$how_meny = $result->num_rows;
	
	if($how_meny>0)
	{
		$_SESSION['logged']=true;
		
		$table = $result->fetch_assoc();
		$_SESSION['id']=$table['id'];
		$_SESSION['user']=$table['login'];
		$_SESSION['name']=$table['name'];
		$_SESSION['surname']=$table['surname'];
		$_SESSION['role']=$table['role'];
		
		unset($_SESSION['error']);	
		$result->close();

if($_SESSION['role'] == 'admin'){
	header('Location: hospitaladmin.php');
} elseif($_SESSION['role'] == 'doctor'){
	header('Location: hospitaldoctor.php');
}else {
	header('Location: hospital.php');
}		
	}
	else
	{
		$_SESSION['error']='<span style="color:red">Wrong password or logoin!</span>';
		header('Location: index.php');
		
	}	
	}

$connect->close();
}
?>
