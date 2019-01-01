<?php
/* Clase de modelo de Partido, el cual accederá exclusivamente a la base de datos
*/
class Partido{
	
	var $idPartido;
  	var $fecha_hora;
    var $numPista;
    var $jugadores;
	var $mysqli;
	//Atributos
	
	function __construct($idPartido=NULL, $fecha_hora=NULL, $numPista=NULL, $jugadores=NULL){
		//Asignaciones
		$this->_setIdPartido($idPartido);
		$this->_setFecha_Hora($fecha_hora);
		$this->_setNumPista($numPista);
		$this->_setJugadores($jugadores);
		
		include_once '../Functions/AccederBD.php';
		$this->mysqli = ConectarBD();
	}

	function _setIdPartido($idPartido){
		$this->idPartido = $idPartido;
	}

	function _setFecha_Hora($fecha_hora){
		$this->fecha_hora = $fecha_hora;
	}

	function _setNumPista($numPista){
		$this->numPista = $numPista;
	}

	function _setJugadores($jugadores){
		$this->jugadores = $jugadores;
	}

	function _getJugadores(){
		return $this->jugadores;
	}

	function _getNumPista(){
		return $this->numPista;
	}

	function _getIdPartido(){
		return $this->idPartido;
	}

	function _getFecha_Hora(){
		return $this->fecha_hora;
	}

	function _showAll(){
		$sql = "SELECT * FROM `Partido`";
		
		$resultado = $this->mysqli->query($sql);
		
		if(!$resultado){
			return "No se ha podido conectar con la DB";
		}else{
			return $resultado;
		}
	}

	function _mygames(){
		$usuario = mysqli_real_escape_string($this->mysqli, $_SESSION['login']);
		$sql = "SELECT idPartido, `Pista_Fecha/Hora`, Jugadores, Pista FROM Partido AS P , Usuarios_has_Partido AS U WHERE (U.Partido_idPartido = P.idPartido AND U.Usuarios_login = '$usuario')";
		$resultado = $this->mysqli->query($sql);
		if(!$resultado || $resultado->num_rows == 0){
			return 'No se ha encontrado ningun Partido';
		}
		if(!$resultado){
			return "No se ha podido conectar con la DB";
		}
		else{
			return $resultado;
		}
	}

	function _insertarPartido(){
		if($this->_checkExistePistaDisponible()){
			$fecha_hora = mysqli_real_escape_string($this->mysqli, $this->fecha_hora);
			$jugadores = mysqli_real_escape_string($this->mysqli, $this->jugadores);
			
			$sql = "INSERT INTO Partido (`Pista_Fecha/Hora`, Jugadores) VALUES ('$fecha_hora', '$jugadores')";
			$respuesta = $this->mysqli->query($sql);
			
			if(!$respuesta){
				return 'Error al insertar en la base de datos';
			}else{
				return 'Partido promocionado correctamente';
			}
		}
		else{
			return 'No hay pistas a esta fecha y hora, ya estan reservadas o no están a la disposición del público';	
		}
	}

	function _apuntarUsuario($idPartido){
		$this->_getPartidoLanzado($idPartido);
		$this->_setJugadores($this->_getJugadores()+1);
		if($this->_getJugadores()==4){
			if(!$this->_updateDisponibilidad($idPartido))
				return "Ha habido un error interno o todas las pistas para este día y hora han sido reservadas";
			else
				return "Modificado correcto";
		} else if($this->_getJugadores()>4){
			return "No pueden haber mas de 4 jugadores";
		} else{
			$idPartido = mysqli_real_escape_string($this->mysqli, $idPartido);
			$usuario = mysqli_real_escape_string($this->mysqli, $_SESSION['login']);
			$sql = "INSERT INTO Usuarios_has_Partido (Usuarios_login, Partido_idPartido) VALUES ('$usuario', '$idPartido')";
			if(!$this->mysqli->query($sql)){
				return 'Ha fallado la insercion del usuario';
			}else{
				$jugadores = mysqli_real_escape_string($this->mysqli, $this->_getJugadores());
				$sql = "UPDATE Partido SET Jugadores = '$jugadores' WHERE idPartido = '$idPartido'";
				if(!$this->mysqli->query($sql)){
					return 'Ha fallado la actualización del numero de Jugadores';
				}else{
					return 'Modificado correcto';
				}
			}
		}
	}

