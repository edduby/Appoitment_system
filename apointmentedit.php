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
		echo "Good Register duiuiuiuiuuipa"; 
	$all_ok=true;
	$id=$_POST['id'];
	$doctorname=$_POST['doctorname'];
	$year=$_POST['year'];
	$day=$_POST['day'];
	$mounth=$_POST['mounth'];
	$hh=$_POST['hh'];
	$mm=$_POST['mm'];
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
		$result = $connect->query("SELECT ID FROM appointment WHERE (doctorname='".$doctorname."' AND time='".$year."-".$mounth."-".$day." ".$hh.":".$mm.":00') OR (username='".$_SESSION['user']."' AND time='".$year."-".$mounth."-".$day." ".$hh.":".$mm.":00')");
		if(!$result) throw new Exception($connect->error);
		$how_many_mail = $result->num_rows;
			if($how_many_mail>0)
			{
			$all_ok=false;
			$_SESSION['e_login']="Term is unallowed operation";
			}
				if($all_ok==true){
				//insert 
				echo "Good Register dupa"; 
				if($connect->query("UPDATE appointment SET time='".$year."-".$mounth."-".$day." ".$hh.":".$mm.":00' WHERE ID='".$id."'"))
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



	<input type="submit" value="Change " /><br/><br/>
	Change from this data:<br/>	
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
	
	<br/> Doctor name:<input type="text" name="doctorname"/> <br />
	
<br/><br/>Change to this data:<br/>
new day
<select name='day'>
<option value="01">01</option>
	<option value="02">02</option>
	<option value="03">03</option>
	<option value="04">04</option>
	<option value="05">05</option>
	<option value="06">06</option>
	<option value="07">07</option>
	<option value="08">08</option>
	<option value="09">09</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="03">13</option>
	<option value="04">14</option>
	<option value="05">15</option>
	<option value="06">16</option>
	<option value="07">17</option>
	<option value="08">18</option>
	<option value="09">19</option>
	<option value="10">20</option>
	<option value="11">21</option>
	<option value="12">22</option>
	</select>
	new mounth
<select name='mounth'>
	<option value="01">01</option>
	<option value="02">02</option>
	<option value="03">03</option>
	<option value="04">04</option>
	<option value="05">05</option>
	<option value="06">06</option>
	<option value="07">07</option>
	<option value="08">08</option>
	<option value="09">09</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	</select>
	new year
	<select name='year'>
	<option value="2016">2016</option>
	<option value="2017">2017</option>
	</select>
	new hh
	<select name='hh'>
	<option value="08">08</option>
	<option value="09">09</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
		<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	</select>
	new mm
	<select name='mm'>
<option value="00">00</option>
	<option value="05">05</option>
	<option value="10">10</option>
	<option value="15">15</option>
	<option value="20">20</option>
	<option value="25">25</option>
	<option value="30">30</option>
	<option value="35">35</option>
	<option value="40">40</option>
	<option value="45">45</option>
	<option value="50">50</option>
	<option value="55">55</option>
	</select>
		
	
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

 </body>
</html>
