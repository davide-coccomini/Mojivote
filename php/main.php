<?php

	require_once("config.php");
	include("controlli.php");
    include("bancontrol.php");
	SESSION_start();
    
    if( (!isset($_COOKIE["login"])) || (isset($_COOKIE["login"]) && $_COOKIE["login"]!=1))
    {
		if(isset($_GET["id"])){
			$id=$_GET["id"];
			header('location: ../index.php?id='.$id.'&message=Effettua il login!');
			die();
		}else{
			header('location: ../index.php?message=Effettua il login!');
			die();
		}
    }
    $banned=isBanned();
    
    if($banned==true)
   	{
    	header('location: ../index.php?message=Il tuo account è bannato. Per ricevere supporto invia un email a contact@mojivote.com');
  		$_SESSION=NULL;
		die();
    }
	if($_SESSION["loading"]==0)
    {
    	echo"<div id='loading_screen'>
              <img src='../img/logomoji.png' id='loading_logo'>
              <div id='loading_text'>
                <p>Benvenuto su Mojivote!</p>
                <img src='../img/loadicon.gif'>
              </div>
            </div>";
            

		echo "<script>setTimeout(function(){fadeout('loading_screen',1)},3000);</script>";
        $_SESSION["loading"]=1;
    }

$query="SELECT punteggio FROM utenti WHERE idutente=".$_COOKIE['idutente'];
	$result=$mysqli->query($query);
	$row=$result->fetch_assoc();
	$newpunteggio=$row["punteggio"];
	setcookie("punteggio", $newpunteggio,time() + (10 * 365 * 24 * 60 * 60));
    
    	if(! isset ($_GET["p"]))
		{
			$_GET["p"]="bacheca";
		}
?>
<html lang="it">
<head><title>Mojivote</title>
<meta charset="utf-8" />
<link rel="icon" href="../img/favicon.png" type="image/png" />

<link rel="stylesheet" type="text/css" href="../css/styles.css">
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js'></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="../javascript/notifiche.js"></script>
<script type="text/javascript" src="../javascript/main.js"></script>
</head>

<body>
<div id="sectionbackground"></div>
<?php

/* SISTEMA NOTIFICHE*/

$query="SELECT COUNT(*) as numero FROM sondaggi NATURAL JOIN votisondaggi WHERE idutente=".$_COOKIE['idutente'];
$result=$mysqli->query($query);
$matrice="";

	for($i=0;$row=$result->fetch_assoc();$i++)
    {
    	$matrice[$i][0]=$row["idsondaggio"];
        $matrice[$i][1]=$row["titolo"];
        $matrice[$i][2]=$row["totalecommenti"];
        $matrice[$i][3]=$row["totalevoti"];
    }
$righe=$i+1;
?>


<script>
var matrice=<?php echo json_encode($matrice); ?>;
var righe=<?php echo json_encode($righe); ?>;
var newMatrice="";
var tempo = 1000; //modifica il tempo di apparizione della notifica
var diversi; 
var righeDiversi=0;
function notifica(notice) {
    $('<div class="notice" style="opacity:0"></div>')
    .append('<a href="#" class="chiudi"></a>')//Pulsante chiusura
    .append($('<div class="contenuto"></div>').html($(notice)))
    .hide()
    .appendTo('#notifica')
    .fadeIn(tempo);
}
//setInterval(function(){ generazioneNotifiche()},3000);

function generazioneNotifiche()
{
	recuperaNuovaMatrice();
    setTimeout(function(){confrontaMatrici();},4000);
	 setTimeout(function(){creaBoxNotifiche();},4000);
}
var aperto=false;
function creaBoxNotifiche() {
for(var m=0;m<righeDiversi;m++){
	if(diversi[m][2]==0){
  		notifica("<p>Qualcuno ha votato il tuo sondaggio: "+diversi[m][1]+" </p>"); //INSERISCI LE TUE NOTIFICHE QUI
    }else{
    	notifica("<p>Qualcuno ha commentato il tuo sondaggio: "+diversi[m][1]+" </p>"); //INSERISCI LE TUE NOTIFICHE QUI
    }
    
}
$("#notifica").fadeOut(1);
    //INIZIO CHIUSURA E RIAPERTURA NOTIFICA
    $("#riapri").click(
            function(){
            if(aperto==false){
            $("#notifica").fadeIn(1000);
            $(".chiudi").show();
            aperto=true;
            }else{
              $("#notifica").fadeOut(1000);
              $(".chiudi").hide();
              aperto=false;
            }        
     });
}



  
  </script>

<?php include("messages.php");?>


<div id="mainwrapper">
<div id="content">
<div id="maintopbar" class="maintopbar">
	<a href="main.php?p=bacheca"><div id="logomaintopbar">
	</div></a>
	<div id="ricerca">
		<form method="POST" action="main.php?p=ricerca_page">
			<select id='ricercacategoria' name="categoria">
				<option value="utenti">Utenti</option>
				<option value="sondaggi">Sondaggi</option>  				
			</select>
		<input type="textbox" name="testo">
		<input type="submit" class="button" id="pulsantericerca" value="CERCA">
		
		</form>
	</div>
	<div id="mainlefttopbar">
		<a href="main.php?p=profilo" class="linkbuttonmenu">
		<div id="buttonprof" <?php if($_GET["p"]=="profilo") echo "class='buttoncur'";?>>
		<div id="iconfoto">
			<?php
				$imgprof=$_COOKIE["imgprof"];
				echo "<img src='../img/imgprof/".$imgprof."'>";
			?>
		</div>
		<p>Profilo</p>
		</div>
		</a>
		<div class="divisore">
		</div>
		<a href="main.php?p=menucategorie" class="linkbuttonmenu">
		<div id="buttonhome" <?php if($_GET["p"]=="menucategorie") echo "class='buttoncur'";?>>
		<div id="iconhome">
		<img src='../img/homeicon.png'>	
		</div>
		<p>Categorie</p>
		</div>
		</a>
		<div class="divisore">
		</div>
		<a href="main.php?p=sondaggio_new_page" class="linkbuttonmenu">
		<div class="mainmenuicon">
          <div class="newsondaggioicon">
       
          </div>
		</div>
		</a>
		
		
		
		

		
      
		
		
		<a href="logout.php" class="linkbuttonmenu">
		<div class="mainmenuicon">
		<img src="../img/logouticon.png">
		</div>
		</a>
		<?php if($_SESSION["admin"]>0)
				echo"<a href='main.php?p=pannello_generale' class='linkbuttonmenu'>
					<div class='mainmenuicon'>
					<img src='../img/engineicon.png'>
					</div>
					</a>";
		?>
	</div>
</div>
	<?php
		
		if($_COOKIE["login"]==0){
			header('location: ../index.php');
			$mysqli->close();
			die();
		}
		if(isset($_GET["p"])){
			$pagina=$_GET["p"];
			include($pagina.".php");
		}
	?>
</div>
</div>
</body>
</html>

