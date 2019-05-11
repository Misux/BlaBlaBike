<!DOCTYPE html>
<html>
  <head>
      <title> Organizza Uscita </title>
      <link rel="stylesheet" type="text/css" href="css/uscite2.css"/>
      <script type="text/javascript" src="js/tappe.js"></script>
      <script type="text/javascript" src="js/validaUscita.js"></script>
  </head>
  <body>
    <h3>Organizza la tua uscita: è semplice e veloce!</h3>
    <h5> I campi obbligatori (*) </h5>
    <div class="boxInsert" style="overflow-y:scroll; overflow-x:hidden;">

        <form name="organizza" id="organizza2" method="POST" action="common/OrgE.php" onsubmit="return validaInserimentoUscita(this)">
        <!--DATI USCITA-->
        <table id="organizza">
          <tr>
            <td class="dimRiga0">Uscita</td>
          </tr>
          <tr>
            <td class="dimRiga"><input class="orgIns" type = "text"  id="titoloU" name = "titoloU"  placeholder="Titolo dell'uscita*" onfocus="this.placeholder"/></td>
          </tr>
          <tr>
            <td class="dimRiga" style="font-size:13px; text-align:center">
              <!--vicolo sul tipo di uscita rispettato grazie al radio button-->
              <input type="radio" name="tipo" id="Corsa" value="Bici Da Corsa" > Uscita Bici da Corsa*
              <input type="radio" name="tipo"  id="Mbike" value="Mountain Bike"> Uscita Mountain Bike*
            </td>
          </tr>
          <tr>
            <td class="spazOrg"></td>
          </tr>
          <tr>
            <td class="dimRiga0">Ritrovo</td>
          </tr>
          <tr>
            <td class="dimRiga">
              <input class="orgIns4" type="date" name="dataU">&nbsp;
              <input class="orgIns4" type="time" name="oraR">&nbsp;
              <input class="orgIns4" type="text" id="luogoR" name="luogoR" placeholder="Luogo del ritrovo*" onfocus="this.placeholder">
            </td>
          </tr>
          <tr>
            <td class="spazOrg"></td>
          </tr>
          <tr>
            <td class="dimRiga0">Percorso</td>
          </tr>
          <tr>
            <td class="dimRiga2">
              <input class="orgIns3" type="numeric" name="dislivello" placeholder="Dislivello (m)" onfocus="this.placeholder">&nbsp;
              <!--Il vincolo è garantito grazie a un alert javascript che informa l’utente di non poter
              inserire un valore di durata che sia inferiore a 1 o maggiore di 8, validaUscita.js-->
              <input class="orgIns3" type="numeric" id="durata" name="durata" placeholder="Durata (ore)*" onfocus="this.placeholder" maxlength="1">&nbsp;
            </td>
          </tr>
          <tr>
            <!--vincolo sulla difficoltà di un'uscita rispettato grazie a input radio-->
            <td class="dimRiga2" style="font-size:13px; text-align:center">
              <input type="radio" name="difficolta" id="bassa" value="bassa"> Difficoltà Bassa &nbsp;
              <input type="radio" name="difficolta" id="media" value="media"> Difficoltà Media &nbsp;
              <input type="radio" name="difficolta" id="alta" value="alta">  Difficoltà Alta  &nbsp;
            </td>
          </tr>
        </table>

        <!--TAPPE-->
        <table width=92% height="27%" style="border:1px solid grey; margin:4%; padding-bottom:2%;">
          <tr>
            <td valign="top" style="text-align:center;">
              <table border="0" align="center">
                <tr>
                  <td style="font-size:13px;">Numero di tappe : </td>
                  <td><input style="padding-left:2px;" type="number" name="tappa" id="tappa" placeholder="Almeno una*" onfocus="this.placeholder" min=1 maxlength="3" onkeyup="AggiungiTappa(this)"/></td>
              </tr>
              </table>
              <span id='box_tappe' class='box_tappe' style="overflow: scroll;">
                <!-- Box che conterrà le righe aggiunte. Inizialmente vuoto! -->
              </span>
            </td>
          </tr>
        </table>

        <!--note-->
        <table width=92% height="27%" style="border:1px solid grey; margin:4%; padding-bottom:2%;">
          <tr>
            <td valign="top" style="text-align:center;">
              <table border="0" align="center">
                <tr>
                  <td style="font-size:13px;">Numero di note : </td>
                  <td><input style="padding-left:2px;" type="number" name="nota" id="nota" min=0 maxlength="2" onkeyup="AggiungiNota(this)"/></td>
              </tr>
              </table>
              <span id='box_note' style="overflow: scroll;">
                <!-- Box che conterrà le righe aggiunte. Inizialmente vuoto! -->
              </span>
            </td>
          </tr>
        </table>

        <!--VISIBILITA-->
        <table class="visibilita">
          <tr>
            <!--vicolo sulla visibilità rispettato grazie al radio button-->
            <td class="dimRiga2" style="font-size:13px;" align="center">
              <input  type="radio" name="visibilita" id="pubblica" value="pubblica"> Visibilità Pubblica*
              <input  type="radio" name="visibilita" id="privata" value="privata"> Visibilità Privata*
            </td>
          </tr>
          <tr>
            <td style="text-align:center;">
              <div><b>Pubblica:</b> tutti gli utenti del sistema possono visualizzare ed unirsi all’uscita.</div>
            </td>
          </tr>
          <tr>
            <td style="text-align:center;">
              <div><b> Privata:</b> solo chi ti segue puo visualizzare e unirsi all’uscita.</div>
            </td>
          </tr>
          <tr>
              <td class="spazOrg"></td>
          </tr>
          <tr>
            <td class="spazButPub"><input class="butPubblica" type="submit" value="Pubblica"></td>
          </tr>
       </table>
     </form>
    </div>
  </body>
</html>
