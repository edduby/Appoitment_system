
 <h1>Admin Panel</h1><br/>
 
 <?php
 session_start();
 
 if(!isset(($_SESSION['logged'])))
 {
	 echo "wchodzi zle3";
	 header('Location: index.php');
	 exit();
	 
 }
 if($_SESSION['role']=='user'){
	  
	 header('Location: index.php');
	 exit();	 
 }

if (!empty($_POST['doctorname']) && !empty($_POST['branch'])){
		echo "Good Register duiuiuiuiuuipa"; 
	$all_ok=true;
	$doctorname=$_POST['doctorname'];
	$newdoctor2=$_POST['newdoctor2'];
	$branch=$_POST['branch'];
	$radio=$_POST['option'];

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
			if($radio=='add'){
		//is email i database?
		$result = $connect->query("SELECT doctorname FROM doctor WHERE doctorname='$doctorname'");
		if(!$result) throw new Exception($connect->error);
		$how_many_mail = $result->num_rows;
			if($how_many_mail>0)
			{
			$all_ok=false;
			$_SESSION['e_login']="Doctor allready in data base";
			}
				if($all_ok==true){
				//insert 
				echo "Good Register dupa"; 
				if($connect->query("INSERT INTO doctor VALUES('$doctorname','$branch')"))
				{			
				$_SESSION['correctregister']=true;
				header('Location: hospitaladmin.php');			
				}
				else{
		
				throw new Exception($connect->error);
				}			
	}
	$connect->close();
	
			}
			if($radio=='delete'){
				
				if($all_ok==true){
				//insert 
				echo "Good Register dupa"; 
				if($connect->query("DELETE FROM doctor WHERE doctorname='$doctorname'"))
				{			
				$_SESSION['correctregister']=true;
				header('Location: hospitaladmin.php');			
				}
				else{
		
				throw new Exception($connect->error);
				}			
				}
				$connect->close();
				
			}
			if($radio=='update'){
				
				if($all_ok==true){
				//insert 
				echo "Good Register dupa"; 
				if($connect->query("UPDATE doctor SET branch='$branch', doctorname='$newdoctor2' WHERE doctorname='$doctorname'"))
				{			
				$_SESSION['correctregister']=true;
				header('Location: hospitaladmin.php');			
				}
				else{
		
				throw new Exception($connect->error);
				}			
				
				
				}
				$connect->close();
			}
			
}

	}
	catch(Exception $e)
	{
		echo "Good Register duiuiuiuiuuipa"; 
		$all_ok=false;
		echo '<span style="color:red;">Error server</span>';		
	}
	
}


if (!empty($_POST['newbranch'])){
		echo "wejscie do newbrach"; 
	$all_ok=true;
	
	$newbranch=$_POST['newbranch'];
	$newbranch2=$_POST['newbranch2'];
	$radio=$_POST['branchoption'];

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
			if($radio=='add'){
		//is email i database?
		echo "addmd?"; 
		$result = $connect->query("SELECT namebranch FROM branch WHERE namebranch='$newbranch'");
		if(!$result) throw new Exception($connect->error);
		$how_many_mail = $result->num_rows;
			if($how_many_mail>0)
			{
			$all_ok=false;
			$_SESSION['e_login']="Branch allready in data base";
			}
				if($all_ok==true){
				//insert 
				echo "add"; 
				if($connect->query("INSERT INTO branch VALUES('$newbranch')"))
				{			
				$_SESSION['correctregister']=true;
				header('Location: hospitaladmin.php');			
				}
				else{
		
				throw new Exception($connect->error);
				}			
	}
	$connect->close();
	
			}
			if($radio=='delete'){
				
				if($all_ok==true){
				//insert 
				echo "delete"; 
				if($connect->query("DELETE FROM branch WHERE namebranch='$newbranch'"))
				{			
				$_SESSION['correctregister']=true;
				header('Location: hospitaladmin.php');			
				}
				else{
		
				throw new Exception($connect->error);
				}			
				if($connect->query("DELETE FROM doctor WHERE branch='0'"))
				{			
				$_SESSION['correctregister']=true;
				header('Location: hospitaladmin.php');			
				}
				else{
		
				throw new Exception($connect->error);
				}					}
				$connect->close();
			}
			if($radio=='update'){
				
				if($all_ok==true){
				//insert 
				echo "update"; 
				if($connect->query("UPDATE `branch` SET namebranch='$newbranch2' WHERE namebranch='$newbranch'"))
				{			
				$_SESSION['correctregister']=true;
				header('Location: hospitaladmin.php');			
				}
				else{
		
				throw new Exception($connect->error);
				}							
				}
				$connect->close();
			}
			
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
 <title>Admin Panel</title>
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
Update doctor data:<br/>
Name Doxtor:<br/> <input type="text" name="doctorname"/> <br/>

Name Branch:
<?php
if(isset($_SESSION['e_branch']))
{
    echo'<span style="color:red;">'.$_SESSION['e_branch'].'</span>';
    unset($_SESSION['e_branch']);

}
require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);	
$connect = new mysqli($host, $db_user, $db_password, $db_name);
$result = $connect->query("SELECT * FROM branch");
echo "<select name='branch'>";
	while($option = $result->fetch_row())
	{
		echo "<option value=".$option[0].">".$option[0]."</option>";
	}
	echo "</select>";
