<?php
include_once("connection.php");
//VERIFICA SE è PRESENTE UN FILTRO ASSOCIATO ALL'UTENTE
$filtro="SELECT `valore` FROM filtri WHERE tipo='uscite' AND user='$user'";
$result=$cid->query($filtro) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
                    . ": " . $cid->error) . "</p>";

while ($row=$result->fetch_assoc()) {
  $valoreFiltroUscita=$row["valore"];
}


if (!isset($valoreFiltroUscita)) {
$valoreFiltroUscita= "SELECT titoloU, dataU, durata, distanza, dislivello, oraR, visibilita, difficolta, luogoR, organizzatore,tipo FROM uscita WHERE dataU > now() ORDER BY dataU DESC;";
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<form name="filtri" action="common/aggiungiFiltroUscite.php" method="POST" style='border:0px solid black; height:60px; padding:0px;'>
  <table id="tabFiltri">
    <tr><td><b>TIPO DI USCITA&nbsp;</b><select class="lungFiltro" name="tipo">
                              <option value=""> Nessun Filtro </option>
  <?php // SI SELEZIONANO TUTTE LE MARCHE PRESENTI NEL DATABASE E SI VERIFICA SE IL VALORE DI UNA DI ESSE è
  // PRESENTE NELLA STRINGA ASSOCIATA AL FILTRO PER QUELL'UTENTE. IN TAL CASO, TALE OPTION AVRà L'ATTRIBUTO SELECT
                            $queryTipo="SELECT distinct tipo FROM tipologia";
                                    $res1=$cid->query($queryTipo) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
                                  	                    . ": " . $cid->error) . "</p>";
                                    while ($row=$res1->fetch_assoc()) {
                                      $cercaStringa=strstr($valoreFiltroUscita, $row["tipo"]);
                                      if ($cercaStringa){
                                        echo "<option id=\"".$row["tipo"]."\" value=\"".$row["tipo"]."\" selected>".$row["tipo"]."</option>";
                                      } else {
                                        echo "<option id=\"".$row["tipo"]."\" value=\"".$row["tipo"]."\">".$row["tipo"]."</option>";
                                      }

                                    }

                             ?>

  <td><b>DIFFICOLTA&nbsp;</b><select class="lungFiltro" name="difficolta">
                <option value=""> Nessun Filtro </option>
<?php // SI SELEZIONANO TUTTI I COLORI DELLE BICI PRESENTI NEL DATABASE E SI VERIFICA SE IL VALORE DI CIASCUN COLORE DI è
// PRESENTE NELLA STRINGA ASSOCIATA AL FILTRO PER QUELL'UTENTE. IN TAL CASO, TALE OPTION AVRà L'ATTRIBUTO SELECT
                  $cercaStringa=strstr($valoreFiltroUscita, "bassa");
                          if ($cercaStringa){
                            echo "<option value=\"bassa\" selected> Bassa</option>";
                          } else {
                            echo "<option value=\"bassa\"> Bassa</option>";
                          }

                  $cercaStringa=strstr($valoreFiltroUscita, "media");
                            if ($cercaStringa){
                              echo "<option value=\"media\" selected> Media</option>";
                            } else {
                              echo "<option value=\"media\"> Media</option>";
                            }

                  $cercaStringa=strstr($valoreFiltroUscita, "alta");
                            if ($cercaStringa){
                              echo "<option value=\"alta\" selected> Alta</option>";
                            } else {
                             echo "<option value=\"alta\"> Alta</option>";
                            }?>
                          </select>

<td><input id="botFiltro" type="submit" value="FILTRA" ></td></tr>
</table>
</form>
</body>
</html>


<?php
$res=$cid->query($valoreFiltroUscita) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
                      . ": " . $cid->error) . "</p>";
?>
