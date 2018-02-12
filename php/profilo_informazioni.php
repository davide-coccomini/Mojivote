<div id="profiloinfobox">

<div id="profiloinfotitolo">
Informazioni
</div>
	<div id="profiloinfocontent">

	<?php
	
	include("config.php");
	if(isset($_GET["id"]))
		$idutente=filtra($_GET["id"]);
	else
		$idutente=$_COOKIE["idutente"];
	
		$query="SELECT * FROM utenti WHERE idutente=".$idutente;
		$result=$mysqli->query($query);	
		$row=$result->fetch_assoc();
		if(isset($_GET["id"])) 
        {
       	 echo" <fieldset><legend>Informazioni generali:</legend>
            <label>Nome:</label><input type='textbox' class='profiloinfolabeldisabled' id='profiloinfonome' name='nome' value='".$row["nome"]."' disabled>
            <label>Cognome:</label><input type='textbox' class='profiloinfolabeldisabled' id='profiloinfonome' name='cognome' value='".$row["cognome"]."' disabled>
			<label>Data di nascita:</label><input type='textbox' class='profiloinfolabeldisabled' name='datanascita' id='profiloinfonascita' value='".$row["datanascita"]."' disabled>
			<label>Data di iscrizione:</label><input type='textbox' class='profiloinfolabeldisabled' name='dataiscrizione' class='profiloinfolabeldisabled' id='profiloinfoiscrizione' value='".$row["dataiscrizione"]."' disabled>
			<label>Sondaggi creati:</label><input class='profiloinfolabeldisabled' type='textbox' id='profiloinfocreati' value='".$row["sondaggicreati"]."' disabled>
			<label>Sondaggi votati:</label><input class='profiloinfolabeldisabled' type='textbox' id='profiloinfovotati' value='".$row["votieffettuati"]."' disabled>";
        }else{
		
		echo "<fieldset id='infoimg'><legend>Immagine del profilo:</legend>
               <form method='POST' action='inserisciimgprof.php' enctype='multipart/form-data'>
          <input type='hidden' name='MAX_FILE_SIZE' value='30000000'>
          <input type='file' accept='image/png,image/gif,image/jpeg' name='file' value='' id='changeimg'>
          <input type='submit' class='button' id='changeimgsubmit' value='Aggiorna immagine'>
         </form></fieldset>
        	<form method='POST' action='aggiornainfo.php'>
        	<fieldset><legend>Informazioni generali:</legend>
            <label>Nome:</label><input type='textbox' id='profiloinfonome' name='nome' value='".$row["nome"]."'>
            <label>Cognome:</label><input type='textbox' id='profiloinfonome' name='cognome' value='".$row["cognome"]."'>
			<label>Data di nascita:</label><input type='textbox' name='datanascita' id='profiloinfonascita' value='".$row["datanascita"]."'>
			<label>Data di iscrizione:</label><input type='textbox' name='dataiscrizione' class='profiloinfolabeldisabled' id='profiloinfoiscrizione' value='".$row["dataiscrizione"]."' disabled>
			<label>Sondaggi creati:</label><input class='profiloinfolabeldisabled' type='textbox' id='profiloinfocreati' value='".$row["sondaggicreati"]."' disabled>
			<label>Sondaggi votati:</label><input class='profiloinfolabeldisabled' type='textbox' id='profiloinfovotati' value='".$row["votieffettuati"]."' disabled>
           	<input type='submit' value='Aggiorna informazioni' id='buttonaggiornainfo' class='button'>
           </form>
           <form method='POST' action='aggiornainfo.php'>
           </fieldset><fieldset><legend>Cambia password:</legend>
            <label>Vecchia password:</label><input type='password' name='pswold' id='profiloinfovotati'>
            <label>Nuova password:</label><input type='password' name='pswnew' id='profiloinfovotati'>
            <label>Conferma nuova password:</label><input type='password' name='pswnewconfirm' id='profiloinfovotati'>
            </fieldset>
            <input type='submit' value='Aggiorna password' id='buttonaggiornainfo' class='button'>
           </form>";
		}
	?>

	</div>
</div>
