<?php
	
	if($_SESSION["manutenzione"]==1 && $_SESSION["admin"]==0)
    {
    	header('location: ../index.php?imessage=Mojivote è attualmente in manutenzione. Torneremo tra poco!');
		$mysqli->close();
        die();
    }

	if($_SESSION["ban"]==1)
    {
    	header('location: ../index.php?imessage=Siamo spiacenti di comunicarti che il tuo account è stato bannato. Per maggiori informazioni manda una mail a contact@mojivote.com.');
		$mysqli->close();
        die();
    }
?>