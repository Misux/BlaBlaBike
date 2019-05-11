<?php
include_once("connection.php");
session_start();
$user=$_SESSION["username"];
$tipo=$_POST["tipo"];
$difficolta=$_POST["difficolta"];

//query di visualizzazione uscite, la query viene spezzata su più righe in caso vengono impostati dei filtri
$valore= "SELECT titoloU, dataU, durata, distanza, dislivello, oraR, visibilita,
difficolta, luogoR, organizzatore,tipo FROM uscita WHERE dataU > now()";

#fase filtraggio se il tipo e/o la difficoltà sono settati
if ($tipo!="") {
  $valore.=" AND tipo=\'".$tipo."\'";
}
if ($difficolta!="") {
  $valore.=" AND difficolta= \'".$difficolta."\'";
}

$valore.=" ORDER BY dataU DESC";

$tipoFiltro="uscite";
/* L’attributo tipoFiltro ci permette di differenziare l'inserimento della tupla nella tabella filtri.
  se assume valore "uscite" il tipo = uscite altrimenti analogamente tipo = annunci */
$verificaPresenzaFiltro="SELECT valore FROM `filtri` WHERE user='$user' AND tipo='$tipoFiltro'";
$risultato=$cid->query($verificaPresenzaFiltro);
while ($row=$risultato->fetch_assoc()) {
  $giaPresente=$row["valore"];
}
// SE è GIà PRESENTE UN FILTRO ASSOCIATO A QUELL'UTENTE, IL VALORE DEL FILTRO VIENE AGGIORNATO //
if ($giaPresente) {
  $query="UPDATE `filtri` SET `valore`='$valore' WHERE `user`='$user' and tipo='$tipoFiltro'";

// SE INVECE NON è ANCORA PRESENTE UN FILTRO ASSOCIATO ALL'UTENTE, VIENE MEMORIZZATO UN NUOVO RECORD NEL DATABASE
} else {
  $query="INSERT INTO `filtri`(`user`, `tipo`, `valore`) VALUES ('$user','$tipoFiltro','$valore')";
}

// SI EFFETTUA LA QUERY DI INSERT O UPDATE ALL'INTERNO DELLA TABELLA FILTRI E SI RITORNA ALLA PAGINA DEGLI USCITE
$res=$cid->query($query)Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
                    . ": " . $cid->error) . "</p>";

header("location: ../index.php?op=uscite&act=view");
?>
