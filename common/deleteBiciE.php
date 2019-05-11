<?php
 include_once("connection.php");
 session_start();
 $telaio=$_POST["telaio"];
 $proprietario=$_SESSION["username"];
 $query = "DELETE from bicicletta WHERE telaio='$telaio';";
 $res=$cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
        . ": " . $cid->error) . "</p>";
 if($cid->affected_rows > 0) {
  $msg="Eliminazione effettuata correttamente!";
 } else {
  $msg= "Errore nella cancellazione";
 }
 $msg= base64_encode($msg);
 header("location: ../index.php?op=bici&act=view&id=$proprietario&msg=$msg");
?>
