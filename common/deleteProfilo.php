<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/profilo0.css"/>
    <script type="text/javascript" src="js/validate.js"></script>
    <script type="text/javascript">
    /*---------- ALERT DI CONFERMA CANCELLAZIONE ---------*/
    function mostraMessaggio() {
      var domanda = confirm("I tuoi dati andranno definitivamente persi");
      if (domanda === true) {
        location.href = 'common/deleteProfiloE.php';
      } else{
        location.href = 'index.php?op=profilo&act=canc';
      }
    }
    </script>
  </head>
  <body background="images/ciclistaFaccia2.jpg">
    <table align=center class="pro">
      <tr>
        <td class="foto" valign="top" background="images/profilo.png">
        </td>
        <td class="info" rowspan="2">
         <form name="cancelloProfilo" method="POST" action="common/deleteProfiloE.php">
          <table border="0px" style="text-align:center; margin-left:5.5%;">
            <tr>
              <td id="fraseCanc" style="padding-bottom:3%;">
                Vuoi cancellare il tuo profilo blablabike?
              </td>
            </tr>
            <tr>
              <td>
               <input class="pulsante" type="button" value="Cancella" onClick="mostraMessaggio()">
              </td>
            </tr>
          </table>
         </form>
        </td>
      </tr>
      <tr>
        <td style="background-color:white;" valign="top"> <?php include("common/submenu.php"); ?> </td>
      </tr>
    </table>
  </body>
</html>
