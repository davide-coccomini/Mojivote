	
<div id="tuoisondaggi">
<?php
	
	if(isset($_GET["id"]))
	{
		$idutente=filtra($_GET["id"]);
	}
    if(isset($_GET["c"]))
    	$c=$_GET["c"];
    else
    	$c="random";
    if($c=="random")    
		$query="SELECT * FROM sondaggi NATURAL JOIN associazioni NATURAL JOIN utenti WHERE eliminato=0 AND idutente=".$idutente." ORDER BY idsondaggio DESC,emoticon ASC";
	else
    	$query="SELECT * FROM sondaggi NATURAL JOIN associazioni NATURAL JOIN utenti WHERE eliminato=0 AND categoria='".$c."' AND idutente=".$idutente." ORDER BY idsondaggio DESC,emoticon ASC";
	
    echo"<script>setTimeout(function(){aggiornaSfondo('".$c."');},200);</script>";	
	
    $result=$mysqli->query($query);	

?>
<div id="profilosondaggicontent">
	<?php
	
	
		$sondaggio=NULL;
		$i=0;
		$presente=false;
        
		while($row=$result->fetch_assoc()){
	    $presente=true;
		$exp=explode(".",$row["img"]);
		$extension = end($exp);
		$nomefile = basename($row['img'],".".$extension);
			if($i==0)
			{
            	if($c=="random")
					$querynumero="SELECT COUNT(*) as numero FROM sondaggi NATURAL JOIN associazioni NATURAL JOIN utenti WHERE eliminato=0 AND idutente=".$idutente." AND idsondaggio=".$row['idsondaggio']." GROUP BY idsondaggio ORDER BY idsondaggio DESC,emoticon ASC";
				else
            		$querynumero="SELECT COUNT(*) as numero FROM sondaggi NATURAL JOIN associazioni NATURAL JOIN utenti WHERE eliminato=0 AND categoria='".$c."' AND idutente=".$idutente." AND idsondaggio=".$row['idsondaggio']." GROUP BY idsondaggio ORDER BY idsondaggio DESC,emoticon ASC";
	
                $risultato=$mysqli->query($querynumero);
				$riga=$risultato->fetch_assoc();
				$num=$riga["numero"];
				$sondaggio=$row["idsondaggio"];
				$i++;
				if($num==5 || $num==6)
						echo "<div class='profilosondaggibox5'>";
					else
						echo "<div class='profilosondaggibox'>";
					
				echo"<div class='profilosondaggitop'>
						".$row['titolo']."
					</div>
					  <div class='profilosondaggicenter'>
						<div class='profilosondaggiassociazione".$num."'>
							<div class='profilosondaggietichetta'>".$row['etichetta']."</div>
							<img src='../img/imgsondaggi/".$nomefile.$row['contatore'].".".$extension."' class='profilosondaggiimg'>
							<input type='textbox' class='associazionevoti".$num."' value=".$row['Voti']." disabled>
							<img src='../img/emoji".$row['emoticon'].".png' class='profilosondaggiemoji".$num."'>
						</div>";
			}else{
				if($sondaggio==$row["idsondaggio"]){
				
				 echo"<div class='profilosondaggiassociazione".$num."'>
						<div class='profilosondaggietichetta'>".$row['etichetta']."</div>
						<img src='../img/imgsondaggi/".$nomefile.$row['contatore'].".".$extension."' class='profilosondaggiimg'>
						<input type='textbox' class='associazionevoti".$num."' value=".$row['Voti']." disabled>
						<img src='../img/emoji".$row['emoticon'].".png' class='profilosondaggiemoji".$num."'>
					  </div>";
				}else{
					$querynumero="SELECT COUNT(*) as numero FROM sondaggi NATURAL JOIN associazioni NATURAL JOIN utenti WHERE eliminato=0 AND idutente=".$idutente." AND idsondaggio=".$row['idsondaggio']." GROUP BY idsondaggio ORDER BY idsondaggio DESC,emoticon ASC";
					$risultato=$mysqli->query($querynumero);
					$riga=$risultato->fetch_assoc();
						$num=$riga["numero"];
					
					$sondaggio=$row["idsondaggio"];
					echo"</div></div>";
               
					if($num==5 || $num==6)
						echo "<div class='profilosondaggibox5'>";
					else
						echo "<div class='profilosondaggibox'>";
					
					echo"<div class='profilosondaggitop' >
						".$row['titolo']."
					 </div>
					  <div class='profilosondaggicenter'>
					  <div class='profilosondaggiassociazione".$num."'>
					  <div class='profilosondaggietichetta'>".$row['etichetta']."</div>
					   <img src='../img/imgsondaggi/".$nomefile.$row['contatore'].".".$extension."' class='profilosondaggiimg'>
					   <input type='textbox' class='associazionevoti".$num."' value=".$row['Voti']." disabled>
					   <img src='../img/emoji".$row['emoticon'].".png' class='profilosondaggiemoji".$num."'>
					  </div>";
				}
					
			}
		}
if($presente==true){
echo "</div>";
					}
echo "</div></div>";

?>
</div>
