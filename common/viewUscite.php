<?php
include_once("common/connection.php");
include_once("common/file.php");
$user = $_SESSION["username"];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>viewUscite</title>
    <link rel="stylesheet" type="text/css" href="css/viewUscite.css"/>
    <style>.linkP:hover{text-decoration:underline}</style>
    <script>
    function mostraAmiciInvito(count) {
      var riga=document.getElementById("rigaAmici"+ count);
        if (riga.style.display==="none")
          {
            riga.style.display="block";

          } else {
            riga.style.display="none";
          }
    }
    </script>
  </head>
  <body>
    <div id="boxInsert2" style="overflow-y:scroll;">

      <div id="boxRicerca">
        <div id="trova">INSERISCI DEI FILTRI PER LA RICERCA</div>
      </div>
        <!--VISUALIZZA USCITE-->
        <div id="boxUscite">
          <?php
          #filtriUscite: all'interno di questa pagina troviamo la select delle uscite con i filtri se settati
          include("common/filtriUscite.php");
          echo"<table border=0px width='60%' height='20%'>";
          #messaggio d'inserimento se l'uscita viene organizzata con successo o viceversa
          if (isset($_GET["msg"])) {
            echo"<tr><td style='padding-left:10%'><span style='font-size:10pt' id='msgPos'><b>";
            echo base64_decode($_GET["msg"]) ."</b></span></td>";
          }
          echo"</table>";

          echo"<table id='tabSelect'>";
            $count=0;
            $count2=0;
              while ($row=$res->fetch_assoc())
              {
                $t=$row["titoloU"];
                $d=$row["dataU"];
                $p=$row["tipo"];
                $visibilita=$row["visibilita"];
                $organizzatore=$row["organizzatore"];
                $luogoR=$row["luogoR"];

                $partecipanti=verPartecipanti($cid,$t,$d); //VERIFICO PARTECIPANTI

                if(($visibilita=='pubblica')||(($visibilita=='privata')&&($organizzatore==$user))){
                  //cancellazione e modifica di un'uscita solo se si tratta dell'organizzatore
                  if(verOrg($cid,$user,$t,$d)==true) {
                     echo "<tr><td style='padding-left:6%;' class='rigaSelect1'> " . $row["titoloU"]. "</td><td class='rigaSelect1'><b>" . $row["dataU"]." </b>&emsp;</td><td class='rigaSelect1b'><a href='index.php?op=uscite&act=edit&id=$t'><img src='images/mat.png' width='25' height='25'></a>&emsp;<a href='index.php?op=uscite&act=canc&id=$t' onclick=\"return confermaRinuncia();\"><img src='images/bin.jpg' width='25' height='25'></a></td>";
                     echo "<td class='rigaSelect1'> <button onclick=\"mostraAmiciInvito(".$count.")\" value='Invita'> Invita Amici </button> </td> </tr>";
                     echo "<tr> <td> </td> <td > </td> <td> </td> <td id=\"rigaAmici".$count."\" style=\"display:none;\">";
                     /*pagina per invitare amici a partecipare ad un'uscita (Un utente organizzatore può invitare ad un uscita solo gli
                     utenti che lo seguono e che non hanno già manifestato la loro adesione a partecipare a tale uscita.)*/
                     include("common/mostraAmiciInvito.php");
                     echo "</td></tr>";
                     $count++;
                  } else {
                    echo "<tr><td style='padding-left:6%;' class='rigaSelect1'> " . $row["titoloU"]. "</td><td class='rigaSelect1'><b>" . $row["dataU"]." </b>&emsp;</td><td class='rigaSelect1'>&emsp;</td>";
                    echo "<td class='rigaSelect1'> </td></tr>";
                  }

                  echo "<tr><td style='padding-left:6%;' class='rigaSelect2b'><a href='index.php?op=uscite&act=map&map=$luogoR'><img src='images/map2.png' width='22' height='20'></a>&nbsp;<b>".$row["luogoR"]." - " . $row["oraR"]. " </b></td><td class='rigaSelect2b'><b>" . $row["tipo"]. "</b>&emsp;</td> <td class='rigaSelect2b'> Organizzatore <b>" . $row["organizzatore"]. "</b> </td> <td class='rigaSelect2b'> <a class='link' href='index.php?op=uscite&act=tap&id=$t'><b>Dettagli tappe</b></a></td></tr>";
                  echo "<tr><td style='padding-left:6%;' class='rigaSelect3'> Durata:  <b> " . $row["durata"]. " ore </b></td><td class='rigaSelect3'> Distanza: <b>" . $row["distanza"]. " km </b> </td><td class='rigaSelect3b'> Dislivello: <b>" . $row["dislivello"]. " m</b> </td> <td class='rigaSelect3b'>  Difficolta <b>" . $row["difficolta"]. " </b></td></tr>";

                  //VERIFICO PARTECIPAZIONE
                  if(verPartecipa($cid,$user,$t,$d)==true){
                    echo "<tr><td class='rigaVisi2'><span class='font'><b>" . $row["visibilita"]. "</b><span></td><td><span style='font-weight:bold; color:#2E8B57;' class='font'> Già iscritto!</span></td><td><a style='color:blue; font-size:14px;' class='linkP' onclick=\"mostraPartecipanti((".$count2."));\"><b> Partecipanti:</a><span style='font-size:13px;'>&nbsp;$partecipanti</b></span></td>";
                    echo  "<td class='rinu'><a href='index.php?op=uscite&act=annullaPart&id1=$t&id2=$d&id3=$p'><input class='botPartecipa' type='submit' value='Rinuncia' onclick=\"return confermaRinuncia();\"/></a></td></tr>";
                    echo "<tr> <td> </td> <td> </td> <td id=\"mostraPart".$count2."\" style=\"display:none\">";
                    include("common/mostraPartecipanti.php");
                    echo "</td> </tr>";
                  } else {
                    echo "<tr><td class='rigaVisi2'><span class='font'><b>" . $row["visibilita"]. "</b><span></td><td style='padding-left:2.5%;'><a href='index.php?op=uscite&act=part&id1=$t&id2=$d&id3=$p'><input class='botPartecipa' type='submit' value='Partecipa'/></td><td><a style='color:blue; font-size:14px;' class='linkP' onclick=\"mostraPartecipanti((".$count2."));\"> <b> Partecipanti:</a><span style='font-size:13px;'>&nbsp;$partecipanti</b><span></td></tr>";
                    echo "<tr> <td> </td> <td> </td> <td id=\"mostraPart".$count2."\" style=\"display:none\">";
                    include("common/mostraPartecipanti.php");
                    echo "</td> </tr>";
                  }

                  //Le uscite con visibilità privata vengono mostrati solo agli utenti che seguono l’organizzatore.
                } elseif(($visibilita=='privata')&&(verificaSeguiti($cid,$user,$organizzatore)==true)){
                  if(verOrg($cid,$user,$t,$d)==true) echo "<tr><td style='padding-left:6%;' class='rigaSelect1'> " . $row["titoloU"]. "</td><td class='rigaSelect1'><b>" . $row["dataU"]." </b>&emsp;</td><td class='rigaSelect1b'><a href='index.php?op=uscite&act=edit&id=$t'><img src='images/mat.png' width='25' height='25'></a>&emsp;<a href='index.php?op=uscite&act=canc&id=$t' onclick=\"return confermaRinuncia();\"><img src='images/bin.jpg' width='25' height='25'></a></td>";
                  else echo "<tr><td style='padding-left:6%;' class='rigaSelect1'> " . $row["titoloU"]. "</td><td class='rigaSelect1'><b>" . $row["dataU"]." </b>&emsp;</td><td class='rigaSelect1'>&emsp;</td><td class='rigaSelect1'>&emsp;</td></tr>";

                  echo "<tr><td style='padding-left:6%;' class='rigaSelect2b'><a href='index.php?op=uscite&act=map&map=$luogoR'><img src='images/map2.png' width='22' height='20'></a>&nbsp;<b>".$row["luogoR"]." - " . $row["oraR"]. " </b></td><td class='rigaSelect2b'><b>" . $row["tipo"]. "</b>&emsp;</td> <td class='rigaSelect2b'> Organizzatore <b>" . $row["organizzatore"]. "</b> </td> <td class='rigaSelect2b'> <a class='link' href='index.php?op=uscite&act=tap&id=$t'><b>Dettagli tappe</b></a></td></tr>";
                  echo "<tr><td style='padding-left:6%;' class='rigaSelect3'> Durata:  <b> " . $row["durata"]. " ore </b></td><td class='rigaSelect3'> Distanza: <b>" . $row["distanza"]. " km </b> </td><td class='rigaSelect3b'> Dislivello: <b>" . $row["dislivello"]. " m</b> </td> <td class='rigaSelect3b'>  Difficolta: <b>" . $row["difficolta"]. "</b> </td></tr>";

                  //VERIFICO PARTECIPAZIONE
                  if(verPartecipa($cid,$user,$t,$d)==true){
                    echo "<tr><td class='rigaVisi2'><span class='font'><b>" . $row["visibilita"]. "</b><span></td><td><span style='font-weight:bold; color:#2E8B57;' class='font'> Già iscritto!</span></td><td><a style='color:blue; font-size:14px;' class='linkP' onclick=\"mostraPartecipanti((".$count2."));\"> <b> Partecipanti:</a> <span style='font-size:13px;'>&nbsp;$partecipanti</b></span></td>";
                    echo  "<td class='rinu'><a href='index.php?op=uscite&act=annullaPart&id1=$t&id2=$d&id3=$p'><input class='botPartecipa' type='submit' value='Rinuncia' onclick=\"return confermaRinuncia();\"/></a></td></tr>";
                    echo "<tr> <td> </td> <td> </td> <td id=\"mostraPart".$count2."\" style=\"display:none\">";
                    include("common/mostraPartecipanti.php");
                    echo "</td> </tr>";
                  } else {
                    echo "<tr><td class='rigaVisi2'><span class='font'><b>" . $row["visibilita"]. "</b><span></td><td style='padding-left:2.5%;'><a href='index.php?op=uscite&act=part&id1=$t&id2=$d&id3=$p'><input class='botPartecipa' type='submit' value='Partecipa'/> </a></td><td><a style='color:blue; font-size:14px;' class='linkP' onclick=\"mostraPartecipanti((".$count2."));\"> <b> Partecipanti:</a><span style='font-size:13px;'>&nbsp;$partecipanti</b></span></td></tr>";
                    echo "<tr> <td> </td> <td> </td> <td id=\"mostraPart".$count2."\" style=\"display:none\">";
                    include("common/mostraPartecipanti.php");
                    echo "</td> </tr>";
                }

              }
              $count2++;
            }
              echo"</table>";
              Unset($res); // questa istruzione libera le risorse allocate
          ?>
      </div>
    </div>
  </body>
</html>
