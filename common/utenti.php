<!DOCTYPE html>
<html>
  <head>
    <title> Utenti </title>
    <link rel="stylesheet" type="text/css" href="css/utente.css"/>
  </head>
  <body>
    <table id="boxUtenti">
      <tr>
        <td id="ricercaUtenti">
          <div id="ricercaUtenti2">
            <form action="common/ricercaUtenti.php" method="POST">
              <table width=100% border=0px>
                <tr>
                  <td align=right width=65%;><input id="s" type="search" name="search" placeholder="Cerca utente"></td>
                  <td align=left><input id='botRicerca' type="submit" value="CERCA"></td>
                </tr>
              </table>
            </form>
          </div>
        </td>
      </tr>
       <td>
        <?php
         include("connection.php");
         include("connection2.php"); #non usato
         include("common/file.php");
         $user=$_SESSION["username"];

         //SI VERIFICA SE I RISULTATI DA MOSTRARE SONO FRUTTO DI UNA RICERCA DA PARTE DELL'UTENTE
         if (isset($_POST["ricerca"])) {
            if (isset($_POST["risultatiRicerca"])) {
              $utenti=$_POST["risultatiRicerca"]; #se hai fatto una ricerca stampa i risultati
            } else {
              $utenti=array();
            }
         } else {
           #si mostrano tutti gli utenti tranne lo user loggato e senza alcuna ricerca, vicolo rispettato
           $utenti=cercaUtenti($cid, $user);
         }
         $seguiti=cercaFollowingAccettata($cid, $user);
         $inAttesa=cercaFollowingSospesa($cid, $user);
        ?>
         <div id="boxUtenti3">
        <?php
        echo "<table id='boxUtenti4'>";
        echo "<tr> <td id='utentiRiga1'> Tutti gli Utenti </td> </tr>";
        /* Si visualizzano gli utenti già seguiti, gli utenti a cui ho mandato una richiesta
          non ancora accetta, gli utenti che non seguo */
        foreach ($utenti as $utente) {
          #già seguiti
          if (verificaSegui($seguiti, $utente)) {
            echo "<form name=\"segui\" method=\"POST\" action=\"common/segui.php?seg=no\">";
            echo "<tr><td class='rigaUtente'> User: <b>". $utente ." </b></td> <td> <button type=\"submit\" name=\"utente\" value=$utente> Non Seguire Più </a> </td>
               <td><input id='visitaUtente' type=\"button\" value=\"Visita Profilo\" onclick=\"window.location.href='index.php?op=profilo&id=$utente'\"> </td> </tr>";
            echo "</form>";
          #utenti in attesa di conferma richiesta
          } else if (verificaSegui($inAttesa, $utente)) {
            echo "<form name=\"segui\" method=\"POST\" action=\"common/segui.php?seg=no\">";
            echo "<tr><td class='rigaUtente'> User: <b>". $utente ." </b></td> <td> <button type=\"submit\" name=\"utente\" value=$utente> Annulla Richiesta </a> </td> </tr>";
            echo "</form>";
          #utenti che non seguo
          } else {
            echo "<form name=\"segui2\" method=\"POST\" action=\"common/segui.php?seg=yes\">";
            echo "<input type=\"hidden\" name=\"stato\" value=\"sospesa\">";
            echo "<tr><td class='rigaUtente'> User: <b>". $utente ." </b></td> <td> <button type=\"submit\" name=\"utente\" value=$utente> Segui </a> </tr>";
            echo "</form>";
          }
        }
        echo"</table>";
        ?>
       </div>
       </td>
     </tr>
   </table>
 </body>
</html>
