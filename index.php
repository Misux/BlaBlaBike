<?php
  session_start();
  include("common/connection.php");
  $operation="home";
  if (isset($_GET["op"]))  $operation= $_GET["op"];
?>
<!DOCTYPE html>
<html>
  <head>
      <title>BlaBlaBike</title>
      <meta name="DonaFra" content="Portale biciclette">
      <link rel="stylesheet" type="text/css" href="css/style.css"/>
      <link rel='stylesheet prefetch' href='http://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css'>
      <link rel="stylesheet" type="text/css" href="css/icone.css"/>
      <link rel="stylesheet" type="text/css" href="css/annunci.css"/>
      <link rel="icon" type="image/png" href="https://d1ovtcjitiy70m.cloudfront.net/vi-1/favicon-32x32.png" sizes="32x32">
      <script type="text/javascript" src="js/validate.js"></script>
      <script type="text/javascript" src="js/validaInsBici2.js"></script>
      <script type="text/javascript" src="js/validaUscita.js"></script>
      <link rel="stylesheet" type="text/css" href="css/responsive.css"/>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> <!--jquery-->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> <!--bootstrap-->
  </head>
  <body>
    <!--header-->
    <div class="header">
    <?php include("common/menu.php"); #menù che cambia a seconda se l'utente risulta loggato
    if (isset($_SESSION["active"])) {
      $user = $_SESSION["username"];
    ?>
    <table width=99%>
      <tr>
        <td align=right><div id="topright2"> Benvenuto <?php echo "$user" ?>  &nbsp;<a id="butOut" href="index.php?op=exit"> ESCI </a></div></td>
      </tr>
    </table>
    <?php
    } else {
      include("common/login.php");
    }
    ?>
    </div>
    <!--Corpo-->
    <div class="corpo">
        <?php
         switch ($operation) {
           case "home":
           include ("common/slider.php"); #slider immagini
           include("common/banner.php"); #banner mercatino
           include("common/intro.php"); #banner di 3 immagini fisse
           break;

           case "reg":
           header("location:common/reg.php");
           break;

           case "profilo":
           if (isset($_SESSION["active"])) {
             include("common/profilo.php");
           } else {
             header("location: index.php");
           }
           break;

           case "utenti":
           if (isset($_SESSION["active"])) {
             include("common/utenti.php");
           } else {
             header("location: index.php");
           }
           break;

           case "bici":
           if (isset($_SESSION["active"])) {
             include("common/bici.php");
           } else {
             header("location: index.php");
           }
           break;

           case "annunci":
           include("common/annuncio.php");
           break;

           case "uscite":
           if (isset($_SESSION["active"])) {
             include("common/uscite.php");
           } else {
             header("location: index.php");
           }
           break;

           case "amici":
           if (isset($_SESSION["active"])) {
             include("common/amici.php");
           } else {
             header("location: index.php");
           }
           break;

           case "richieste":
           if (isset($_SESSION["active"])) {
             include("common/richiesteUsciteRicevute.php");
           } else {
             header("location: index.php");
           }
           break;

           case "vendute":
           if (isset($_SESSION["active"])) {
             include("common/confermaVendite.php");
           } else {
             header("location: index.php");
           }
           break;

           case "venduteE":
           if (isset($_SESSION["active"])) {
             include("common/confermaVenditeE.php");
           } else {
             header("location: index.php");
           }
           break;

           case "venduteAnn":
           if (isset($_SESSION["active"])) {
             include("common/annullaVendita.php");
           } else {
             header("location: index.php");
           }
           break;

           case 'acquisti':
           if (isset($_SESSION["active"])) {
             include("common/acquistiMercatino.php");
           } else {
             header("location: index.php");
           }
           break;

           case "exit":
			     session_destroy();
			     header("location: index.php");
			     break;

           case "msg":
           echo base64_decode($_GET["msg"]);
           echo"<img src='images/bici9.jpg' max-width='80%' max-height='80%'>";
           break;

           default:
             header("Location: err.php?e=404");
             break;
         }
        ?>
    </div>
    <?php include("common/footer.php"); #Footer ?>
  </body>
</html>
