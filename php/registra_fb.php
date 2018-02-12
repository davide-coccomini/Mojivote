<?php

if((!isset($_COOKIE["nome_fb"])) || (!isset($_COOKIE["cognome_fb"])) || (!isset($_COOKIE["id_fb"])) || (!isset($_COOKIE["d_nascita_fb"])) || (!isset($_COOKIE["sesso_fb"])) || (!isset($_COOKIE["email_fb"])))
die();

include("config.php");
include("filtro.php");

$nome_fb = filtra($_COOKIE["nome_fb"]);
$cognome_fb = filtra($_COOKIE["cognome_fb"]);
$id_fb = filtra($_COOKIE["id_fb"]);
$d_nascita_fb = filtra($_COOKIE["d_nascita_fb"]);
$sesso_fb = filtra($_COOKIE["sesso_fb"]);
$email_fb = filtra($_COOKIE["email_fb"]);

if($sesso_fb == 0)
	$img = 'silm.png';
else
	$img = 'silf.png';

$query = "insert into utenti (nome,cognome,email,sesso,datanascita,dataiscrizione,fb_id,password,imgprof) 
		VALUES ('".$nome_fb."','".$cognome_fb."','".$email_fb."','".$sesso_fb."','".$d_nascita_fb."',CURRENT_DATE,'".$id_fb."',NULL,'".$img."')";

$mysqli->query($query);

$query="select * from utenti where email='".$email_fb."'";
$result=$mysqli->query($query);
$row=$result->fetch_assoc();

setcookie("login",1,time() + (10 * 365 * 24 * 60 * 60),'/');

$_SESSION["letto"]=0;

$tutorial=$row["tutored"];
setcookie("tutorial", $tutorial);

$_SESSION["admin"]=$row["admin"];


$idutente=$row["idutente"];
setcookie("idutente", $idutente,time() + (10 * 365 * 24 * 60 * 60));

$psw=$row["password"];
setcookie("psw", $psw,time() + (10 * 365 * 24 * 60 * 60));

$nome=$row["nome"];
setcookie("nome", $nome,time() + (10 * 365 * 24 * 60 * 60));

$cognome=$row["cognome"];
setcookie("cognome", $cognome,time() + (10 * 365 * 24 * 60 * 60));


$email=$row["email"];
setcookie("email", $email,time() + (10 * 365 * 24 * 60 * 60));

$sesso=$row["sesso"];
setcookie("sesso", $sesso,time() + (10 * 365 * 24 * 60 * 60));

$_SESSION["loading"]=0;

$imgprof=$row["imgprof"];
$contatore=$row["contatoreimg"];
$exp=explode(".", $imgprof);
$extension = end($exp);
$nomefile = basename($imgprof,".".$extension);
$imgprof=$nomefile.$contatore.".".$extension;
setcookie("imgprof", $imgprof,time() + (10 * 365 * 24 * 60 * 60));

$datanascita=$row["datanascita"];
setcookie("datanascita", $datanascita,time() + (10 * 365 * 24 * 60 * 60));

$dataiscrizione=$row["dataiscrizione"];
setcookie("dataiscrizione", $dataiscrizione,time() + (10 * 365 * 24 * 60 * 60));

$votieffettuati=$row["votieffettuati"];
setcookie("votieffettuati", $votieffettuati,time() + (10 * 365 * 24 * 60 * 60));

$sondaggicreati=$row["sondaggicreati"];
setcookie("sondaggicreati", $sondaggicreati,time() + (10 * 365 * 24 * 60 * 60));

$punteggio=$row["punteggio"];
setcookie("punteggio", $punteggio,time() + (10 * 365 * 24 * 60 * 60));

$mysqli->close();
$_SESSION["letto"]=0;

?>
