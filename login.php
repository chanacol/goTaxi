<?php
echo '<!--section id="form" data-transition="slide" class="show"-->
	<section id="main_section">
	<header></header>
	<article id="main-article" class="active list indented">
	<!--article id="form-normal" class="active"-->';
if(isset($mensajes['error']['login'])){
	echo '<ul>
                <li class="dark">
                    <strong>Error</strong>
                    <small>' . $mensajes['error']['login'] . '</small>
                </li>
            </ul>';
	unset($mensajes['error']['login']);
}
echo	'<div class="form">
			<script>
				function validaNumero(value){
				var num = "0123456789";
				var numerico = true;
				for(var i = 0; i < value.length; i++){
					if(num.indexOf(value.charAt(i)) == -1){
						numerico = false;
					}
				}
				return numerico;
			}
			function validaFormulario(){
				if(!validaNumero(new String(document.getElementsByName("id").item(0).value))){
					Lungo.Notification.show("Usuario debe ser un n&uacute;mero.","info",2);
				}else{
					return true;
				}
				return false;
			}
			</script>
        	<form name="form1" method="post" action="./" onSubmit="return validaFormulario()">
            	<fieldset data-icon="">
                    <label>Usuario:</label>
                    <input type="text" name="id" value="' . $_POST['id'] . '" required>
                    <label>Contraseña:</label>
                    <input type="password" name="pass" maxlength="10" value="' . $_POST['pass'] . '" required>
                    <input type="submit" name="login" class="button anchor" value="Entrar"/>
                </fieldset>
            </form>
        </div>
		<div class="form">
			<label>Ejemplo de otra Aplicación que utiliza Geolocalización: PadMap.</label><br><br>
			<iframe width="560" height="315" src="http://www.youtube.com/embed/m3MXM8qjwVI?rel=0" frameborder="0" allowfullscreen></iframe>
			<br><br>
			<label>Si te gustó y para apoyarme, recomiendame:</label>
			<div class="fb-like" data-href="http://gotaxi.comeze.com/" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true" data-font="verdana"></div>
		</div>
        <footer class="bandera"></footer>
    </article>
</section>
</body>
</html>';
?>