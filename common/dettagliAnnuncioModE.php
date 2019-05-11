 <?php
  include_once("file.php");
  include_once("connection.php");
  $telaio=$_GET["id1"];
  $venditore=$_GET["id2"];
  $dataA=$_GET["id3"];
  $titoloA=$_GET["id4"];


  $query= "SELECT `titoloA`, `prezzo`, `descrizione`,`stato`
		FROM `annuncio` NATURAL JOIN bicicletta WHERE venditore='$venditore' AND titoloA='$titoloA' AND dataA='$dataA' AND telaio='$telaio';";
  $res = $cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
  	                    . ": " . $cid->error) . "</p>";
  while ($row=$res->fetch_assoc()) {
      $s=$row["stato"];
      $t=$row["titoloA"];
      $p=$row["prezzo"];
      $d=$row["descrizione"];
  }
  //controlli modifica
  $stato=$_POST["stato"];

  if(!empty($_POST["titoloA"])) $titoloMod=str_replace("_", " ",$_POST["titoloA"]);
  else $titoloMod=$t;

  if(!empty($_POST["prezzo"])) $prezzo=$_POST["prezzo"];
  else $prezzo=$p;

  if(!empty($_POST["descrizione"])) $descrizione=$_POST["descrizione"];
  else $descrizione=$d;

  $titoloMod=mysqli_real_escape_string($cid,$titoloMod);
  $res=modificaAnnuncio($cid, $venditore, $dataA, $telaio, $titoloMod, $descrizione, $prezzo, $stato);
  ?>
<!DOCTYPE html>
<html>
 <head>
 </head>
 <body onload="document.forms[0].submit();">
  <?php echo "<form action=\"../index.php?op=annunci&act=view&tipo=miei\" method=\"POST\"></form>";?>
 </body>
</html>
