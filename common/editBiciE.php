<?php
  session_start();
  include_once("connection.php");
  include_once("file.php");
  $proprietario=$_SESSION["username"];
  $telaio=$_POST["telaio"];
  $annoA=$_POST["annoA"];
  $colore=$_POST["colore"];

  if (isset($_POST["peso"])) {
    $peso=$_POST["peso"];
    $query="UPDATE `bicicletta` SET `peso`='$peso',`ruote`= NULL,`annoA`='$annoA',
          `colore`='$colore' WHERE telaio='$telaio';";
  }

  if (isset($_POST["ruote"])) {
    $ruote=$_POST["ruote"];
    $query="UPDATE `bicicletta` SET `ruote`='$ruote',`peso`=NULL,`annoA`='$annoA',
          `colore`='$colore' WHERE telaio='$telaio';";
  }

  $res=$cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno. ": " . $cid->error) . "</p>";
  if($cid->affected_rows > 0) {
    $msg="Aggiornamento andato a buon fine";
  } else {
    $msg= "Errore nell'aggiornamento";
  }
  $msg= base64_encode($msg);
  header("location: ../index.php?op=bici&act=view&id=$proprietario&msg=$msg");
?>
