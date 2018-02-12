<?php
include("config.php");
include("filtro.php");
if(empty($_POST["email"])){
header('location: main.php?p=pannello_ban_page&message=Form incompleto');
$mysqli->close();
}
$email = filtra($_POST["email"]);
$query="UPDATE utenti SET ban=IF(ban=1,0,1) WHERE email='".$email."'";

$result=$mysqli->query($query);
header('location: main.php?p=pannello_ban_page&message=Operazione effettuata');
$mysqli->close();

?>