$connect->close();
	?>
<br/>


<input type="radio" name="option" value="add" checked="checked"  /> Add Doctor
<input type="radio" name="option" value="delete" /> Delete Doctor
  <input type="radio" name="option" value="update" /> Update Doctor:(write new name)  <input type="text" name="newdoctor2"/> <br/>
<br/>
<input type="submit" value="Confirm" /> <br><br><br>

Update branch data:<br/>
Name Branch:<br/> <input type="text" name="newbranch"/> <br/>

<input type="radio" name="branchoption" value="add" checked="checked"  /> Add Branch
<input type="radio" name="branchoption" value="delete" /> Delete Branch
  <input type="radio" name="branchoption" value="update" /> Update Branch: (write new name)  <input type="text" name="newbranch2"/> <br/>
  
  
  

<br/>
<input type="submit" value="Confirm" /> 
<br/><br/><br/>


<?php
if(isset($_SESSION['e_branch']))
{
    echo'<span style="color:red;">'.$_SESSION['e_branch'].'</span>';
    unset($_SESSION['e_branch']);

}
require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);	
$connect = new mysqli($host, $db_user, $db_password, $db_name);
$result = $connect->query("SELECT * FROM branch");
	echo "<table cellpadding=\"2\" border=1>";
	echo "<td> Branches: </td>" ;
	while($row = $result->fetch_array())
  {
    echo "<tr>";
	echo "<td> ".$row['namebranch']."</td>" ;
	echo "<br />";
    echo "</tr>";
  }
    echo "</tr>";
    echo "</table>"; 
	$connect->close();
?>



<?php
if(isset($_SESSION['e_branch']))
{
    echo'<span style="color:red;">'.$_SESSION['e_branch'].'</span>';
    unset($_SESSION['e_branch']);

}
require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);	
$connect = new mysqli($host, $db_user, $db_password, $db_name);
$result = $connect->query("SELECT * FROM doctor");

	echo "<table id='td'>";
	echo "<thead>";
		echo "<tr><td colspan='2'>Doctors info:<br/></td></tr>";
	echo "<td> Name: </td><td> Branch:</td>" ;
	while($row = $result->fetch_array())
  {
    echo "<tr>";
	echo "<td> ".$row['doctorname']."</td><td> ".$row['branch']."</td>" ;
	echo "<br />";
    echo "</tr>";
  }
    echo "</tr>";
	echo "</thead>";
    echo "</table>"; 
	$connect->close();
?>

<br/><br/><br/>

 <?php
 echo '[<a href="reportafter.php">Report after</a>]';
 echo '[<a href="reportbefore.php">Report before</a>]';
 echo '[<a href="logout.php">Logout!</a>]';
 echo "<p>Hello ".$_SESSION['user']."! ";
 echo "<p>Name: ".$_SESSION['name']."  ";
 echo "Surname: ".$_SESSION['surname'];
  echo "Role: ".$_SESSION['role'];
 
 ?>
</form>
 </body>
</html>
