// SI VALUTA CHE ENTRAMBI GLI ANNI SIANO CORRETTI //
function validaAnno(annoP, annoA) {
  var espressione = /[0-9]{4}$/;
  var oggi = new Date();
  var annoCorrente = oggi.getFullYear();

  if ( (!espressione.test(annoP)) || (!espressione.test(annoA)) ) //ANNO FORMATO DA 4 CIFRE
  {
    return "Verifica la correttezza delle date inserite\n";
  } else {
  if (annoP>annoCorrente || annoP<1901 )
  //ANNO PRODUZIONE DEV ESSERE COMPRESO TRA 1901 E L'ANNO CORRENTE
  {
    return "L'anno di produzione dev'essere compreso tra il 1901 e l'anno corrente\n";
  }
  if (annoA>annoCorrente || annoA<1901 )
  //ANNO ACQUISTO DEV ESSERE COMPRESO TRA 1901 E L'ANNO CORRENTE
  {
    return "L'anno di Acquisto dev'essere compreso tra il 1901 e l'anno corrente\n";
  }
  if (annoA<annoP)
  //ANNO ACQUISTO DEV ESSERE MAGGIORE DELL'ANNO DI PRODUZIONE
  {
    return "L'anno di acquisto deve essere successivo all'anno di produzione\n"
  }
    return "";
  }
}

// VERIFICA CHE SIA STATO INSERITO UN VALORE PER IL PESO E CHE SIA MAGGIORE DI 0 E MINORE DI 100 KG
function validaPeso (peso) {
  if (peso=="") {
    return "Inserisci un valore per il peso!\n";
  }
  if (peso<=0) {
    return "Inserisci un peso maggiore di 0 Kg!\n";
  }
  if (peso>=100) {
    return "Inserisci un valore di Peso realistico! \n";
  }
  return "";
}

// VALIDA NUMERO DI TELAIO //
function validaTelaio(telaio) {
  if (telaio == "") {
    return "Il numero di telaio e' Obbligatorio!\n";
  }
  return "";
}

// VERIFICA CHE SIA STATA SCELTA UNA MARCA, NUOVA O ESISTENTE //
function validaMarca (Esistente, Nuova, inserimentoNuova) {
  if ((Esistente.checked == false) && (Nuova.checked == false)) {
    return "La Marca e' obbligatoria!\n";
  }
  if ((Nuova.checked==true) && (inserimentoNuova=="")) { // SE SI è SCELTA UNA MARCA NUOVA, DEV ESSERE INSERITA NEL CAMPO APPOSITO
    return "Inserisci un nome di una Marca!\n";
  }
  return "";
}

// SI DEVE SCEGLIERE OBBLIGATORIAMENTE IL TIPO DI BICI //
function validaTipologiaBici (Corsa, Mbike) {
  if ((Corsa.checked == false) && (Mbike.checked == false)) {
    return "Scegli una tipologia di bicicletta!\n";
  }
  return "";
}

function validaInserimentoBici(form) {
  var fail = "";
  fail +=validaAnno(form.annoP.value, form.annoA.value);
  fail +=validaMarca(document.getElementById("Esistente"),document.getElementById("Nuova"), document.getElementById("nuovaM").value);
  fail +=validaTipologiaBici(document.getElementById("Corsa"),document.getElementById("Mbike"));
  fail +=validaTelaio(form.telaio.value);
  //IL CONTROLLO SUL PESO VIENE FATTO SOLO SE è RICHIESTO CHE IL PESO SIA PRESENTE A SECONDA DELLA TIPOLOGIA DI BICI
  if ((document.getElementById("pesoB").disabled==false)) {
    fail += validaPeso(form.peso.value);
  }

  if (fail == "") return true;
  else { alert(fail); return false; }
}

// VALIDAZIONI PER LA PAGINA DI MODIFICA BICI
function validaUpdateBici(form) {
  var fail = "";
  fail += validaAnno(form.annoP.value, form.annoA.value);
  if (form.peso !== undefined ) {
	 fail += validaPeso(form.peso.value);
	}
  if (fail == "") return true;
  else { alert(fail); return false; }
}

//abilita e disabilita a seconda se il tipo della bici è da corsa
function mostraPeso () {
  var corsa=document.getElementById("Corsa");
  if (corsa.checked)
  {
    document.getElementById("pesoB").disabled=false;

    document.getElementById("ruote").disabled=true;
  }
}

//abilita e disabilita a seconda se il tipo della bici è mountain bike
function mostraRuote() {
  var Mbike=document.getElementById("Mbike");
  if (Mbike.checked)
  {
    document.getElementById("ruote").disabled=false;

    document.getElementById("pesoB").disabled=true;
  }
}
