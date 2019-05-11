<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="js/validaEditProfilo.js"> </script>
    <link rel="stylesheet" type="text/css" href="css/profilo0.css"/>
  </head>
  <body background="images/ciclistaFaccia2.jpg">
   </br>
    <table align=center class="pro">
     <tr>
      <td class="foto" valign="top" background="images/profilo.png">
      <td class="info" rowspan="2">
      <?php
        include_once ("connection.php");
        include_once ("file.php");
        //query select dati dello user
        $query = "SELECT `user`, `nome`, `cognome`, `luogoN`, `residenza`,
          `categoria`, `dataN`, `sesso`, `email` FROM `utente` WHERE user='$user';";
        $res= $cid->query($query)
        Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
        . ": " . $cid->error) . "</p>";
        while ($row = $res->fetch_assoc()){
          //str_replace sostituisce lo spazio vuoto con _ in modo da poter leggere quei particolari campi con lo spazio
          $user=str_replace(" ", "_",$row["user"]);
          $nome=str_replace(" ", "_",$row["nome"]);
          $cognome=str_replace(" ", "_",$row["cognome"]);
          $luogoN=str_replace(" ", "_",$row["luogoN"]);
          $residenza=str_replace(" ", "_",$row["residenza"]);
          $categoria=$row["categoria"];
          $dataN=$row["dataN"];
          $sesso=$row["sesso"];
          $email=$row["email"];
        }
      ?>
     <!--validazioni della modifica profilo in validateEditProfilo.js-->
     <form name="modificaProfilo" method="POST" action=index.php?op=profilo&act=editProfiloE onsubmit="return validaModificaProfilo(this)">
      <table class="infodbEdit">
        <tr> <td class="datiMod"> Modifica User: </td> <?php echo " <td class='datiMod2'> <input class='cellaEdit' type=\"text\" name=\"user\" value=$user readonly> </td> </tr> ";?>
        <tr> <td class="datiMod"> Modifica Nome: </td> <?php echo " <td class='datiMod2'> <input class='cellaEdit' type=\"text\" name=\"nome\" value=$nome> </td> </tr> ";?>
        <tr> <td class="datiMod"> Modifica Cognome: </td> <?php echo " <td class='datiMod2'> <input class='cellaEdit' type=\"text\" name=\"cognome\" value=$cognome> </td> </tr>";?>
        <tr> <td class="datiMod"> Modifica Luogo di Nascita: </td> <?php echo " <td class='datiMod2'> <input class='cellaEdit' type=\"text\" name=\"luogoN\" value=$luogoN> </td> </tr>";?>
        <tr> <td class="datiMod"> Modifica Residenza: </td> <?php echo " <td class='datiMod2'> <input class='cellaEdit' type=\"text\" name=\"residenza\" value=$residenza> </td> </tr>";?>
        <!-- vincolo sulla categoria del ciclista rispettato grazie al input radio-->
        <tr> <td class="datiMod"> Modifica Categoria: </td> <?php echo " <td class='datiMod2'> <input  type=\"radio\" name=\"categoria\" value=\"Amatore\"> Amatore
                                                                                               <input  type=\"radio\" name=\"categoria\" value=\"Esperto\"> Esperto</td></tr>";?>
        <tr> <td class="datiMod"> Modifica Data Di Nascita: </td> <?php echo " <td class='datiMod2'> <input class='cellaEdit' type=\"date\" name=\"dataN\" value=$dataN> </td> </tr>";?>
        <!-- vincolo sul sesso del ciclista rispettato grazie al input radio-->
        <tr> <td class="datiMod"> Modifica Sesso: </td> <?php echo " <td class='datiMod2'> <input type=\"radio\" name=\"sesso\" value=\"M\"> Maschio
                                                                                           <input type=\"radio\" name=\"sesso\" value=\"F\"> Femmina</td> </tr>";?>
        <tr> <td class="datiMod"> Modifica Email: </td> <td class="datiMod2"> <input class='cellaEdit' type="text" name="email" value=<?php echo$email?> > </td> </tr>
      </table>
      <div style='padding-left:25%; padding-top:1.5%;'><input class="pulsante" type="submit" value="Modifica"> &nbsp;<input class="pulsante" type="reset" name="Ripristina"> </div>
     </form>
     </td>
    </tr>
    <tr>
     <td style="background-color:white;" valign="top"> <?php include("common/submenu.php"); ?> </td>
   </tr>
  </table>
 </body>
</html>
