<?php
/* Clase de modelo de CLASE, el cual accederá exclusivamente a la base de datos

*/
class Escueladeportiva{
	
	var $idClase;
	var $Fecha;
	var $Entrenador_login;
	var $Pista;
	var $Precio;
	var $numJugadores;
	var $mysqli;
	var $Tipo;
	
	//Atributos
	
	function __construct($idClase=NULL, $Fecha=NULL, $Entrenador_login=NULL, $Pista=NULL, $numJugadores=NULL, $Precio=NULL, $Tipo = NULL){
		//Asignaciones
		$this->_setidClase($idClase);
		$this->_setPeriodo($Fecha);
		$this->_setEntrenador($Entrenador_login);
		$this->_setPista($Pista);
		$this->_setnumJugadores($numJugadores);
		$this->_setPrecio($Precio);
		$this->_setTipo($Tipo);

		include_once '../Functions/AccederBD.php';
		$this->mysqli = ConectarBD();
	}
	
		function _setidClase($idClase){
			$this->idClase = $idClase;
		}
		
		function _setPeriodo($Fecha){
			$this->Fecha = $Fecha;
		}
		
		function _setEntrenador($Entrenador_login){
			$this->Entrenador_login = $Entrenador_login;
		}
		
		function _setPista($Pista){
			$this->Pista = $Pista;
		}

		function _setnumJugadores($numJugadores){
			$this->numJugadores = $numJugadores;
		}

		function _setPrecio($Precio){
			$this->Precio = $Precio;
		}

		function _setTipo($Tipo){
			$this->Tipo = $Tipo;
		}
		
		
		function _getidClase(){
			return $this->idClase;
		}
		
		function _getFecha(){
			return $this->Fecha;
		}
		
		function _getEntrenador_login(){
			return $this->Entrenador_login;
		}
		
		function _getPista(){
			return $this->Pista;
		}

		function _getnumJugadores(){
			return $this->numJugadores;
		}

		function _getPrecio(){
			return $this->Precio;
		}

		function _getTipo(){
			return $this->Tipo;
		}
		
