<?php
	if(isset($_GET["message"]) && $_SESSION["letto"]==0)
	{
		echo "<div id='messagecontent' style='opacity:0;' onclick='fade('messagecontent','out',1)'><div id='messagebox'><img src='../img/alerticon.png' id='messageimg'><p>".$_GET['message']."</p></div></div>";
		echo "<script>setTimeout(function(){fade('messagecontent','in',1.5)});</script>";
        $_SESSION["letto"]=1;
	}
	if(isset($_GET["imessage"]) && $_SESSION["letto"]==0)
	{
		echo "<div id='messagecontent' style='opacity:0;' onclick='fade('messagecontent','out',1)'><div id='messagebox'><img src='img/alerticon.png' id='messageimg'><p>".$_GET['imessage']."</p></div></div>";
		echo "<script>setTimeout(function(){fade('messagecontent','in',1.5)});</script>";
        $_SESSION["letto"]=1;
	}
?>