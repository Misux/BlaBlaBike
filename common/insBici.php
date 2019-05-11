<?php
include_once ("connection.php");
include_once ("common/file.php");
$proprietario=$_SESSION["username"];
?>
<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="js/validate.js"></script>
    <script type="text/javascript" src="js/validaInsBici2.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bici2.css"/>
  </head>
  <body id="part2">
    <div class="boxBici2">
    <form name="inserimentoBici" method="POST" action="common/insBiciE.php" onsubmit="return validaInserimentoBici(this)">
    <table id='tabBiciIns'>
    <tr>
    <!-- SE SI SCEGLIE DI AGGIUNGERE UNA MARCA ESISTENTE COMPARE SELECT, PER INSERIRE NUOVA MARCA APPARE FORM !-->
    <!--funzioni in validate.js-->
    <td class="fontInfo2"><b>Marca Bicicletta:</b></td>
    <td class="fontInfo1"><input type="radio" name="nomeM" id="Esistente" onclick="selectMarca();" >Scegli tra quelle presenti </td>
    <td class="fontInfo1"><input type="radio" name="nomeM" id="Nuova" onclick="insNuova();"  >Aggiungi Nuova </td>
  </tr>
  <tr>
    <td> </td>
    <!-- MARCHE ESISTENTI !-->
    <td class="fontInfo1">
      <select id="selectM" name="marcaEsistente" disabled="true" style="display:none;">
          <?php
          $marche=array();
          $marche=scegliMarche($cid);
          foreach ($marche as $marca) {
          echo " <option value=$marca>".$marca."</option> ";
          }
          ?>
        </select>
    </td>
    <!-- NUOVA MARCA !-->
    <td class="fontInfo1">
      <input id="nuovaM" type="text" name="marcaN" disabled="true" style="display:none;">
    </td>
  </tr>
  <tr>
    <td class="fontInfo2"><b>Numero Telaio</b></td>
    <td class="fontInfo1"> <input id="telaio" type="text" name="telaio">
    </td>
  </tr>
  <tr><!-- TIPOLOGIA BICICLETTA !-->
    <td class="fontInfo2"><b>Tipologia Bicicletta:</b></td>
    <!--funzioni in validaInsBici2.js-->
      <td class="fontInfo1"> <input type="radio" name="tipoB" id="Corsa" value="Bici Da Corsa" onclick="mostraPeso();"> Bici Da Corsa </td>
      <td class="fontInfo1"> <input type="radio" name="tipoB" id="Mbike" value="Mountain Bike" onclick="mostraRuote();"> Mountain Bike</td>
  </tr>

  <tr><!-- SI PUò INSERIRE PESO SOLO SE LA BICI è DA CORSA! -->
    <td class="fontInfo2"><b>Peso:</b></td>
      <td class="fontInfo1">
        <input id="pesoB" type="number" name="peso" disabled="true" min="1" max="100">
      </td>
  </tr>
<tr>
  <!-- SI PUò INSERIRE DIMENSIONE DELLE RUOTE SOLO SE LA BICI è MOUNTAIN BIKE
  e le dimensioni delle ruote devono essere di quelle misure!-->
    <td class="fontInfo2"><b>Dimensione Ruote:<b></td>
      <td class="fontInfo1"> <select id="ruote" name="ruote" disabled="true" >
            <option value="26" checked> 26 </<option>
            <option value="27.5"> 27.5 </<option>
            <option value="29"> 29 </<option>
          </select>
      </td>
  </tr>

  <tr>
    <td class="fontInfo2"><b>Colore:</b></td>
    <td class="fontInfo1"> <input type="text" name="colore">
    </td>
  </tr>
  <tr>
    <!-- validazioni con un alert, vedi validaInsBici2.js-->
    <td class="fontInfo2"><b>Anno Produzione: </b></td>
    <td class="fontInfo1"> <input type="text" name="annoP">
    </td>
  </tr>
  <tr>
    <td class="fontInfo2"><b>Anno Acquisto:</b></td>
    <td class="fontInfo1"> <input type="text" name="annoA">
    </td>
  </tr>
  <tr>
    <td colspan="3" style="padding-top:5%; padding-bottom:2%;"class="fontInfo1">
      <input class="buttonAg" type="submit" name="Aggiungi Bicicletta" value="Aggiungi Bicicletta">
      &nbsp;<input class="botCanc" type="submit" name="Cancella" value="Cancella">
    </td>
</tr>
</table>
</form>
</div></br>
<?php echo"<span style='margin-left:20%;'><a class='linkBici' href='index.php?op=bici&act=view&id=$proprietario'><b><img src='images/indietro2.png' width='3%' height='4%'></b></a></span>";?>
  </body>
  </html>
