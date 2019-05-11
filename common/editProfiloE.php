<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/bici2.css"/>
  </head>
  <body>
    <?php
      $errore="";
      include_once("connection.php");
      include_once("common/file.php");
      //controlli php dei parametri da Editprofilo.php
      //str_replace sostituisce _ con lo spazio vuoto in modo da poter leggere quei particolari campi con lo spazio
      $user=str_replace("_", " ",$_POST["user"]);
      $nome=str_replace("_", " ",$_POST["nome"]);
      if (isset($_POST["cognome"])) {
        $cognome=str_replace("_", " ",$_POST["cognome"]);
      } else {
        $cognome=NULL;
      }
      if (isset($_POST["luogoN"])) {
        $luogoN=str_replace("_", " ",$_POST["luogoN"]);
      } else {
        $luogoN=NULL;
      }
      if (isset($_POST["residenza"])) {
        $residenza=str_replace("_", " ",$_POST["residenza"]);
      } else {
        $residenza=NULL;
      }
      if (isset($_POST["categoria"])) {
        $categoria=$_POST["categoria"];
      } else {
        $categoria=NULL;
      }
      //CONTROLLO DATA
      if (isset($_POST["dataN"]) && ($_POST["dataN"]!="")) {
        $dataN=$_POST["dataN"];
        //validazione data presente nel file.php
        if (!validateData($dataN)) {
          $errore=$errore . "Formato della data non accettato! ";
        }
      } else if (isset($_POST["dataN"]) && ($_POST["dataN"]=="")) {
        $dataN=NULL;
      } else {
        $dataN=NULL;
      }
      if (isset($_POST["sesso"])) {
        $sesso=$_POST["sesso"];
      } else {
        $sesso=NULL;
      }
      //CONTROLLO DELLA MAIL
      $email=$_POST["email"];
      if (empty($_POST["email"])) {
        $errore = "Email is required";
      } else {
        //Per verificare se l'email è valida, passiamo come parametro FILTER_VALIDATE_EMAIL, funzione di sicurezza php
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
          $errore = "Invalid email format";
        }
      }

     //SE NON TROVIAMO ERRORI ALLORA POSSO MODIFICARE
     if ($errore=="") {
      #dove troviamo l'apostrofo viene sostituito con una slash per permettere la lettura
      $residenza=mysqli_real_escape_string($cid,$residenza);
      $luogoN=mysqli_real_escape_string($cid,$luogoN);
      #query di modifica profilo
      $query="UPDATE `utente` SET `user`='$user',`nome`='$nome',
      `cognome`='$cognome',`luogoN`='$luogoN',`residenza`='$residenza',`categoria`='$categoria',
      `dataN`='$dataN',`sesso`='$sesso',`email`='$email' WHERE user='$user';";
      $res=$cid->query($query) Or die("<p>Impossibile eseguire query.</p>" . "<p>Codice errore " . $cid->errno
      . ": " . $cid->error) . "</p>";

      if($cid->affected_rows > 0) {
          echo "<div style='padding-left:5%; font-size:20pt;'><b>Modifica Effettuata con successo!</b></div>";
      } elseif($cid->affected_rows == 0) echo "<div style='padding-left:5%; font-size:20pt;'><b>Non hai modificato nulla!</b></div>";

     } else {
        echo "<div style='padding-left:5%; font-size:20pt;'><b>Verifica la correttezza dei dati inseriti: </br> ". $errore;
        echo"</b></div>";
     }
    ?>
    </br><div style='padding-left:5%;'><a style='font-weight:bold;' class='linkBici' href="index.php"> Torna alla Homepage </a></div>
    </br><div style='padding-left:5%;'><a style='font-weight:bold;' class='linkBici' href="index.php?op=profilo&act=view&id=<?php echo $user;?>"> Vai al tuo Profilo </a></div>
    <img src='images/bici9.jpg' max-width='80%' max-height='80%'>
  </body>
</html>
