// VALIDA LA DATA DELL'USCITA
function validaData(dataU) {
  var oggi = new Date();
  var arrDataU = dataU.split("-");
  var dataUscita = new Date(arrDataU[0], arrDataU[1]-1, arrDataU[2]);

  if ((dataU == "") || (oggi > dataUscita)) {
    return "La data e' obbligatoria e dev'essere successiva a quella odierna \n";
  }
  return "";
}

// VALIDA IL TITOLO //
function validaTitolo(titoloU) {
    if (titoloU == "") {
      return "Il titolo e' obbligatorio!\n";
    }
    return "";
}
// VALIDA IL LUOGO DI RITROVO //
function validaLuogoR(luogoR) {
    if (luogoR == "") {
      return "Il luogo di ritrovo e' obbligatorio!\n";
    }
    return "";
}
//LA DURATA DI UNA TAPPA DEVE ESSERE OBBLIGATORIAMENTE MINORE DI 8//
function validaDurata(durata) {
  if ((durata== "" ) || (durata < 0) || (durata > 8)) {
    return "La durata dell'uscita deve essere minore di 8 ore!\n";
  }
  return "";
}
// SI DEVE SCEGLIERE OBBLIGATORIAMENTE IL TIPO DI USCITA //
function validaTipologiaUscita(Corsa, Mbike) {
  if ((Corsa.checked == false) && (Mbike.checked == false)) {
    return "Scegli una tipologia di uscita!\n";
  }
  return "";
}
// SI DEVE SCEGLIERE OBBLIGATORIAMENTE LA VISIBILITA//
function validaVisibilita (privata, pubblica) {
  if ((privata.checked == false) && (pubblica.checked == false)) {
    return "Scegli la visibilità!\n";
  }
  return "";
}
// SI DEVE SCEGLIERE OBBLIGATORIAMENTE IL TIPO DI DIFFICOLTA //
function validaDifficolta (bassa, media, alta) {
  if ((bassa.checked == false) && (media.checked == false)  && (alta.checked == false)) {
    return "Scegli la difficoltà dell'uscita!\n";
  }
  return "";
}

function validaArrivo(form) {
 var sceltaArrivo=false;
 for (var i=0; i < form.elements['arrivo'].length; i++){
      if (form.elements['arrivo'][i].value=="") {
        return false;
      } else {
        sceltaArrivo=true;
      }
    }

    if (sceltaArrivo) {
      return true;
    }


    if (!sceltaArrivo) {
      if (form.arrivo.value=="") {
        return false;
      } else {
        return true;
      }
    }
    return false;
}

//SI DEVE SCEGLIERE OBBLIGATORIAMENTE LA PARTENZA TAPPA//
function validaPartenza(form) {
  var sceltaPartenza=false;
  for (var i=0; i < form.elements['partenza'].length; i++){
       if (form.elements['partenza'][i].value=="") {
         return false;
       } else {
         sceltaPartenza=true;
       }
     }

     if (sceltaPartenza) {
       return true;
     }


     if (!sceltaPartenza) {
       if (form.partenza.value=="") {
         return false;
       } else {
         return true;
       }
     }
     return false;
 }

//OGNI TAPPA DEVE AVERE UNA LUNGHEZZA IN KM
 function validaLunghezza(form) {
   var sceltaLunghezza=false;
   for (var i=0; i < form.elements['lunghezza'].length; i++){
        if ((form.elements['lunghezza'][i].value=="") || (form.elements['lunghezza'][i].value<1)) {
          return false;
        } else {
          sceltaLunghezza=true;
        }
      }

      if (sceltaLunghezza) {
        return true;
      }


      if (!sceltaLunghezza) {
        if ((form.lunghezza.value=="") || (form.lunghezza.value<1)) {
          return false;
        } else {
          return true;
        }
      }
      return false;
  }

