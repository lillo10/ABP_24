<?php
/* Clase de modelo de Tabla de Clasificacion, el cual accederá exclusivamente a la base de datos

*/
class TablaClasificacion{
	
	var $idCampeonato;
	var $NombrePareja;

	
	//Atributos
	
	function __construct($idCampeonato, $NombrePareja){
		//Asignaciones
		$this->_setidCampeonato($idCampeonato);
		$this->_setNombrePareja($NombrePareja);
	
		
		include_once '../Functions/AccederBD.php';
		$this->mysqli = ConectarBD();
	}
	
		function _setidCampeonato($idCampeonato){
			$this->idCampeonato = $idCampeonato;
		}
		
		function _setNombrePareja($NombrePareja){
			$this->NombrePareja = $NombrePareja;
		}
		

		function _getidCampeonato(){
			return $this->idCampeonato;
		}
		
		function _getNombrePareja(){
			return $this->NombrePareja;
		}
	
		
	
	function ADD(){//Para añadir a la BD
		if(($this->idCampeonato == '')){
			return 'idCampeonato vacío, introduzca un idCampeonato';
		}else{
			$idCampeonato = mysqli_real_escape_string($this->mysqli, $this->idCampeonato);
			$NombrePareja = mysqli_real_escape_string($this->mysqli, $this->NombrePareja);
			$sql = "SELECT * FROM Tablaclasificacion WHERE idCampeonato = '$idCampeonato' AND NombrePareja = '$NombrePareja'";
			
			$resultado = $this->mysqli->query($sql);
			
			if(!$resultado){
				return 'No se ha podido conectar con la BDghhdgh';
			}else{
				if($resultado->num_rows == 0){
					$sql = "SELECT COUNT(idCampeonato) as num FROM Tablaclasificacion WHERE idCampeonato = '$idCampeonato' AND Grupo = 1;";
					$grupo1 = $this->mysqli->query($sql);
					$data = $grupo1->fetch_row();
					$grupo1 = $data[0]; 

					$sql = "SELECT COUNT(idCampeonato) as num FROM Tablaclasificacion WHERE idCampeonato = '$idCampeonato' AND Grupo = 2;";
					$grupo2 = $this->mysqli->query($sql);
					$data = $grupo2->fetch_row();
					$grupo2 = $data[0]; 

					$grupo=1;

					if ($grupo1 > $grupo2) {
						$grupo = 2;
					}

					
					$sql = "INSERT INTO Tablaclasificacion (NombrePareja, PartidosJugados, PartidosGanados, PartidosPerdidos, PartidosEmpatados, Puntuacion, idCampeonato, Grupo) VALUES ('$NombrePareja',0, 0, 0, 0, 0,'$idCampeonato','$grupo');";
					$respuesta = $this->mysqli->query($sql);

					if (!$respuesta) {
						return false;
					}
					else{
						return true;
					}

					

				}else{
					return 'El idCampeonato introducido ya existe';
				}
			}
		}
	}
	
}
?>