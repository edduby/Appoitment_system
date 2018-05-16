<?php
session_start();
	 $_SESSION['temp']=$_POST['chosebranch'];
	 header('Location: appointmentadd.php');
	
	 if(!isset(($_SESSION['logged'])))
 {
	 header('Location: index.php');
	 exit();
 }
 ?>