<?php
 $hostname= 'localhost';
 $username='root';
 $password='';
 $db='db_misuraca_dicapua2';

 $cid = new mysqli($hostname,$username,$password,$db);

 if ($cid->connect_errno){
   die('Errore di connessione ('. $cid->connect_errno . ')' . $cid->connect_error);
 }
?>
