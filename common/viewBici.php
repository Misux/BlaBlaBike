<?php
include_once("connection.php");
include_once("common/file.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Profilo</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" href="css/bici2.css"/>
    <script>
    function eliminaBici() {
      var domanda = confirm("I tuoi dati andranno definitivamente persi");
      if (domanda === true) {
        //location.href = 'common/deleteBiciE.php';
        return true;
      } else {
        return false;
      }
    }
    </script>
  </head>
  <body id="part1">
    <?php
    $user = $_SESSION["username"];
    $id = $_GET["id"];
    if (($id!=$user) && (verificaViewAmico($cid,$user,$id)==false)) {
      header("Location: err.php?e=404");
    } else if ((($id!=$user) && (verificaViewAmico($cid,$user,$id)==true)) || ($id==$user))  {
    echo"<div class='boxBici'>";
    echo"<div id='boxIns'>";
    echo "<div id='titoloBici'>Le biciclette di ". $proprietario . "</div>";
    if (isset($_GET["msg"])) echo base64_decode($_GET["msg"]) ."<br/>";

    //--SOLO L'UTENTE LOGGATO PUO' ACCEDERE ALLA PAGINA D'INSERIMENTO NUOVA BICI --//
    if ($proprietario==$_SESSION["username"]) {
      echo "</br><a class='linkBici' href=\"index.php?op=bici&id='$proprietario'&act=ins\"> <b>Inserisci Bici </b></a>";
    }
    echo"</div>";

    $res=selectBici($cid, $proprietario);
    echo "<table id='tabBici'>";
    $count=1;
    while ($row=$res->fetch_assoc()) {
      echo  "<tr></tr>";
      echo  "<tr></tr>";
      echo  "<tr></tr>";
      echo "<tr><td class='fontInfo'> Marca </br> <b style=\"text-transform: uppercase\">".$row["nomeM"]."</td>";
      echo "<td class='fontInfo'> Tipo </br><b style=\"text-transform: uppercase\">" .$row["tipo"]. "</td>";
      echo "<td class='fontInfo'> Numero di Telaio </br> <b style=\"text-transform: uppercase\">" .$row["telaio"]. "</td>";
      if ($row["tipo"]=="Bici Da Corsa") {
        echo "<td class='fontInfo'> Peso </br><b style=\"text-transform: uppercase\">".$row["peso"]."</td>";
      } else {
        echo "<td class='fontInfo'> Dimensione Ruote </br><b style=\"text-transform: uppercase\">".$row["ruote"]."</td>";
      }
      echo "<td class='fontInfo'> Anno Produzione </br><b style=\"text-transform: uppercase\">" .$row["annoP"]. "</td>";
      echo "<td class='fontInfo'> Anno Acquisto </br><b style=\"text-transform: uppercase\">" .$row["annoA"]. "</td>";
      echo "<td class='fontInfo'> Colore </br><b style=\"text-transform: uppercase\">" .$row["colore"]. "</td>";
      $marca=mysqli_real_escape_string($cid,$row["nomeM"]);
      echo "<td class='fontInfo'> Media Marca </br> <b style=\"text-transform: uppercase\">". $media=mediaMarca($cid, $marca)."</td>";

      //SE E' LO USER POSSO MODIFICARE O CANCELLARE DATI BICI
      if ($proprietario==$_SESSION["username"]) {
        #modifica
        echo "<td></td><td></td><td style=\"text-align:center\"> <button onclick=\"window.location.href='index.php?op=bici&act=edit&telaio=".$row["telaio"]."&id=$proprietario'\"> Modifica </button> </td>";
        #cancella
        /* IL NUMERO DI TELAIO NON VIENE MOSTRATO MA SERVE PER MODIFICARE LA GIUSTA BICI è PER ELIMINARE UNA
           BICI E' NECESSARIO PASSARE TRAMITE METODO POST PASSATO TRAMITE FORM CON TYPE=HIDDEN */
        echo "<td></td> <td></td> <td style=\"text-align:center\">
        <form method=\"POST\" action=\"common/deleteBiciE.php\" onsubmit=\"return eliminaBici()\">
        <input type=\"hidden\" name=\"telaio\" value=\"".$row["telaio"]."\">
        <input class='botElimina'type=\"submit\" value=\"Elimina\">
        </form>";
      }
      echo  "<tr></tr>";
      echo  "<tr></tr>";
      echo  "<tr></tr>";
      echo  "<tr></tr>";
      echo  "<tr></tr>";
      echo  "<tr></tr>";
    }
    echo"</table>";
    echo"</div>";
    }
    ?>
  </body>
</html>
