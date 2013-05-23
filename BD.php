<?php
include('./adodb/adodb.inc.php');
class BD{
	private $driver;
	private $host;
	private $user;
	private $pass;
	private $schema;
	private $con;
	
	function BD($d,$h,$u,$p,$s){
		$thi->driver = $d;
		$this->host = $h;
		$this->user = $u;
		$this->pass = $p;
		$this->schema = $s;
		$this->con =& ADONewConnection($thi->driver);
	}
	
	function abrirConexion(){
		$this->con->Connect($this->host, $this->user, $this->pass, $this->schema) or die('FALLO CONEXION');
		$this->con->SetFetchMode(ADODB_FETCH_BOTH);
		if(!$this->con){
			die ("Connection Failed!");
			return false;
		}
		return true;
	}
	
	function cerrarConexion(){
		$this->con->Close();
	}
	
	function encode($var){
		return base64_encode($var);
	}
	
	function verificaLogin($id,$pas){
		$result = 'Sin conexión';
		$usuario = array();
		if($this->abrirConexion()){
			//printf('Conexión existente');
			$sql = sprintf('select id_usuario as id, pass, nivel, estado from usuario where id_usuario = %d and pass = %s',$id,$this->con->qstr($this->encode($pas)));
			$rs = $this->con->Execute($sql);
			if(!$rs->EOF){
				//Encontro algo
				while(!$rs->EOF){
					$usuario['id'] = $rs->fields['id'];
					$usuario['pass'] = $rs->fields['pass'];
					$usuario['nivel'] = $rs->fields['nivel'];
					$usuario['estado'] = $rs->fields['estado'];
					$rs->MoveNext();
				}
				$rs->Close();
				if($usuario['estado'] > 0){
					if($usuario['nivel'] == 0){
						$sql = sprintf('select id_rel_t_t,id_taxi from rel_taxista_taxi where id_taxista=%d and estado=%d',$usuario['id'],1);
						$rs2 = $this->con->Execute($sql);
						if(!$rs2->EOF){
							while(!$rs2->EOF){
								$usuario['id_rel'] = $rs2->fields['id_rel_t_t'];
								$usuario['taxi'] = $rs2->fields['id_taxi'];
								$rs2->MoveNext();
							}
							$rs2->Close();
							$result = $usuario;
						}else{
							$result = 'Información incompleta.';
						}
					}else{
						$result = $usuario;
					}
				}else{
					//No activo
					$result = 'No esta activo como usuario';
				}
			}else{
				//No existe usuario
				$result = 'Usuario y/o contraseña incorrectos';
			}
			$this->cerrarConexion();
		}
		return $result;
	}
	
	function getHistorial(){
		$result = '<tr><td colspan="3">Sin conexión</td></tr>';
		$text = '';
		$id_rel;
		if($this->abrirConexion()){
			$sql = sprintf('select dia,hora,monto from historial where id_rel_t_t=%d and dia=%s order by hora ASC limit %d',$_SESSION['id_rel_usuario'],$this->con->qstr(date('Y-m-d')),15);
			$rs = $this->con->Execute($sql);
			if(!$rs->EOF){
				while(!$rs->EOF){
					$text .= '<tr><td>' . $rs->fields['dia'] . '</td><td>' . $rs->fields['hora'] . '</td><td>' . $rs->fields['monto'] . '</td></tr>';
					$rs->MoveNext();
				}
				$rs->Close();
				if(strlen($text) == 0){
					$text = '<tr><td colspan="3">No tiene un historial aun</td></tr>';
				}
			}else{
				$text = '<tr><td colspan="3">No tiene un historial aun</td></tr>';
			}
			$result = $text;
			$this->cerrarConexion();
		}
		return $result;
	}
	
