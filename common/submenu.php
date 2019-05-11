<html>
  <head>
  </head>
  <body>
    <div id="submenu">
      <ul><li><a href="index.php?op=profilo&act=editProfilo">Modifica profilo</a><li></ul>
      <ul><li><a href="index.php?op=bici&id=<?php echo $user?>">Le tue biciclette</a><li></ul>
      <ul><li><a href="index.php?op=amici&id=<?php echo $user?>">I tuoi amici</a><li></ul>
      <ul><li><a href="index.php?op=profilo&act=top&id=<?php echo $user?>">Top local friend</a><li></ul>
      <ul><li><a href="index.php?op=uscite&act=your&id=<?php echo $user?>">Le tue uscite</a><li></ul>
      <ul><li><a href="index.php?op=uscite&act=yourOrg&id=<?php echo $user?>">Uscite organizzate</a><li></ul>
      <ul><li><a href="index.php?op=richieste">Inviti uscite</a><li></ul>
      <ul><li><a href="index.php?op=vendute&id=<?php echo $user?>">Conferma vendite</a><li></ul>
      <ul><li><a href="index.php?op=profilo&act=canc">Cancella profilo</a><li></ul>
    </div>
  </body>
</html>
