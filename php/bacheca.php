<?php
	include("config.php");
	include("filtro.php");
	
		
		if(! isset ($_GET["c"]))
		{
			$_GET["c"]="random";
		}
		if(isset($_GET["c"])){
			$cat=$_GET["c"];
		}
		if($_COOKIE["tutorial"]<1)
        {
        	echo "<script>setTimeout(function(){tutorial(2)},300);</script>";
        }
		
	echo"<script>setTimeout(function(){aggiornaSfondo('".$cat."');},200);</script>";	
	if($cat=="random"){	
		$querynumerosondaggi="SELECT COUNT(*) as numero FROM sondaggi WHERE eliminato=0";
		$res=$mysqli->query($querynumerosondaggi);
		$ro=$res->fetch_assoc();
		$numerosondaggi=$ro["numero"];
		
		$querynumeroass="SELECT COUNT(*) as numero FROM associazioni NATURAL JOIN sondaggi WHERE eliminato=0";
		$res=$mysqli->query($querynumeroass);
		$ro=$res->fetch_assoc();
		$numeroass=$ro["numero"];
		
		$queryattivati="SELECT idsondaggio,emoticon FROM sondaggi NATURAL JOIN associazioni WHERE eliminato=0 ORDER BY idsondaggio DESC";
		$res=$mysqli->query($queryattivati);
		$ro=$res->fetch_assoc();
		
		for($k=0;$k<$numerosondaggi;$k++)
		{
		 $prec=$ro["idsondaggio"];
		 for($g=0;$g<6;$g++)
		 {
			$attivati[$k][$g]=10;
		 }
         
			for($h=0;$ro["idsondaggio"]==$prec;$h++)
			{
				$attivati[$k][7]=(int)($ro["idsondaggio"]);
				$attivati[$k][$ro["emoticon"]]=(int)($ro["emoticon"]);
				$prec=$ro["idsondaggio"];
				$ro=$res->fetch_assoc();
			}
		}	
        $query="SELECT idsondaggio,titolo,etichetta,img,emoticon,contatore,nome,cognome,datacreazione,categoria,voti FROM sondaggi NATURAL JOIN associazioni NATURAL JOIN utenti WHERE eliminato=0 ORDER BY idsondaggio DESC,emoticon ASC";
	}else{
		$querynumerosondaggi="SELECT COUNT(*) as numero FROM sondaggi WHERE eliminato=0 AND categoria='".$cat."'";
		$res=$mysqli->query($querynumerosondaggi);
		$ro=$res->fetch_assoc();
		$numerosondaggi=$ro["numero"];
		
		$querynumeroass="SELECT COUNT(*) as numero FROM associazioni NATURAL JOIN sondaggi WHERE eliminato=0 AND categoria='".$cat."'";
	
		$res=$mysqli->query($querynumeroass);
		$ro=$res->fetch_assoc();
		$numeroass=$ro["numero"];
		
		$queryattivati="SELECT idsondaggio,emoticon FROM sondaggi NATURAL JOIN associazioni WHERE eliminato=0 AND categoria='".$cat."' ORDER BY idsondaggio DESC,emoticon ASC";
		$res=$mysqli->query($queryattivati);
		$ro=$res->fetch_assoc();
	
		
		for($k=0;$k<$numerosondaggi;$k++)
		{
		 $prec=$ro["idsondaggio"];
		 for($g=0;$g<6;$g++)
		 {
			$attivati[$k][$g]=10;
		 }
			for($h=0;$ro["idsondaggio"]==$prec;$h++)
			{
				
				$attivati[$k][7]=(int)($ro["idsondaggio"]);
				$attivati[$k][$ro["emoticon"]]=(int)($ro["emoticon"]);
				$prec=$ro["idsondaggio"];
				$ro=$res->fetch_assoc();
			}
		}
		
		$querynumeroass="SELECT COUNT(*) as numero FROM associazioni NATURAL JOIN sondaggi WHERE eliminato=0 AND categoria='".$cat."'";
		$res=$mysqli->query($querynumeroass);
		$ro=$res->fetch_assoc();
		$numeroass=$ro["numero"];
		
		$query="SELECT idsondaggio,titolo,etichetta,img,emoticon,contatore,nome,cognome,datacreazione,categoria,voti FROM sondaggi NATURAL JOIN associazioni NATURAL JOIN utenti WHERE eliminato=0 AND categoria='".$cat."' ORDER BY idsondaggio DESC, emoticon ASC";

	}
			
			$result=$mysqli->query($query);
			$matrice="";
			$voci=array("idsondaggio","titolo","etichetta","img","emoticon","contatore","nome","cognome","datacreazione","categoria","voti","emoticon1","emoticon2");
			$i=0;
			while($row=$result->fetch_assoc())
			{
				$querynumero="SELECT COUNT(*) as numero FROM sondaggi NATURAL JOIN associazioni WHERE  eliminato=0 AND idsondaggio=".$row['idsondaggio']." GROUP BY idsondaggio ORDER BY idsondaggio DESC,emoticon ASC";
				$risultato=$mysqli->query($querynumero);
				$riga=$risultato->fetch_assoc();

				$queryvotato="SELECT COUNT(*) as numero FROM votisondaggi WHERE idsondaggio=".$row['idsondaggio']." AND idutente=".$_COOKIE['idutente'];
			
                $risul=$mysqli->query($queryvotato);
				$fetch=$risul->fetch_assoc();
				if($fetch["numero"]!=0) $votato=1;
				else $votato=0;
			
				
				$num=$riga["numero"];
				for($j=0;$j<count($row);$j++)
				{
					$matrice[$i][$j]=$row[$voci[$j]];	
					$matrice[$i][11]=$num;
					$exp=explode(".",$row["img"]);
					$extension = end($exp);
					$nomefile = basename($row['img'],".".$extension);
					$matrice[$i][12]=$nomefile;
					$matrice[$i][13]=$extension;
					$matrice[$i][14]=$votato;
				
			
					/* 0:idsondaggio; 1:titolo; 2:etichetta; 3:img; 4:emoticon; 5:contatore; 6:nome; 7:cognome;8:datacreazione;
					9:categoria;10:voti;11:numero associazioni;12:file senza ext;13:ext; 14:votato; */
				}
			 $i++;
			}
            
			$l=0;
			for($l=0;$matrice[$l][0]!=$matrice[$numeroass-1][0];$l++){}
			
			
