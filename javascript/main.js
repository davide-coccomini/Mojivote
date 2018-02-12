setTimeout('inizializzaDialog()',300);
setTimeout('inizializzaCommenti()',300);
function inizializzaDialog(){
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "block";
}
span.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
}
function inizializzaCommenti()
{
var modal = document.getElementById('commenticontent');

var btn = document.getElementById("discussionesondaggio");
	
btn.onclick = function() {
    modal.style.display = "block";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
}
function inserisciVoto(el,id,d)
{

var nome=el.name;
var v=nome.split("t");
var j=parseInt(v[1]);
matrice[d+j][10]=parseInt(matrice[d+j][10])+1;
matrice[d][14]=1;


	var target=document.getElementById("v"+j);
	var exVal=parseInt(target.value);
	target.value=exVal+1;
	
	$.ajax({
	  type: "GET",
	  url: "inseriscivoto.php",
	  data: "j="+j+"&id="+id+"",
	  dataType: "html",
	});
	
  var tastiera=document.getElementsByClassName("sondaggiotastiera")[0];
  tastiera.className="sondaggiotastieradisabled";
 
  for(var i=0;i<6;i++)
  {
	  var emoji=document.getElementById("idimgtastiera"+i);
	  emoji.onclick=null;
  }
	
}



function inserisciVoto(el,id,d)
{

var nome=el.name;
var v=nome.split("t");
var j=parseInt(v[1]);
matrice[d+j][10]=parseInt(matrice[d+j][10])+1;
matrice[d][14]=1;

var emoji=el.id;
var v=emoji.split("idimgtastiera");
var e=parseInt(v[1]);

	var target=document.getElementById("v"+j);
	var exVal=parseInt(target.value);
	target.value=exVal+1;

	$.ajax({
	  type: "GET",
	  url: "inseriscivoto.php",
	  data: "j="+e+"&id="+id+"",
	  dataType: "html",
	});
	
    var tastiera=document.getElementsByClassName("sondaggiotastiera")[0];
	tastiera.className="sondaggiotastieradisabled";
 
		for (var i = 0; i < tastiera.childNodes.length; i++) {
			tastiera.childNodes[i].className="sondaggiotastodisabled";
		}
 
  for(var i=0;i<6;i++)
  {
  	if(document.getElementById("idimgtastiera"+i)){
	  var emoji=document.getElementById("idimgtastiera"+i);
	  emoji.onclick=null;
    }
  }
	
}



function inserisciVotoVisit(el,id,d)
{

var nome=el.name;
var v=nome.split("t");
var j=parseInt(v[1]);

var emoticon=el.id;
var v=emoticon.split("imgtastiera");
var em=parseInt(v[1]);


matrice[d+j][10]=parseInt(matrice[d+j][10])+1;
matrice[d][14]=1;


	var target=document.getElementById("v"+j);
	var exVal=parseInt(target.value);
	target.value=exVal+1;
	
	$.ajax({
	  type: "GET",
	  url: "inseriscivoto.php",
	  data: "j="+em+"&id="+id+"",
	  dataType: "html",
	});
	
  var tastiera=document.getElementsByClassName("sondaggiotastiera")[0];
  tastiera.className="sondaggiotastieradisabled";
 
		for (var i = 0; i < tastiera.childNodes.length; i++) {
			tastiera.childNodes[i].className="sondaggiotastodisabled";
		}
  
 
  for(var i=0;i<6;i++)
  {
	  var emoji=document.getElementById("idimgtastiera"+i);
	  emoji.onclick=null;
  }
	
}
function apriShareBox(idsondaggio)
{
	var content=document.createElement("div");
    content.id='sharecontent';
    var sharebox=document.createElement("div");
	sharebox.id="sharebox";
    var chiudi=document.createElement("div");
    chiudi.id="chiudibox";
 	chiudi.onclick=function(){fadeout("sharecontent",2);
        					  			 setTimeout(function(){eliminadiv("sharecontent")},3000);}
    var croce=document.createTextNode("X");
    chiudi.appendChild(croce);
    var testo=document.createTextNode("Copia il link, invialo ad un amico e fatti votare per ottenere punti extra!");
    var paragrafo = document.createElement("p");
    sharebox.appendChild(chiudi);
    sharebox.appendChild(paragrafo);
    paragrafo.appendChild(testo);
    var textbox=document.createElement("input");
    textbox.type="textbox";
    textbox.id="textshare";
    textbox.value="https://mojivote.it/php/main.php?p=sondaggio_visit&id="+idsondaggio;
    textbox.disabled=true;
    textbox.selected=true;
  	var scope=document.getElementById("descrizione");
    scope.appendChild(content);
    content.appendChild(sharebox);
    sharebox.appendChild(textbox);  
}
function fade(id, io, tm)
{
    var el = document.getElementById(id);
	el.style.opacity = 1;

	el.onclick = function(event){	
		if (event.target == el) {
			 el.style.display = 'none';
		}
	}
	
    el.style.transition = "opacity " + tm + "s";
    el.style.WebkitTransition = "opacity " + tm + "s";
    
}

function fadeout(id,tm)
{
	var el = document.getElementById(id);
	el.style.opacity = 0;
    el.style.transition = "opacity " + tm + "s";
    el.style.WebkitTransition = "opacity " + tm + "s";
    setTimeout(function () {var el = document.getElementById(id); el.style.display="none";},400);   
}
function eliminadiv(id)
{
	var el = document.getElementById(id);
	el.parentNode.removeChild(el);
}

function validazione(elemento,controllo)
{
var contenuto=elemento.value;
var name=elemento.name;

/* Controllo nome o cognome (0) */
if(controllo==0){
    if ((contenuto == "") || (contenuto == "undefined") || (contenuto.length > 15) || (contenuto.length<2)) {
       elemento.style.border="1px solid red";
       elemento.style.boxShadow="0.5px 0.5px 9.5px 1px red";
       return false;
    }else{
       elemento.style.border="1px solid lime";
       elemento.style.boxShadow="0.5px 0.5px 9.5px 1px lime";
       return true;
    }
    
    
}


/* Controllo password (1) */
if(controllo==1){
	if ((contenuto == "") || (contenuto == "undefined") || (contenuto.length > 25) || (contenuto.length<6)) {
       elemento.style.border="1px solid red";
       elemento.style.boxShadow="0.5px 0.5px 9.5px 1px red";
       return false;
    }else{
   	   elemento.style.border="1px solid lime";
       elemento.style.boxShadow="0.5px 0.5px 9.5px 1px lime";
       return true;
    }
}	

/* Controllo data (2) */

var data = contenuto.split("/");
	if((data[2]>2005 || data[2]<1900) || (data[1]>12 || data[1]<1) || (data[0]>31 || data[2]<1))
    {
       elemento.style.border="1px solid red";
       elemento.style.boxShadow="0.5px 0.5px 9.5px 1px red";
       return false;
    }else{
       elemento.style.border="1px solid lime";
       elemento.style.boxShadow="0.5px 0.5px 9.5px 1px lime";
       return true;
    }
/* Controllo email (3) */
var ris=emailCheck(contenuto);
	if(ris==false) {
       elemento.style.border="1px solid red";
       elemento.style.boxShadow="0.5px 0.5px 9.5px 1px red";
       return false;
    }else{
       elemento.style.border="1px solid lime";
       elemento.style.boxShadow="0.5px 0.5px 9.5px 1px lime";
       return true;
    }

/* Controllo etichetta sondaggi (4) */
if(controllo==4){
  if(contenuto.length>22)
  {
    elemento.style.border="1px solid red";
  	elemento.style.boxShadow="0.5px 0.5px 9.5px 1px red";
    return false;
  }else{
  	elemento.style.border="1px solid lime";
    elemento.style.boxShadow="0.5px 0.5px 9.5px 1px lime";
    return true;
  }
}

}

function setCheckbox(id)
{
	var el=document.getElementById("checkboxemoji"+id);
    el.checked=true;
}
function emailCheck(emailStr) {
        var emailPat = /^(.+)@(.+)$/;
        var specialChars = "\\(\\)<>@,;:\\\\\\\"\\.\\[\\]";
        var validChars = "[^\\s" + specialChars + "]";
        var quotedUser = "(\"[^\"]*\")";
        var ipDomainPat = /^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;
        var atom = validChars + "+";
        var word = "(" + atom + "|" + quotedUser + ")";
        var userPat = new RegExp("^" + word + "(\\." + word + ")*$");
        var domainPat = new RegExp("^" + atom + "(\\." + atom + ")*$");
        var matchArray = emailStr.match(emailPat);
        if (matchArray == null) {
            alert("L'email sembra essere sbagliata: (controlla @ e .)");
            return false;
        }
        var user = matchArray[1];
        var domain = matchArray[2];
        if (user.match(userPat) == null) {
            alert("La parte dell'email prima di '@' non sembra essere valida!");
            return false;
        }
        var IPArray = domain.match(ipDomainPat);
        if (IPArray != null) {
            for (var i = 1; i <= 4; i++) {
                if (IPArray[i] > 255) {
                    alert("L'IP di destinazione non è valido!");
                    return false;
                }
            }
            return true;
        }
        var domainArray = domain.match(domainPat);
        if (domainArray == null) {
            alert("La parte dell'email dopo '@' non sembra essere valida!");
            return false;
        }
        var atomPat = new RegExp(atom, "g");
        var domArr = domain.match(atomPat);
        var len = domArr.length;
        if (domArr[domArr.length - 1].length < 2 ||
            domArr[domArr.length - 1].length > 6) {
            alert("Il dominio di primo livello (es: .com e .it) non sembra essere valido!");
            return false;
        }
        if (len < 2) {
            var errStr = "L'indirizzo manca del dominio!";
            alert(errStr);
            return false;
        }
        return true;
    }

function punti(action)
{
	if(action==1){ //+1 punto
      var box = document.createElement("div");
      var boxtext = document.createTextNode("+2 punti");
      box.appendChild(boxtext);
      box.style.color="green";
      box.style.margin="-22% auto";
      box.style.width="20%";
      box.style.fontWeight="bold";
      box.id="puntibox";
      if(document.getElementsByClassName("sondaggiotastiera")[0])
      	var scope = document.getElementsByClassName("sondaggiotastiera")[0];
      else
      	var scope = document.getElementsByClassName("sondaggiotastieradisabled")[0];
      scope.appendChild(box);
      box.style.opacity = 1;
      box.style.transition = "opacity 3s, margin-top 2.5s";
      box.style.WebkitTransition = "opacity 3s,margin-top 2.5s"; 
      setTimeout(function() {dissolviPunti();},50);
    }
}
function dissolviPunti()
{
	var box = document.getElementById("puntibox");
	box.style.opacity = 0;
    box.style.marginTop = "-31%";
    setTimeout(function(){var el=document.getElementById("puntibox"); el.parentNode.removeChild(el);},3000);
}
function evidenzia(cl,e,c)
{
	if(c==1){
      var scope=document.getElementsByTagName("body")[0];
      var boxdis=document.createElement("div");
      boxdis.id="tutorialContent";
      boxdis.style.opacity="0.3";
      boxdis.style.background="black";
      boxdis.style.width="100%";
      boxdis.style.height="100%";
      boxdis.style.top=0;
      boxdis.style.position="fixed";
      boxdis.style.zIndex="0";
      scope.appendChild(boxdis);
      var boxblock=document.createElement("div");
      boxblock.id="tutorialLocker";
      boxblock.style.opacity="0";
      boxblock.style.width="100%";
      boxblock.style.height="100%";
      boxblock.style.top=0;
      boxblock.style.position="fixed";
      boxblock.style.zIndex="3";
      scope.appendChild(boxblock);
    }
    if(e==1){
      var evidenzia=document.getElementsByClassName(cl)[0];
      evidenzia.style.brightness="200%";
      evidenzia.style.zIndex=2;
      evidenzia.style.position="relative";
    }
    if(e==2){
      var disevidenzia=document.getElementsByClassName(cl)[0];
      disevidenzia.style.zIndex=0;
    }
    if(e==3){
      var evidenzia=document.getElementsByClassName(cl)[0];
      evidenzia.style.brightness="200%";
      evidenzia.style.zIndex=2;
      evidenzia.style.position="relative";
      var evidenzia=document.getElementsByClassName(cl)[1];
      evidenzia.style.brightness="200%";
      evidenzia.style.zIndex=2;
      evidenzia.style.position="relative";
    }
    if(e==4){
      var disevidenzia=document.getElementsByClassName(cl)[0];
      disevidenzia.style.zIndex=0;
      var disevidenzia=document.getElementsByClassName(cl)[1];
      disevidenzia.style.zIndex=0;
    }
    if(e==5){
     for(var i=0;i<9;i++){
        var evidenzia=document.getElementsByClassName(cl)[i].parentNode;
        evidenzia.style.brightness="200%";
        evidenzia.style.zIndex=2;
        evidenzia.style.position="relative";    
      }
    }
    
    if(e==6)
    {
     for(var i=1;i<9;i++){
      var disevidenzia=document.getElementsByClassName(cl)[i].parentNode;
      disevidenzia.style.zIndex=0;
     }
    }
}
function tutorial(p)
{
	
    if(p==0)
	{
      evidenzia(0,0,1);
      var bod=document.getElementsByTagName("body")[0];
      bod.style.overflow="hidden";
      var testobox=document.createElement("div");
      testobox.id="testobox";
      testobox.style.position="fixed";
      testobox.style.zIndex=4;
      testobox.style.top=0;
      testobox.style.left="30%";
      testobox.style.marginTop="20%";
      testobox.style.width="40%";
      testobox.style.height="20%";
      testobox.style.textAlign="center";
      var paragrafo=document.createElement("p");

      paragrafo.style.fontWeight="bold";
      var testo=document.createTextNode("Benvenuto su Mojivote! Su questa piattaforma potrai creare sondaggi in modo semplice e veloce per poi condividerli dove preferisci e farti votare! Col tempo potrai acquisire punti spendibili sul sito e seguaci che seguiranno i tuoi contenuti.")
	  var btn=document.createElement("button");
      btn.onclick=function(){tutorial(111);};
      btn.className="button";
      btn.style.width="30%";
      var testobtn=document.createTextNode("Avanti");
      btn.appendChild(testobtn);
      testobox.appendChild(paragrafo);
      testobox.appendChild(btn);
      paragrafo.appendChild(testo);
      var content=document.getElementsByTagName("body")[0];
      content.appendChild(testobox);
    }
    if(p==111)
    {
      evidenzia("labelsection",5,0);
      var element = document.getElementById("testobox");
	  element.parentNode.removeChild(element);
      var testobox=document.createElement("div");
      testobox.id="testobox";
      testobox.style.position="fixed";
      testobox.style.zIndex=4;
      testobox.style.top=0;
      testobox.style.left="27%";
      testobox.style.marginTop="0.5%";
      testobox.style.width="40%";
      testobox.style.height="13%";
      testobox.style.textAlign="center";
      var paragrafo=document.createElement("p");

      paragrafo.style.fontWeight="bold";
      var testo=document.createTextNode("Per iniziare a vedere i sondaggi degli altri utenti dovrai scegliere una sezione a tuo piacimento da questa lista.")
	  var btn=document.createElement("button");
      btn.onclick=function(){tutorial(112);};
      btn.className="button";
      btn.style.width="30%";
      var testobtn=document.createTextNode("Avanti");
      btn.appendChild(testobtn);
      testobox.appendChild(paragrafo);
      testobox.appendChild(btn);
      paragrafo.appendChild(testo);
      var content=document.getElementsByTagName("body")[0];
      content.appendChild(testobox);
    }
    if(p==112)
    {
      evidenzia("labelsection",6,0);
      aggiornaSfondo("random");
      var element = document.getElementById("testobox");
	  element.parentNode.removeChild(element);
      var testobox=document.createElement("div");
      testobox.id="testobox";
      testobox.style.position="fixed";
      testobox.style.zIndex=4;
      testobox.style.top=0;
      testobox.style.left="1%";
      testobox.style.marginTop="36%";
      testobox.style.width="40%";
      testobox.style.height="13%";
      testobox.style.textAlign="center";
      var paragrafo=document.createElement("p");

      paragrafo.style.fontWeight="bold";
      var testo=document.createTextNode("Se per esempio volessi vedere tutti i sondaggi in ordine cronologico ti basterebbe cliccare qui.")
	  var btn=document.createElement("button");
      btn.onclick=function(){tutorial(113);};
      btn.className="button";
      btn.style.width="30%";
      var testobtn=document.createTextNode("Avanti");
      btn.appendChild(testobtn);
      testobox.appendChild(paragrafo);
      testobox.appendChild(btn);
      paragrafo.appendChild(testo);
      var content=document.getElementsByTagName("body")[0];
      content.appendChild(testobox);
    }
    if(p==113)
    {
    	setTimeout(function(){location.href = 'http://www.mojivote.altervista.org/php/main.php?p=bacheca&c=random';},100);
    }
    if(p==2)
    { 
	 if(document.getElementsByClassName("sondaggiotastiera")[0]!=null){
      	  evidenzia("sondaggiotastiera",1,1);
		  var tastiera=document.getElementsByClassName("sondaggiotastiera")[0];
	 }else{
		  evidenzia("sondaggiotastieradisabled",1,1);
		  var tastiera=document.getElementsByClassName("sondaggiotastieradisabled")[0];
	 }
	
    
      tastiera.style.boxShadow="1px 1px 20px yellow";
      var testobox=document.createElement("div");
      testobox.id="testobox";
      testobox.style.position="fixed";
      testobox.style.zIndex=4;
      testobox.style.top=0;
      testobox.style.left="32.5%";
      testobox.style.marginTop="25%";
      testobox.style.width="30%";
      testobox.style.height="28%";
      testobox.style.textAlign="center";
      var paragrafo=document.createElement("p");
      paragrafo.style.fontWeight="bold";
      var testo=document.createTextNode("Una volta scelta la categoria desiderata, avrai accesso a tutti i sondaggi di quella categoria. Usando questa tastiera puoi votare i sondaggi degli altri utenti. Per ogni voto che riceve un tuo sondaggio o un voto che dai al sondaggio di qualcun altro ottieni 2 punti. Questi punti ti serviranno poi per creare altri sondaggi.")
	  var btn=document.createElement("button");
      btn.onclick=function(){tutorial(3);};
      btn.className="button";
      var testobtn=document.createTextNode("Avanti");
      btn.appendChild(testobtn);
      testobox.appendChild(paragrafo);
      testobox.appendChild(btn);
      paragrafo.appendChild(testo);     
      var content=document.getElementsByTagName("body")[0];
      content.appendChild(testobox);
    }
    if(p==3)
    { 
      
      evidenzia("sondaggiobuttonset",1,0);
	  if(document.getElementsByClassName("sondaggiotastiera")[0]!=null){
      	  evidenzia("sondaggiotastiera",2,0);
		  var tastiera=document.getElementsByClassName("sondaggiotastiera")[0];
	  }else{	  
      	  evidenzia("sondaggiotastieradisabled",2,0);
		  var tastiera=document.getElementsByClassName("sondaggiotastieradisabled")[0];
	  }
	  tastiera.style.boxShadow="0px 0px 0px black";
      var shareicon=document.getElementById("sharesondaggio");
      shareicon.style.background="url('../img/shareicontutorial.png')";
      shareicon.style.backgroundSize="100% 100%";
      var element = document.getElementById("testobox");
	  element.parentNode.removeChild(element);
      var testobox=document.createElement("div");
      testobox.id="testobox";
      testobox.style.position="fixed";
      testobox.style.zIndex=4;
      testobox.style.top=0;
      testobox.style.left="0.5%";
      testobox.style.marginTop="7%";
      testobox.style.width="30%";
      testobox.style.height="19%";
      testobox.style.textAlign="center";
      var paragrafo=document.createElement("p");

      paragrafo.style.fontWeight="bold";
      var testo=document.createTextNode("Cliccando su questo pulsante potrai condividere il sondaggio dove preferisci copiando il link che verrà generato automaticamente.")
	  var btn=document.createElement("button");
      btn.onclick=function(){tutorial(31);};
      btn.className="button";
      var testobtn=document.createTextNode("Avanti");
      btn.appendChild(testobtn);
      testobox.appendChild(paragrafo);
      testobox.appendChild(btn);
      paragrafo.appendChild(testo);
          
      var content=document.getElementsByTagName("body")[0];
      content.appendChild(testobox);
    }
     if(p==31)
    { 
      
      var shareicon=document.getElementById("sharesondaggio");
      var commentsicon=document.getElementById("discussionesondaggio");
      shareicon.style.background="url('../img/shareicon.png')";
      commentsicon.style.background="url('../img/commentsicontutorial.png')";
      shareicon.style.backgroundSize="100% 100%";
      commentsicon.style.backgroundSize="100% 100%";
      var element = document.getElementById("testobox");
	  element.parentNode.removeChild(element);
      var testobox=document.createElement("div");
      testobox.id="testobox";
      testobox.style.position="fixed";
      testobox.style.zIndex=4;
      testobox.style.top=0;
      testobox.style.left="0.5%";
      testobox.style.marginTop="7%";
      testobox.style.width="30%";
      testobox.style.height="15%";
      testobox.style.textAlign="center";
      var paragrafo=document.createElement("p");

      paragrafo.style.fontWeight="bold";
      var testo=document.createTextNode("Cliccando su questo pulsante potrai leggere i commenti che gli utenti hanno fatto sul sondaggio e potrai inserirne uno tuo.")
	  var btn=document.createElement("button");
      btn.onclick=function(){tutorial(4);};
      btn.className="button";
      var testobtn=document.createTextNode("Avanti");
      btn.appendChild(testobtn);
      testobox.appendChild(paragrafo);
      testobox.appendChild(btn);
      paragrafo.appendChild(testo);
          
      var content=document.getElementsByTagName("body")[0];
      content.appendChild(testobox);
    }
    if(p==4)
    { 
      evidenzia("sondaggiobuttonset",2,0);
      evidenzia("newsondaggioicon",1,0);
      evidenzia("maintopbar",1,0);
      var commentsicon=document.getElementById("discussionesondaggio");
      commentsicon.style.background="url('../img/commentsicon.png')";
      commentsicon.style.backgroundSize="100% 100%";
      
      var newicon=document.getElementsByClassName("newsondaggioicon")[0];
      newicon.style.background="url('../img/newicontutorial.png')";
      newicon.style.backgroundSize="100% 100%";
      
      var element = document.getElementById("testobox");
	  element.parentNode.removeChild(element);
      var testobox=document.createElement("div");
      testobox.id="testobox";
      testobox.style.position="fixed";
      testobox.style.zIndex=4;
      testobox.style.top=0;
      testobox.style.left="61%";
      testobox.style.marginTop="4%";
      testobox.style.width="30%";
      testobox.style.height="15%";
      testobox.style.textAlign="center";
      var paragrafo=document.createElement("p");
      paragrafo.style.fontWeight="bold";
      var testo=document.createTextNode("Cliccando sul pulsante + potrai accedere alla pagina per creare un nuovo sondaggio.")
	  var btn=document.createElement("button");
      btn.onclick=function(){tutorial(5);};
      btn.className="button";
      btn.style.width="50%";
       btn.style.height="40%";
      var testobtn=document.createTextNode("Continua il tutorial quando vorrai creare un sondaggio");
      btn.appendChild(testobtn);
      testobox.appendChild(paragrafo);
      testobox.appendChild(btn);
      paragrafo.appendChild(testo);
     
    
      
      var content=document.getElementsByTagName("body")[0];
      content.appendChild(testobox);
    }
    if(p==5)
    {
      $.ajax({
        type: "GET",
        url: "aggiornatutorial.php",
        data: "p=1",
        dataType: "html",
      });
    	setTimeout(function(){location.reload()},500);
    }
    if(p==6)
    { 
    	setTimeout(function(){
          evidenzia("newtitlebox",1,1);
           var newtitolobox=document.getElementsByClassName("newtitlebox")[0];
      	  newtitolobox.style.boxShadow="1px 1px 20px yellow";
          var testobox=document.createElement("div");
          testobox.id="testobox";
          testobox.style.position="fixed";
          testobox.style.zIndex=4;
          testobox.style.top=0;
          testobox.style.left="32.5%";
          testobox.style.marginTop="22%";
          testobox.style.width="30%";
          testobox.style.height="15%";
          testobox.style.textAlign="center";
          var paragrafo=document.createElement("p");
        
          paragrafo.style.fontWeight="bold";
          var testo=document.createTextNode("Per iniziare, dovrai inserire qui il titolo che vuoi dare al tuo sondaggio.")
          var btn=document.createElement("button");
          btn.onclick=function(){tutorial(7);};
          btn.className="button";
          var testobtn=document.createTextNode("Avanti");
          btn.appendChild(testobtn);
          testobox.appendChild(paragrafo);
          testobox.appendChild(btn);
          paragrafo.appendChild(testo);

          var content=document.getElementsByTagName("body")[0];
          content.appendChild(testobox);
          },1000);
    }
    
    if(p==7)
    { 
        var element = document.getElementById("testobox");
	    element.parentNode.removeChild(element);
        evidenzia("newtitlebox",2,0);
        var newtitlebox=document.getElementsByClassName("newtitlebox")[0];
        newtitlebox.value="Questo è un titolo di prova!";
        newtitlebox.style.boxShadow="0px 0px 0px black";
        evidenzia("newcategorybox",1,0);
        var newcategorybox=document.getElementsByClassName("newcategorybox")[0];
      	newcategorybox.style.boxShadow="1px 1px 20px yellow";
        var testobox=document.createElement("div");
        testobox.id="testobox";
        testobox.style.position="fixed";
        testobox.style.zIndex=4;
        testobox.style.top=0;
        testobox.style.left="33%";
        testobox.style.marginTop="22%";
        testobox.style.width="30%";
        testobox.style.height="15%";
        testobox.style.textAlign="center";
        var paragrafo=document.createElement("p");

        paragrafo.style.fontWeight="bold";
        var testo=document.createTextNode("Successivamente dovrai selezionare da questo menu a tendina la categoria del sondaggio.")
        var btn=document.createElement("button");
        btn.onclick=function(){tutorial(8);};
        btn.className="button";
        var testobtn=document.createTextNode("Avanti");
        btn.appendChild(testobtn);
        testobox.appendChild(paragrafo);
        testobox.appendChild(btn);
        paragrafo.appendChild(testo);

        var content=document.getElementsByTagName("body")[0];
        content.appendChild(testobox);
    }
    if(p==8)
    { 	
        var element = document.getElementById("testobox");
	    element.parentNode.removeChild(element);
        evidenzia("newcategorybox",2,0);
        var newcategorybox=document.getElementsByClassName("newcategorybox")[0];
      	newcategorybox.style.boxShadow="0px 0px 0px black";
        var newtitlebutton=document.getElementById("pulsantenewtitle");
        newtitlebutton.disabled=false;
        newtitlebutton.style.zIndex=5;
        newtitlebutton.style.position="relative";
        newtitlebutton.style.background="rgb(102, 170, 220)";
    	newtitlebutton.style.background="border-color: black";
        newtitlebutton.style.boxShadow="1px 1px 20px yellow";
        var testobox=document.createElement("div");
        testobox.id="testobox";
        testobox.style.position="fixed";
        testobox.style.zIndex=4;
        testobox.style.top=0;
        testobox.style.left="33%";
        testobox.style.marginTop="22%";
        testobox.style.width="30%";
        testobox.style.height="15%";
        testobox.style.textAlign="center";
        var paragrafo=document.createElement("p");
   
        paragrafo.style.fontWeight="bold";
        var testo=document.createTextNode("Adesso premi il pulsante avanti per procedere con l'ultima parte del tutorial.")
     
 
        testobox.appendChild(paragrafo);
        paragrafo.appendChild(testo);

        var content=document.getElementsByTagName("body")[0];
        content.appendChild(testobox);
    }
    
    if(p==9)
    { 	
    	setTimeout(function(){
         evidenzia("associazionibox",3,1); 
		 var associazionibox=document.getElementsByClassName("associazionibox")[0];
      	 associazionibox.style.boxShadow="1px 1px 20px yellow";
         var associazionibox=document.getElementsByClassName("associazionibox")[1];
      	 associazionibox.style.boxShadow="1px 1px 20px yellow";
          var testobox=document.createElement("div");
          testobox.id="testobox";
          testobox.style.position="fixed";
          testobox.style.zIndex=4;
          testobox.style.top=0;
          testobox.style.left="18%";
          testobox.style.marginTop="33%";
          testobox.style.width="30%";
          testobox.style.height="15%";
          testobox.style.textAlign="center";
          var paragrafo=document.createElement("p");

          paragrafo.style.fontWeight="bold";
          var testo=document.createTextNode("Potrai scegliere le opzioni del sondaggio compilando questi box da un minimo di 2 a un massimo di 6.")

          var btn=document.createElement("button");
          btn.onclick=function(){tutorial(10);};
          btn.className="button";
          var testobtn=document.createTextNode("Avanti");
          btn.appendChild(testobtn);
          testobox.appendChild(paragrafo);
          testobox.appendChild(btn);
          paragrafo.appendChild(testo);

          var content=document.getElementsByTagName("body")[0];
          content.appendChild(testobox);
          },500);
    }
    
    if(p==10)
    { 	
        var element = document.getElementById("testobox");
	    element.parentNode.removeChild(element);
        var etichetta1=document.getElementsByClassName("etichettabox")[0];
        var etichetta2=document.getElementsByClassName("etichettabox")[1];
        etichetta1.value="Etichetta1";
        etichetta2.value="Etichetta2";
        var checkbox1=document.getElementById("checkboxemoji1");
        var checkbox2=document.getElementById("checkboxemoji2");
        checkbox1.checked = true;
        checkbox2.checked = true;
        var testobox=document.createElement("div");
        testobox.id="testobox";
        testobox.style.position="fixed";
        testobox.style.zIndex=4;
        testobox.style.top=0;
        testobox.style.left="18%";
        testobox.style.marginTop="33%";
        testobox.style.width="30%";
        testobox.style.height="15%";
        testobox.style.textAlign="center";
        var paragrafo=document.createElement("p");

        paragrafo.style.fontWeight="bold";
        var testo=document.createTextNode("Dovrai inserire le etichette che compariranno sotto le immagini delle varie opzioni del sondaggio e caricare le immagini corrispondenti.")
     
   		var btn=document.createElement("button");
        btn.onclick=function(){tutorial(11);};
        btn.className="button";
        var testobtn=document.createTextNode("Avanti");
        btn.appendChild(testobtn);
        testobox.appendChild(paragrafo);
        testobox.appendChild(btn);
        paragrafo.appendChild(testo);

        var content=document.getElementsByTagName("body")[0];
        content.appendChild(testobox);
    }
    if(p==11)
    { 	
    	evidenzia("associazionibox",4,0); 
        var associazionibox=document.getElementsByClassName("associazionibox")[0];
        associazionibox.style.boxShadow="0px 0px 0px black";
        var associazionibox=document.getElementsByClassName("associazionibox")[1];
        associazionibox.style.boxShadow="0px 0px 0px black";
        evidenzia("buttoncreasondaggio",1,0); 
        var element = document.getElementById("testobox");
	    element.parentNode.removeChild(element);
        var etichetta1=document.getElementsByClassName("etichettabox")[0];
        var etichetta2=document.getElementsByClassName("etichettabox")[1];
        etichetta1.value="Etichetta1";
        etichetta2.value="Etichetta2";
        var checkbox1=document.getElementById("checkboxemoji1");
        var checkbox2=document.getElementById("checkboxemoji2");
        checkbox1.checked = true;
        checkbox2.checked = true;
        var testobox=document.createElement("div");
        testobox.id="testobox";
        testobox.style.position="fixed";
        testobox.style.zIndex=4;
        testobox.style.top=0;
        testobox.style.left="61%";
        testobox.style.marginTop="9%";
        testobox.style.width="30%";
        testobox.style.height="15%";
        testobox.style.textAlign="center";
        var paragrafo=document.createElement("p");
        paragrafo.style.fontWeight="bold";
        var testo=document.createTextNode("Dopo aver compilato le opzioni che ti interessano ti basterà clicare il pulsante per creare il tuo sondaggio!")
     
   		var btn=document.createElement("button");
        btn.onclick=function(){tutorial(12);};
        btn.className="button";
        btn.style.width="40%";
        var testobtn=document.createTextNode("Termina il tutorial");
        btn.appendChild(testobtn);
        testobox.appendChild(paragrafo);
        testobox.appendChild(btn);
        paragrafo.appendChild(testo);

        var content=document.getElementsByTagName("body")[0];
        content.appendChild(testobox);
    }
    if(p==12)
    {
      $.ajax({
        type: "GET",
        url: "aggiornatutorial.php",
        data: "p=2",
        dataType: "html",
      });
    	setTimeout(function(){location.href = 'https://www.mojivote.altervista.org/php/main.php?p=bacheca';},1000);
    }
}

var terminata=1;
var sec="";
function resetTerminata()
{
	eliminata=0;
}
function aggiornaSfondo(s)
{
sec=s;
	if(terminata==1){
      var scope=document.getElementById("sectionbackground");
      scope.style.transition = "background 0.5s";
      scope.style.WebkitTransition = "background 0.5s"; 
      scope.style.background="url(../img/imgsection/bg"+s+".jpg)";
      scope.style.backgroundRepeat="no-repeat";
      scope.style.backgroundAttachment="fixed";
      scope.style.backgroundSize="100% 100%";
      scope.style.width="100%";
      scope.style.height="100%";
      scope.style.position="fixed";
      scope.style.zIndex="-1";
      setTimeout(function(){resetTerminata();},500);
 	}else{
    	setTimeout(function(){aggiornaSfondo(sec)},100);
    }
}

