<?php
session_start();
include("config.php");
include("filtro.php");

if(isset($_GET["id"]))
	$id=filtra($_GET["id"]);

if(isset($_GET["testo"]))
	$testo=filtra($_GET["testo"]);

$data=date("d/m/Y");
$orario=date("H:i");

$query="UPDATE sondaggi SET totalecommenti=totalecommenti+1 WHERE idsondaggio=".$id;
$result=$mysqli->query($query);

$query="INSERT INTO commentisondaggi (idutente,idsondaggio,data,orario,testo) VALUES(".$_COOKIE['idutente'].",".$id.",'".$data."','".$orario."','".$testo."')";
$result=$mysqli->query($query);

//salvataggio log
	$data = date("d-m-y"); 
	$orario = date("G:i:s");

	$query="SELECT titolo FROM sondaggi WHERE idsondaggio=".$id;
	$result=$mysqli->query($query);
	$row=$result->fetch_assoc();
	$titolo=$row["titolo"];
	$fp = fopen('log.txt', 'a');
	$testo="------\n\r[Commento]".$data." ".$orario.":".$_COOKIE["nome"]." ".$_COOKIE["cognome"]." ha scritto '".$testo."' al sondaggio <".$titolo.">\n";
	fwrite($fp,$testo);
	fclose($fp);
?>