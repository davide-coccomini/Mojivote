<div id="profcontent">
<div id="boximgprof">
<div id="contatorepunti">
	<?php
		echo "Punti: ".$_COOKIE["punteggio"];
	?>
</div>

<div id="imgprof">
	<?php
		$imgprof=$_COOKIE["imgprof"];
		echo "<img id='imgprofint' src='../img/imgprof/".$imgprof."'>";
	?>
	<div id="titleimgprof">
	<?php
		echo $_COOKIE["nome"]." ".$_COOKIE["cognome"];
	?>
	</div>
</div>

</div>
<div id="profnavbar">
	<a href="main.php?p=profilo"><div id="profnavbarleft">I miei sondaggi</div></a>
	<a href="main.php?p=profilo&s=profilo_informazioni"><div id="profnavbarcenter">Informazioni</div></a>
	<a href="main.php?p=profilo&s=profilo_seguaci"><div id="profnavbarcenter">Seguaci</div></a>
</div>
<?php
		if(! isset ($_GET["s"]))
		{
			$_GET["s"]="profilo_menucategorie";
		}
		if($_COOKIE["login"]==false){
			header('location: ../index.php?');
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

















