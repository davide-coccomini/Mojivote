<?php

include("config.php");
include("filtro.php");
session_start();

$query="SELECT admin FROM utenti WHERE idutente=".$_COOKIE["idutente"]." AND email='".$_COOKIE["email"]."'";
$result=$mysqli->query($query);
$row=$result->fetch_assoc();

  if($row["admin"]<1)
  {
      header('location: main.php?p=sondaggio_new_associazioni&categoria='.$categoria.'&titolo='.$titolo.'&message=La prima etichetta è troppo lunga&t='.$tipo);
      $mysqli->close();
      die();
  }else{
 	  echo "<div id='pannellobox'>";
      include("pannello_menu.php");
     
      echo "<div id='pannelloright'>";
		
	
		$fp = fopen('log.txt', 'r');
		$log = fread($fp, 200000);
		echo "<div><textarea cols='145' rows='40' readonly>".$log."</textarea></div>";
		
		fclose($fp);
   
      echo"</div></div>";
    	
    
  	
  }

?>