<?php

session_start();
include("config.php");
include("filtro.php");

	if(isset($_GET["id"]))
		$idseguito=filtra($_GET["id"]);
	
$data=date("Y-m-d");

$query="INSERT INTO seguaci(idutente,idseguace,datainizio) VALUES(".$idseguito.",".$_COOKIE["idutente"].",'".$data."')";
$result=$mysqli->query($query);

header('location: main.php?p=profilo_visit_page&id='.$idseguito.'&message=Iscritto!');
$_SESSION["letto"]=0;
$mysqli->close();
die();



?>