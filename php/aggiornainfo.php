<?php
include("config.php");
include("filtro.php");

session_start();


	if(isset ($_POST["nome"]))
    {
    	
    	if($_POST["nome"]!=$_COOKIE["nome"])
        {
        	$newname = filtra($_POST["nome"]);
              if(strlen($newname)>15 or strlen($newname)<2)
              {
                header('location: main.php?p=profilo&s=profilo_informazioni&message=Nome invalido (3-15 caratteri)');
          	    $_SESSION["letto"]=0;
                $mysqli->close();
                die();
              }else{
              	$query="UPDATE utenti SET nome='".$newname."' WHERE idutente=".$_COOKIE['idutente'];
                $result=$mysqli->query($query);
                
				setcookie("nome", $newname,time() + (10 * 365 * 24 * 60 * 60));
              }
        }
    }
    if(isset ($_POST["cognome"]))
    {
    	
    	if($_POST["cognome"]!=$_COOKIE["cognome"])
        {
        	$newsurname = filtra($_POST["cognome"]);
              if(strlen($newsurname)>15 or strlen($newsurname)<2)
              {
                header('location: main.php?p=profilo&s=profilo_informazioni&message=Cognome invalido (2-15 caratteri)');
          	    $_SESSION["letto"]=0;
                $mysqli->close();
                die();
              }else{
              	$query="UPDATE utenti SET cognome='".$newsurname."' WHERE idutente=".$_COOKIE['idutente'];
                $result=$mysqli->query($query);
				setcookie("cognome", $newsurname,time() + (10 * 365 * 24 * 60 * 60));
              }
        }
    }
	if(isset ($_POST["datanascita"]))
    {
    	$data = $_POST["datanascita"];
        $elementi = explode('-', $data);
        
      
        if(($elementi[2]<=31 && $elementi[2]>=1) && ($elementi[1]<=12 && $elementi[1]>=1) 
        	&& ($elementi[0]>=1910 && $elementi[0]<=2010))
        {
        	if(strlen($data)!=10)
              {
                header('location: main.php?p=profilo&s=profilo_informazioni&message=Data di nascita invalida (Assicurati di aver usato il formato corretto [gg/mm/aaaa])');
          		$_SESSION["letto"]=0;
                $mysqli->close();
                die();
              }else{
                $data=filtra($_POST["datanascita"]);
                $query="UPDATE utenti SET datanascita='".$data."' WHERE idutente=".$_COOKIE['idutente'];
                $result=$mysqli->query($query);
    
				setcookie("datanascita", $data,time() + (10 * 365 * 24 * 60 * 60));
              }
        }else{
        	header('location: main.php?p=profilo&s=profilo_informazioni&message=La data di nascita è inesistente');
          	$_SESSION["letto"]=0;
            $mysqli->close();
            die();
        }
    }

    if((isset($_POST["pswold"]) && (isset($_POST["pswnew"])) && (isset($_POST["pswnewconfirm"]))))
    {
    	if(sha1($_POST["pswold"])!=$_COOKIE["psw"])
        {
        	header('location: main.php?p=profilo&s=profilo_informazioni&message=La vecchia password è sbagliata');
          	$_SESSION["letto"]=0;
            $mysqli->close();
            die();
        }   
    	if($_POST["pswnewconfirm"]!=$_POST["pswnew"])
        {
        	header('location: main.php?p=profilo&s=profilo_informazioni&message=Le password non corrispondono');
          	$_SESSION["letto"]=0;
            $mysqli->close();
            die();
        }
        
        $newpass = filtra($_POST["pswnew"]);
        
		if(strlen($newpass)>25 or strlen($newpass)<6){
        	header('location: main.php?p=profilo&s=profilo_informazioni&message=La nuova password è invalida (6-25 caratteri)');
          	$_SESSION["letto"]=0;
            $mysqli->close();
            die();
        }else{
        	$query="UPDATE utenti SET password=sha1('".$newpass."') WHERE idutente=".$_COOKIE['idutente'];
            $result=$mysqli->query($query);
            $pswcrypt=sha1($newpass);
			setcookie("psw", $pswcrypt,time() + (10 * 365 * 24 * 60 * 60));
        }
    }
    
   header('location: main.php?p=profilo&s=profilo_informazioni&message=Profilo aggiornato con successo!');
   $_SESSION["letto"]=0;
   $mysqli->close();
   die();
?>