<!DOCTYPE html>
<html>
 <head>
 </head>
 <body>
 <?php
 include_once ("connection.php");
 include_once ("file.php");
 if (isset($_SESSION["active"])) {
   $action="view";
   if (isset($_GET["act"])) $action=$_GET["act"];

   switch ($action) {
     case 'view':
     include("viewProfilo.php");
     break;

     case 'editProfilo':
     include("editProfilo.php");
     break;

     case 'editProfiloE':
     include("editProfiloE.php");
     break;

     case 'caricaFoto':
     include("caricaFoto.php");
     break;

     case 'amici':
     include("amici.php");
     break;

     case 'top':
     include("topLocalFriend.php");
     break;

     case 'canc':
     include("deleteProfilo.php");
     break;

     default:
       header("Location: err.php?e=404");
       break;
   }
 } else {
     header("../index.php");
 }
 ?>
 </body>
</html>
