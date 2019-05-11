<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/viewUscite.css"/>
    <style>
    #boxYourU{
      margin-left: 15%;
      margin-bottom: 5%;
      border:1px solid #909090;
      width:70%;
      background-color:white;
      font-family: VERDANA;
    }
    .textOrg{
      text-align: center;
      padding-left: 6%;
      padding-top: 3%;
      font-weight: bold;
      font-size: 20pt;
    }
    #tabYourU{
      padding-bottom: 3%;
      padding-top: 3%;
      width:100%;
    }
    .mis{font-size: 12pt;}
    </style>
  </head>
  <body>
  <?php
   include_once("common/connection.php");
   include_once("common/file.php");
   $user = $_SESSION["username"];
   $id=$_GET["id"];
   if (($id!=$user) && (verificaViewAmico($cid,$user,$id)==false)) {
      header("Location: err.php?e=404");
   } else if ((($id!=$user) && (verificaViewAmico($cid,$user,$id)==true)) || ($id==$user))  {
    $k=0;
    $today = date("Y-m-d");
    //query di visualizzazione uscite a cui partecipi
    $query = "SELECT uscita.titoloU, uscita.dataU,durata,distanza,dislivello,oraR,luogoR,visibilita,difficolta,tipo,organizzatore,telaio, valutazione FROM partecipa JOIN uscita WHERE partecipa.titoloU=uscita.titoloU and partecipa.ciclista='$id' and statoPartecipazione='confermata' ORDER BY uscita.dataU DESC;";
    $res= $cid->query($query)
    Or die("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
    . ": " . $cid->error) . "</p>";

    echo"<div id='boxYourU' style='overflow-y:scroll;'>";

    if($cid->affected_rows>0) echo"<div class='textOrg'> Le uscite di ".$id."!</div>";
    else echo"<div class='textOrg'> Nessun uscita in programma per ".$id."!</div>";

    echo"<table id='tabYourU'>";
    while ($row = $res->fetch_assoc()) {
      $titoloU=$row["titoloU"];
      $dataU=$row["dataU"];
      $v=valutazione($cid,$titoloU,$dataU);
      $mediaV=mediaValutazione($cid,$titoloU,$dataU);
      $luogoR=$row["luogoR"];
      echo "<tr><td style='width:29%; padding-left:6%;' class='rigaSelect1'> " . $row["titoloU"]. "</td><td style='width:22%;' class='rigaSelect1'>" . $row["dataU"]."&emsp;</td><td style='width:22%;' class='rigaSelect1'>&emsp;</td><td style=' width:20%; padding-left:0%;' class='rigaSelect1'><span class='font' style='padding-left:0%;'><b>" . $row["visibilita"]. "</b><span></td></tr>";
      echo "<tr><td style='padding-left:6%;' class='rigaSelect2b'><a href='index.php?op=uscite&act=map&map=$luogoR'><img src='images/map2.png' width='22' height='20'></a>&nbsp;<b>".$row["luogoR"]." - " . $row["oraR"]. " </b></td><td class='rigaSelect2b'> <b>" . $row["tipo"] . "&emsp; </b></td><td class='rigaSelect2b'>Bici Scelta: <b>" . $row["telaio"]. "</b>&emsp;</td><td class='rigaSelect2b'>Organizza: <b>" . $row["organizzatore"]. "</b>&emsp;</td></tr>";
      echo "<tr><td style='padding-left:6%;' class='rigaSelect3'> Durata: <b>" . $row["durata"]. " ore </b></td><td class='rigaSelect3' style='padding-left:0%;'> Distanza: <b>" . $row["distanza"]. " km</b></td><td class='rigaSelect3' style='padding-left:0%;'> Dislivello: <b>" . $row["dislivello"]. " m </b></td><td class='rigaSelect3'></td></tr>";
      echo "<tr><td style='padding-left:6%;' class='rigaSelect5'> Difficolta: <b>" . $row["difficolta"]. "</b></td>";

      //SE SONO USCITE DELLO USER SI PUO' VALUTARE L'USCITA E VIENE MOSTRATO XML
      if($id==$user){
        // Valutazione (se cambi il segno vedrai link "esprimi vlutazioni" anche per uscite future")
        if(($dataU<$today)&&(verificaValutazione($cid,$titoloU,$dataU)==false)) {
          echo"<td><a class='link' href='index.php?op=uscite&act=valut&val1=$titoloU&val2=$dataU'>Esprimi valutazione</a></td>";
          //se è stata fatta l'uscita e ho espresso la valutazione allora posso modificarla
        } elseif(($dataU<$today)&&(verificaValutazione($cid,$titoloU,$dataU)==true)){
          echo"<td class='rigaSelect5'>Valutazione: <b>".$v."</b>&nbsp;";
          echo"<a href='index.php?op=uscite&act=valut&val1=$titoloU&val2=$dataU'><img src='images/mat.png' width='19' height='19'></a></td>";
        }
        //xml
        if (verPartecipa($cid,$user,$titoloU, $dataU)) {
          echo"<td class='rigaSelect5'><a class='link' href='index.php?op=uscite&act=xml&id=$titoloU&id2=$id'><b>xml</b></a></td></tr>";
        }
      }

      //tappe
      $query2 = "SELECT numeroT,titoloU,dataU,tipoT,partenza,arrivo,lunghezza FROM tappa WHERE titoloU='$titoloU';";
        $res1= $cid->query($query2)
        Or die("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
        . ": " . $cid->error) . "</p>";
        while ($row = $res1->fetch_assoc())
        {
            echo "<tr><td style='padding-left:6%; padding-top:2%;' class='mis'><b> Tappa " . $row["numeroT"]. "</b></td><td>&emsp;</td><td>&emsp;</td><td>&emsp;</td></tr>";
            echo "<tr><td style='padding-left:6%; padding-bottom:2%;' class='mis'> Partenza: <b>".$row["partenza"]."</b></td>";
            echo "<td class='mis' style='padding-bottom:2%;'> Arrivo: <b>" . $row["arrivo"]. "</b></td>";
            echo "<td class='mis' style='padding-bottom:2%;'> Lunghezza: <b>" . $row["lunghezza"]. " km</b></td>";
            echo "<td class='mis' style='padding-left:0%; padding-right:0%; padding-bottom:2%;'>Percorso: <b>" . $row["tipoT"]. "</b></td></tr>";
        }

      //note
      $query3 = "SELECT titoloN,testoN FROM nota WHERE titoloU='$titoloU';";
        $res2= $cid->query($query3)
        Or die("<p>Inpossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
        . ": " . $cid->error) . "</p>";
        while ($row = $res2->fetch_assoc())
        {
          if($k==0) echo "<tr><td style='padding-left:6%; padding-top:4%;' class='mis'><b>Note</b></td><td>&emsp;</td><td>&emsp;</td><td>&emsp;</td></tr>";
          echo "<tr><td style='padding-left:6%; padding-top:2%;' class='mis'>Titolo: " . $row["titoloN"]. "</td><td>&emsp;</td><td>&emsp;</td><td>&emsp;</td></tr>";
          echo "<tr><td style='padding-left:6%; padding-top:1%;padding-bottom:2%;' class='mis'>" . $row["testoN"]. "</td><td>&emsp;</td><td>&emsp;</td><td>&emsp;</td></tr>";
          $k = $k +1;
        }
    }
    echo"</table></div>";
    unset($res);
    unset($res1);
    unset($res2);
  }
  ?>
  </body>
</html>
