<?php 
include('./vars.php');
if(isset($_POST['corte'])){
	session_start();
	$bd->hacerCorte();
	$mensajes['page'] = 'normal_user.php';
}
if(isset($_POST['reload'])){
	session_start();
	$mensajes['page'] = trim($_POST['reload']);
}else if(isset($_POST['corrida'])){
	session_start();
	$monto = trim($_POST['monto']);
	$bd->saveCorrida($monto);
	$mensajes['page'] = 'normal_user.php';
	unset($_POST);
}else if(isset($_POST['login'])){
	if(!isset($_POST['id']) && !isset($_POST['pass'])){
		$mensajes['error']['login'] = 'Usuario y contraseña vacios.';
	}else{
		//Validación
		$user = trim($_POST['id']);
		$pass = trim($_POST['pass']);
		$result = $bd->verificaLogin($user,$pass);
		if(is_array($result)){
			unset($pass);
			if(!isset($_SESSION['id_usuario'])){
				session_start();
				$_SESSION['id_usuario'] = $result['id'];
				$_SESSION['nivel_usuario'] = $result['nivel'];
			}
			if($_SESSION['nivel_usuario'] == 0){
				$mensajes['page'] = 'normal_user.php';
				$_SESSION['id_rel_usuario'] = $result['id_rel'];
				$_SESSION['taxi_usuario'] = $result['taxi'];
				if(!isset($_SESSION['ocupado_usuario'])){
					$_SESSION['ocupado_usuario'] = 0;
				}
				unset($_POST);
			}else{
				$mensajes['page'] = 'admin_user.php';
			}
		}else{
			$mensajes['error']['login'] = $result;
		}
	}
}
echo $html[0];
include ($mensajes['page']);
echo $html[1];
?>