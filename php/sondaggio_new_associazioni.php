<div id="associazionicontent">
 <form method="POST" onsubmit="return confirm('Sei sicuro di voler creare il sondaggio? Ti costerà 10 punti.');" action="sondaggio_new_process.php"  enctype="multipart/form-data">
 <div id="associazionicontenttop">

		<div id="sondaggiotitle">
		<?php
		include("config.php");
		include("filtro.php");
        
		
		echo"<div id='loading_screen' style='display:none'>
              <img src='../img/logomoji.png' id='loading_logo'>
              <div id='loading_text'>
                <p>Sto creando il sondaggio!</p>
                <img src='../img/loadicon.gif'>
              </div>
            </div>";
            

       if($_COOKIE["tutorial"]<2)
        {
        	echo "<script>tutorial(9)</script>";
        }
			if((!isset ($_GET["titolo"]))&&(!isset($_POST["titolo"])) or ((!isset($_GET["categoria"]))&&(!isset($_POST["categoria"])))){
				header('location: main.php?p=sondaggio_new_page&message=Inserisci un titolo e una categoria');
				$_SESSION["letto"]=0;
                $mysqli->close();
				die();
			}else{
				if(isset ($_GET["titolo"]))
				  $titolo=filtra($_GET["titolo"]);
				else
					$titolo=filtra($_POST["titolo"]);
				if(isset ($_GET["categoria"]))
				 	$categoria=filtra($_GET["categoria"]);
				else
					$categoria=filtra($_POST["categoria"]);
            
				echo "<input type='textbox' name='titolo' value='".$titolo."' readonly>";
			}
			
			if(strlen($titolo)<5 or (strlen($titolo)>60)){
				header('location: main.php?p=sondaggio_new_page&message=Numero di caratteri invalido (5-30)');
				$_SESSION["letto"]=0;
                $mysqli->close();
				die();
			}
			if($_COOKIE["punteggio"]<10)
			{
				header('location: main.php?p=sondaggio_new_page&message=Non hai abbastanza punti (minimo 10)');
				$_SESSION["letto"]=0;
                $mysqli->close();
				die();
			}
            $catlow=strtolower($categoria);
			echo"<script>setTimeout(function(){aggiornaSfondo('".$catlow."');},200);</script>";
		?>
		</div>
		<script>
			function loading(){
				var scope=document.getElementById("loading_screen");
				scope.style.display="block";
			}
		</script>
		<div id="buttoncrea">
		<input type="hidden" <?php echo "value='.".$categoria."'"; ?> name="categoria">
			<input type="submit" value="Crea sondaggio" class="button buttoncreasondaggio" onclick="loading()">
			<a href="main.php?p=sondaggio_new_page&c=1&titolo=<?php echo $titolo; ?>">
			
			<input type="button" value="Indietro"  class="button" id="buttonindietroassociazioni">
			</a>
               
		</div>
 </div>
 <div id="associazioniinfobox">
 Scegli quali emoji utilizzare per il tuo sondaggio (almeno 2) cliccando sulle celle. 
 Inserisci un'etichetta a cui far corrispondere l'emoji e carica l'immagine del soggetto da votare.
 </div>
 <div id="associazionicontentbottom">
  
 <div class="associazionibox">
  <div class="associazioniboxinterno">
  <img src="../img/emoji0.png"><br>
  <input type="checkbox" name="emoji1" id="checkboxemoji1"><br>
  <input type="textbox" class='etichettabox' name="etichetta1" maxlength="22" onchange="validazione(this,4)" onclick="setCheckbox(1)"><br>
  <input type="hidden"  name="MAX_FILE_SIZE" value="300000000">
  <input  type="file" class='filebox' name="file1" accept="image/png,image/gif,image/jpeg,image/jpg" />
  </div>
 </div>
 
  <div class="associazionibox">
    <div class="associazioniboxinterno">
  <img src="../img/emoji1.png"><br>
  <input type="checkbox" name="emoji2" id="checkboxemoji2"><br>
  <input type="textbox" class='etichettabox' name="etichetta2" maxlength="22" onchange="validazione(this,4)" onclick="setCheckbox(2)"><br>
  <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
   <input type="file" class='filebox' name="file2" accept="image/png,image/gif,image/jpeg,image/jpg" /> 
  </div>
 </div>
 
  <div class="associazionibox">
    <div class="associazioniboxinterno">
  <img src="../img/emoji2.png"><br>
  <input type="checkbox" name="emoji3"  id="checkboxemoji3"><br>
  <input type="textbox" name="etichetta3"  maxlength="22" onchange="validazione(this,4)" onclick="setCheckbox(3)"><br>
  <input type="hidden" name="MAX_FILE_SIZE" value="30000000">
<input type="file" name="file3" accept="image/png,image/gif,image/jpeg" /> 
  </div>
 </div>
 
  <div class="associazionibox">
  <div class="associazioniboxinterno">
  <img src="../img/emoji3.png"><br>
  <input type="checkbox" name="emoji4" id="checkboxemoji4"><br>
  <input type="textbox" name="etichetta4"  maxlength="22" onchange="validazione(this,4)" onclick="setCheckbox(4)"><br>
  <input type="hidden" name="MAX_FILE_SIZE" value="30000000">
  <input type="file" name="file4" accept="image/png,image/gif,image/jpeg" />
  </div>
 </div>
 
  <div class="associazionibox">
    <div class="associazioniboxinterno">
  <img src="../img/emoji4.png"><br>
  <input type="checkbox" name="emoji5"  id="checkboxemoji5"><br>
  <input type="textbox" maxlength="22" name="etichetta5" onchange="validazione(this,4)" onclick="setCheckbox(5)"><br>
  <input type="hidden" name="MAX_FILE_SIZE" value="30000000">
  <input type="file" name="file5" accept="image/x-png,image/gif,image/jpeg"/>
  </div>
 </div>
 
  <div class="associazionibox">
    <div class="associazioniboxinterno">
  <img src="../img/emoji5.png"><br> 
  <input type="checkbox" name="emoji6" id="checkboxemoji6"><br>
  <input type="textbox" maxlength="22" name="etichetta6" onchange="validazione(this,4)" onclick="setCheckbox(6)"><br>
  <input type="hidden" name="MAX_FILE_SIZE" value="30000000">
  <input  type="file" name="file6" accept="image/x-png,image/gif,image/jpeg"/> 
  </div>
 </div>
 

 
 </div>
 </form>
</div>
