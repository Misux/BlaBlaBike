<!DOCTYPE html>
<html>
 <head>
   <link rel="stylesheet" type="text/css" href="css/bici2.css"/>
 </head>
 <body>
 <?php
  include_once("common/file.php");
  include_once("common/connection.php");
  //richiamo l'array di sessione e assegno i parametri
  $acquirente=$_SESSION["username"];
  //controllo querystring
  $totAnnunci=contaTuttiAnnunci($cid,$acquirente);
  if(($_GET["id"]==NULL) || ($_GET["id"]>$totAnnunci-1) || ($_GET["id"]<0)) header("Location: err.php?e=404");
  else{
    $id=$_GET['id'];
    $bicicletta=$_SESSION["bicicletta"][$id];
    $telaio=$bicicletta["telaio"];
    $dataA=$bicicletta["dataA"];
    $venditore=$bicicletta["venditore"];
    $titoloA=str_replace("_", " ",$bicicletta["titoloA"]);
    $titoloA=mysqli_real_escape_string($cid,$titoloA);
    $id1=$_GET['id1'];

    $ric=$_GET["ric"];
    switch ($ric) {
      #schiacciando su "acquista", invii una richiesta di conferma acquisto
      case "acquista":
      if (RequestVendite($cid, $acquirente, $venditore, $dataA,$titoloA, $telaio)) { #richiesta di conferma
        echo"<h1 style='padding-left:50px;'>Richiesta di acquisto mandata al venditore.</h1>";
      }
      else {
        echo"<h1 style='padding-left:50px;'>Qualcosa non ha funzionato!</h1>";
      }
      echo"<table><tr><td><span style='padding-left:50px;'><b><a class='linkBici' href='index.php?op=annunci&act=dettagli&id=$id1'>Torna ai dettagli</a></span></b>";
      echo"</td></tr><tr><td><img src='images/bici9.jpg' max-width='80%' max-height='80%'></td></tr></table>";
      break;
    }
  }
 ?>
 </body>
</html>
