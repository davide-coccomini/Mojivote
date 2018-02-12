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
$query="SELECT * FROM manutenzione";
$riga=$mysqli->query($query);
$manutenzione=false;

	while($row=$riga->fetch_assoc())
	{
		if($row["status"]==1)
			$manutenzione=true;
	}
	echo "<fieldset id='fieldstatus'>";
	if($manutenzione==true)
		echo"Status:<b>In manutenzione</b>";
	else
		echo"Status:<b>Online</b>";


  
	if($manutenzione==false){
		echo"<form method='post' action='pannello_manutenzione_process.php?action=0'>
				<legend>Motivazione</legend>	
				<textarea id='textarea' class='textboxmess' name='motivazione'></textarea>
				<input type='submit' value='Metti in manutenzione' class='button'>
			</form>";
	}else{
		echo"
				<form method='post' action='pannello_manutenzione_process.php?action=1'>
				<input type='submit' value='Rimuovi dalla manutenzione' class='button'>
				</form>";
	}
   echo"</fieldset><div id='pannelloboxinfo'><fieldset id='fieldsetinfo'>Informazioni generali";
   	
   $query="SELECT COUNT(*) as numero FROM utenti";
   $result=$mysqli->query($query);
   $row=$result->fetch_assoc();
   $numeroregistrati=$row["numero"];
   
   $query="SELECT COUNT(*) as numero FROM sondaggi";
   $result=$mysqli->query($query);
   $row=$result->fetch_assoc();
   $numerosondaggi=$row["numero"];
   
   $query="SELECT COUNT(*) as numero FROM votisondaggi";
   $result=$mysqli->query($query);
   $row=$result->fetch_assoc();
   $numerovoti=$row["numero"];
   
   $query="SELECT AVG(votieffettuati) as numero FROM utenti";
   $result=$mysqli->query($query);
   $row=$result->fetch_assoc();
   $mediavotiperutente=$row["numero"];
   
   $query="SELECT AVG(sondaggicreati) as numero FROM utenti";
   $result=$mysqli->query($query);
   $row=$result->fetch_assoc();
   $mediasondaggiperutente=$row["numero"];
   
   $query="SELECT AVG(punteggio) as numero FROM utenti";
   $result=$mysqli->query($query);
   $row=$result->fetch_assoc();
   $mediapunteggio=$row["numero"];
   
   
   
   $query="SELECT categoria,COUNT(*) as numero FROM sondaggi GROUP BY categoria ORDER BY numero DESC";
   $result=$mysqli->query($query);
   echo "<table id='tabellainfo'>
   			<tr><th>Utenti registrati</th><th>Sondaggi creati</th><th>Voti effettuati</th></tr>
            <tr><td>$numeroregistrati</td><td>$numerosondaggi</td><td>$numerovoti</td></tr>
            <tr><th>Media punteggio/utente</th><th>Media sondaggi/utente</th><th>Voti effettuati</th></tr>
            <tr><td>$mediapunteggio</td><td>$mediasondaggiperutente</td><td>$mediavotiperutente</td></tr>
          </table></fieldset>";
          
    echo "<fieldset id='fieldsetcategorie'>Sondaggi per categoria<table id='tabellacategorie'>";
    	while($row=$result->fetch_assoc())
        {
        	echo "<tr><th>".$row['categoria']."</th><td>".$row['numero']."</td></tr>";
        }
    echo "</fieldset></table>";   
          
            
   			
   
   
	echo"</div></div></div>";
    	
    
  	
  }

?>