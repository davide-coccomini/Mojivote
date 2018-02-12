<?php

SESSION_start();
include("config.php");
include("filtro.php");
$count=0;
$arrayimg=array("","","","","","");
$arrayetichette=array(0,0,0,0,0,0);
$arrayestensioni=array(0,0,0,0,0,0);
$titolo=filtra($_POST["titolo"]);
$categoria=filtra($_POST["categoria"]);

if((isset($_POST["emoji1"])) and (isset($_POST["etichetta1"])) and ((trim($_FILES['file1']['name']))!=""))
{
	$count=$count+1;
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$exp=explode(".",$_FILES["file1"]["name"]);
	$extension = end($exp);
	if (($_FILES["file1"]["size"] > 5242880)
	|| !in_array($extension, $allowedExts)){
		header('location: main.php?p=sondaggio_new_associazioni&categoria='.$categoria.'&titolo='.$titolo.'&message=Il primo file non è un immagine&t='.$tipo);
		$mysqli->close();
		die();
	}
	$nomefile = basename($_FILES['file1']['name'],".".$extension);
	$find =  array(' ','�','à','ò','ù','ì','^','=','ç','°','é','è','#','§','[',']','?','$','£','!','|','/');
    $nomefile =  str_replace ($find, 'x', $nomefile);
	$arrayimg[0]=$nomefile;
    if(strlen($_POST["etichetta1"])>22)
    {
    	header('location: main.php?p=sondaggio_new_associazioni&categoria='.$categoria.'&titolo='.$titolo.'&message=La prima etichetta è troppo lunga&t='.$tipo);
		$_SESSION["letto"]=0;
        $mysqli->close();
		die();
    }
	$arrayetichette[0]=filtra($_POST["etichetta1"]);
	$arrayestensioni[0]=$extension;
}
if((isset($_POST["emoji2"])) and (isset($_POST["etichetta2"])) and ((trim($_FILES['file2']['name']))!="") )
{
	$count=$count+1;
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$exp=explode(".", $_FILES["file2"]["name"]);
	$extension = end($exp);
		if (($_FILES["file2"]["size"] > 5242880)
		|| !in_array($extension, $allowedExts)){
		header('location: main.php?p=sondaggio_new_associazioni&categoria='.$categoria.'&titolo='.$titolo.'&message=Il secondo file non è un immagine');
	    $_SESSION["letto"]=0;
        $mysqli->close();
		die();
	}
	$nomefile = basename($_FILES['file2']['name'],".".$extension);
	$find =  array(' ','�','à','ò','ù','ì','^','=','ç','°','é','è','#','§','[',']','?','$','£','!','|','/');
    $nomefile =  str_replace ($find, 'X', $nomefile);
	$arrayimg[1]=$nomefile;
    if(strlen($_POST["etichetta2"])>22)
    {
    	header('location: main.php?p=sondaggio_new_associazioni&categoria='.$categoria.'&titolo='.$titolo.'&message=La seconda etichetta è troppo lunga&t='.$tipo);
		$_SESSION["letto"]=0;
        $mysqli->close();
		die();
    }
	$arrayetichette[1]=filtra($_POST["etichetta2"]);
	$arrayestensioni[1]=$extension;
}
if((isset($_POST["emoji3"])) and (isset($_POST["etichetta3"])) and ((trim($_FILES["file3"]["name"]))!=""))
{
	$count=$count+1;
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$exp=explode(".", $_FILES["file3"]["name"]);
	$extension = end($exp);
		if (($_FILES["file3"]["size"] > 5242880)
		|| !in_array($extension, $allowedExts)){
		header('location: main.php?p=sondaggio_new_associazioni&categoria='.$categoria.'&titolo='.$titolo.'&message=Il terzo file non è un immagine');
		$_SESSION["letto"]=0;
        $mysqli->close();
		die();
	}
	$nomefile = basename($_FILES['file3']['name'],".".$extension);
	$find =  array(' ','�','à','ò','ù','ì','^','=','ç','°','é','è','#','§','[',']','?','$','£','!','|','/');
    $nomefile =  str_replace ($find, 'X', $nomefile);
	$arrayimg[2]=$nomefile;
    if(strlen($_POST["etichetta3"])>22)
    {
    	header('location: main.php?p=sondaggio_new_associazioni&categoria='.$categoria.'&titolo='.$titolo.'&message=La terza etichetta è troppo lunga&t='.$tipo);
		$_SESSION["letto"]=0;
        $mysqli->close();
		die();
    }
	$arrayetichette[2]=filtra($_POST["etichetta3"]);
	$arrayestensioni[2]=$extension;
}
if((isset($_POST["emoji4"])) and (isset($_POST["etichetta4"])) and ((trim($_FILES["file4"]["name"]))!=""))
{
	$count=$count+1;
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$exp=explode(".", $_FILES["file4"]["name"]);
	$extension = end($exp);
		if (($_FILES["file4"]["size"] > 5242880)
		|| !in_array($extension, $allowedExts)){
		header('location: main.php?p=sondaggio_new_associazioni&categoria='.$categoria.'&titolo='.$titolo.'&message=Il quarto file non è un immagine');
		$mysqli->close();
		die();
	}
	$nomefile = basename($_FILES['file4']['name'],".".$extension);
	$find =  array(' ','�','à','ò','ù','ì','^','=','ç','°','é','è','#','§','[',']','?','$','£','!','|','/');
    $nomefile =  str_replace ($find, 'X', $nomefile);
	$arrayimg[3]=$nomefile;
    if(strlen($_POST["etichetta4"])>22)
    {
    	header('location: main.php?p=sondaggio_new_associazioni&categoria='.$categoria.'&titolo='.$titolo.'&message=La quarta etichetta è troppo lunga&t='.$tipo);
		$_SESSION["letto"]=0;
        $mysqli->close();
		die();
    }
	$arrayetichette[3]=filtra($_POST["etichetta4"]);
	$arrayestensioni[3]=$extension;
}
if((isset($_POST["emoji5"])) and (isset($_POST["etichetta5"])) and ((trim($_FILES["file5"]["name"]))!="")) 
{
	$count=$count+1;
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$exp=explode(".", $_FILES["file5"]["name"]);
	$extension = end($exp);
		if (($_FILES["file5"]["size"] > 5242880)
		|| !in_array($extension, $allowedExts)){
		header('location: main.php?p=sondaggio_new_associazioni&categoria='.$categoria.'&titolo='.$titolo.'&message=Il quinto file non è un immagine');
		$_SESSION["letto"]=0;		
        $mysqli->close();
		die();
	}
	$nomefile = basename($_FILES['file5']['name'],".".$extension);
	$find =  array(' ','�','à','ò','ù','ì','^','=','ç','°','é','è','#','§','[',']','?','$','£','!','|','/');
    $nomefile =  str_replace ($find, 'X', $nomefile);
	$arrayimg[4]=$nomefile;
    if(strlen($_POST["etichetta5"])>22)
    {
    	header('location: main.php?p=sondaggio_new_associazioni&categoria='.$categoria.'&titolo='.$titolo.'&message=La quinta etichetta è troppo lunga&t='.$tipo);
		$_SESSION["letto"]=0;
        $mysqli->close();
		die();
    }
	$arrayetichette[4]=filtra($_POST["etichetta5"]);
	$arrayestensioni[4]=$extension;
}
if((isset($_POST["emoji6"])) and (isset($_POST["etichetta6"])) and ((trim($_FILES["file6"]["name"]))!=""))
{
	$count=$count+1;
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$exp=explode(".", $_FILES["file6"]["name"]);
	$extension = end($exp);
		if (($_FILES["file6"]["size"] > 5242880)
		|| !in_array($extension, $allowedExts)){
		header('location: main.php?p=sondaggio_new_associazioni&categoria='.$categoria.'&titolo='.$titolo.'&message=Il sesto file non è un immagine');
		$mysqli->close();
		die();
	}
	$nomefile = basename($_FILES['file6']['name'],".".$extension);
	$find =  array(' ','�','à','ò','ù','ì','^','=','ç','°','é','è','#','§','[',']','?','$','£','!','|','/');
    $nomefile =  str_replace ($find, 'X', $nomefile);
	$arrayimg[5]=$nomefile;
    if(strlen($_POST["etichetta6"])>22)
    {
    	header('location: main.php?p=sondaggio_new_associazioni&categoria='.$categoria.'&titolo='.$titolo.'&message=La sesta etichetta è troppo lunga&t='.$tipo);
		$_SESSION["letto"]=0;
        $mysqli->close();
		die();
    }
	$arrayetichette[5]=filtra($_POST["etichetta6"]);
	$arrayestensioni[5]=$extension;
}
if($count<2)
{
	header('location: main.php?p=sondaggio_new_associazioni&categoria='.$categoria.'&titolo='.$titolo.'&message=Devi scegliere almeno due opzioni per il tuo sondaggio');
	$_SESSION["letto"]=0;
    $mysqli->close();
	die();
}
if($_COOKIE["punteggio"]<10)
{
	header('location: main.php?p=sondaggio_new_page&categoria='.$categoria.'&titolo='.$titolo.'&message=Non hai abbastanza punti (minimo 10)');
	$_SESSION["letto"]=0;
    $mysqli->close();
	die();
}
$newpunteggio=$_COOKIE["punteggio"]-10;
setcookie("punteggio", $newpunteggio,time() + (10 * 365 * 24 * 60 * 60));
$query="UPDATE utenti SET punteggio=punteggio-10 WHERE idutente=".$_COOKIE['idutente']."";
$result=$mysqli->query($query);

