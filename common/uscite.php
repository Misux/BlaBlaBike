<?php
$act=$_GET["act"];
if (isset($_SESSION["username"])) {
  $user=$_SESSION["username"];
  switch ($act) {
    case 'org':
      include("common/org.php");
      break;

      case 'view':
      include("common/viewUscite.php");
      break;

      case 'your':
        include("common/tueUscite.php");
        break;

      case 'xml':
        include("common/xmlUscite.php");
        break;

      case 'yourOrg':
        include("common/tueOrg.php");
        break;

      case 'tap':
        include("common/detTappe.php");
        break;

      case 'part':
        include("common/PartecipaU.php");
        break;

      case 'partE':
        include("common/PartecipaE.php");
        break;

      case 'canc':
        include("common/cancUscita.php");
        break;

      case 'edit':
        include("common/editUscita.php");
        break;

      case 'editE':
        include("common/editUscitaE.php");
        break;

      case 'rifiuta':
        include("common/rifiuta.php");
        break;

      case 'annullaPart':
        include("common/annullaPartecipazione.php");
        break;
      case 'valut':
        include("common/valutazU.php");
        break;

      case 'valutE':
        include("common/valutazUE.php");
        break;

      case 'map':
        include("common/mappa.php");
        break;
        
      default:
        header("Location: err.php?e=404");
        break;
    }
}
?>
