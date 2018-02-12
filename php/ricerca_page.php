<?php
include("filtro.php");
include("config.php");
	if(isset($_POST["categoria"]) && isset($_POST["testo"]))
	{
		$categoria=filtra($_POST["categoria"]);
		$testo=filtra($_POST["testo"]);
	}else{
		header('location: main.php?p=bacheca&message=Form Incompleto');
        $_SESSION["letto"]=0;
		$mysqli->close();
		die();
	}

	if($categoria=="utenti"){
		$sql="SELECT * FROM utenti WHERE ";
		$arr_txt = explode(" ", $testo);
	
		 for ($i=0; $i<count($arr_txt); $i++)
		 {
				if ($i > 0)
				{
					$sql .= " AND ";
				}
			$sql .= "(nome LIKE '%" . $mysqli->real_escape_string($arr_txt[$i]) . "%' OR cognome LIKE '%" . $mysqli->real_escape_string($arr_txt[$i]) . "%')";
		 }
	
	}
	else{
		$sql="SELECT * FROM sondaggi WHERE eliminato=0 AND ";
		$arr_txt = explode(" ", $testo);
	
		 for ($i=0; $i<count($arr_txt); $i++)
		 {
				if ($i > 0)
				{
					$sql .= " AND ";
				}
			$sql .= "(titolo LIKE '%" . $mysqli->real_escape_string($arr_txt[$i]) . "%' )";
		 }
	}
	if($categoria=="utenti")
	{
		$sql .= " ORDER BY idutente ASC";
	}else{
		$sql .= " ORDER BY titolo ASC";
	}
	 $result=$mysqli->query($sql);

	echo "<div id='risultatibox'><div id='risultatitop'><input type='textbox' value='Hai cercato <".$testo."> e ottenuto i seguenti risultati:' disabled>
	<a href='main.php?p=bacheca'><input type='button' class='button' id='buttonindietroricerca' value='Indietro'></a></div>";
	
		 while($row=$result->fetch_assoc())
		 {
			 if($categoria=="utenti"){
				echo "<a href='main.php?p=profilo_visit_page&id=".$row['idutente']."'><div class='risultatiopz'>".$row["nome"]." ".$row["cognome"]."<div class='arrowricerca'></div></div></a>";
			 }else{
				echo "<a href='main.php?p=sondaggio_visit&c=".$row['categoria']."&id=".$row['idsondaggio']."'><div class='risultatiopz'>".$row["titolo"]."</div></a>"; 
			 }
		 }
		 
	echo "</div>";
	 
	 
	
?>

