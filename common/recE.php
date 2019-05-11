<?php
include_once("./connection.php");
include_once("./file.php");

$mail=$_POST["mail"];
$pwd=$_POST["pwd"];
$pwd2=$_POST["pwd2"];

// funzione di modifica password in file.php
$risultato=inserisciNuovaPwd($cid,$pwd,$pwd2,$mail);
if ($risultato["status"]==1)
  $msg= "<h1 style=\"text-align:center;\"> Password reimpostata. Procedi con il login </h1>";
else
  $msg=  $risultato["msg"];

$msg= base64_encode($msg);
header("location: ../index.php?op=msg&msg=$msg");
?>
