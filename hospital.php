 <?php
 session_start();

 
 
 if((null!=($_SESSION['logged'])))
 {
	 header('Location: index.php');
	 exit();
	 
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
 echo '[<a href="logout.php">Logout!</a>]';
 echo "<p>Hello ".$_SESSION['user']."! ";
 echo "<p>   Name: ".$_SESSION['name']." ";
 echo "     Surname: ".$_SESSION['surname'];
  echo "    Role: ".$_SESSION['role'];
 
 ?>

 <br/> 
 <a href="apointmentedit.php">Edit appointment</a><br/>
  <a href="apointmentdelete.php">Delete appointment</a><br/><br/>
  =======================================================
 
 <?php
if(isset($_SESSION['e_branch']))
{
    echo'<span style="color:red;">'.$_SESSION['e_branch'].'</span>';
    unset($_SESSION['e_branch']);

}
if(isset($_SESSION['correctregister']))
{
	echo "Success!"; 
	unset($_SESSION['correctregister']);
}

require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);	
$connect = new mysqli($host, $db_user, $db_password, $db_name);
$result = $connect->query("SELECT * FROM appointment WHERE username='".$_SESSION['user']."'");
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
?>

	<form action="tmp.php" method="post">

<br/>
If you want add appointment you must first chose branch and confirm useing "Add":<br/><br/>
Branch:
<?php
if(isset($_SESSION['e_branch']))
{
    echo'<span style="color:red;">'.$_SESSION['e_branch'].'</span>';
    unset($_SESSION['e_branch']);

}
require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);	
$connect = new mysqli($host, $db_user, $db_password, $db_name);
$result = $connect->query("SELECT DISTINCT branch FROM doctor");
echo "<select name='chosebranch'>";
	while($option = $result->fetch_row())
	{
		echo "<option value=".$option[0].">".$option[0]."</option>";
	}
	echo "</select>";
$connect->close();
	?><br/>
		<input type="submit" value="Add " />
</form> 
 


 </body>
</html>

