<?php
 session_start();
 
 if(!isset(($_SESSION['logged'])))
 {
	 
	 header('Location: index.php');
	 exit();
	 
 }
 if($_SESSION['role']=='user'){
	  
	 header('Location: index.php');
	 exit();
	 
 }
 

if(count($_POST)>0)
{
   {
	$all_ok=true;
	$id=$_POST['idbranch'];
	require_once "connect.php";	
	mysqli_report(MYSQLI_REPORT_STRICT);
	
			
		//is email i database?
	
	 
if(isset($_SESSION['e_branch']))
{
    echo'<span style="color:red;">'.$_SESSION['e_branch'].'</span>';
    unset($_SESSION['e_branch']);

}
require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);	
$connect = new mysqli($host, $db_user, $db_password, $db_name);
$result = $connect->query("CALL beforeprocedure('".$id."');");
	echo "<table cellpadding=\"2\" border=2>";
	echo "<tr><td colspan='4'>Your actual appointment:<br/></td></tr>";
	echo "<td> ID </td><td> Doctor Name </td><td> User Name</td><td> Date </td>" ;
	while($row = $result->fetch_array())
  {
    echo "<tr>";
	echo "<td> ".$row['ID']."</td><td> ".$row['doctorname']."</td><td> ".$row['username']."</td><td> ".$row['time']."</td>" ;
	echo "<br />";
    echo "</tr>";
  }
    echo "</tr>";
    echo "</table>"; 
	$connect->close();

	
	}
	
}

 
 ?>

 
<!DOCTYPE HTML>
<html>
 <head>
 <meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome,firefox=1" />
<link href="arkusz.css" rel="stylesheet" type="text/css">
 <title>Hospital</title>
 </head>
 <body>

 <?php
 
if(isset($_SESSION['e_login']))
{
	echo'<div class="error">'.$_SESSION['e_login'].'</div>';
	unset($_SESSION['e_login']);
}
 echo '[<a href="logout.php">Logout!</a>]';
  echo '[<a href="hospitaladmin.php"> Back</a>]';
 echo "<p>Hello ".$_SESSION['user']."!";
 echo "<p>Name:".$_SESSION['name']." ";
 echo "Surname:".$_SESSION['surname'];
  echo "Role:".$_SESSION['role'];
 
 ?>
	<form method="post">
	<input type="submit" value="Raport" /><br/><br/>
	
	ID:
<?php


if(isset($_SESSION['e_branch']))
{
    echo'<span style="color:red;">'.$_SESSION['e_branch'].'</span>';
    unset($_SESSION['e_branch']);

}
require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);	
$connect = new mysqli($host, $db_user, $db_password, $db_name);
$result = $connect->query("SELECT namebranch FROM branch");
echo "<select name='idbranch'>";
	while($option = $result->fetch_row())
	{
		echo "<option value=".$option[0].">".$option[0]."</option>";
	}
	echo "<option value=ALL>ALL</option>";
	echo "</select>";
	
$connect->close();
	?>		
</form> 
 </body>
</html>

