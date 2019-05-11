<?php
include_once("common/connection.php");
$user=$_SESSION["username"];
$titoloU=$_GET["id1"];
$dataU=$_GET["id2"];
#elimino partecipazione
$queryDel="DELETE FROM `partecipa` WHERE ciclista='$user' AND titoloU='$titoloU' AND dataU='$dataU' AND statoPartecipazione='sospesa';";
$risultato=$cid->query($queryDel) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
                    . ": " . $cid->error) . "</p>";
if ($cid->affected_rows==0) {
    $msg= "<h1> Errore </h1> </br>";
} else {
    $msg="<h1> Invito Riufiutato Correttamente </h1> </br>";
}
$msg= base64_encode($msg);
header("location:index.php?op=richieste&msg=$msg");
?>
