<?php
	include("config.php");
	include("filtro.php");
    include("admincontrol.php");

		
		if(! isset ($_GET["c"]))
		{
			$_GET["c"]="random";
		}
		if(isset($_GET["id"])){
			$categoria=filtra($_GET["c"]);
			$cat=strtolower($categoria);
			$idsondaggio=filtra($_GET["id"]);
		}
		$query="SELECT idsondaggio,titolo,etichetta,img,emoticon,contatore,nome,cognome,datacreazione,categoria,voti FROM sondaggi NATURAL JOIN associazioni NATURAL JOIN utenti WHERE eliminato=0 AND idsondaggio=$idsondaggio ORDER BY idsondaggio DESC, emoticon ASC";
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
            

	$queryvotato="SELECT COUNT(*) as numero FROM votisondaggi WHERE idsondaggio=".$idsondaggio." AND idutente=".$_COOKIE['idutente'];
	$risul=$mysqli->query($queryvotato);
	$fetch=$risul->fetch_assoc();
	if($fetch["numero"]!=0) $votato=1;
	else $votato=0;
				
	$query="SELECT COUNT(*) as numero FROM sondaggi NATURAL JOIN associazioni WHERE idsondaggio=".$idsondaggio;
	$result=$mysqli->query($query);
	$row=$result->fetch_assoc();		
	$numeroAss=$row["numero"];
	
	
	$query="SELECT * FROM sondaggi NATURAL JOIN associazioni WHERE idsondaggio=".$idsondaggio;
	$result=$mysqli->query($query);	
   		
	
    	$queryattivati="SELECT idsondaggio,emoticon FROM sondaggi NATURAL JOIN associazioni WHERE eliminato=0 AND idsondaggio=".$idsondaggio." ORDER BY idsondaggio DESC";
		$res=$mysqli->query($queryattivati);
	
	
		 
		 for($g=0;$g<6;$g++)
		 {
			$attivati[$g]=10;
		 }
			while($ro=$res->fetch_assoc())
			{
				$attivati[7]=(int)($ro["idsondaggio"]);
				$attivati[$ro["emoticon"]]=(int)($ro["emoticon"]);	
			}
		
 
	
?>

<div id="descrizione">

<div id="mainright">
		<div id="sondaggiocontenitore">
<?php
$row=$result->fetch_assoc();
$titolo=$row['titolo'];
$admin=isAdmin();
if($admin==false)
	echo "<div class='sondaggiotitolo'><button id='discussionesondaggio'><button id='sharesondaggio' onclick='apriShareBox(".$idsondaggio.")'></button></button>".$titolo."<button id='myBtn' class='sondaggioinfobutton'></button></div>";
else
	echo "<div class='sondaggiotitolo'><img src='../img/crossicon.png' class='buttondeletesondaggio' onclick=cancellaSondaggio(".$row['idsondaggio'].")><button id='discussionesondaggio'><button id='sharesondaggio' onclick='apriShareBox(".$idsondaggio.")'></button></button>".$titolo."<button id='myBtn' class='sondaggioinfobutton'></button></div>";

?>
		<div id="displaysondaggiovisit">


<?php

			echo "<div class='sondaggiocenter'>";
			do{ 
            	$k=0;
				$exp=explode(".",$row["img"]);
				$extension = end($exp);
				$nomefile = basename($row['img'],".".$extension);
				
			echo "<div class='sondaggioassociazione".$numeroAss."'>
					<div class='sondaggioetichetta'>".$row['etichetta']."</div>
					<img src='../img/imgsondaggi/".$nomefile.$row['contatore'].".".$extension."' class='sondaggiimg'>
					<input type='textbox' id=v".$k." class='associazionevoti".$numeroAss."' value=".$row['Voti']." disabled>
					<img src='../img/emoji".$row['emoticon'].".png' class='sondaggiemoji".$numeroAss."'>
				  </div>";
                  $k++;
			}while($row=$result->fetch_assoc());
			echo "</div>";
			if($votato==0){
			 echo"<div class='sondaggiotastiera'>";
             $b=0;
				for ($p=0;$p<6;$p++)
				{
					if($attivati[$p]==$p)
					{	
                    	
					    echo "<img src='../img/emoji".$p.".png' class='sondaggiotastoenabled' name=t".$b." onclick='inserisciVotoVisit(this,".$matrice[0][0].",0)' id='imgtastiera".$p."'>";
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
	</div>
	
<?php /*COMMENTI*/
$query="SELECT COUNT(*) as numero FROM commentisondaggi NATURAL JOIN utenti NATURAL JOIN sondaggi WHERE idsondaggio=".$idsondaggio;
$result=$mysqli->query($query);
$row=$result->fetch_assoc();
$numerocommentitot=$row["numero"];

$query="SELECT * FROM commentisondaggi NATURAL JOIN utenti NATURAL JOIN sondaggi WHERE idsondaggio=".$idsondaggio." ORDER BY idcommentosondaggio DESC";
$result=$mysqli->query($query);

$voci=array("idutente","nome","cognome","imgprof","idsondaggio","titolo","data","orario","testo",);
$infocommenti="";

$presenza=false;
	echo "<div id='commenticontent'><div id='commentiwrapper'><div id='commentititolo'>".$titolo."</div><div class='commentibox'>";
			 
	for($i=0;$i<$numerocommentitot;$i++)
	{
		$row=$result->fetch_assoc();
		$exp=explode(".",$row["imgprof"]);
		$extension = end($exp);
		$nomefile = basename($row['imgprof'],".".$extension);
		$file=$nomefile.$row["contatoreimg"].".".$extension;
		
		  echo "<div class='commenticenter'><div class='commentitop'><div class='commentifoto'><img src='../img/imgprof/".$file."'></div>
		  <div class='commentiinfo'><div class='commentinome'>".$row['nome']." ".$row['cognome']." </div><div class='commentidata'>".$row['data']." ".$row['orario']."</div></div></div>
		  <div class='commentitesto'>".$row['testo']."</div>
		  </div>";
		  $presenza=true;
	}
	
	if($presenza==false)
	{
		echo "<div id='nessuncommento'>Nessuno ha ancora commentato questo sondaggio!</div>";
	}
	echo "</div><div id='formcommento'>
	<input type='button' class='button' value='Commenta' onclick='inserisciCommento(".$idsondaggio.")'><textarea id='textarea' rows='4' cols='50'></textarea></div></div></div>";
	



?>

<div id="myModal" class="modal">

  <div id="dialog" class="modal-content">
    <span class="close">x</span>
	
    <p id="paragrafo">
	<b>Titolo:</b>
	<?php
		echo $titolo."<br><br>";
	?>
	<b>Autore:</b>
	<?php
		echo $row['nome']." ".$row['cognome']."<br><br>";
	?>
	<b>Data creazione:</b>
	<?php
		echo $row['datacreazione']."<br><br>";
	?>
	<b>Categoria:</b>
	<?php
		echo $cat."<br><br>";
	?>
	</p>
	
	
  </div>


</div>
<script>

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
	
	$.ajax({
	  type: "GET",
	  url: "../php/inseriscicommento.php",
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
	
}

</script>

    <script type="text/javascript">
      var matrice = <?php echo json_encode( $matrice ) ?>;
      </script>
      <script>

function cancellaSondaggio(id) {
  var domanda = confirm("Sei sicuro di voler cancellare?");
  if (domanda === true) {
    location.href = 'eliminasondaggio.php?id='+id;  
  }
}

</script>
