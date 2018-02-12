 <?php
 
 $categorie=array("Gestione generale","Gestione utenti","Gestione sondaggi");
    $categorielink=array("pannello_generale","pannello_utenti","pannello_sondaggi");
  	echo"
   		    <div id='pannelloleft'>
           	<ul>";
            	for($i=0;$i<count($categorie);$i++)
                {	
                	echo "<a href='main.php?p=".$categorielink[$i]."'><li>".$categorie[$i]."</li></a>";
                }
    echo"</ul></div>";
                
 ?>