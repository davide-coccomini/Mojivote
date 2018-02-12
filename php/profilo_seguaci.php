<div id="profiloseguacibox">

<?php
	include("config.php");
	if(isset($_GET["id"]))
	{
		if($_GET["id"]!=$_COOKIE["idutente"])
			$idutente=filtra($_GET["id"]);
	}else{
		$idutente=$_COOKIE["idutente"];
	}
	
	
$query="SELECT COUNT(*) as numero FROM utenti NATURAL JOIN seguaci WHERE idutente=".$idutente;
$result=$mysqli->query($query);
$row=$result->fetch_assoc();
echo "<div id='profiloseguacitop'><label>Seguaci:</label>  ".$row['numero']."</div>";



$query="SELECT * FROM utenti U INNER JOIN seguaci S ON U.idutente=S.idseguace WHERE S.idutente=".$idutente;
$result=$mysqli->query($query);
	while($row=$result->fetch_assoc())
	{
		$imgprof=$row["imgprof"];
		$contatore=$row["contatoreimg"];
		$exp=explode(".", $imgprof);
		$extension = end($exp);
		$nomefile = basename($imgprof,".".$extension);
		$img=$nomefile.$contatore.".".$extension;
		echo "<a href='main.php?p=profilo_visit_page&id=".$row['idseguace']."'><div class='profiloseguacifoto'><img src='../img/imgprof/".$img."'></div></a>";
	}
?>
</div>