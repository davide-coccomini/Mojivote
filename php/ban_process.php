<?php
session_start();
include("admincontrol.php");
include("config.php");
include("filtro.php");

$admin=isAdmin();
	if(isset($_GET["idutente"]) && $admin==true)
    {
    	$idutente=filtra($_GET["idutente"]);       
        $query="SELECT ban FROM utenti WHERE idutente=".$idutente;
        $result=$mysqli->query($query);	
        $row=$result->fetch_assoc();
        if($row['ban']==1)
        	$ban=0;
        else
        	$ban=1;
            
    	$query="UPDATE utenti SET ban=".$ban." WHERE idutente=".$idutente;
        $result=$mysqli->query($query);	
        header('location: main.php?p=profilo_visit_page&id='.$idutente.'&message=Azione effettuata con successo');
        $mysqli->close();
        die();
    }else{
		header('location: main.php?p=profilo_visit_page&id='.$idutente.'&message=Errore, contattare il web master');
        $mysqli->close();
        die();
    }



?>