	function saveCoords(){
		$lat = $_COOKIE[$_SESSION['id_usuario'] . '_lat'];
		$long = $_COOKIE[$_SESSION['id_usuario'] . '_long'];
		unset($_COOKIE[$_SESSION['id_usuario'] . '_lat']);
		unset($_COOKIE[$_SESSION['id_usuario'] . '_long']);
		$esta = false;
		$taxis = new SimpleXMLElement('./datos.xml',null,true);
		foreach($taxis->taxi as $taxi){
			if($taxi->id == $_SESSION['id_usuario']){
				$esta = true;
				$taxi->lat = $lat;
				$taxi->long = $long;
				$taxi->ocupado = $_SESSION['ocupado_usuario'];
				$taxi->activo = 1;
			}
		}
		if(!$esta){
			$taxi = $taxis->addChild('taxi');
			$taxi->addChild('id',$_SESSION['id_usuario']);
			$taxi->addChild('lat',$lat);
			$taxi->addChild('long',$long);
			$taxi->addChild('ocupado',$_SESSION['ocupado_usuario']);
			$taxi->addChild('activo',1);
		}
		$taxis->asXML('./datos.xml');
	}
	
	function cambiarEstado(){
		$taxis = new SimpleXMLElement('./datos.xml',null,true);
		foreach($taxis->taxi as $taxi){
			if($taxi->id == $_SESSION['id_usuario']){
				$taxi->activo = 0;
			}
		}
		$taxis->asXML('./datos.xml');
	}
	
	function saveCorrida($monto){
		$result = 'Sin conexion';
		if($this->abrirConexion()){
			$sql = sprintf('insert into historial(dia,hora,id_rel_t_t,monto) values(%s,%s,%d,%d)',$this->con->qstr(date('Y-m-d')),$this->con->qstr(date('H:i:s')),$_SESSION['id_rel_usuario'],$monto);
			$result = $this->con->Execute($sql);
			unset($_POST);
			$this->cerrarConexion();
		}
		return $result;
	}
	
	function hacerCorte(){
		$result = 'Sin conexión.';
		if($this->abrirConexion()){
			$sql = sprintf('update historial set corte=%d where id_rel_t_t=%d and dia=%s',1,$_SESSION['id_rel_usuario'],$this->con->qstr(date('Y-m-d')));
			$result = $this->con->Execute($sql);
			$this->cerrarConexion();
		}
		return $result;
	}
	
	function leerDatos(){
		$marcadores = array();
		$taxis = new SimpleXMLElement('./datos.xml',null,true);
		foreach($taxis->taxi as $taxi){
			if($taxi->activo == 1){
				$marcadores[$taxi->id] = array();
				$marcadores[$taxi->id]['id'] = $taxi->id;
				$marcadores[$taxi->id]['lat'] = $taxi->lat;
				$marcadores[$taxi->id]['long'] = $taxi->long;
				$marcadores[$taxi->id]['ocupado'] = $taxi->ocupado;
			}
		}
		return $marcadores;
	}
	function cargaFeatures($id){
		$result = '<table><tr><td>Sin conexion</td></tr></table>';
		if($this->abrirConexion()){
			$sql = sprintf('select concat(t1.nombre," ",t1.ap_paterno," ",t1.ap_materno) as nombre,t1.licencia as licencia,t1.Comentarios as comment from taxista as t1 where t1.id_taxista=%d',$id);
			$rs = $this->con->Execute($sql);
			if(!$rs->EOF){
				$result = '<table>';
				while(!$rs->EOF){
					$result .= '<tr><td>' . $rs->fields['nombre'] . '</td><td>' . $rs->fields['licencia'] . '</td><td>' . $rs->fields['comment'] . '</td></tr>';
					$rs->MoveNext();
				}
				$rs->Close();
				$resutl .= '</table>';
			}
		}
		return $result;
	}
}
//$bd = new BD("mysql",'mysql17.000webhost.com','a7881501_grety','chanacol11','a7881501_gotaxi');
$bd = new BD("mysql",'127.0.0.1:3306','root','bello','gotaxi');
?>