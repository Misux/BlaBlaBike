<?php
include_once("common/connection.php");
include_once("common/file.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Profilo</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" href="css/profilo0.css"/>
    <script type="text/javascript" src="jquery/richieste.js"></script>
    <style>p{display:none;}.butJ{width:70px; height:22px; color:white; font-size: 13px; background-color:#1E90FF;}</style>
  </head>
  <body background="images/ciclistaFaccia2.jpg" style='background-repeat: no-repeat;'>
    <table align=center class="pro">
      <tr>
        <td class="foto" valign="top" background="images/profilo.png"></td>
        <td class="info" rowspan="2">
            <?php
            $user = $_SESSION["username"];
            $id = $_GET["id"];
            //---CONTROLLO PER NON CONSENTIRE L'ACCESSO A UN PROFILO DI UN UTENTE NON SEGUITO TRAMITE QUERY STRING NELLA BARRA DI RICERCA--//
            if (($id!=$user) && (verificaViewAmico($cid,$user,$id)==false)) {
              header("Location: err.php?e=404");
            } else if ((($id!=$user) && (verificaViewAmico($cid,$user,$id)==true)) || ($id==$user))  {
            // Query di visualizzazione dati profilo
              $query = "SELECT user, password, nome, cognome, luogoN, residenza, categoria, dataN, sesso, email FROM utente WHERE user = '$id';";
              $res= $cid->query($query)
              Or die("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
              . ": " . $cid->error) . "</p>";
              ?>
              <div class='amiciScrol'><table class="infodb" style='background-color:transparent;'>
                <?php
                while ($row = $res->fetch_assoc())
                {
                  echo "<tr><td class='dati1'> User: </td><td class='dati2' style='font-size:23px;'>" . $row["user"]. " </td> </tr>";
                  echo "<tr><td class='dati1'> Nome: </td> <td class='dati2'> " . $row["nome"]."</td></tr>";
                  echo "<tr><td class='dati1'> Cognome: </td><td class='dati2'> ". $row["cognome"] ."</td></tr>";
                  echo "<tr><td class='dati1'> LuogoN: </td><td class='dati2'> ".$row["luogoN"]."</td></tr>";
                  echo "<tr><td class='dati1'> Residenza: </td><td class='dati2'>". $row["residenza"]."</td></tr>";
                  echo "<tr><td class='dati1'> Categoria: </td><td class='dati2'>".$row["categoria"]."</td></tr>";
                  if ($row["dataN"]=="0000-00-00") {
                    $dataN="";
                    echo "<tr><td class='dati1'> DataN: </td><td class='dati2'>".$dataN."</td></tr>";
                  } else {
                    echo "<tr><td class='dati1'> DataN: </td><td class='dati2'>".$row["dataN"]."</td></tr>";
                  }
                  echo "<tr><td class='dati1'> Sesso: </td><td class='dati2'>".$row["sesso"]."</td></tr>";
                  echo "<tr><td class='dati1'> Email: </td><td class='dati2'>".$row["email"]."</td><tr>";
                }
                Unset($res); // questa istruzione libera le risorse allocate
				if ($id==$user) {
					echo"<tr><td class='dati1'>Richieste: </td><td class='dati2'><button class='butJ' id='show'>Mostra</button>";
					echo"&emsp;<button class='butJ' id='hide'>Nascondi</button></td></tr>";
				}
                echo "</table>";
                // richieste di amicizia dello user
                if ($id==$user) {
                  echo"<table>";
                  $richiedenti=array();
                  #mi ricreca gli utenti che mi hanno inviato una richiesta che ancora lo user non ha confermato
                  $richiedenti=cercaRichiestaSospesa($cid, $user);
                  if(empty($richiedenti)) echo"<tr><td style='font-size:14px; padding-left:45px;'><p>Non hai nessuna richiesta di amicizia.</p><td></tr>";
                  $k=0;
                  foreach ($richiedenti as $richiedente) {
                    echo "<tr><td><p><span style='font-size:14px; padding-left:45px;'>$richiedente vuole seguirti<span><p><td>";
                    $accept=array("richiedente"=>$richiedente,"stato"=>"accettata","user"=>$id);
                    $_SESSION["accept"][$k]=$accept;
                    echo"<td><p><a style='font-size:12px; color:limegreen; padding-right:15px; text-decoration:none' href='common/segui.php?seg=accept&acc=$k'><b>ACCETTA</b></a></p><td>";
                    echo"<td><p><a style='font-size:12px; color:red; padding-right:15px; text-decoration:none' href='common/segui.php?seg=refuse&ref=$k'><b>RIFIUTA</b></a></p><td></tr>";
                    $k++;
                  }
                  echo"</table>";
                }
              }
            ?>
        </td>
      </tr>
      <tr>
        <td style="background-color:white;" valign="top">
             <?php
             //-----MENU LATERALE DIVERSIFICATO A SECONDA SE L'UTENTE LOGGATO VISUALIZZA IL SUO PROFILO O QUELLO DI UN AMICO ---//
             if($id==$user) {
               include("common/submenu.php");
             } else {
               include("common/submenuAmico.php");
             }
             ?>
         </td>
      </tr>
    </table>
  </body>
</html>
