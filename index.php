<html lang="it">
<head>
<title>Mojivote</title>
<link rel="icon" href="img/favicon.png" type="image/png" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="javascript/main.js"></script>
<script type="text/javascript" src="javascript/login_fb.js"></script>
<script src="javascript/cookie.js"></script>
<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body id="bodyindex">
<!--<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/it_IT/sdk.js#xfbml=1&version=v2.8&appId=1166271176826249";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
-->
<?php
	session_start();
	include("php/messages.php");
    
    if((isset($_COOKIE["login"]) && $_COOKIE["login"]==1)) //ciao davide <3
	{
		header('location: '.'php/main.php?p=menucategorie');
		$_SESSION["letto"]=0;
		//$mysqli->close();
		die();
	}

?>
<div id="wrapper">
<div id="topbar">
<div id="logo">
</div>
<div id="logincontent">
	<form id="formlogin" method="post" action="php/login_process.php">
		<label>Email:</label><input type="email" name="email">
		<label>Password:</label><input type="password" name="password">
		<input type="submit" id="loginbutton" value="ENTRA" class="button">
	</form>
</div>
</div>
<div id="registrazionecontent">
<div id="registrazioneleft">
<form id="formregistrazione" method="post" action="php/registrazione_process.php">
<fieldset>
<div><label>Nome</label></div><input type="textbox" maxlength="15" name="nome" onchange="validazione(this,0)" value="<?php if(isset ($_GET["nome"])) echo $_GET['nome']; ?>">
</fieldset>
<fieldset>
<div><label>Cognome</label></div><input type="textbox" maxlength="15" name="cognome" onchange="validazione(this,0)"  value="<?php if(isset ($_GET["cognome"])) echo $_GET['cognome']; ?>">
</fieldset>
<fieldset>
<div><label>Password</label></div><input type="password" maxlength="25" name="password" onchange="validazione(this,1)" >
</fieldset>
<fieldset>
<div><label>Data di nascita</label></div>
<select name="giorno" class='dataselect'>
<?php
for($i=1; $i<32; $i++){
echo '<option value="'.$i.'">'.$i.'</option>';
}
?>
</select>

<select name="mese" class='dataselect'>
<?php
for($i=1; $i<13; $i++){
echo '<option value="'.$i.'">'.$i.'</option>';
}
?>
</select>

<select name="anno" class='dataselect'>
<?php
for($i=1940; $i<2011; $i++){
echo '<option value="'.$i.'">'.$i.'</option>';
}
?>
</select>
</fieldset>
<fieldset>
<div><label>Email</label></div><input type="email" name="email"  onchange="validazione(this,3)" value="<?php if(isset ($_GET["email"])) echo $_GET['email']; ?>">
</fieldset>
<fieldset>
<label>Uomo</label>
<input id="radio1" class="radio" type="radio" name="sesso" value="0"/>
<label>Donna</label><input id="radio2" class="radio" type="radio" name="sesso" value="1"/>
</fieldset>
<input type="submit" class="button" id="pulsanteregistrazione" value="Registrati">
</form>
</div>
<div id="registrazioneright">
</div>

<fb:login-button scope="public_profile,user_birthday,email" onlogin="checkLoginState();">
</fb:login-button>

</div>
</div>
</body>
</html>