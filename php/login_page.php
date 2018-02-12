<div id="topbar">
<div id="logo">
</div>
<div id="logincontent"><form id="formlogin"><label>Username:</label><input type="textbox"><label>Password:</label><input type="password"><input type="button" id="loginbutton" value="ENTRA" class="button" onclick="login_process"></form>
</div>
</div>
<div id="registrazionecontent">
<div id="registrazioneleft">
<form id="formregistrazione">
<fieldset>
<div><label>Username</label></div><input type="textbox" name="Username">
</fieldset>
<fieldset>
<div><label>Password</label></div><input type="password" name="Password">
</fieldset>
<fieldset>
<div><label>Data di nascita</label></div><input type="date" name="DataNascita">
</fieldset>
<fieldset>
<div><label>Email</label></div><input type="email" name="email">
</fieldset>
<fieldset>
<label>Uomo</label>
<input id="radio1" class="radio" type="radio" name="sesso" value="0"/>
<label>Donna</label><input id="radio2" class="radio" type="radio" name="sesso" value="1"/>
</fieldset>
<input type="submit" class="button" id="pulsanteregistrazione" value="Registrati" onclick="registrazione_process">
</form>
</div>
<div id="registrazioneright">

</div>

</div>