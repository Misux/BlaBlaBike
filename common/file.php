<?php
require "connection.php";
//_________________________________REGISTRAZIONE_______________________________//
function inserisciUtente($cid,$user,$pwd,$pwd2,$mail){
	$risultato=array("msg" => "", "status" => 1);
	$msg="";
	$errore="";
	#controlli di registrazione
	if (empty($user) || empty($pwd) || empty($pwd2) || empty($mail)) {
		$errore="Devono essere compilati tutti i campi! <br/> <br/> <a href=\"index.php?op=reg\"> </a> Torna alla registrazione ";
  }
	if (!empty($errore)) {
		$msg= "<h1 style=\"text-align:center;\"> Si sono verificati i seguenti errori: $errore  </h1>";
		$risultato["status"]=0;
	}
	else
	{
		#inserimento del nuovo utente sul portale
		$sql = "INSERT INTO utente (`user`, `password`, `email`) VALUES ('$user','$pwd','$mail');";
		$res=$cid->query($sql);
		if ($cid->affected_rows==0)
		{
			$msg= "<h1 style=\"text-align:center;\"> Non posso inserire questo utente </h1> ";
		  $risultato["status"]=0;
		}
	}
	$risultato["msg"]=$msg;
	return $risultato;
}
//____________________________REIMPOSTA PASSWORD_______________________________//
function inserisciNuovaPwd($cid,$pwd,$pwd2,$mail){
	$risultato=array("msg" => "", "status" => 1);
	$msg="";
	$errore="";
	if (empty($pwd) || empty($pwd2) || empty($mail)) {
		 $errore="Devono essere compilati tutti i campi! <br/> <br/> <a href=\"common/recupero.php\"> Prova di Nuovo!";
	}
	if (!empty($errore)){
 		$msg= "<h1 style=\"text-align:center;\"> Si sono verificati i seguenti errori: $errore </h1>";
 		$risultato["status"]=0;
 	}
 	else
 	{
		#modifica pwd
		$sql= "UPDATE `utente` SET password='$pwd' WHERE email='$mail';";
 		$res=$cid->query($sql);
 		if ($cid->affected_rows==0)
 		{
 			$msg= "<h1 style=\"text-align:center;\"> Non puoi modificare la password </h1>";
 		  $risultato["status"]=0;
 		}
 	}
	$risultato["msg"]=$msg;
 	return $risultato;
}
//______________________________________LOGIN__________________________________//
function login($cid,$user,$pwd){
	$sql="SELECT * FROM utente WHERE BINARY user = '".$user."' AND password = '".$pwd."'";
	$res=$cid->query($sql) or die();
	if ($res){
		if($cid->affected_rows==0) return false;
		else return true;
	}
	return false;
}
//__________________VERIFICA SEGUACI CHE SEGUONO ORGANIZZATORE_________________//
function verificaSeguiti($cid,$user,$organizzatore){
	$query="SELECT * FROM `segue` WHERE seguace='$user' and seguito='$organizzatore' and stato='accettata';";
	$res=$cid->query($query);
	if ($cid->affected_rows) return true;
}
//______________________RICHIESTA DI SEGUIRE UTENTE____________________________//
function followRequest($cid, $userFollower, $userFollowing, $stato){
	$dataS = date("Y-n-j");
	$query="INSERT INTO `segue`(`dataS`, `seguace`, `seguito`, `stato`) VALUES ('$dataS','$userFollower','$userFollowing', '$stato')";
	$res=$cid->query($query);
	if ($cid->affected_rows) return true;
}
//_____________________ACCETTA RICHIESTA DI FARSI SEGUIRE DA UTENTE____________//
function followAccept($cid, $richiedente, $user, $stato){
	$dataS = date("Y-n-j");
	$query="UPDATE `segue` SET `dataS`='$dataS',`stato`='$stato' WHERE (seguace='$richiedente' AND seguito='$user')";
	$res=$cid->query($query);
	if ($cid->affected_rows) return true;
}
//_____________________RIFIUTARE RICHIESTA DI FARSI SEGUIRE DA UTENTE____________//
function followRefuse($cid, $richiedente, $user){
	$stato='sospesa';
	$query="DELETE FROM `segue` WHERE seguace='$richiedente' AND seguito='$user' AND stato='$stato';";
	$res=$cid->query($query);
	if ($cid->affected_rows) return true;
}
//_____________________________NON SEGUIRE PIU_________________________________//
function deleteFollow($cid,$userFollower, $userFollowing) {
	$query="DELETE FROM `segue` WHERE seguace='$userFollower' and seguito='$userFollowing';";
	$res=$cid->query($query);
	if ($cid->affected_rows) return true;
}
//_________________VERIFICA UTENTI GIA SEGUITI E QUELLI NON SEGUITI____________//
function verificaSegui($seguito, $utente) {
  foreach ($seguito as $seguito) {
      if ($seguito==$utente) {
        return true;
        break;
      }
  }
  return false;
}
//_________CERCA TUTTI GLI UTENTI SUL PORTALE TRANNE L'USER LOGGATO____________//
function cercaUtenti ($cid, $user) {
	$utenti=array();
	$i=0;
	$query="SELECT user FROM utente WHERE user NOT LIKE '$user'";
	$res=$cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	                    . ": " . $cid->error) . "</p>";
	while ($row=$res->fetch_assoc()) {
	    $utenti["$i"]=$row["user"];
			$i++;
	}
	return $utenti;
}
//_____CERCA UTENTI SEGUITI DALL'USER LOGGATO CON RICHIESTA GIA' ACCETTATA_____//
function cercaFollowingAccettata($cid, $user) {
 $seguiti=array();
 $j=0;
 $stato="accettata";
 $query="SELECT seguito FROM segue WHERE (seguace ='$user' AND stato='$stato')";
 $res=$cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
                    . ": " . $cid->error) . "</p>";
  while ($row=$res->fetch_assoc()) {
      $seguiti["$j"]=$row["seguito"];
      $j++;
  }
	return $seguiti;
}
//_______CERCA UTENTI SEGUITI DALL'USER LOGGATO CON RICHIESTA IN SOSPESO_______//
function cercaFollowingSospesa($cid, $user) {
	$seguiti=array();
	$j=0;
	$stato="sospesa";
	$query="SELECT seguito FROM segue WHERE (seguace ='$user' AND stato='$stato')";
	$res=$cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
                    . ": " . $cid->error) . "</p>";
  while ($row=$res->fetch_assoc()) {
      $seguiti["$j"]=$row["seguito"];
      $j++;
  }
	return $seguiti;
}
//_______________________VERIFICA RICHIESTE IN SOSPESO_________________________//
function cerca($cid, $user) {
	$seguiti=array();
	$j=0;
	$stato="accettata";
	$query="SELECT seguito FROM segue WHERE (seguace ='$user' AND stato='$stato')";
	$res=$cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
                    . ": " . $cid->error) . "</p>";
  while ($row=$res->fetch_assoc()) {
      $seguiti["$j"]=$row["seguito"];
      $j++;
  }
	return $seguiti;
}
//_____CERCA UTENTI SEGUITI DALL'USER LOGGATO CON RICHIESTA GIà ACCETTATA______//
function cercaRichiestaSospesa($cid, $user) {
	$richiedenti=array();
	$j=0;
	$stato="sospesa";
	$query="SELECT seguace FROM segue WHERE (seguito ='$user' AND stato='$stato')";
	$res=$cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
                    . ": " . $cid->error) . "</p>";
  while ($row=$res->fetch_assoc()) {
      $richiedenti["$j"]=$row["seguace"];
      $j++;
  }
	return $richiedenti;
}
//__________________________VERIFICA RICHIESTA PER ACQUISTI____________________//
function verRichiesta($cid,$telaio, $venditore, $dataA, $titoloA){
	$query="SELECT `confermato` FROM annuncio
	WHERE (venditore='$venditore' AND telaio='$telaio' AND dataA='$dataA' AND titoloA='$titoloA' AND confermato='sospesa')";
	$res = $cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
			                    . ": " . $cid->error) . "</p>";
	if ($cid->affected_rows) return true;
}
//______________________RICHIESTA ACQUISTI VENDITE____________________________//
function RequestVendite($cid, $acquirente, $venditore, $dataA,$titoloA, $telaio){
	$stato="vendesi";
	$confermato="sospesa";
	$query="UPDATE `annuncio` SET	`stato`='$stato',`acquirente`='$acquirente',`confermato`='$confermato'
			WHERE (venditore='$venditore' AND telaio= '$telaio' AND dataA='$dataA' AND titoloA='$titoloA')";
			$res = $cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
			                    . ": " . $cid->error) . "</p>";
	if ($cid->affected_rows) return true;
}
//___________________VERIFICA PERMESSO D'ACCESSO PROFILO_______________________//
function verificaViewAmico ($cid, $user, $id){
	$seguiti=array();
	$seguiti=cercaFollowingAccettata($cid, $user);
	foreach ($seguiti as $seguito) {
		if ($seguito==$id) {
			return true;
			break;
		}
	}
	return false;
}
//______________SELEZIONA MARCHE DELLE BICICLETTE GIA PRESENTI_________________//
function scegliMarche ($cid){
	$marche=array();
	$query="SELECT DISTINCT `nomeM`  FROM `bicicletta`";
	$res=$cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
          . ": " . $cid->error) . "</p>";
	$i=0;
	while ($row=$res->fetch_assoc()){
		$marche[$i]=$row["nomeM"];
		$i++;
	}
	return $marche;
}
//_________________________INSERISCI NUOVA BICICLETTA__________________________//
function insertBici ($cid,$telaio,$proprietario,$tipo,$marca,$peso,$ruote, $annoP,$annoA,$colore) {
	$colore=mysqli_real_escape_string($cid,$colore);
	$marca=mysqli_real_escape_string($cid,$marca);
	$acquisita='no';
	$query="INSERT INTO `bicicletta`(`telaio`,`proprietario`, `tipo`, `nomeM`,  `peso`, `ruote`, `annoP`, `annoA`, `colore`, `acquisita`)
	VALUES ('$telaio','$proprietario','$tipo','$marca', '$peso','$ruote', '$annoP','$annoA','$colore','$acquisita')";
	$res=$cid->query($query);
	if ($cid-> affected_rows >0)
		$msg="Inserimento andato a buon fine <br/>";
	else
		$msg="Errore nell'inserimento <br/>";
		return $msg;
}
//_________________________VISUALIZZA BICICLETTE UTENTE________________________//
function selectBici ($cid, $proprietario) {
	$query = "SELECT `nomeM`, `tipo`, `peso`, `ruote`, `annoP`, `annoA`, `colore`, `telaio` FROM `bicicletta` WHERE proprietario='$proprietario';";
	$res = $cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	                    . ": " . $cid->error) . "</p>";
	return $res;
}
//__CALCOLA LA MEDIA DEGLI UTENTI CHE POSSIEDONO BICICLETTE DELLA STESSA MARCA__//
function mediaMarca ($cid, $nomeM) {
	$query="SELECT user FROM utente";
	$res=$cid->query($query);
	while ($row=$res->fetch_row()) {
	  $utentiTotali[]=$row[0];
	}
	$query1="SELECT DISTINCT proprietario FROM `bicicletta` WHERE nomeM='$nomeM' AND proprietario IS NOT NULL";
	$res=$cid->query($query1);
	while ($row=$res->fetch_row()) {
	  $utentiConStessaMarca[]=$row[0];
	}
	$media= ceil((count($utentiConStessaMarca)/count($utentiTotali)) * 100) . "%";
	return $media;
}
//__________________VISUALIZZA BICICLETTE DELL UTENTE PER VENDITA______________//
// sono visualizzate tutte le bici di un utente che non sono già in vendita e non sono impegnate in uscite future
function selectBiciDaVendere ($cid, $proprietario) {
	$query="SELECT `nomeM`, `tipo`, `peso`, `ruote`, `annoP`, `annoA`, `colore`, `telaio` FROM `bicicletta`
			WHERE (bicicletta.proprietario='$proprietario' AND bicicletta.telaio NOT IN
				(SELECT telaio FROM annuncio WHERE (venditore=bicicletta.proprietario AND bicicletta.telaio=annuncio.telaio))
                  and bicicletta.telaio NOT IN (select telaio FROM partecipa WHERE bicicletta.telaio=partecipa.telaio AND dataU > NOW() AND statoPartecipazione='confermata'));";
	$res = $cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	                    . ": " . $cid->error) . "</p>";
	return $res;
}
//__________________________MODIFICA BICICLETTA________________________________//
function updateBici ($cid, $proprietario, $telaio) {
	$query = "SELECT `nomeM`, `tipo`, `peso`, `ruote`, `annoP`, `annoA`, `colore`, `telaio` FROM `bicicletta` WHERE (proprietario='$proprietario' AND telaio='$telaio') ;";
	$res = $cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	                    . ": " . $cid->error) . "</p>";
	return $res;
}
//_______________________VISUALIZZA TUTTI GLI ANNUNCI__________________________//
function visualizzaAnnunci ($cid) {
	$query= "SELECT `dataA`, `venditore`, `telaio`, `titoloA`, `prezzo`, `descrizione`,`stato`, `tipo`, `nomeM`,`confermato`
		FROM `annuncio` NATURAL JOIN bicicletta WHERE ((dataA > curDate()-7))";
	$res = $cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	                    . ": " . $cid->error) . "</p>";
	return $res;
}
//_______________________VISUALIZZA I MIEI ANNUNCI_____________________________//
function visualizzaMieiAnnunci ($cid, $venditore) {
	$query= "SELECT `dataA`, `venditore`, `telaio`, `titoloA`, `prezzo`, `descrizione`,`stato`, `tipo`, `nomeM`,`confermato`
		FROM `annuncio` NATURAL JOIN bicicletta WHERE venditore='$venditore'";
	$res = $cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	                    . ": " . $cid->error) . "</p>";
	return $res;
}
//__________VISUALIZZA DETTAGLI DI UNA BICI PRIMA DI ACQUISTARE________________//
function dettagliBici ($cid, $telaio, $venditore, $dataA, $titoloA, $stato) {
		$query= "SELECT `dataA`, `venditore`, `telaio`, `titoloA`, `prezzo`,`colore`, `peso`, `ruote`, `descrizione`,`stato`, `tipo`, `nomeM`,`acquirente`, `confermato`
			FROM `annuncio` NATURAL JOIN bicicletta WHERE (stato='$stato' AND telaio='$telaio' AND venditore='$venditore' AND dataA='$dataA' AND titoloA='$titoloA')";
			$res = $cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	                    . ": " . $cid->error) . "</p>";
	return $res;
}
//__________VISUALIZZA DETTAGLI DI UNA BICI PRIMA DI ACQUISTARE________________//
function dettagliBiciAcquisto ($cid, $telaio) {
	$query= "SELECT `dataA`, `venditore`, `telaio`, `titoloA`, `prezzo`,`colore`, `peso`, `ruote`, `descrizione`,`stato`, `tipo`, `nomeM`,`confermato`
		FROM `annuncio` NATURAL JOIN bicicletta WHERE (stato='vendesi' AND telaio='$telaio')";
	$res = $cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	                    . ": " . $cid->error) . "</p>";
	return $res;
}
//______________________CONFERMA ACQUISTO BICICLETTA___________________________//
function acquistaBici($cid, $acquirente, $venditore, $dataA,$titoloA, $telaio) {
	$stato="venduta";
	$confermato="si";
	$query="UPDATE `annuncio` SET	`stato`='$stato',`acquirente`='$acquirente',`confermato`='$confermato'
			WHERE (venditore='$venditore' AND telaio= '$telaio' AND dataA='$dataA' AND titoloA='$titoloA')";
			$res = $cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
			                    . ": " . $cid->error) . "</p>";
			return $res;
}
//_____________________________MODIFICA ANNUNCIO_______________________________//
function modificaAnnuncio($cid, $venditore, $dataA, $telaio, $titoloA, $descrizione, $prezzo, $stato) {
	$descrizione=mysqli_real_escape_string($cid,$descrizione);
	$query="UPDATE `annuncio` SET	`stato`='$stato', `descrizione`='$descrizione', `prezzo`='$prezzo', `titoloA`='$titoloA'
			WHERE (venditore='$venditore' AND telaio= '$telaio' AND dataA='$dataA')";
			$res = $cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
													. ": " . $cid->error) . "</p>";
			return $res;
	}
