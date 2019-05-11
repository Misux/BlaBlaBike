<?php
	$map=$_GET["map"];
?>
<html>
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<title>Google Maps</title>
		<style type="text/css">
			body.mapPos{position: fixed; border: 0px solid black; height: 100%;}
			#map {width:100%; height:65%;}
			.ricMap {width:250px; margin-bottom: 1%; padding-left: 3px;}
			#tooltip { padding:10px; text-align:left; }
			#tooltip p { padding:0; margin:0 0 5px 0; }
			#marg{margin-left:30%;}
			@media only screen and (max-width: 975px) {
			    #marg {
			      margin-left:14%;
			    }
			}
			@media only screen and (max-width: 754px) {
			    .ricMap {
			      width:170px;
			    }
			}
		</style>

		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDY0Rkl-FhrMnXasOkiJYViILkjjRQFoDk&callback=true"></script>
		<script type="text/javascript">

		//FUNZIONE DI CREAZIONE MAPPA
		 var createMap = function() {
			searchAddress(); //funzione che ricerca indirizzo sulle mappe
			var address = document.getElementById("address").value;
			var geocoder = new google.maps.Geocoder(); //var di codifica dati localizzazione

			geocoder.geocode( {'address': address}, function(results,status) {
				//se la codifica di localizzazione è andata a buon fine setta dei parametri per la visualizzazione mappa
      	if (status == google.maps.GeocoderStatus.OK) {
					var options = {
  					zoom: 12, //zoom
  					center: results[0].geometry.location, //posizione centrale
  					mapTypeId: google.maps.MapTypeId.ROADMAP //tipo map
					};

					var map = new google.maps.Map(document.getElementById('map'), options);
					//posizione marcatore rosso sulla mappa
					var marker = new google.maps.Marker(
						{
  						position: results[0].geometry.location,
  						map: map,
  						title: '#'
						}
					);

					var tooltip = '<div id="tooltip">'+'<p>formatted_address:<br>'+ results[0].formatted_address+'</p>'+'<p>latLng:<br>'+ results[0].geometry.location+'</p>'+'</div>';

					var infowindow = new google.maps.InfoWindow({content: tooltip});

					google.maps.event.addListener(marker, 'click', function() {infowindow.open(map,marker);});

				} else { alert("Problema nella ricerca dell'indirizzo: " + status); }
      });
		}
		//funzione per una nuova ricerca quando schicci il bottone e richiama la funzione sopra
		var searchAddress = function(){
			document.getElementById("submit").onclick = function() { createMap();}
		}
		//carico la mappa sulla base delle due funzioni sopra
		window.onload = createMap;
		</script>
	</head>
	<!--VISUALIZZAZIONE MAPPA-->
	<body class='mapPos'>
		<div class='posInput'>
    	<?php echo"<span id='marg'><input class='ricMap' id='address' type='textbox' value='$map'>";?>
    	</span><input class='ricMap' id="submit" type="button" value="trova indirizzo sulla mappa">
		</div>
		<table border=0 width=70%; height=100%; style='margin-left:14%;'>
			<tr><td id="map" style='position:abosolute;'></td><tr>
		</table>
	</body>
</html>