	function _showAllEscuela(){
		$sql = "SELECT * FROM Clase";
		
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

	function _showAllEscuelaEntrenador(){
		$usuario = mysqli_real_escape_string($this->mysqli, $_SESSION['login']);
		$sql = "SELECT * FROM Clase WHERE (TIPO = 'PRIVADA' AND Entrenador_login = '$usuario')";
		
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


	function _escuelaMisClases(){//Muestra todas las clases de la escuela deportiva
		$usuario = mysqli_real_escape_string($this->mysqli, $_SESSION['login']);
		$sql = "SELECT C.idClase, C.Pista, C.Fecha, C.Precio, C.numJugadores, C.Entrenador_login, C.TIPO FROM Clase AS C , Clase_has_Usuario AS U WHERE (U.Clase_idClase = C.idClase AND U.Usuario_login = '$usuario')";
		$resultado = $this->mysqli->query($sql);
		if($resultado){
			return $resultado;
		}else{
			return "La escuela deportiva aun no tiene asignada clases";
		}
	}

	function _insertarClase(){
		$existe = $this->_checkDisponibilidadEscuela();
		if($existe == "FALSE"){
			return 'Esta clase no existe o no está disponible el horario';
		}
		else{
			$fecha_hora = mysqli_real_escape_string($this->mysqli, $this->Fecha);
			$numPista = mysqli_real_escape_string($this->mysqli, $this->Pista);
			$entrenador = mysqli_real_escape_string($this->mysqli, $this->Entrenador_login);
				
			$sql = "INSERT INTO Clase (Pista, Fecha, Precio, numJugadores, Entrenador_login, TIPO)
VALUES ('$numPista', '$fecha_hora', '50', '0', '$entrenador', 'PUBLICA')";
			$respuesta = $this->mysqli->query($sql);
			$upd = $this->_updateDisponibilidadEscuela();
			if(!$respuesta){
				return 'Error al insertar en la base de datos';
			}else{
				return 'Clase promocionada correctamente';
			}
		}
	}


	function _updateDisponibilidadEscuela(){
		$this->_getClaseLanzadoEscuela($idClase);
		$fecha_hora = mysqli_real_escape_string($this->mysqli, $this->Fecha);
		$numPista = mysqli_real_escape_string($this->mysqli, $this->Pista);
		$sql = "UPDATE Pista SET Disponibilidad = 'NO' WHERE (`Fecha/Hora` = '$fecha_hora' AND num_Pista = '$numPista')";
		$respuesta = $this->mysqli->query($sql);
		if(!$respuesta){
			return "No se pudo actualizar la disponibilidad de la pista";
		}else{
			return "Disponibilidad actualizada correctamente";
		}
	}

	function _updateJugadores($idClase){
		$jugadores = $this->_getnumJugadores();
		$aux = $jugadores + 1;
		$sql = "UPDATE Clase SET numJugadores = '$aux' WHERE (idClase = '$idClase')";
		if(!$this->mysqli->query($sql)){
			return "No se actualizó correctamente la cantidad de jugadores";
		}else{
			return "Actualizada correctamente";
		}
	}

	function _updateDelJugadores($idClase){
		$jugadores = $this->_getnumJugadores();
		$aux = $jugadores - 1;
		$sql = "UPDATE Clase SET numJugadores = '$aux' WHERE (idClase = '$idClase')";
		if(!$this->mysqli->query($sql)){
			return FALSE;
		}else{
			return TRUE;
		}
	}

	function _apuntarUsuarioClaseEscuela($idClase){
		$this->_getClaseLanzadoEscuela($idClase);
		$tipo = $this->_checkTipo($idClase);
		if($this->_getnumJugadores()==8){//8 jugadores, clase llena
			return "Clase Completa";
		}else if($this->_getnumJugadores()>0 && !$tipo){
			return "No se pudo insertar porque la Clase Privada está Completa";
		}else{
			$this->_updateJugadores($idClase);
			$usuario = mysqli_real_escape_string($this->mysqli, $_SESSION['login']);
			$sql = "INSERT INTO Clase_has_Usuario (Clase_idClase, Usuario_login) VALUES ('$idClase', '$usuario')";

			$res = $this->mysqli->query($sql);
			if(!$res){
				return "No se pudo insertar correctamente al usuario dentro de la clase";
			}else{
				return "Usuario insertado correctamente en la clase";
			}
		}
	}

	function _getClaseLanzadoEscuela($idClase){
		$idClase = mysqli_real_escape_string($this->mysqli, $idClase);
		$sql = "SELECT * FROM Clase WHERE idClase = '$idClase'";
		
		$resultado = $this->mysqli->query($sql);
		
		if(!$resultado){
			return 'No se ha podido conectar con la BD';
		}else if($resultado->num_rows == 0){
			return 'No hay Clases con este id';
		}else{
			$fila = $resultado->fetch_row();
			$this->_setPista($fila[1]);
			$this->_setPeriodo($fila[2]);
			$this->_setPrecio($fila[3]);
			$this->_setnumJugadores($fila[4]);
			$this->_setEntrenador($fila[5]);
		}
	}

	function _showUsersEscuela($idClase){
		$sql = "SELECT Usuario_login FROM Clase_has_Usuario WHERE Clase_idClase = '$idClase'";
		
		$resultado = $this->mysqli->query($sql);
		return $resultado;
	}

	function _deletePartidoEscuela($idClase, $borradoMaxima){
		if(!$borradoMaxima){
			$usuario = mysqli_real_escape_string($this->mysqli, $_SESSION['login']);

			$this->_getClaseLanzadoEscuela($idClase);
			$sql = "SELECT Usuario_login FROM Clase_has_Usuario WHERE Usuario_login = '$usuario' AND Clase_idClase = '$idClase'";
			$resultado = $this->mysqli->query($sql);

			if($resultado->num_rows == 0){
				return 'No estás inscrito en este Partido';
			}else{
				$aux = $this->_updateDelJugadores($idClase);
				if(!$aux){
					return 'Ha fallado la actualización del numero de Jugadores';
				}else{
					$sql = "DELETE FROM Clase_has_Usuario WHERE (Usuario_login = '$usuario' AND Clase_idClase = '$idClase')";
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
			if(esEntrenador()){
				$usuario = mysqli_real_escape_string($this->mysqli, $_SESSION['login']);
				$tipo = $this->_checkTipo($idClase);
				$sql = "SELECT * FROM Clase WHERE (idClase = '$idClase' AND Entrenador_login = '$usuario' AND TIPO = 'PRIVADA')";
				$resultado = $this->mysqli->query($sql);
				if($resultado->fetch_row() == 0){
					return "No puede eliminar una clase pública o de otro entrenador!!!";
				}else{
					$this->_getClaseLanzadoEscuela($idClase);
					$fecha_hora = mysqli_real_escape_string($this->mysqli, $this->Fecha);
					$numPista = mysqli_real_escape_string($this->mysqli, $this->_getPista());
				
					$sql = "UPDATE Pista SET Disponibilidad = 'SI' WHERE (num_Pista = '$numPista' AND `Fecha/Hora` = '$fecha_hora')";
					if(!$this->mysqli->query($sql)){
						return 'Ha fallado la actualización de la disponibilidad de la pista';
					}
				
					$sql = "DELETE FROM Clase_has_Usuario WHERE Clase_idClase = '$idClase'";
					if(!$this->mysqli->query($sql)){
						return 'Ha fallado el borrado de los usuarios de este partido';
					}else{
						$sql = "DELETE FROM Clase WHERE idClase = '$idClase'";
						if(!$this->mysqli->query($sql)){
							return 'Ha fallado el borrado del partido';
						}else{
							return 'Modificado correcto';
						}
					}
				}
			}else{

				$this->_getClaseLanzadoEscuela($idClase);
				$fecha_hora = mysqli_real_escape_string($this->mysqli, $this->Fecha);
				$numPista = mysqli_real_escape_string($this->mysqli, $this->_getPista());
				
					$sql = "UPDATE Pista SET Disponibilidad = 'SI' WHERE (num_Pista = '$numPista' AND `Fecha/Hora` = '$fecha_hora')";
					if(!$this->mysqli->query($sql)){
						return 'Ha fallado la actualización de la disponibilidad de la pista';
					}
				
				$sql = "DELETE FROM Clase_has_Usuario WHERE Clase_idClase = '$idClase'";
				if(!$this->mysqli->query($sql)){
					return 'Ha fallado el borrado de los usuarios de este partido';
				}else{
					$sql = "DELETE FROM Clase WHERE idClase = '$idClase'";
					if(!$this->mysqli->query($sql)){
						return 'Ha fallado el borrado del partido';
					}else{
						return 'Modificado correcto';
					}
				}
			}
		}
	}


	function _searchEscuela(){
		$sql = "SELECT * FROM `Clase` WHERE `idClase` LIKE '%".$this -> idClase."%' or `Fecha` LIKE '%".$this -> Fecha."%' or `Entrenador_login`LIKE '%".$this -> entrenador_login."%'" ;

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


	function _contarJugadores(){
		$idClase = mysqli_real_escape_string($this->mysqli, $idClase);
		$sql = "SELECT count(*) FROM Clase_has_Usuario WHERE Clase_idClase = '$idClase'";
		$toret = $sql->fetch_row();

		return toret;
	}
	

	function _checkTipo($idClase){
		$fecha_hora = mysqli_real_escape_string($this->mysqli, $this->Fecha);
		$sql = "SELECT TIPO FROM Clase WHERE (idClase = '$idClase')";
		$resultado = $this->mysqli->query($sql);
		$fila=$resultado->fetch_row();
		if($fila[0] == "PUBLICA"){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	function _checkDisponibilidadEscuela(){//modificado
		$fecha_hora = mysqli_real_escape_string($this->mysqli, $this->Fecha);
		$numPista = mysqli_real_escape_string($this->mysqli, $this->Pista);

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

	function _insertarClasePrivada(){
		$existe = $this->_checkDisponibilidadEscuela();
		$usuario = mysqli_real_escape_string($this->mysqli, $_SESSION['login']);
		if($existe == "FALSE"){
			return 'Esta clase no existe o no está disponible el horario';
		}
		else{
			$fecha_hora = mysqli_real_escape_string($this->mysqli, $this->Fecha);
			$numPista = mysqli_real_escape_string($this->mysqli, $this->Pista);
			$entrenador = mysqli_real_escape_string($this->mysqli, $this->Entrenador_login);
				
			$sql = "INSERT INTO Clase (Pista, Fecha, Precio, numJugadores, Entrenador_login, TIPO)
VALUES ('$numPista', '$fecha_hora', '50', '0', '$usuario', 'PRIVADA')";
			$respuesta = $this->mysqli->query($sql);
			$upd = $this->_updateDisponibilidadEscuela();
			if(!$respuesta){
				return 'Error al insertar en la base de datos';
			}else{
				return 'Clase promocionada correctamente';
			}
		}
	}
}