$query="UPDATE utenti SET sondaggicreati=sondaggicreati+1 WHERE idutente=".$_COOKIE['idutente']."";
$result=$mysqli->query($query);
$data= date("Y-m-d");
$expl=explode(".", $categoria);
$categoria = end($expl);

$query="INSERT INTO sondaggi(titolo,datacreazione,categoria,idutente) VALUES('".$titolo."','".$data."','".$categoria."',".$_COOKIE['idutente'].")";
$result=$mysqli->query($query);

$query="SELECT idsondaggio FROM sondaggi ORDER BY idsondaggio DESC limit 1";
$result=$mysqli->query($query);
$row=$result->fetch_assoc();
$idsondaggio=$row["idsondaggio"];
	
	for($i=0;$i<6;$i++)
	{
		$query2="SELECT COUNT(*) as numero FROM associazioni WHERE img='".$arrayimg[$i].".".$extension."'";
		$result2=$mysqli->query($query2);
		$row2=$result2->fetch_assoc();
		$contatore=$row2["numero"];
		$nome_senza_estensione=$arrayimg[$i];
		$j=$i+1;
		$exp=explode(".", $_FILES["file".$j.""]["name"]);
		$extension = end($exp);
			if($arrayimg[$i]!=""){
			 $query="INSERT INTO associazioni(idsondaggio,img,contatore,etichetta,emoticon) VALUES(".$idsondaggio.",'".$nome_senza_estensione.".".$extension."',".$contatore.",'".$arrayetichette[$i]."',".$i.")";
			 $result=$mysqli->query($query);
			 move_uploaded_file($_FILES['file'.$j.'']['tmp_name'] , "../img/imgsondaggi/".$nome_senza_estensione.$contatore.".".$extension);
			}
	}
header('location: main.php?p=profilo&message=Sondaggio creato!');
$_SESSION["letto"]=0;
$_SESSION["creazione"]=1;
$mysqli->close();
die();

	
