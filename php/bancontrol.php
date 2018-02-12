<?php

function isBanned()
{
	session_start();
	include("config.php");
	
	$query="SELECT ban FROM utenti WHERE idutente=".$_COOKIE['idutente'];
	
    $result=$mysqli->query($query);	
    $row=$result->fetch_assoc();
    
    if($row['ban']==1)
    	return true;
    else
    	return false;
}

?>