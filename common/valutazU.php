<?php
if($_GET["val1"]==NULL || $_GET["val2"]==NULL) header("Location: err.php?e=404");
$t=$_GET["val1"];
$d=$_GET["val2"];
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Valutazione </title>
    <link rel="stylesheet" type="text/css" href="css/viewUscite.css"/>
    <style>
      #textVal{
        width: 100%;
        text-align: center;
        font-size: 20pt;
        font-weight: bold;
      }
      form{text-align: center;}
    </style>

    <script>
    function confermaInsValut() {
      var r = document.getElementsByName("val")
      var c = -1
      for(var i=0; i < r.length; i++){
        if(r[i].checked) {
          c = i;
        }
      }
      if (c == -1) {
      alert("seleziona un valore!");
      return false;
    } else {
      return true;
    }
      }
    </script>
  </head>
  <body background="images/cic1.jpg" style='background-repeat: no-repeat;' height=95%>
  <table align=center>
    <tr><td>
    <div style='background-color:white; width:500px; height: 180px; padding:2%; '>
    <!--vincolo rispettato grazie a un input radio che permette di esprimere una valutazione da 0 a 5-->
    <div id="textVal"> Esprimi una valutazione da 0 a 5 </div></br>
    <?php echo"<form method='post' action='index.php?op=uscite&act=valutE&val1=$t&val2=$d' onsubmit=\"return confermaInsValut()\">";?>
      <input type="radio" name="val" value="0"> 0 &emsp;
      <input type="radio" name="val" value="1"> 1 &emsp;
      <input type="radio" name="val" value="2"> 2 &emsp;
      <input type="radio" name="val" value="3"> 3 &emsp;
      <input type="radio" name="val" value="4"> 4 &emsp;
      <input type="radio" name="val" value="5"> 5 &emsp;
    </br></br><input class='botPartecipa' type="submit" value="Conferma">
  </form></br>
  <span style='margin-left:48.5%;'><?php echo"<a href='index.php?op=uscite&act=your&id=$user'>";?><img src='images/indietro2.png' width='5%' height='13%'></a>
  </div></td></tr></table>
  </body>
</html>