?>
<div id="descrizione">
	
	<div id="mainright">
     <div id="frecciaboxsx">
		<button id="frecciasx"  onclick='scorri("sx")' <?php echo"name='".($l)."'";?>></button>
     </div>
		<div id="sondaggiocontenitore">
        <?php echo "<div class='sondaggiotitolo'><div class='sondaggiobuttonset'><button id='sharesondaggio' onclick='apriShareBox(".$matrice[0][0].")'></button><button id='discussionesondaggio'></button></div>".$matrice[0][1]."<button id='myBtn' class='sondaggioinfobutton'></button></div>";
			?>
		<div id="displaysondaggio">
		<?php
		
			echo "<div class='sondaggiocenter'>";
			for($k=0;$k<$matrice[0][11];$k++){ 
			echo "<div class='sondaggioassociazione".$matrice[0][11]."'>
					<div class='sondaggioetichetta'>".$matrice[$k][2]."</div>
					<img src='../img/imgsondaggi/".$matrice[$k][12].$matrice[$k][5].".".$matrice[$k][13]."' class='sondaggiimg'>
					<input type='textbox' id=v".$k." class='associazionevoti".$matrice[0][11]."' value=".$matrice[$k][10]." disabled>
					<img src='../img/emoji".$matrice[$k][4].".png' class='sondaggiemoji".$matrice[0][11]."'>
				  </div>";
			}
			echo "</div>";
			if($matrice[0][14]==0){
			 $b=0;
			 echo"<div class='sondaggiotastiera'>";
				for ($p=0;$p<6;$p++)
				{
					if($attivati[0][$p]==$p)
					{	
					    echo "<img src='../img/emoji".$p.".png' class='sondaggiotastoenabled' name=t".$b." onclick='inserisciVoto(this,".$matrice[0][0].",0);punti(1);' id='idimgtastiera".$p."'>";
						$b++;
                    }else{
						echo "<img src='../img/emoji".$p.".png' class='sondaggiotastodisabled'>";
					}
				}
			}else{
			 echo"<div class='sondaggiotastieradisabled'>";
				for ($p=0;$p<6;$p++)
				{
				echo "<img src='../img/emoji".$p.".png'>";
				}
			}
			echo "</div>";

			
		?>
		</div>
		</div>
        <div id="frecciaboxdx">
		<button id="frecciadx" onclick="scorri('dx')" name='<?php echo $matrice[0][11]; ?>' >    </button>
		</div>
	</div>
	
	<?php