	function _updateDisponibilidad($idPartido){
		$this->_getPartidoLanzado($idPartido);
		$this->_setJugadores($this->_getJugadores()+1);
		$fecha_hora = mysqli_real_escape_string($this->mysqli, $this->fecha_hora);
		$sql = "SELECT idPistas FROM Pista WHERE(`Fecha/Hora` = '$fecha_hora' AND Disponibilidad = 'SI')";
		$respuesta = $this->mysqli->query($sql);
		if($respuesta->num_rows == 0 || !$respuesta){
			return FALSE;
		} else {
			$fila=$respuesta->fetch_row();
			$sql = "UPDATE Pista SET Disponibilidad = 'NO' WHERE (`idPistas` = '$fila[0]')";
			$this->mysqli->query($sql);
			$sql = "SELECT num_Pista FROM Pista WHERE (`idPistas` = '$fila[0]')";
			$resultado = $this->mysqli->query($sql);
			$fila=$resultado->fetch_row();
			$sql = "UPDATE Partido SET Pista = '$fila[0]' WHERE (`idPartido` = '$idPartido')";
			$this->mysqli->query($sql);

			$usuario = mysqli_real_escape_string($this->mysqli, $_SESSION['login']);
			$sql = "INSERT INTO Usuarios_has_Partido (Usuarios_login, Partido_idPartido) VALUES ('$usuario', '$idPartido')";
			if(!$this->mysqli->query($sql)){
				return FALSE;
			}else{
				$jugadores = mysqli_real_escape_string($this->mysqli, $this->_getJugadores());
				$sql = "UPDATE Partido SET Jugadores = '$jugadores' WHERE idPartido = '$idPartido'";
				if(!$this->mysqli->query($sql)){
					return FALSE;
				}else{
					return TRUE;
				}
			}
		}
	}
	
	function _getPartidoLanzado($idPartido){
		$idPartido = mysqli_real_escape_string($this->mysqli, $idPartido);
		$sql = "SELECT * FROM Partido WHERE idPartido = '$idPartido'";
		
		$resultado = $this->mysqli->query($sql);
		
		if(!$resultado){
			return 'No se ha podido conectar con la BD';
		}else if($resultado->num_rows == 0){
			return 'No hay partido con este id';
		}else{
			$fila = $resultado->fetch_row();
			$this->_setFecha_Hora($fila[1]);
			$this->_setJugadores($fila[2]);
			$this->_setNumPista($fila[3]);
		}
	}

