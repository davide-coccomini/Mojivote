<?php

SESSION_start();
include("config.php");
include("filtro.php");

if(! isset($_POST["nome"])  or (! isset($_POST["password"])) or (! isset($_POST["email"])) or (! isset($_POST["giorno"])) or (! isset($_POST["mese"]))or (! isset($_POST["anno"]))  or (! isset($_POST["sesso"]))){
header('location: ../index.php?imessage=Form Incompleto&nome='.$_POST["nome"].'&cognome='.$_POST["cognome"].'&email='.$_POST["email"].'');
$_SESSION["letto"]=0;
$mysqli->close();
die();
}else{
$newname = filtra($_POST["nome"]);
	if(strlen($newname)>15 or strlen($newname)<2){
		header('location: ../index.php?imessage=Nome invalido (3-15 caratteri)&cognome='.$_POST["cognome"].'&email='.$_POST["email"].'');
		$mysqli->close();
	}
$newsurname = filtra($_POST["cognome"]);
	if(strlen($newsurname)>15 or strlen($newsurname)<2){
		header('location: ../index.php?imessage=Cognome invalido (3-15 caratteri)&nome='.$_POST["nome"].'&email='.$_POST['email'].'');
		$mysqli->close();
	}
$newpass = filtra($_POST["password"]);
	if(strlen($newpass)>25 or strlen($newpass)<6){
		header('location: ../index.php?imessage=Password invalida (6-25 caratteri)');
		$mysqli->close();
	}
$newsesso = filtra($_POST["sesso"]);


	if($newsesso==0)
		$imgprof="silm.png";
	else
		$imgprof="silf.png";
	
$newgiorno = filtra($_POST["giorno"]);
if(strlen($newgiorno)==1) $newgiorno="0".$newgiorno;
$newmese = filtra($_POST["mese"]);
if(strlen($newmese)==1) $newmese="0".$newmese;
$newanno = filtra($_POST["anno"]);
$newdatanascita=$newanno."-".$newmese."-".$newgiorno;
$newdataiscrizione = date("Y-m-d");
$newemail = filtra($_POST["email"]);
$query="SELECT COUNT(DISTINCT idutente) as numero FROM utenti WHERE email='".$newemail."'";
$result=$mysqli->query($query);
$row=$result->fetch_assoc();

if($row["numero"]>0){
	header('location: ../index.php?imessage=Email gia in uso&nome='.$_POST["nome"].'&cognome='.$_POST["cognome"].'');
	$_SESSION["letto"]=0;
    $mysqli->close();
}else{
	$query="SELECT COUNT(DISTINCT idutente) as numero FROM utenti WHERE email='".$newemail."'";
	$result=$mysqli->query($query);
	$row=$result->fetch_assoc();
	if($row["numero"]>0){
	header('location: ../index.php?imessage=Email gia in uso');
    $_SESSION["letto"]=0;
	$mysqli->close();
	}else{
	$query="INSERT INTO utenti(nome,cognome,password,email,sesso,datanascita,dataiscrizione,votieffettuati,sondaggicreati,punteggio,admin,imgprof) VALUES('".$newname."','".$newsurname."',SHA1('".$newpass."'),'".$newemail."','".$newsesso."','".$newdatanascita."','".$newdataiscrizione."',0,0,100,0,'".$imgprof."')";
	$result=$mysqli->query($query);
	
		
	    //login

        $email = filtra($_POST["email"]);
        $pass = filtra($_POST["password"]);
       

 
$query="select * from utenti where email='".$email."'";
$result=$mysqli->query($query);
$row=$result->fetch_assoc();


setcookie("login", $login,time() + (10 * 365 * 24 * 60 * 60));


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
				$_SESSION["letto"]=0;
				die();
			}
		}	
	}
}
?>
