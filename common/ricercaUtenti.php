<?php
	include_once("connection.php");
	session_start();
	$user=$_SESSION["username"];
	$keyWord=mysqli_real_escape_string($cid,$_POST["search"]);#controllo per apostrofo
	$utenti=array();
	$i=0;
	#query di ricerca
	$query="SELECT user FROM utente WHERE user LIKE '%$keyWord%' AND user NOT LIKE '$user'";
	$res=$cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
	                    . ": " . $cid->error) . "</p>";
	while ($row=$res->fetch_assoc()) {
	   $utenti["$i"]=$row["user"];
		 $i++;
	}
?>
<!DOCTYPE html>
<html>
  <head>
  </head>
	<!-- QUESTA FORM SERVE PER RITORNARE ALLA PAGINA DEGLI UTENTI PER FAR STAMPARE I RISULTATI DI RICERCA!-->
  <body onload="document.forms[0].submit();">
  	<form action="..\index.php?op=utenti" method="POST">
      <input type="hidden" name="ricerca" value="true">
        <?php foreach($utenti as $utente) {
            echo "<input type=\"hidden\" name=\"risultatiRicerca[]\" value=$utente>";
        }
        ?>
    </form>
  </body>
</html>