/*CREAZIONE BOX COMMENTI*/
if($cat=="random"){
	$query="SELECT COUNT(*) as numero FROM (commentisondaggi C INNER JOIN sondaggi S ON S.idsondaggio=C.idsondaggio) INNER JOIN utenti U ON U.idutente=C.idutente WHERE S.eliminato=0";
}else{
	$query="SELECT COUNT(*) as numero FROM (commentisondaggi C INNER JOIN sondaggi S ON S.idsondaggio=C.idsondaggio) INNER JOIN utenti U ON U.idutente=C.idutente WHERE eliminato=0 AND categoria='".$cat."'";
}
$result=$mysqli->query($query);
$row=$result->fetch_assoc();
$numerocommentitot=$row["numero"];

if($cat=="random"){
	$query="SELECT C.idutente,U.nome,U.cognome,U.imgprof,U.contatoreimg,S.idsondaggio,S.titolo,C.data,C.orario,C.testo FROM (commentisondaggi C INNER JOIN sondaggi S ON S.idsondaggio=C.idsondaggio) INNER JOIN utenti U ON U.idutente=C.idutente WHERE S.eliminato=0 ORDER BY C.idcommentosondaggio DESC";
	
	}else{
	$query="SELECT C.idutente,U.nome,U.cognome,U.imgprof,U.contatoreimg,S.idsondaggio,S.titolo,C.data,C.orario,C.testo FROM (commentisondaggi C INNER JOIN sondaggi S ON S.idsondaggio=C.idsondaggio) INNER JOIN utenti U ON U.idutente=C.idutente WHERE eliminato=0 AND categoria='".$cat."' ORDER BY C.idcommentosondaggio DESC";	
}

$result=$mysqli->query($query);

$voci=array("idutente","nome","cognome","imgprof","idsondaggio","titolo","data","orario","testo",);
$infocommenti="";
	for($i=0;$row=$result->fetch_assoc();$i++)
	{
		for($j=0;$j<sizeof($voci);$j++)
		{
			if($voci[$j]=="imgprof"){
				$exp=explode(".",$row["imgprof"]);
				$extension = end($exp);
				$nomefile = basename($row['imgprof'],".".$extension);
				$infocommenti[$i][$j]=$nomefile.$row["contatoreimg"].".".$extension;
			}else{
				$infocommenti[$i][$j]=$row[$voci[$j]];
			}
		}
	}
	
	$presenza=false;
	echo "<div id='commenticontent'><div id='commentiwrapper'><div id='commentititolo'>".$matrice[0][1]."</div><div class='commentibox'>";
			 
	for($i=0;$i<$numerocommentitot;$i++)
	{
		if($infocommenti[$i][4]==$matrice[0][0])
		{	
		  echo "<div class='commenticenter'><div class='commentitop'><div class='commentifoto'><img src='../img/imgprof/".$infocommenti[$i][3]."'></div>
		  <div class='commentiinfo'><div class='commentinome'>".$infocommenti[$i][1]." ".$infocommenti[$i][2]." </div><div class='commentidata'>".$infocommenti[$i][6]." ".$infocommenti[$i][7]."</div></div></div>
		  <div class='commentitesto'>".$infocommenti[$i][8]."</div>
		  </div>";
		  $presenza=true;
		}
	}
	if($presenza==false)
	{
		echo "<div id='nessuncommento'>Nessuno ha ancora commentato questo sondaggio!</div>";
	}
	echo "</div><div id='formcommento'>
	<input type='button' class='button' value='Commenta' onclick='inserisciCommento(".$matrice[0][0].")'><textarea id='textarea' rows='4' cols='50'></textarea></div></div>";

?>

</div>
<div id="myModal" class="modal">

  <div id="dialog" class="modal-content">
    <span class="close">x</span>
	
    <p id="paragrafo">
	<b>Titolo:</b>
	<?php
		echo $matrice[0][1]."<br><br>";
	?>
	<b>Autore:</b>
	<?php
		echo $matrice[0][6]." ".$matrice[0][7]."<br><br>";
	?>
	<b>Data creazione:</b>
	<?php
		echo $matrice[0][8]."<br><br>";
	?>
	<b>Categoria:</b>
	<?php
		echo $matrice[0][9]."<br><br>";
	?>
	</p>
	
	
  </div>


</div>

<script type="text/javascript">
/* 0:idsondaggio; 1:titolo; 2:etichetta; 3:img; 4:emoticon; 5:contatore; 6:nome; 7:cognome;8:datacreazione;
   9:categoria;10:numero associazioni;11:file senza ext;12:ext */

   var attivati = <?php echo json_encode( $attivati ) ?>;
   
   var matrice = <?php echo json_encode( $matrice ) ?>;
