<?php
session_start();
include("config.php");
include("filtro.php");
	if(isset($_GET["p"]))
    {
    	$p=filtra($_GET["p"]);
    	$query="UPDATE utenti SET tutored=".$p." WHERE idutente=".$_COOKIE["idutente"];
		$result=$mysqli->query($query);
		setcookie("tutorial", $p,time() + (10 * 365 * 24 * 60 * 60));
    }
?>