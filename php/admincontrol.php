<?php

function isAdmin()
{
	$mysqli3= new mysqli("ftp.mojivote.altervista.org","mojivote","","my_mojivote");
	$query="SELECT admin FROM utenti WHERE idutente=".$_COOKIE['idutente'];
    $result=$mysqli3->query($query);	
    $row=$result->fetch_assoc();
    
    if($row['admin']==1)
    	return true;
    else
    	return false;
}

?>