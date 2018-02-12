<?php
SESSION_start();
include_once("config.php");
include_once("filtro.php");
if(! isset($_POST["email"]) or (! isset($_POST["password"]))){
	header('Location: '.'../index.php?message=Campi incompleti');
    $_SESSION["letto"]=0;
	$mysqli->close();
}


$email = filtra($_POST["email"]);
$pass = filtra($_POST["password"]);
$query="select password from utenti where email='".$email."'";

$result=$mysqli->query($query);
$row=$result->fetch_assoc();
$login=0;

if(sha1($pass)==$row["password"]){
	$login=1;
}else{
	header('location: ../index.php?message=Password errata');
    $_SESSION["letto"]=0;
	$mysqli->close();
    die();
}

$query="select * from utenti where email='".$email."'";
$result=$mysqli->query($query);
$row=$result->fetch_assoc();


setcookie("login", $login,time() + (10 * 365 * 24 * 60 * 60),'/');


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


//salvataggio log
	$data = date("d-m-y"); 
	$orario = date("G:i:s");
	$fp = fopen('log.txt', 'a');
	$testo="------\n\r[Login]".$data." ".$orario.":".$_COOKIE["nome"]." ".$_COOKIE["cognome"]." ha effettuato l'accesso";
	fwrite($fp,$testo);
	fclose($fp);

if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	header('Location: '.'main.php?p=sondaggio_visit&id='.$id);
	$_SESSION["letto"]=0;
	$mysqli->close();
	die();
}else{
	header('Location: '.'main.php?p=menucategorie');
	$_SESSION["letto"]=0;
	$mysqli->close();
	die();
}
