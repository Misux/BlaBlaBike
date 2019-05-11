<?php
  include_once("connection.php");
  $visibilita=$_POST["visibilita"];
  $titoloU=$_GET["id"];
  #query di modifica visibilità uscita
  $query="UPDATE `uscita` SET `visibilita`='$visibilita' WHERE (titoloU = '$titoloU');";
  $res=$cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
  . ": " . $cid->error) . "</p>";

  if ($cid->affected_rows==0) {
    $msg="<h1> Errore nella modifica della visibilità</h1>";
  } else {
    $msg="<h1> Modifica effettuata con successo </h1>";
  }
  $msg= base64_encode($msg);
  header("location:index.php?op=uscite&act=view&msg=$msg");
?>
