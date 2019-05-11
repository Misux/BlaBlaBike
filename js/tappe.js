// Funzione che permette di aggiungere elementi al form (in questo caso tappe)
function AggiungiTappa(tappa){
  var numero_tappe = tappa.value;
  //vincolo sulle tappe rispettato grazie a questa condizione
  if (numero_tappe > 10 || numero_tappe < 1) {
    alert ("Devi inserire un numero compreso tra 1 e 10");
    return false;
  }
  var box = document.getElementById('box_tappe');
  if(numero_tappe==""){
    box.innerHTML='';
  }else{
    if(isNaN(numero_tappe)==true){
      box.innerHTML='';
    }else{
      var righe = "";
      // Inserisco una riga ad ogni ciclo
      for(i=1; i<=numero_tappe; i++){
        righe = righe + "</br></br><div class='celNum'>Tappa n"+i+"</div></br>";
        //vincolo sul tipo di tappa che può essere di 3 tipologie rispettato grazie al select option
        righe = righe + "<select class='celTap' name='tipoT[]'><option value='piana' selected>Piana</option><option value='discesa'>Discesa</option><option value='salita'>Salita</option></select>&nbsp;";
        righe = righe + "<input class='celTap' type='text' name='partenza[]' id='partenza' placeholder='Partenza*' onfocus='his.placeholder'/>&nbsp;";
        righe = righe + "<input class='celTap' type='text' name='arrivo[]' id='arrivo' placeholder='Arrivo*' onfocus='his.placeholder'/>&nbsp;";
        righe = righe + "<input class='celTap' type='number' name='lunghezza[]' id='lunghezza' min=0 placeholder='Lunghezza (km)*' onfocus='his.placeholder'/>&nbsp;</br>";
      }
      // Aggiorno il contenuto del box che conterrà gli elementi aggiunti
      box.innerHTML=righe;
    }
  }
}

// Funzione che permette di aggiungere elementi al form (in questo caso note)
function AggiungiNota(nota){
  var numero_note = nota.value;
  //vincolo sulle note rispettato grazie a questa condizione
  if (numero_note > 10 || numero_note < 0) {
    alert ("Devi inserire un numero compreso tra 0 e 10");
    return false;
  }
  var box2 = document.getElementById('box_note');
  if(numero_note==""){
    box2.innerHTML='';
  }else{
    if(isNaN(numero_note)==true){
      box2.innerHTML='';
    }else{
      var righe = "";
      // Inserisco una nota ad ogni ciclo
      for(i=1; i<=numero_note; i++){
        righe = righe + "</br></br><div class='celNum'>Nota n"+i+"</div></br>";
        righe = righe + "<input class='celTitoloNota' type='text' name='titoloN[]' id='titoloN' placeholder='Titolo nota' onfocus='his.placeholder'/></br></br>";
        righe = righe + "<textarea class='boxNota' name='testoN[]' id='testoN' form='organizza2' placeholder='Testo Nota..' onfocus='this.placeholder'></textarea></br></br>";
      }
      // Aggiorno il contenuto del box che conterrà gli elementi aggiunti
      box2.innerHTML=righe;
    }
  }
}