//--- SE SI INSERISCONO UNA O PIU NOTAE QUESTE DEVONO AVERE UN TITOLO
  function validaTitoloNota(form) {
    var sceltaTitoloN=false;
    for (var i=0; i < form.elements['titoloN'].length; i++){
         if (form.elements['titoloN'][i].value==""){
           return "La Nota deve avere un titolo \n";
         } else {
           sceltaTitoloN=true;
         }
       }

       if (sceltaTitoloN) {
         return "";
       }


       if (!sceltaTitoloN) {
         if (form.titoloN.value=="") {
           return "La Nota deve avere un titolo \n";
         } else {
           return "";
         }
       }
       return "La Nota deve avere un titolo \n";
   }


   //--- SE SI INSERISCONO UNA O PIU NOTAE QUESTE DEVONO AVERE UN TESTO
     function validaTestoNota(form) {
       var sceltaTestoN=false;
       for (var i=0; i < form.elements['testoN'].length; i++){
            if (form.elements['testoN'][i].value==""){
              return "La Nota deve avere un testo\n";
            } else {
              sceltaTestoN=true;
            }
          }

          if (sceltaTestoN) {
            return "";
          }


          if (!sceltaTestoN) {
            if (form.testoN.value=="") {
              return "La Nota deve avere un testo \n";
            } else {
              return "";
            }
          }
          return "La Nota deve avere un testo\n";
      }


// VALIDA IL TAPPA //
function validaTappa(tappa, form) {
    if ((tappa.value=="") || (tappa.value<1)) {
      return "L'inserimento di almeno una tappa e' obbligatorio!\n";
    } else {
      var arrivo=validaArrivo(form);
      if (arrivo==false) {
        return "L'inserimento dell'arrivo e' obbligatorio!\n";
      } else {
        var partenza=validaPartenza(form);
        if (partenza==false) {
          return "L'inserimento della partenza e' obbligatorio!\n";
        } else {
          var lunghezza=validaLunghezza(form);
          if (lunghezza==false) {
            return "L'inserimento della lunghezza della tappa e' obbligatorio!\n";
          }
        }
      }
    }
    return "";
}


// SI DEVE SCEGLIERE OBBLIGATORIAMENTE IL TIPO DI TAPPA
/*function validaTipoT (tipoT) {
  if ((tipoT.checked == "")) {
    return "Scegli il tipo di tappa tra salita, discesa e pianeggiante!\n";
  }
  return "";

}*/
// SI DEVE SCEGLIERE OBBLIGATORIAMENTE L'ARRIVO DELLA TAPPA//

function validaInserimentoUscita(form)
{
    var fail = "";

    fail += validaData(form.dataU.value);
    fail +=validaTitolo(form.titoloU.value);
    fail +=validaLuogoR(form.luogoR.value);
    fail +=validaDurata(form.durata.value);
    fail +=validaTipologiaUscita(document.getElementById("Corsa"),document.getElementById("Mbike"));
    fail +=validaDifficolta(document.getElementById("bassa"),document.getElementById("media"),document.getElementById("alta"));
    fail +=validaVisibilita(document.getElementById("pubblica"),document.getElementById("privata"));
    fail +=validaTappa(document.getElementById("tappa"), form);
    if (form.nota.value!=""){
      fail +=validaTitoloNota(form);
      fail +=validaTestoNota(form);
    }
    if (fail=="") return true;
    else { alert(fail); return false; }
    return false;
}




function validaModificaUscita() {
  if ((!document.getElementById("pubblica").checked) && (!document.getElementById("privata").checked)) {
    alert("Devi Selezionare Una delle due opzioni!");
    return false;
  } else {
    return true;
  }
}



function confermaRinuncia() {
  var domanda = confirm("Intendi procedere?");
	if (domanda === true) {
		return true;
	}
	return false;

}




function mostraPartecipanti(count){
  var elem=document.getElementById("mostraPart" + count)
  if (elem.style.display=="none") {
    elem.style.display="inline";
  } else {
    elem.style.display="none";
  }
}
