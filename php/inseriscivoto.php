<?php
session_start();
include("config.php");
include("filtro.php");
$voto=filtra($_GET["j"]);
$id=filtra($_GET["id"]);

$query="SELECT COUNT(*) as numero FROM votisondaggi WHERE idutente=".$_COOKIE['idutente']." AND idsondaggio=".$id;
$result=$mysqli->query($query);
$row=$result->fetch_assoc();
echo $query;
if($row["numero"]!=0){
	$mysqli->close();
	die();
}else{
	$query="INSERT INTO votisondaggi(idsondaggio,idutente,voto) VALUES(".$id.",".$_COOKIE['idutente'].",".$voto.")";

	$result=$mysqli->query($query);

	$query="UPDATE sondaggi SET totalevoti=totalevoti+1 WHERE idsondaggio=".$id;
	$result=$mysqli->query($query);
    echo $query;
	$query="UPDATE associazioni SET Voti=Voti+1 WHERE idsondaggio=".$id." AND emoticon=".$voto;
	$result=$mysqli->query($query);
	$query="SELECT idutente,titolo FROM utenti NATURAL JOIN sondaggi WHERE idsondaggio=".$id;
	$result=$mysqli->query($query);
	$row=$result->fetch_assoc();
	$idutente=$row["idutente"];
	
	$titolo=$row["titolo"];
	
	$query="UPDATE utenti SET punteggio=punteggio+1 WHERE idutente=".$idutente;
	$result=$mysqli->query($query);
    $query="UPDATE utenti SET punteggio=punteggio+1 WHERE idutente=".$_COOKIE['idutente'];
	$result=$mysqli->query($query);
	
	
	//salvataggio log
	$data = date("d-m-y"); 
	$orario = date("G:i:s");

	$fp = fopen('log.txt', 'a');
	$testo="------\n\r".$data." ".$orario.":".$_COOKIE["nome"]." ".$_COOKIE["cognome"]." ha votato ".$voto." al sondaggio <".$titolo.">";
	fwrite($fp,$testo);
	fclose($fp);
}


?>
