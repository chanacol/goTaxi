<section id="main" data-transition="slide" class="show">
	<header class="extended"></header>
    <nav class="groupbar">
        <a href="#loc" data-router="article" class="active">
            Localizaci&oacute;n
        </a>
        <a href="#hist" data-router="article">
            Historial
        </a>
        <a href="./exit.php" data-router="article" data-icon="home">
            Salir
        </a>
    </nav>
    <article id="loc" class="active">
    	<?php 
		echo $_SESSION['nivel_usuario'];
		include('./loc.php')?>
    </article>
    <article id="hist">
    	<div class="form">
        	<div class="form">
            	<script>
					function recargar(){
						document.getElementById("reload").submit();
					}
					function redireccionar(){
						location.href="#hist";
					}
					//setTimeout ("redireccionar()", 20000);
				</script>
            	<fieldset>
                	<form method="post" action="./" id="reload">
                    	<input type="hidden" name="reload" value="normal_user.php" />
                		<a class="button anchor" href="javascript:recargar()">Refrescar Historial</a>
                    </form>
                </fieldset>
            </div>
        	<table class="tabla">
            	<tr>
                	<th>Dia</th>
                    <th>Hora</th>
                    <th>Monto</th>
                </tr>
                <?php echo $bd->getHistorial();?>
            </table>
            <div class="form">
            	<fieldset>
                	<form method="post" action="./">
                		<input type="submit" class="button anchor" value="Hacer corte de caja" name="corte" />
                    </form>
                </fieldset>
            </div>
        </div>
    </article>
    <footer></footer>
</section>