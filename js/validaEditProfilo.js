// -- VALIDAZIONI DELLA PAGINA DI MODIFICA PROFILO -- //
function validaEmail(field){
  if (field=="") {
    return "Email Obbligatoria \n";
  }
  if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(field)))  {
    return "E-mail Obbligatoria! Devi inserire un indirizzo mail valido.\n";
  }
  return "";
}

function validaData(field){
  if (field == "") {
  return "Inserisci una data valida \n";
  }  else  {
    var espressione = /[0-9]{4}-[0-9]{2}-[0-9]{2}$/;
    if (!espressione.test(field))  {
        return "La data non &egrave; nel formato corretto\n";
    }
	  else {
	   anno = parseInt(field.substr(0,4),10);
     mese = parseInt(field.substr(5, 2),10);
     giorno = parseInt(field.substr(8,2),10);
		 // Crea la nuova data
		 var data=new Date(anno, mese, giorno);
     var oggi = new Date();
     /* Controlla che i parametri della data siano
        gli stessi che abbiamo impostato */
     if (data.getFullYear()==anno && data.getMonth()==mese && data.getDate()==giorno)
       if (data < oggi) {
          return "";
       } else {
          return "La data specificata dev'essere anteriore a quella odierna \n";
       }
		 else
		    return "La data specificata non esiste.\n";
	  }
  }
}

function validaModificaProfilo(form){
  var fail = "";
  fail += validaEmail(form.email.value);
  if (form.dataN.value!="") {
    fail += validaData(form.dataN.value);
  }
  if (fail == "") return true;
	else { alert(fail); return false; }
}
