<html>
 <head>
  <title>Cancellazione Uscita</title>
 </head>
 <body>
  <?php
    include_once("connection.php");
    $titolo=$_GET["id"];
    #query di cancellazione uscita
    $query = "DELETE FROM uscita WHERE titoloU='$titolo';";
    $res=$cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
    . ": " . $cid->error) . "</p>";

    if($cid->affected_rows > 0) {
      echo "<div style='padding-left:5%; font-size:20pt;'><b>Cancellazione avvenuta</b></div>";
    }
    echo"</br><span style='margin-left:5%;'><a href='index.php?op=uscite&act=view'><img src='images/indietro2.png' width='3%' height='4%'></a></span>";
    echo"</br><img src='images/bici9.jpg' width='75%' height='70%'>";
  ?>
 </bdoy>
</html>
