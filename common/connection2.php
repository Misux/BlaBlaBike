<?php
 $hostname= 'localhost';
 $username='root';
 $password='';
 $db='db_misuraca_dicapua2';

 $cid2 = new mysqli($hostname,$username,$password,$db);

 if ($cid2->connect_errno){
   die('Errore di connessione ('. $cid2->connect_errno . ')' . $cid2->connect_error);
 }
?>
