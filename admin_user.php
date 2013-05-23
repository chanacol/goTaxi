<?php
$marcadores = $bd->leerDatos();
echo '<section id="main_section">
		<header></header>
		<article id="main-article" class="active list indented">
			<div class="form">
				<a class="button anchor" href="./exit.php">Salir</a>
			</div>
			<div id="map2"></div>
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
			<script>
				var theDate = new Date();
				var oneYearLater = new Date( theDate.getTime() + 31536000000 );
				var expiryDate = "Thu, 2 Aug 2021 20:47:11 UTC";
				function CustomMarker1(latlng,  map) {
					this.latlng_ = latlng;
				
					// Once the LatLng and text are set, add the overlay to the map.  This will
					// trigger a call to panes_changed which should in turn call draw.
					this.setMap(map);
				  }
				  CustomMarker1.prototype = new google.maps.OverlayView();
				  CustomMarker1.prototype.draw = function() {
					var me = this;
				
					// Check if the div has been created.
					var div = this.div_;
					if (!div) {
					  // Create a overlay text DIV
					  div = this.div_ = document.createElement("DIV");
					  // Create the DIV representing our CustomMarker1
					  div.style.border = "none";
					  div.style.position = "absolute";
					  div.style.paddingLeft = "0px";
					  div.style.cursor = "pointer";
				
					  var img = document.createElement("img");
					  img.src = "./images/marker-red.png";
					  div.appendChild(img);
					  google.maps.event.addDomListener(div, "click", function(event) {
						google.maps.event.trigger(me, "click");
					  });
					  google.maps.event.addDomListener(div, "mouseover", function(event) {
						google.maps.event.trigger(me, "mouseover");
					  });
					  google.maps.event.addDomListener(div, "mouseout", function(event) {
						google.maps.event.trigger(me, "mouseout");
					  });
				
					  // Then add the overlay to the DOM
					  var panes = this.getPanes();
					  panes.overlayImage.appendChild(div);
					}
				
					// Position the overlay 
					var point = this.getProjection().fromLatLngToDivPixel(this.latlng_);
					if (point) {
					  div.style.left = point.x + "px";
					  div.style.top = point.y + "px";
					}
				  };
				
				  CustomMarker1.prototype.remove = function() {
					// Check if the overlay was on the map and needs to be removed.
					if (this.div_) {
					  this.div_.parentNode.removeChild(this.div_);
					  this.div_ = null;
					}
				  };
				
				  CustomMarker1.prototype.getPosition = function() {
				   return this.latlng_;
				  };
			//---------------CustomMarker0-----------------------------------------------------------------------
				function CustomMarker0(latlng,  map) {
					this.latlng_ = latlng;
				
					// Once the LatLng and text are set, add the overlay to the map.  This will
					// trigger a call to panes_changed which should in turn call draw.
					this.setMap(map);
				  }
				  CustomMarker0.prototype = new google.maps.OverlayView();
				  CustomMarker0.prototype.draw = function() {
					var me = this;
				
					// Check if the div has been created.
					var div = this.div_;
					if (!div) {
					  // Create a overlay text DIV
					  div = this.div_ = document.createElement("DIV");
					  // Create the DIV representing our CustomMarker0
					  div.style.border = "none";
					  div.style.position = "absolute";
					  div.style.paddingLeft = "0px";
					  div.style.cursor = "pointer";
				
					  var img = document.createElement("img");
					  img.src = "./images/marker-yellow.png";
					  div.appendChild(img);
					  google.maps.event.addDomListener(div, "click", function(event) {
						google.maps.event.trigger(me, "click");
					  });
					  google.maps.event.addDomListener(div, "mouseover", function(event) {
						google.maps.event.trigger(me, "mouseover");
					  });
				
					  // Then add the overlay to the DOM
					  var panes = this.getPanes();
					  panes.overlayImage.appendChild(div);
					}
				
					// Position the overlay 
					var point = this.getProjection().fromLatLngToDivPixel(this.latlng_);
					if (point) {
					  div.style.left = point.x + "px";
					  div.style.top = point.y + "px";
					}
				  };
				
				  CustomMarker0.prototype.remove = function() {
					// Check if the overlay was on the map and needs to be removed.
					if (this.div_) {
					  this.div_.parentNode.removeChild(this.div_);
					  this.div_ = null;
					}
				  };
				
				  CustomMarker0.prototype.getPosition = function() {
				   return this.latlng_;
				  };
				function success() {
					//alert("debug2");
					var latlng = new google.maps.LatLng(19.535201, -96.914520);
					var myOptions = {
						zoom: 12,
						center: latlng,
						mapTypeControl: false,
						navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};
					
					var map = new google.maps.Map(document.getElementById("map2"), myOptions);
					var overlay0 = new CustomMarker0(new google.maps.LatLng(19.502057999999998, -96.88635359999999), map);
		  			var iw0 = new google.maps.InfoWindow({content: "'.$bd->cargaFeatures('234567').'", pixelOffset: new google.maps.Size(5,0)});
		  			google.maps.event.addListener(overlay0, "click", function() {
						esconder();
					});
					google.maps.event.addListener(overlay0, "mouseover", function() {
						iw0.open(map, overlay0);
					});
					var overlay33 = new CustomMarker1(new google.maps.LatLng(19.602057999999998, -96.98635359999999), map);
		  			var iw33 = new google.maps.InfoWindow({content: "'.$bd->cargaFeatures('234567').'", pixelOffset: new google.maps.Size(5,0)});
		  			google.maps.event.addListener(overlay33, "click", function() {
						esconder();
					});
					google.maps.event.addListener(overlay33, "mouseover", function() {
						iw33.open(map, overlay33);
					});';
$i = 1;
foreach($marcadores as $marker){
	echo 'var overlay' . $i . '= new CustomMarker' . $marker['ocupado'] . '(new google.maps.LatLng(' . $marker['lat'] . ', ' . $marker['long'] . ');, map);
		  var iw' . $i . ' = new google.maps.InfoWindow({content: "' . $bd->cargaFeatures($marker['id']) . '", pixelOffset: new google.maps.Size(5,0)});
		  google.maps.event.addListener(overlay' . $i . ', "click", function() {
			esconder();
		  });
		  google.maps.event.addListener(overlay' . $i . ', "mouseover", function() {
			iw' . $i . '.open(map, overlay' . $i . ');
		  });';
	$i++;
}
echo 		   '}
				if(navigator.geolocation){
					success();
				}
				function esconder(){
					Lungo.View.Aside.toggle("#features");
				}
				function recargar(){
					document.getElementById("reload").submit();
				}
			</script>
			<fieldset>
				<form method="post" action="./" id="reload">
					<input type="hidden" name="reload" value="admin_user.php" />
					<a class="button anchor" href="javascript:recargar()">Refrescar mapa</a>
				</form>
			</fieldset>
			<footer class="bandera"></footer>
    	</article>
	</section>
	<aside id="features">
		<header data-title="Perfil"></header>
		<article class="active">
			<table class="tabla2">
				<tr><td>Total de taxis activos:</td><td>' . (count($marcadores) + 2) . '</td></tr>
			</table>	
			<a onclick="esconder()" class="button">Cerrar</a>
		</article>
	</aside>';
?>