<?php
include('./vars.php');
session_start();
if($_SESSION['nivel_usuario'] == 0){
	$bd->cambiarEstado();
}
session_destroy();
header('Location:./');
?>