<?php
  $act=$_GET["act"];
  if (isset($_SESSION["username"])) {
    $user=$_SESSION["username"];
  }

  switch ($act) {
    case 'ins':
      if (isset($_SESSION["username"])) {
        include("common/insAnnuncio.php");
      } else {
        #per vendere devi essere un utente del portale
        echo"<h1><a style='text-decoration:none; margin-left:10%;' href=\"index.php?op=reg\"> REGISTRATI AL PORTALE </a></h1>";
        echo"<div style='border:0px solid black; position:fixed;'><img src='images/bici9.jpg' max-width='82%' max-height='80%'></div>";
      }
      break;

    case 'view':
      include("common/viewAnnuncio.php");
      break;

    case 'dettagli':
      include("common/dettagliAnnuncio.php");
      break;

    case 'dettagliE':
      include("common/dettagliAnnuncioE.php");
      break;

    case 'dettagliMod':
      include("common/dettagliAnnuncioMod.php");
      break;

    case 'dettagliCanc':
      include("common/dettagliAnnuncioCanc.php");
      break;
    default:
      header("Location: err.php?e=404");
      break;
  }
?>
