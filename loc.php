<?php
echo '<div id="map"></div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>
	var estado = 0;
	var theDate = new Date();
	var oneYearLater = new Date( theDate.getTime() + 31536000000 );
	//var expiryDate = oneYearLater.toGMTString();
	var expiryDate = "Thu, 2 Aug 2021 20:47:11 UTC";
	function mostrarOcultar(){
		if(estado == 1){
			document.getElementById("monto").style.display = "block"
			estado = 0;
		}else{
			estado = 1;
		}
		document.cookie ="' . $_SESSION['id_usuario'] . '_ocupado=" + estado + "; expires=" + expiryDate + "; path=/";
	}
	function success(position) {
		//alert("debug2");
		var lat = position.coords.latitude;
		var long = position.coords.longitude;
	  	var latlng = new google.maps.LatLng(lat, long);
	  	var myOptions = {
			zoom: 15,
			center: latlng,
			mapTypeControl: false,
			navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
			mapTypeId: google.maps.MapTypeId.ROADMAP
		  };
		var map = new google.maps.Map(document.getElementById("map"), myOptions); 
	  	var marker = new google.maps.Marker({
		  position: latlng, 
		  map: map, 
		  title:"You are here!"
		});
		document.cookie ="' . $_SESSION['id_usuario'] . '_lat=" + lat + "; expires=" + expiryDate + "; path=/";
		document.cookie ="' . $_SESSION['id_usuario'] . '_long=" + long + "; expires=" + expiryDate + "; path=/";
	}
	function error(msg) {
	  Lungo.Notification.show(typeof msg == "string" ? msg : "failed",5);
	}
	if(navigator.geolocation){
		//alert("debug1");
		navigator.geolocation.getCurrentPosition(success, error);
		navigator.geolocation.watchPosition(succes,error);
	}
	function validaDinero(){
		var dinero = new String(document.getElementsByName("monto").item(0).value);
		var num = "0123456789.";
		var numerico = true;
		for(var i = 0; i < dinero.length; i++){
			if(num.indexOf(dinero.charAt(i)) == -1){
				numerico = false;
			}
		}
		Lungo.Notification.show("En monto solo indique la cantidad que cobro (se aceptan decimales).","info",2);
		return numerico;
	}
</script>'
;
if(isset($_COOKIE[$_SESSION['id_usuario'] . '_ocupado'])){
	$_SESSION['ocupado_usuario'] = $_COOKIE[$_SESSION['id_usuario'] . '_ocupado'];
	unset($_COOKIE[$_SESSION['id_usuario'] . '_ocupado']);
}
$bd->saveCoords();
echo '<div class="form">
		<label>Estado</label>
		<div class="switch demo3">
			<input type="checkbox" id="estado" onchange="mostrarOcultar()" ' . (($_SESSION['estado_usuario'] == 1)? 'checked:"checked"': '') .' />
			<label><i></i></label>
		</div>
	</div>
	<div id="monto" style="display:none">
		<div class="form">
			<form method="post" action="./" onsubmit="validaDinero()">
				<fieldset data-icon="">
					<label>Monto: $</label><input type="text" name="monto" required/>
					<input class="button anchor" type="submit" name="corrida" value="Guardar"/>
				</fieldset>
			</form>>
		</div>
	</div>';
?>