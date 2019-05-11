<!DOCTYPE html>
<html>
  <head>
    <style>
    .mySlides {
      margin-left:0px;
      display:none;
      padding-top: 20px;
      padding-bottom: 20px;
      width:630px;
      height:450px;
    }
    #boxSlider{
      width: 99.5%;
      height: 550px;
      border:0px solid black;
      padding-left: 2.5%;
      padding-right: 3%;
      padding-bottom: 2%;
      padding-top: 2%;
      background-color: #EFEFEF;
    }
    #spazFraseB{padding-left: 3%;padding-top: 7%;}
    #fraseB{
      border: 0px solid black;
      font-size: 24pt;
      font-weight: bold;
      height: 50px;
      color:#2F2F2F;
    }
    #fraseC{
      font-size: 13pt;
      height: 200px;
      border: 0px solid black;
      padding-top: 3%;
    }
    .let1{font-size: 35pt;}
    #tabD{
      background-color: white;
      border-radius: 5px;
      padding-left: 2%;
      padding-right: 2%;
    }
    #fraseD{
      font-size: 13pt;
      color:#2F2F2F;
      border: 0px solid black;
      height: 30px;
      padding-top: 0%;
    }
    </style>
  </head>
  <body>
    <table id="boxSlider">
      <tr>
        <td id='dimSlid'>
          <!-- metodo d'identificazione dell'elemento per classe "mySlides"-->
          <img class="mySlides" src="images/bici1.png">
          <img class="mySlides" src="images/bici8.png">
          <img class="mySlides" src="images/bici3.png">
        </td>
        <td id="spazFraseB" valign=top>
          <div id="fraseB"><span class="let1">B</span>la<span class="let1">B</span>la<span class="let1">B</span>ike</div>
          <div id="fraseC">è una community che permette di riunire appassionati di bicicletta che
            organizzano uscite! Se non vuoi pedalare da solo qui puoi conoscere nuovi amici e partecipare alle uscite.
          </div>
          <table id="tabD">
            <tr>
              <td><img src="images/crea.png" style="width:90px; height:90px;"></td>
              <td id="fraseD">Crea il tuo account e rimani in contatto con i tuoi amici.</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <!-- funzione di scorrimento delle immagini -->
  <script>
    var myIndex = 0;
    carousel(); //letteralmente "giostra"
    function carousel() {
      var i;
      var x = document.getElementsByClassName("mySlides");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      myIndex++;
      if (myIndex > x.length) {myIndex = 1}
      x[myIndex-1].style.display = "block"; //blocco l'immagine precedente
      setTimeout(carousel, 6000); // Cambio immagine ogni 6 secondi
    }
  </script>
  </body>
</html>
