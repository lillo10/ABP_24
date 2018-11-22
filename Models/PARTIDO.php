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
		$sql = "SELECT * FROM `Partido` WHERE `idPartido` LIKE '%".$this -> idPartido."%' and `Pista_idPistas` LIKE '%".$this -> numPista."%' and `Pista_Fecha/Hora` LIKE '%".$this -> fecha_hora."%'";
		
		$resultado = $this->mysqli->query($sql);
		
		if(!$resultado || $resultado->num_rows == 0){
			return 'No se ha encontrado ningun dato';
		}
		if(!$resultado){
			return "No se ha podido conectar con la DB";
		}else{
			return $resultado;
		}
	}

	function _insertarPartido(){
		$existe = $this->_checkExistePista();
		if($existe == "FALSE"){
			return 'Esta pista a esta fecha y hora no esta a la disposición del publico';
		}
		else{
			$disponibilidad = $this->_checkDisponibilidad();

			if($disponibilidad == "FALSE"){
				return 'Esta pista a esta fecha y hora ya esta reservada';				
			}
			else{
				$fecha_hora = mysqli_real_escape_string($this->mysqli, $this->fecha_hora);
				$numPista = mysqli_real_escape_string($this->mysqli, $this->numPista);
				$jugadores = mysqli_real_escape_string($this->mysqli, $this->jugadores);
				
				$sql = "INSERT INTO Partido (Pista_idPistas, `Pista_Fecha/Hora`, Jugadores)
VALUES ('$numPista', '$fecha_hora', '$jugadores')";
				$respuesta = $this->mysqli->query($sql);
				
				if(!$respuesta){
					return 'Error al insertar en la base de datos';
				}else{
					return 'Partido promocionado correctamente';
				}
			}
		}
	}

	function _updateDisponibilidad(){
		$this->_getPartidoLanzado($idPartido);
		$fecha_hora = mysqli_real_escape_string($this->mysqli, $this->fecha_hora);
		$numPista = mysqli_real_escape_string($this->mysqli, $this->numPista);
		$sql = "UPDATE Pista SET Disponibilidad = 'NO' WHERE (`Fecha/Hora` = '$fecha_hora' AND num_Pista = '$numPista')";
		$respuesta = $this->mysqli->query($sql);
	}

	function _apuntarUsuario($idPartido){
		$this->_getPartidoLanzado($idPartido);
		$this->_setJugadores($this->_getJugadores()+1);

		if($this->_getJugadores()==4){
			$this->_updateDisponibilidad();
		}
		$idPartido = mysqli_real_escape_string($this->mysqli, $idPartido);
		include '../Models/USUARIO.php';
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
			$this->_setNumPista($fila[2]);
			$this->_setJugadores($fila[3]);
		}
	}

	function _deletePartido($idPartido){
		if(!esAdmin()){
			$usuario = mysqli_real_escape_string($this->mysqli, $_SESSION['login']);
			$idPartido = mysqli_real_escape_string($this->mysqli, $idPartido);
			$this->_getPartidoLanzado($idPartido);
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
		else{
			$this->_getPartidoLanzado($idPartido);
			$existe = $this->_checkExistePista();
			if($existe == "FALSE"){
				return 'Este partido no existe en la base de datos';
			}else if($existe == "TRUE"){
				$idPartido = mysqli_real_escape_string($this->mysqli, $idPartido);
				$fecha_hora = mysqli_real_escape_string($this->mysqli, $this->fecha_hora);
				$numPista = mysqli_real_escape_string($this->mysqli, $this->numPista);

				echo $fecha_hora;
				echo $numPista;
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
			}else{
				return 'No se ha podido conectar con la BD';
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
		$sql = "SELECT * FROM `Partido` WHERE `Pista_idPistas` LIKE '%".$this -> numPista."%' or `Pista_Fecha/Hora` LIKE '%".$this -> fecha_hora."%' or `Jugadores`LIKE '%".$this -> jugadores."%'" ;

		$resultado = $this->mysqli->query($sql);
		
		if(!$resultado || $resultado->num_rows == 0){
			return 'No se ha encontrado ningun dato';
		}
		if(!$resultado){
			return "No se ha podido conectar con la DB";
		}else{
			return $resultado;
		}
	}

	function _mygames(){
		$usuario = mysqli_real_escape_string($this->mysqli, $_SESSION['login']);
		$sql = "SELECT idPartido, Pista_idPistas, `Pista_Fecha/Hora`, Jugadores FROM Partido AS P , Usuarios_has_Partido AS U WHERE (U.Partido_idPartido = P.idPartido AND U.Usuarios_login = '$usuario')";
		$resultado = $this->mysqli->query($sql);
		if($resultado->num_rows == 1){
			return $resultado;
		}else{
			return "El usuario no tiene partidos";
		}
	}

	function _checkExistePista(){
		$fecha_hora = mysqli_real_escape_string($this->mysqli, $this->fecha_hora);
		$numPista = mysqli_real_escape_string($this->mysqli, $this->numPista);
		$sql = "SELECT * FROM Pista WHERE (`Fecha/Hora` = '$fecha_hora' AND `num_Pista` = '$numPista')";
		$resultado = $this->mysqli->query($sql);
		if($resultado != 0){
			return "TRUE";
		}
		else if(!$resultado)
			return "FAILED";
		else
			return "FALSE";
	}

	function _checkDisponibilidad(){
		$fecha_hora = mysqli_real_escape_string($this->mysqli, $this->fecha_hora);
		$numPista = mysqli_real_escape_string($this->mysqli, $this->numPista);

		$sql = "SELECT Disponibilidad FROM Pista WHERE (`Fecha/Hora` = '$fecha_hora' AND `num_Pista` = '$numPista')";
		$resultado = $this->mysqli->query($sql);
		$fila = $resultado->fetch_row();
		if($fila[0] == "NO")
			return "FALSE";
		else if(!$resultado)
			return "FAILED";
		else
			return "TRUE";
	}
}