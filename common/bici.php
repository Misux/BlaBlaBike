<!DOCTYPE html>
<html>
 <body>
   <?php
   include_once ("common/connection.php");
   include_once ("common/file.php");

   if (isset($_SESSION["active"])) {
     $user=$_SESSION["username"];
     $proprietario=$_GET["id"];
     $action="view";
     if (isset($_GET["act"])) $action=$_GET["act"];

     switch ($action) {
       case 'view':
        include("viewBici.php");
        break;

       case 'ins':
        include("insBici.php");
        break;

       case 'edit':
        include("editBici.php");
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