function scorri(f){
// d=numero associazioni della prima + 1

var numeroSondaggi = <?php echo json_encode( $numerosondaggi ) ?>;

	if(f=="sx")
	{
		var succ=document.getElementById("frecciasx");
		var d=parseInt(succ.name);
		for(var m=0;matrice[m][0]!=matrice[d][0];m++){}
		
		d=m;
	}else{
		var succ=document.getElementById("frecciadx");
		var d=parseInt(succ.name);
	}

	var contenitore = document.getElementById("sondaggiocontenitore");
	var eliminabile = document.getElementById("displaysondaggio");
    var eliminabiletitolo=document.getElementsByClassName("sondaggiotitolo")[0];
	var idSondaggio=matrice[d][0];
	
	// Rimuovo il vecchio
	contenitore.removeChild(eliminabile);
	contenitore.removeChild(eliminabiletitolo);
    
    // Creo il nuovo titolo e lo appendo
	var titolo = matrice[d][1];
	var titolobox=document.createElement("div");
	titolobox.className="sondaggiotitolo";
	contenitore.appendChild(titolobox);
	var t=document.createTextNode(titolo);
	titolobox.appendChild(t);
	
   
	//Creo il bottone info e lo appendo (manca da richiamare la funzione JS per il dialog)
	var button=document.createElement("button");
	button.id="myBtn";
	button.className="sondaggioinfobutton";
	titolobox.appendChild(button);
	
 
	//Creo il nuovo display e lo appendo
	var display=document.createElement("div");
	display.id="displaysondaggio";
	contenitore.appendChild(display);
	
	
	//Creo sondaggiocenter e lo appendo
	var center=document.createElement("div");
	center.className="sondaggiocenter";
	display.appendChild(center);
	
	//Creo le associazioni
	var numAss=matrice[d][11];                              
    for(var i=0;i<numAss;i++)                     
	{
		var associazione=document.createElement("div");
		associazione.className="sondaggioassociazione"+numAss;
		//titoli
		var etichettabox=document.createElement("div");
		etichettabox.className="sondaggioetichetta";
		var etichetta=document.createTextNode(matrice[d+i][2]);
		etichettabox.appendChild(etichetta);
		associazione.appendChild(etichettabox);
		//img
		var img=document.createElement("img");
		img.src="../img/imgsondaggi/"+matrice[d+i][12]+matrice[d+i][5]+"."+matrice[d+i][13];
		img.className="sondaggiimg";
		associazione.appendChild(img);
		//voto
		var votobox=document.createElement("input");
		votobox.type="textbox";
		votobox.disabled=true;
		votobox.className="associazionevoti"+numAss;
		votobox.id="v"+i;
		votobox.value=matrice[d+i][10];
		
		associazione.appendChild(votobox);
		var emoji=document.createElement("img");
		emoji.src="../img/emoji"+matrice[d+i][4]+".png";
		emoji.className="sondaggiemoji"+numAss;
		associazione.appendChild(emoji);
		center.appendChild(associazione);
	}
	
	//Creo la tastiera (d è il numero di associazioni)
	id=parseInt(matrice[d+1][0]);
	
	for(var y=0;id!=attivati[y][7];y++){}
	
	id=y;
	var idsondaggio=attivati[y][7];
	var tastierabox=document.createElement("div");
	if(matrice[d][14]==0){
	 tastierabox.className="sondaggiotastiera";
	 var c=0;
	 var u=0;
		for(var j=0;j<6;j++)
		{		
			var imgtastiera=document.createElement("img");
			imgtastiera.src="../img/emoji"+j+".png";
			imgtastiera.id="idimgtastiera"+j;
			if(attivati[id][j]==j){
         	
			imgtastiera.onclick = function(){
            						punti(1);
									inserisciVoto(this,idsondaggio,d);
						 		  };
			imgtastiera.name="t"+u;
            imgtastiera.className="sondaggiotastoenabled";
			u++;
			}else{
				imgtastiera.className="sondaggiotastodisabled";
				imgtastiera.onclick=null;
			}
		 tastierabox.appendChild(imgtastiera);
		}
	}else{
	  tastierabox.className="sondaggiotastieradisabled";
		for(var j=0;j<6;j++)
		{
			
			var imgtastiera=document.createElement("img");
			imgtastiera.src="../img/emoji"+j+".png";
			tastierabox.appendChild(imgtastiera);
		}
	}
	display.appendChild(tastierabox);
		
	 //Creo il bottone share e lo appendo
    var button=document.createElement("button");
    button.id="sharesondaggio";
    button.onclick=function(){
					 apriShareBox(matrice[d][0]);
				   }
    titolobox.appendChild(button);

	//Aggiorno le informazioni di info
	var eliminabile=document.getElementById("paragrafo");
	var content=document.getElementById("dialog");
	content.removeChild(eliminabile);
	
	var paragrafobox=document.createElement("p");
	paragrafobox.id="paragrafo";
	content.appendChild(paragrafobox);
	
	var grastit=document.createElement("b");
	var tagtit=document.createTextNode("Titolo:  ");
	grastit.appendChild(tagtit);
	paragrafobox.appendChild(grastit);
	var tit=document.createTextNode(matrice[d][1]);
	var br1=document.createElement("br");
	var br2=document.createElement("br");
	paragrafobox.appendChild(tit);
	paragrafobox.appendChild(br1);
	paragrafobox.appendChild(br2);
	
	var grasaut=document.createElement("b");
	var tagaut=document.createTextNode("Autore:  ");
	grasaut.appendChild(tagaut);
	paragrafobox.appendChild(grasaut);
	var aut=document.createTextNode(matrice[d][6]+" "+matrice[d][7]);
	var br3=document.createElement("br");
	var br4=document.createElement("br");
	paragrafobox.appendChild(aut);
	paragrafobox.appendChild(br3);
	paragrafobox.appendChild(br4);
	
	var grasdata=document.createElement("b");
	var tagdata=document.createTextNode("Data di creazione:  ");
	grasdata.appendChild(tagdata);
	paragrafobox.appendChild(grasdata);
	var data=document.createTextNode(matrice[d][8]);
	var br5=document.createElement("br");
	var br6=document.createElement("br");
	paragrafobox.appendChild(data);
	paragrafobox.appendChild(br5);
	paragrafobox.appendChild(br6);
	
	var grascat=document.createElement("b");
	var tagcat=document.createTextNode("Categoria:  ");
	grascat.appendChild(tagcat);
	paragrafobox.appendChild(grascat);
	var br7=document.createElement("br");
	var br8=document.createElement("br");
	var cat=document.createTextNode(matrice[d][9]);
	paragrafobox.appendChild(cat);
	paragrafobox.appendChild(br7);
	paragrafobox.appendChild(br8);
	
    
    
    
    
	inizializzaDialog();
	setTimeout('inizializzaCommenti()',200);
	setTimeout('aggiornaTastiBacheca('+d+')',200);         

	//Aggiorno le informazioni dei commenti
	var scope=document.getElementsByClassName("sondaggiotitolo")[0];
	var button=document.createElement("button");
	button.id="discussionesondaggio";
	scope.appendChild(button);
	
	var eliminabile=document.getElementById("commentiwrapper");
	var content=document.getElementById("commenticontent");
	content.removeChild(eliminabile);
	
	var wrapper=document.createElement("div");
	wrapper.id="commentiwrapper";
	content.appendChild(wrapper);
	var presenza=false;
	var infocommenti = <?php echo json_encode( $infocommenti ) ?>;
	var numerocommentitot = <?php echo json_encode( $numerocommentitot ) ?>;

		
		var titolobox=document.createElement("div");
		titolobox.id="commentititolo";
		var titolo=document.createTextNode(matrice[d][1]);
		titolobox.appendChild(titolo);
		wrapper.appendChild(titolobox);
	
	var box=document.createElement("div");
	box.className="commentibox";
	wrapper.appendChild(box);	
	
	
	for(var i=0;i<numerocommentitot;i++)
	{
		if(infocommenti[i][4]==matrice[d][0]){
			var centerbox=document.createElement("div");
			centerbox.className="commenticenter";
			box.appendChild(centerbox);
			var topbox=document.createElement("div");
			topbox.className="commentitop";
			centerbox.appendChild(topbox);
			var fotobox=document.createElement("div");
			fotobox.className="commentifoto";
			topbox.appendChild(fotobox);
			var foto=document.createElement("img");
			foto.src="../img/imgprof/"+infocommenti[i][3];
			fotobox.appendChild(foto);
			var infobox=document.createElement("div");
			infobox.className="commentiinfo";
			topbox.appendChild(infobox);
			var nomebox=document.createElement("div");
			nomebox.className="commentinome";
			infobox.appendChild(nomebox);
			var nome=document.createTextNode(infocommenti[i][1]+infocommenti[i][2]);
			nomebox.appendChild(nome);
			
			var databox=document.createElement("div");
			databox.className="commentidata";
			infobox.appendChild(databox);
			var data=document.createTextNode(infocommenti[i][6]+" "+infocommenti[i][7]);
			databox.appendChild(data);
			
			var testobox=document.createElement("div");
			testobox.className="commentitesto";
			centerbox.appendChild(testobox);
			var testo=document.createTextNode(infocommenti[i][8]);
			testobox.appendChild(testo);
			presenza=true;
		}
	}
	
	if(presenza==false)
	{
		var testobox=document.createElement("div");
		testobox.id="nessuncommento";
		box.appendChild(testobox);
		var testo=document.createTextNode("Nessuno ha ancora commentato questo sondaggio!");
		testobox.appendChild(testo);		
	}
	var form=document.createElement("div");
	form.id="formcommento";
	var button=document.createElement("input");
	button.type="button";
	button.className="button";
	button.onclick=function(){
					 inserisciCommento(matrice[d][0]);
				   }
	button.value="Commenta";
	form.appendChild(button);
	var textarea=document.createElement("textarea");
	textarea.rows="4";
	textarea.cols="50";
	textarea.id="textarea";

	form.appendChild(textarea);
	wrapper.appendChild(form);

}


