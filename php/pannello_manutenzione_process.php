<?php
session_start();
include("config.php");

	if($_COOKIE["login"]==0 or $_SESSION["admin"]==0){
		header('location: index.php');
		$mysqli->close();
		die();
	}
	
if (isset($_GET['action']))
	 $action=$_GET['action'];
 
	if($action==0)  // Avvio manutenzione
	{
	if(empty($_POST["motivazione"])){
	header('location: main.php?p=pannello_generale');
	$mysqli->close();
	}
		$motivazione=$_POST["motivazione"];
		$timestamp = date("H:i d/m/Y");
		$query="INSERT INTO manutenzione(timestamp,motivazione,idutente,status) VALUES('".$timestamp."','".$motivazione."','".$_COOKIE['idutente']."',1)";
		$result=$mysqli->query($query);
		$mysqli->close();
		header('location: main.php?p=pannello_generale');
		die();
	}


	if($action==1) // Interruzione manutenzione
	{
		$query="UPDATE manutenzione SET status=0";
		$result=$mysqli->query($query);
		$mysqli->close();
		header('location: main.php?p=pannello_generale');
		die();
	}
?>