<?php
		if($_COOKIE["tutorial"]<2)
        {
        	echo "<script>tutorial(6)</script>";
        }

?>

<div id="newtitlebox">
		<img src="../img/imgsondaggio.png">
		<div id="newtitlecontent">
			<form id="formnewtitle" method="POST" onsubmit="return confirm('Se sei sicuro di aver inserito la categoria corretta premi OK altrimenti premi annulla e cambiala dal menu a tendina.');" action="main.php?p=sondaggio_new_associazioni">
				<input type="textbox" class="newtitlebox"  onmouseout="consentiti(this)" onchange="consentiti(this)" onblur="consentiti(this)" onChange="consentiti(this)" onkeypress="consentiti(this)" id="newtitletextbox" name="titolo" <?php if(isset($_GET["titolo"])) echo "value='".$_GET['titolo']."'";?>>
				<select name="categoria" class="newcategorybox">
				  <option value="Politica">Politica</option>
				  <option value="Spettacolo">Cinema e spettacolo</option>
				  <option value="Videogiochi">Videogiochi</option>
				  <option value="Anime">Anime e manga</option>
				  <option value="Attualita">Attualità</option>
                  <option value="Cibo">Cibo e cucina</option>
				  <option value="Sport">Sport</option>
				  <option value="Scienza">Scienza e tecnologia</option>
                  <option value="Musica">Musica</option>
                  <option value="Letteratura">Libri e letteratura</option>
				  <option value="Altro">Altro</option>					
				</select>
				<input type="submit" class="formnewavanti" value="Avanti" style="background:#d4d4d4;border-color:#dcdbdb;" class="button" id="pulsantenewtitle" disabled>
			</form>
		</div>
</div>

<script>

function consentiti(campo) {

setTimeout(function(){
	var stringa = campo.value;
	var r1 =  /^[A-Za-z ][A-Za-z0-9!@#$%^?!()€éèòàùì&* ]*$/;
	var box=document.getElementById("newtitletextbox");
	var btn=document.getElementById("pulsantenewtitle");

	if (r1.test(stringa) == false || stringa.length>70){
		box.style.background="red";
		btn.disabled=true;
		btn.style.background="#d4d4d4";
		btn.style.borderColor="#dcdbdb";
	}else{
		box.style.background="green";
		btn.disabled=false;
		btn.style.background="#66aadc";
		btn.style.borderColor="black";
	}
},100);
}

</script>