function aggiornaTastiBacheca(d)
{
	var matrice = <?php echo json_encode( $matrice ) ?>;
	var sx=document.getElementById("frecciasx");
	var dx=document.getElementById("frecciadx");
	var numeroAss = <?php echo json_encode( $numeroass ) ?>; 
	if(d!=0)
		sx.name=d-(matrice[d-1][11]);
	else
		sx.name=numeroAss-1;


	if((parseInt(d)+parseInt(matrice[d][11]))+1>=numeroAss)
	 dx.name=0
	else
	 dx.name=parseInt(d)+parseInt(matrice[d][11]);
}


function inserisciCommento(id)
{	

   var imgprof = <?php echo json_encode( $_COOKIE["imgprof"] ) ?>;
   var nome = <?php echo json_encode( $_COOKIE["nome"] ) ?>;
   var cognome = <?php echo json_encode( $_COOKIE["cognome"] ) ?>;
   var data = new Date();
   var gg, mm, aaaa;
   gg = data.getDate() + "/";
   mm = data.getMonth() + 1 + "/";
   aaaa = data.getFullYear();
   var orario=new Date();
   var h,m;
   h=orario.getHours();
   m=orario.getMinutes();
   
    var textarea=document.getElementById("textarea");
	var testo=textarea.value;
	textarea.value="";
    var lung=testo.length;
    
    if(lung>4 && lung<10000)
	{
	$.ajax({
	  type: "GET",
	  url: "inseriscicommento.php",
	  data: "id="+id+"&testo="+testo+"",
	  dataType: "html",
	});
	
	var scope=document.getElementsByClassName("commentibox")[0];
	if(scope.firstChild.id=='nessuncommento')
	{
		var eliminabile=document.getElementById("nessuncommento");
		scope.removeChild(eliminabile);
	}	
	var centerbox=document.createElement("div");
	centerbox.className="commenticenter";
	scope.appendChild(centerbox);
	var primo=document.getElementsByClassName("commenticenter")[0];
	scope.insertBefore(centerbox, primo);
	
	
	var topbox=document.createElement("div");
	topbox.className="commentitop";
	centerbox.appendChild(topbox);
	var fotobox=document.createElement("div");
	fotobox.className="commentifoto";
	topbox.appendChild(fotobox);
	var foto=document.createElement("img");
	foto.src="../img/imgprof/"+imgprof;
	fotobox.appendChild(foto);
	var infobox=document.createElement("div");
	infobox.className="commentiinfo";
	topbox.appendChild(infobox);
	var nomebox=document.createElement("div");
	nomebox.className="commentinome";
	infobox.appendChild(nomebox);
	var nome=document.createTextNode(nome+" "+cognome);
	nomebox.appendChild(nome);
	var databox=document.createElement("div");
	databox.className="commentidata";
	infobox.appendChild(databox);
	var data=document.createTextNode(gg+mm+aaaa+" "+h+":"+m);
	
	databox.appendChild(data);
	var testobox=document.createElement("div");
	testobox.className="commentitesto";
	centerbox.appendChild(testobox);
	var testo=document.createTextNode(testo);
	testobox.appendChild(testo);
  }else{
   	alert("Commento invalido");
   }
}
 
</script>
