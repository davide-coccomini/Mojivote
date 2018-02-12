<?php 

include("config.php");
include("filtro.php");
session_start();

$allowedExts = array("gif", "jpeg", "jpg", "png");
	$exp=explode(".",$_FILES["file"]["name"]);
	$extension = end($exp);
	if (($_FILES["file"]["size"] > 5242880)||(!in_array($extension, $allowedExts))){
		header('location: main.php?p=profilo&message=Il file non è un immagine');
        $_SESSION["letto"]=0;
		$mysqli->close();
		die();
	}
	
	$nomefile = basename($_FILES['file']['name'],".".$extension);
	$find =  array(' ','�','à','ò','ù','ì','^','=','ç','°','é','è','#','§','[',']','?','$','£','!','|','/');
    $nomefile =  str_replace ($find, 'x', $nomefile);
	
	$query="SELECT COUNT(*) as numero FROM utenti WHERE imgprof='".$nomefile.".".$extension."'";
	$result=$mysqli->query($query);
	$row=$result->fetch_assoc();
	$numero=$row["numero"];
	$query="UPDATE utenti SET imgprof='".$nomefile.".".$extension."' WHERE idutente=".$_COOKIE['idutente'];
	$result=$mysqli->query($query);

	$query="UPDATE utenti SET contatoreimg=".$numero."WHERE idutente=".$_COOKIE['idutente'];
	$result=$mysqli->query($query);

	move_uploaded_file($_FILES['file']['tmp_name'] , "../img/imgprof/".$nomefile.$numero.".".$extension);
	$newimgprof=$nomefile.$numero.".".$extension;
	setcookie("imgprof", $newimgprof,time() + (10 * 365 * 24 * 60 * 60));
	header('location: main.php?p=profilo&message=Foto profilo aggiornata!');
    $_SESSION["letto"]=0;
	$mysqli->close();
	die();
	
?>