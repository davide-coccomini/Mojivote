<?php

include("config.php");
include("filtro.php");

if(isset($_GET["id"]))
	$idsondaggio=filtra($_GET["id"]);
    $query="SELECT idutente FROM sondaggi WHERE idsondaggio=".$idsondaggio;
	$result=$mysqli->query($query);
	$row=$result->fetch_assoc();
	$idutente=$row["idutente"];
	$newpunteggio=$_COOKIE["punteggio"]+5;
	setcookie("punteggio", $newpunteggio,time() + (10 * 365 * 24 * 60 * 60));
	
    $query = "UPDATE utenti SET punteggio=punteggio+5 WHERE idutente=".$idutente;
  	$result=$mysqli->query($query);	
	
   	$query = "UPDATE sondaggi SET eliminato=1 WHERE idsondaggio=".$idsondaggio;
  	$result=$mysqli->query($query);	
	
    
    header('location: main.php?p=profilo&message=Sondaggio cancellato!');
    $_SESSION["letto"]=0;
	$mysqli->close();
	die();
?>