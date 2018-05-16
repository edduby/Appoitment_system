<?php
 session_start();
 
 if(!isset(($_SESSION['logged'])))
 {
	
	 header('Location: index.php');
	 exit();
	 
 }

 

if(count($_POST)>0)
{
   {
	
	$all_ok=true;
	$id=$_POST['id'];
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
			
		//is email i database?
		$result = $connect->query("SELECT time FROM appointment WHERE (ID='$id') AND (username='".$_SESSION['user']."')");
		echo "raz dwa trzy";
		if(!$result) throw new Exception($connect->error);
		$how_many_mail = $result->num_rows;
			if($how_many_mail==0)
			{
			$all_ok=false;
			$_SESSION['e_login']="You cant delete this element";
			}
				if($all_ok==true){
			
				if($connect->query("DELETE FROM appointment WHERE ID='$id'"))
				{			
				$_SESSION['correctregister']=true;
				header('Location: hospital.php');			
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
		
		$all_ok=false;
		echo '<span style="color:red;">Error server</span>';
		
	}
	
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
  echo '[<a href="hospital.php"> Back</a>]';
 echo "<p>Hello ".$_SESSION['user']."!";
 echo "<p>Name:".$_SESSION['name']." ";
 echo "Surname:".$_SESSION['surname'];
  echo "Role:".$_SESSION['role'];
 
 ?>
<form method="post">

	<input type="submit" value="Delete" /><br/><br/>	
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
$result = $connect->query("SELECT ID FROM appointment WHERE username='".$_SESSION['user']."'");
echo "<select name='id'>";
	while($option = $result->fetch_row())
	{
		echo "<option value=".$option[0].">".$option[0]."</option>";
	}
	echo "</select>";
	
$connect->close();
	?>
	
	
	
</form> 


 Your actual appointmen:
  
 <?php
if(isset($_SESSION['e_branch']))
{
    echo'<span style="color:red;">'.$_SESSION['e_branch'].'</span>';
    unset($_SESSION['e_branch']);

}
require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);	
$connect = new mysqli($host, $db_user, $db_password, $db_name);
$result = $connect->query("SELECT * FROM appointment WHERE username='".$_SESSION['name']."'");
	echo "<table cellpadding=\"2\" border=1>";
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
?>

 </body>
</html>