//______________________________ELIMINA ANNUNCIO_______________________________//
function eliminaAnnuncio($cid, $venditore, $dataA, $telaio) {
		$query="DELETE FROM `annuncio` WHERE venditore='$venditore' AND dataA='$dataA' AND telaio='$telaio'; ";
		$res = $cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
												. ": " . $cid->error) . "</p>";
		return $res;
	}
//UTENTE CHE INSERISCE L'ANNUNCIO VENDE LA BICI AL DI FUORI DEL PORTALE, PERTANTO SETTA IL VALORE DI PROPRIETARIO = NULL//
function vendiBiciEsternamente($cid, $telaio) {
	$query="UPDATE `bicicletta` SET `proprietario` = NULL WHERE telaio='$telaio';";
	$res = $cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
											. ": " . $cid->error) . "</p>";
	return $res;
}
//________________________CAMBIA PROPRIETARIO BICI_____________________________//
function cambiaProprietario($cid, $acquirente,$telaio) {
	$annoA=date("Y");
	$acquisita='si';
  $query="UPDATE `bicicletta` SET `annoA`='$annoA',`proprietario`='$acquirente', `acquisita`='$acquisita'
	WHERE `telaio`='$telaio'";
	$res = $cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
											. ": " . $cid->error) . "</p>";
	return $res;
}
//__________________________INSERISCI NUOVA USCITA_____________________________//
function insertUscita($cid,$titoloU,$dataU,$durata,$distanza,$dislivello,$oraR,$visibilita,$difficolta,$luogoR,$user,$tipoU) {
	$query="INSERT INTO `uscita`(`titoloU`, `dataU`, `durata`, `distanza`, `dislivello`, `oraR`, `visibilita`, `difficolta`, `luogoR`, `organizzatore`, `tipo`)
	VALUES ('$titoloU','$dataU','$durata','$distanza','$dislivello','$oraR','$visibilita','$difficolta','$luogoR','$user','$tipoU')";
	$res=$cid->query($query);
	if ($cid-> affected_rows >0) {
		$errore="";
	} else {
		$errore="Errore nell'inserimento <br/>";
}
return $errore;
}
//__________________________INSERISCI NUOVA TAPPA______________________________//
function insertTappa($cid,$numTappa,$titoloU,$dataU,$tipoT,$partenza,$arrivo,$lunghezza) {
	//Alle tappe di ogni uscita è associato un numero progressivo che parte necessariamente da 1, vicolo rispettato con $num
	$num=1;
	for($i=0; $i<$numTappa; $i++){
		$titoloU=mysqli_real_escape_string($cid,$titoloU);
		$partenza[$i]=mysqli_real_escape_string($cid,$partenza[$i]);
		$arrivo[$i]=mysqli_real_escape_string($cid,$arrivo[$i]);
		$query="INSERT INTO `tappa`(`numeroT`, `titoloU`, `dataU`, `tipoT`, `partenza`, `arrivo`, `lunghezza`)
		VALUES ('$num','$titoloU','$dataU','$tipoT[$i]','$partenza[$i]','$arrivo[$i]','$lunghezza[$i]')";
		$res=$cid->query($query);
		$num++;
	}
	if ($cid-> affected_rows >0) {
		$errore="";
	} else {
		$errore="Errore nell'inserimento <br/>";
	}
	return $errore;
}
//__________________________INSERISCI NOTA_____________________________________//
function insertNota($cid,$numNota,$titoloN,$testoN,$titoloU,$dataU) {
	for($i=0; $i<$numNota; $i++){
		$titoloN[$i]=mysqli_real_escape_string($cid,$titoloN[$i]);
		$titoloU=mysqli_real_escape_string($cid,$titoloU);
		$testoN[$i]=mysqli_real_escape_string($cid,$testoN[$i]);
		$query="INSERT INTO `nota`(`titoloN`, `testoN`,`titoloU`, `dataU`)
		VALUES ('$titoloN[$i]','$testoN[$i]','$titoloU','$dataU')";
		$res=$cid->query($query);
	}
	if ($cid-> affected_rows >0) {
		$errore="";
	} else {
		$errore="Errore nell'inserimento <br/>";
	}
	return $errore;
}
//__________________________VERIFICA PARTECIPAZIONE____________________________//
function verPartecipa($cid,$user,$titoloU, $dataU) {
	$query="SELECT titoloU FROM partecipa WHERE ciclista='$user' AND titoloU='$titoloU' AND dataU='$dataU' AND statoPartecipazione='confermata';";
	$res=$cid->query($query);
	if ($cid->affected_rows) return true;
}
//_________________VERIFICA UTENTE PER CANCELLARE USCITA_______________________//
function verOrg($cid,$user,$titoloU,$dataU){
	$query="SELECT titoloU FROM uscita WHERE organizzatore='$user' AND titoloU='$titoloU' AND dataU='$dataU';";
	$res=$cid->query($query);
	if ($cid->affected_rows) return true;
}
//__________________________VERIFICA PARTECIPANTI______________________________//
function verPartecipanti($cid,$titoloU, $dataU){
	$query="SELECT COUNT(ciclista) FROM partecipa WHERE titoloU='$titoloU' AND dataU='$dataU' AND statoPartecipazione='confermata';";
	$res=$cid->query($query);
	while ($row=$res->fetch_row())
	  $partecipanti=$row[0];
	return $partecipanti;
}
//__________________________VERIFICA VALUTAZIONE_______________________________//
function verificaValutazione($cid,$titoloU,$dataU){
	$val=0;
	$query="SELECT valutazione FROM partecipa WHERE titoloU='$titoloU' AND dataU='$dataU' AND statoPartecipazione='confermata';";
	$res=$cid->query($query);
	while ($row=$res->fetch_row())
	  $val=$row[0];
	if ($val != null) return true;
}
//__________________________STAMPA VALUTAZIONE_________________________________//
function valutazione($cid,$titoloU,$dataU){
	$val=0;
	$query="SELECT valutazione FROM partecipa WHERE titoloU='$titoloU' AND dataU='$dataU' AND statoPartecipazione='confermata';";
	$res=$cid->query($query);
	while ($row=$res->fetch_row())
	  $val=$row[0];
	return $val;
}
//__________________MEDIA DELLE VALUTAZIONI SU QUELLA USCITA____________________//
//funzione non usata
function mediaValutazione($cid,$titoloU,$dataU){
	$query="SELECT AVG(valutazione) FROM partecipa WHERE titoloU='$titoloU' AND dataU='$dataU' AND statoPartecipazione='confermata' and valutazione!='null';";
	$res=$cid->query($query);
	while ($row=$res->fetch_row())
	  $media=$row[0];
	return $media;
}
//________________________VISUALIZZAZIONE DELLA DATA___________________________//
//pagina EditProfiloE.php
function validateData($date){
  $d = DateTime::createFromFormat('Y-m-d', $date);
  return $d && $d->format('Y-m-d') === $date;
}
//____________CONTEGGIO TUTTI GLI ANNUNCI PER ERRORE QUERYSTRING_______________//
function contaTuttiAnnunci($cid,$user) {
	$query= "SELECT COUNT(*) FROM `annuncio` WHERE venditore!='$user' AND ((dataA > curDate()-7))";
	$res = $cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	                    . ": " . $cid->error) . "</p>";
	while ($row=$res->fetch_row())
			$cont=$row[0];
	return $cont;
}
//_________________CONTEGGIO MIEI ANNUNCI PER ERRORE QUERYSTRING_______________//
function mieiAnnunci($cid,$user) {
	$query= "SELECT COUNT(*) FROM `annuncio` WHERE venditore='$user' AND ((dataA > curDate()-7))";
	$res = $cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	                    . ": " . $cid->error) . "</p>";
	while ($row=$res->fetch_row())
			$cont=$row[0];
	return $cont;
}
//____________CONTEGGIO TUTTI GLI ANNUNCI FUORI PER ERRORE QUERYSTRING_______________//
function contaTuttiAnnunciFuori($cid) {
	$query= "SELECT COUNT(*) FROM `annuncio` WHERE ((dataA > curDate()-7))";
	$res = $cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	                    . ": " . $cid->error) . "</p>";
	while ($row=$res->fetch_row())
			$cont=$row[0];
	return $cont;
}
?>
