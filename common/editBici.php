<html>
 <head>
  <title>Modifica Bici</title>
  <link rel="stylesheet" type="text/css" href="css/bici2.css"/>
  <style>
    .fontEdit{font-size: 10pt;}
    #botMod{
      width: 84%;
      color: white;
      height: 25px;
      background-color: grey;
    }
    #botMod:hover{background:#5d5d5d;}
  </style>
 </head>
 <body>
  <h2 style='margin-left:8%;'>Modifica i tuoi dati della tua bici</h2>
  <table border=0px style='margin-left:10%; padding-top:1%;' width='400px'>
   <tr>
    <td>
      <?php
      include_once("common/connection.php");
	    include_once("common/file.php");
      $proprietario=$_SESSION["username"];
      $telaio=$_GET["telaio"];
      /* SOLO L'UTENTE LOGGATO PUO' MODIFICARE LE SUE BICI
         evita di far accedere con id diverso dallo user nella barra di ricreca */
      if ($_GET["id"]!=$_SESSION["username"]) {
          $msg="Non sei abilitato a questa operazione!";
          $msg= base64_encode($msg);
          header("location:index.php?op=msg&msg=$msg");
      } else {
          $_GET["id"]=$proprietario;
          // funzione di modifica bici in file.php
          $res=updateBici ($cid, $proprietario, $telaio);
          // validazioni in valiInsBici2.js
          echo "<form method=\"POST\" action=\"common/editBiciE.php\" onsubmit=\"return validaUpdateBici(this);\"> ";
          echo "<table>";
          while ($row=$res->fetch_assoc()) {
            echo "<tr> <td class='fontEdit'> TIPO: </td> <td class='fontEdit'> <b>" . $row["tipo"]." </b> </td> </tr>";
            echo "<tr> <td class='fontEdit'> MARCA: </td> <td class='fontEdit'> <b>" . $row["nomeM"]." </b> </td> </tr>";
            echo "<tr> <td class='fontEdit'> TELAIO: </td> <td class='fontEdit'> <b>" . $row["telaio"]." </b> </td> </tr>";
            echo "<tr> <td class='fontEdit'> <input type=\"hidden\" name=\"telaio\" value=\"".$row["telaio"]."\" style=\"display:none\"> </td> </tr>";
            if ($row["tipo"]=="Bici Da Corsa") {
              echo "<tr> <td class='fontEdit'> PESO (Kg): </td> <td> <b> <input type=\"number\" min=1 max=100 id=\"pesoB\" name=\"peso\" value=".$row["peso"]."> </td> </tr>";
            } else {
              echo "<tr> <td class='fontEdit'> DIMENSIONI RUOTE (pollici): </td> <td> <select name=\"ruote\">
                                                           <option  value=26> 26 </option>
                                                           <option value=27.5> 27.5 </option>
                                                           <option value=29> 29 </option>
                                                           </select> </td></tr>";
            }
            echo "<tr> <td class='fontEdit'> ANNO DI PRODUZIONE: </td> <td class='fontEdit'> <b>" . $row["annoP"]." </b> </td> </tr>";
            echo "<tr> <td class='fontEdit'> <input type=\"hidden\" name=\"annoP\" value=\"".$row["annoP"]."\" style=\"display:none\"> </td> </tr>";
            echo "<tr> <td class='fontEdit'> ANNO DI ACQUISTO: </td> <td> <b> <input style='padding-left:1%;' type=\"text\" name=\"annoA\" value=". $row["annoA"]."> </b> </td> </tr>";
            echo "<tr> <td class='fontEdit'> COLORE: </td> <td> <b> <input style='padding-left:1%;' type=\"text\" name=\"colore\" value=". $row["colore"]."> </b> </td> </tr>";
          }
        }
        echo "<tr><td style='padding-top:5%; padding-bottom:3%;'><input id='botMod' type=\"submit\" value=\"Applica Modifiche\"> </td> </tr>";
        echo"</table>";
        echo "</form>";
        ?>
        </td>
      </tr>
    </table>
    <?php echo"<span style='margin-left:10.5%;'><a class='linkBici' href='index.php?op=bici&act=view&id=$proprietario'><b><img src='images/indietro2.png' width='3%' height='4%'></b></a></span>";?>
  </br><img src='images/bici9.jpg' max-width='80%' max-height='80%'>
  </body>
 </html>
