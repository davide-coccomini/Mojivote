<div id="categorieprof">
		<ul>
		<?php
		$arrayc=array("random","politica","spettacolo","videogiochi","anime","attualita","cibo","sport","scienza","musica","letteratura","altro");
		$arrayet=array("Ordine cronologico","Politica","Cinema e spettacolo","Videogiochi","Anime e manga","Attualità","Cibo e cucina","Sport","Scienza e tecnologia","Musica","Libri e letteratura","Altro");

        for($i=0;$i<count($arrayc);$i++)
		{
            	$style="background:url(../img/imgsection/".$arrayc[$i].".jpg);background-size:100% 100%;";
                $fun="aggiornaSfondo('".$arrayc[$i]."')";
				echo "<a onmouseover=".$fun." href='main.php?p=profilo&s=mieisondaggi&c=".$arrayc[$i]."'><li style='".$style."'><div class='labelsection'><label>".$arrayet[$i]."</label></div></li></a>";
        }
        
			
		?>
		</ul>
</div>
	