<?php
include("config.php");
session_start();
 if($_GET["notifica"]==1){
$query="SELECT * FROM sondaggi WHERE idutente=".$_COOKIE['idutente']."";
$result=$mysqli->query($query);    

$ris=array();

	for($i=0;$row=$result->fetch_assoc();$i++){
        $ris[$i][0]=$row["idsondaggio"];
        $ris[$i][1]=$row["titolo"];
        $ris[$i][2]=$row["totalevoti"];
        $ris[$i][3]=$row["totalecommenti"];
      }
 	   
       echo json_encode($ris); 
 }


?>