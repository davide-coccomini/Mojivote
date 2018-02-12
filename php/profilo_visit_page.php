<?php

	include("config.php");
	include("filtro.php");
	include("admincontrol.php");
    
	if(isset($_GET["id"]))
	{
		if($_GET["id"]==$_COOKIE["idutente"])
		{
			header('location: main.php?p=profilo');
			$mysqli->close();
			die();
		}else{
			$idutente=filtra($_GET["id"]);
		}
	}else{
		header('location: main.php?p=profilo');
		$mysqli->close();
		die();
	}
?>

<div id="profcontent">
<?php
$admin=isAdmin();

	if($admin==true){
    	$query="SELECT ban FROM utenti WHERE idutente=".$idutente;
        $result=$mysqli->query($query);	
        $row=$result->fetch_assoc();
    	if($row['ban']==0)
    		echo "<div id='profiloadmincontent'><form method='POST' action='ban_process.php?idutente=".$idutente."'><legend>Admin panel</legend><input type='submit' value='Banna' class='button'></form></div>";
		else
        	echo "<div id='profiloadmincontent'><form method='POST' action='ban_process.php?idutente=".$idutente."'><legend>Admin panel</legend><input type='submit' value='Sbanna' class='button'></form></div>";
	
    }
?>
<div id="boximgprof">
<?php
	$query="SELECT COUNT(*) AS numero FROM seguaci WHERE idutente=".$idutente." AND idseguace=".$_COOKIE["idutente"]; 
	$result=$mysqli->query($query);
	$row=$result->fetch_assoc();
	
	if($row["numero"]==0)
		echo "<a href='profilo_segui.php?id=".$idutente."'><button id='segui' value='Segui' class='button'>Segui</button></a>";
	else
		echo "<button id='seguidisabled' class='button'>Iscritto</button>";
	
?>



<div id="imgprof">
	<?php
	$query="SELECT * FROM utenti WHERE idutente=".$idutente;
	$result=$mysqli->query($query);
	$row=$result->fetch_assoc();
	
	$imgprof=$row["imgprof"];
	$contatore=$row["contatoreimg"];
	$exp=explode(".", $imgprof);
	$extension = end($exp);
	$nomefile = basename($imgprof,".".$extension);
	$imgprof=$nomefile.$contatore.".".$extension;
	echo "<img id='imgprofint' src='../img/imgprof/".$imgprof."'>";
	?>
	<div id="titleimgprof">
	<?php
		echo $row["nome"]." ".$row["cognome"];
	?>
	</div>
</div>

</div>
<div id="profnavbar">
	<a href="main.php?p=profilo_visit_page&s=profilo_visit_menucategorie&id=<?php echo $idutente;?>"><div id="profnavbarleft">Sondaggi creati</div></a>
	<a href="main.php?p=profilo_visit_page&s=profilo_informazioni&id=<?php echo $idutente;?>"><div id="profnavbarcenter">Informazioni</div></a>
	<a href="main.php?p=profilo_visit_page&s=profilo_seguaci&id=<?php echo $idutente;?>"><div id="profnavbarcenter">Seguaci</div></a>
</div>
<?php
		if(! isset ($_GET["s"]))
		{
			$_GET["s"]="profilo_visit_menucategorie";
		}
		if($_COOKIE["login"]==false){
			header('location: ../index.php');
			$mysqli->close();
			die();
		}
		if(isset($_GET["s"])){
			$pagina=$_GET["s"];
			include($pagina.".php");
		}
?>
</div>
</div>

















