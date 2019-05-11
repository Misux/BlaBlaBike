// ---- VALIDAZIONI SULLA REGISTRAZIONE DI UN UTENTE ----//
function validaUser(field){
 if (field == "") return "Non hai specificato il campo login.\n";
 else
    if (field.length < 6)
        return "Il campo login deve avere almeno 5 caratteri.\n";
    else
	    if (/[^a-zA-Z0-9_-]/.test(field))
            return "Solo i caratteri a-z, A-Z, 0-9, - e _ sono ammessi per il campo login.\n";
 return "";
}

function validaPassword(field1, field2){
 if (field1 == "") return "Non hai specificato la password.\n";
 else
     if (field1.length < 8)
        return "La password deve essere di almeno 6 caratteri.\n";
     else
	     if (!/[a-z]/.test(field1) || ! /[A-Z]/.test(field1) || !/[0-9]/.test(field1))
             return "La password deve contenere un carattere tra a-z, A-Z e 0-9.\n";
          else
            if (field1 != field2)
                return "Le due password devono coincidere\n";

  return ""
}

function validaRegistrazione(form){
  var fail = "";
  fail += validaUser(form.username.value);
	fail += validaPassword(form.pwd.value, form.pwd2.value);

	if (fail == "") return true;
	else { alert(fail); return false; }
}

function validaEmail(field){
  if (field == "") return "L'email non &egrave; stata specificata.\n"
  else
      if (!((field.indexOf(".") > 0) && (field.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(field))
         return "Indirizzo email non &egrave; valido.\n";
  return "";
}

// ----------- MOSTRA LE MARCHE GIA PRESENTI ----//
function selectMarca() {
var esistente=document.getElementById("Esistente");
  if(esistente.checked)
  {
    document.getElementById("selectM").disabled=false;
    document.getElementById("selectM").style.display="inline";
    document.getElementById("nuovaM").disabled=true;
    document.getElementById("nuovaM").style.display="none";
  }
}

// -------- INSERISCI MARCA EX NOVO ---- //
function insNuova() {
var nuova=document.getElementById("Nuova");
  if (nuova.checked)
  {
    document.getElementById("nuovaM").disabled=false;
    document.getElementById("nuovaM").style.display="inline";
    document.getElementById("selectM").disabled=true;
    document.getElementById("selectM").style.display="none";
  }
}

//-- SERVE PER ASSICURARE CHE VIENE EFFETTUATA UNA SCELTA PER UNA BICI DA VENDERE --//
function checkTelaioVendita(f) {
  var boolRadio = false;
  for (var i = 0; i < f.elements['telaio'].length; i++) {
    boolRadio = (boolRadio || f.elements['telaio'][i].checked); //QUESTO SERVE SE CI SONO PIU SCELTE
    }
    boolRadio = (boolRadio || f.telaio.checked) // QUESTO SERVE SE C'è SOLO UNA BICI DA POTER VENDERE
    if (!boolRadio) {
    return "Scegli la bici che vuoi vendere \n" ;
    }
    return "";
  }

//---- SI VERIFICA L'INSERIMENTO DEL PREZZO NELL'ANNUNCIO DI VENDITA --//
function validaPrezzo(prezzo) {
  if ((prezzo=="")||(prezzo==0)) {
      return "Inserisci Prezzo \n";
    }
    return "";
}

//--- VERIFICA CHE SI è SCELTO UN TITOLO PER L'ANNUNCIO DI VENDITA --//
function validaTitolo(titolo) {
    if (titolo=="") {
      return "Inserisci Titolo\n";
    }
    return "";
}

// ---- VERIFICA DELL'INSERIMENTO DEI CAMPI OBBLIGATORI IN UN ANNUNCIO --//
function validaInsAnnuncio (f) {
  fail="";
  fail+=validaPrezzo(document.getElementById("prezzo").value);
  fail+=validaTitolo(document.getElementById("titoloA").value);
  fail+=checkTelaioVendita(f);
  if (fail=="") {
    return true;
  } else {
    alert(fail);
    return false;
  }
}

// --- CONFERMA CANCELLAZIONE --- //
function confermaCanc() {
	var domanda = confirm("Intendi procedere?");
	if (domanda === true) {
		return true;
	}
	return false;
}

function confermaModifica() {
fail="";
if (document.getElementById("confermaModificaTitolo").checked) {
    titolo=document.getElementById("nuovoTitolo").value;
    fail+=validaTitolo(titolo);
  }
if (document.getElementById("confermaModificaPrezzo").checked) {
  prezzo=document.getElementById("nuovoPrezzo").value;
  fail+=validaPrezzo(prezzo);
  }
  if (fail=="") {
    return true;
  } else {
    alert(fail);
    return false;
  }
}

// --- MOSTRA I CAMPI CHE POSSONO ESSERE MODIFICABILI IN UN ANNUNCIO PUBBLICATO DALL'USER LOGGATO --//
function mostraModifica() {
document.getElementById("confermaModifica").innerHTML="<a href='index.php?op=annunci&act=dettagliMod' onclick=\"return confermaModifica();\">Conferma Modifica</a><p style=\"color:red\">  Spunta solo i campi che vuoi modificare! </p>";
//<button type=\"submit\" name=\"Modifica\" onclick=\"return confermaModifica();\"> Conferma Modifica </button><p style=\"color:red\">  Spunta solo i campi che vuoi modificare! </p>";
//document.getElementById("editTitolo").innerHTML="<input type=\"text\" id=\"nuovoTitolo\" name=\"nuovoTitolo\" placeholder=\"Nuovo titolo\" onfocus=\"this.placeholder\"> <input id=\"confermaModificaTitolo\" type=\"checkbox\" name=\"confermaModificaTitolo\" >";
document.getElementById("editPrezzo").innerHTML="<input type=\"text\" id=\"nuovoPrezzo\" name=\"nuovoPrezzo\" placeholder=\"Nuovo Prezzo\" onfocus=\"this.placeholder\"> <input id=\"confermaModificaPrezzo\" type=\"checkbox\" name=\"confermaModificaPrezzo\"> ";
document.getElementById("editDescrizione").innerHTML="<textarea name=\"nuovaDescrizione\"  cols=\"60\" rows=\"10\">Inserisci Descrizione </textarea> <input id=\"confermaModificaDescrizione\" type=\"checkbox\" name=\"confermaModificaDescrizione\">";
document.getElementById("editStato").innerHTML="<select name=\"nuovoStato\"> <option value=\"venduta\">Venduta </option> <option value=\"in Vendita\"> In Vendita </option> </select> <input id=\"confermaModificaStato\" type=\"checkbox\" name=\"confermaModificaStato\"> ";
document.getElementById("bottoneModifica").setAttribute("style", "display:none");
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