	function _deletePartido($idPartido, $borradoMaxima){
		if(!$borradoMaxima){
			$usuario = mysqli_real_escape_string($this->mysqli, $_SESSION['login']);
			$idPartido = mysqli_real_escape_string($this->mysqli, $idPartido);
			$this->_getPartidoLanzado($idPartido);
			$sql = "SELECT Usuarios_login FROM Usuarios_has_Partido WHERE Usuarios_login = '$usuario' AND Partido_idPartido = '$idPartido'";
			$resultado = $this->mysqli->query($sql);
			if($resultado->num_rows == 0){
				return 'No estas inscrito en este Partido';
			}
			else{
				if($this->_getJugadores()==4){
					$fecha_hora = mysqli_real_escape_string($this->mysqli, $this->_getFecha_Hora());
					$numPista = mysqli_real_escape_string($this->mysqli, $this->_getNumPista());
					$sql = "UPDATE Pista SET Disponibilidad = 'SI' WHERE (num_Pista = '$numPista' AND `Fecha/Hora` = '$fecha_hora')";
					if(!$this->mysqli->query($sql)){
						return 'Ha fallado la actualización de la disponibilidad de la pista';
					}
					$sql = "UPDATE Partido SET Pista = null WHERE idPartido = '$idPartido'";
					$this->mysqli->query($sql);
				}
				$this->_setJugadores($this->_getJugadores()-1);
				$jugadores = mysqli_real_escape_string($this->mysqli, $this->_getJugadores());
				$sql = "UPDATE Partido SET Jugadores = '$jugadores' WHERE idPartido = '$idPartido'";
				if(!$this->mysqli->query($sql)){
					return 'Ha fallado la actualización del numero de Jugadores';
				}else{
					$sql = "DELETE FROM Usuarios_has_Partido WHERE (Usuarios_login = '$usuario' AND Partido_idPartido = '$idPartido')";
					if(!$this->mysqli->query($sql)){
						return 'Ha fallado tu eliminación de este partido';
					}
					else{
						return 'Modificado correcto';
					}
				}
			}
		}
		else{
			$this->_getPartidoLanzado($idPartido);
			$idPartido = mysqli_real_escape_string($this->mysqli, $idPartido);
			$fecha_hora = mysqli_real_escape_string($this->mysqli, $this->fecha_hora);
			$numPista = mysqli_real_escape_string($this->mysqli, $this->_getNumPista());
			if($this->_getJugadores()==4){
				$sql = "UPDATE Pista SET Disponibilidad = 'SI' WHERE (num_Pista = '$numPista' AND `Fecha/Hora` = '$fecha_hora')";
				if(!$this->mysqli->query($sql)){
					return 'Ha fallado la actualización de la disponibilidad de la pista';
				}
			}
			$sql = "DELETE FROM Usuarios_has_Partido WHERE Partido_idPartido = '$idPartido'";
			if(!$this->mysqli->query($sql)){
				return 'Ha fallado el borrado de los usuarios de este partido';
			}else{
				$sql = "DELETE FROM Partido WHERE idPartido = '$idPartido'";
				if(!$this->mysqli->query($sql)){
					return 'Ha fallado el borrado del partido';
				}else{
					return 'Modificado correcto';
				}
			}
		}
	}

	function _showUsers($idPartido){
		$idPartido = mysqli_real_escape_string($this->mysqli, $idPartido);
		$sql = "SELECT Usuarios_login FROM Usuarios_has_Partido WHERE Partido_idPartido = '$idPartido'";
		
		$resultado = $this->mysqli->query($sql);
		return $resultado;
	}

	function _search(){
		$fecha_hora = mysqli_real_escape_string($this->mysqli, $this->fecha_hora);
		$numPista = mysqli_real_escape_string($this->mysqli, $this->numPista);
		$jugadores = mysqli_real_escape_string($this->mysqli, $this->jugadores);
		
		$sql = "SELECT * FROM `Partido` WHERE (`Pista_idPistas`= '$numPista' OR `Pista_Fecha/Hora`='$fecha_hora' OR `Jugadores`='$jugadores')" ;

		$resultado = $this->mysqli->query($sql);
		
		if($resultado->num_rows == 0){
			return 'No se ha encontrado ningun dato';
		}
		else if(!$resultado){
			return "No se ha podido conectar con la DB";
		}
		else{
			return $resultado;
		}
	}

	function _checkExistePistaDisponible(){
		$fecha_hora = mysqli_real_escape_string($this->mysqli, $this->fecha_hora);
		$sql = "SELECT * FROM Pista WHERE (`Fecha/Hora` = '$fecha_hora' AND `Disponibilidad` = 'SI')";
		$resultado = $this->mysqli->query($sql);
		if($resultado->num_rows != 0)
			return TRUE;
		else if(!$resultado)
			return FAILED;
		else
			return FALSE;
	}
}