<?php
/* Clase de modelo de ENFRENTAMIENTO, el cual accederá exclusivamente a la base de datos

*/
class Enfrentamiento{
	
	var $Fecha;
	var $Grupo;
	var $Pareja1;
	var $Pareja2;
	var $Resultado;
	var $idCampeonato;
	

	function __construct($Fecha, $Grupo, $Pareja1, $Pareja2, $Resultado,$idCampeonato){
		//Asignaciones
		$this->_setFecha($Fecha);
		$this->_setGrupo($Grupo);
		$this->_setPareja1($Pareja1);
		$this->_setPareja2($Pareja2);
		$this->_setResultado($Resultado);
		$this->_setidCampeonato($idCampeonato);
		
		include_once '../Functions/AccederBD.php';
		$this->mysqli = ConectarBD();
	}
	
		function _setFecha($Fecha){
			$this->Fecha = $Fecha;
		}
		
		function _setGrupo($Grupo){
			$this->Grupo = $Grupo;
		}
		
		function _setPareja1($Pareja1){
			$this->Pareja1 = $Pareja1;
		}
		
		function _setPareja2($Pareja2){
			$this->Pareja2 = $Pareja2;
		}
		
		function _setResultado($Resultado){
			$this->Resultado = $Resultado;
		}

		function _setidCampeonato($idCampeonato){
			$this->idCampeonato = $idCampeonato;
		}
		
		
		
		function _getFecha(){
			return $this->Fecha;
		}
		
		function _getGrupo(){
			return $this->Grupo;
		}
		
		function _getPareja1(){
			return $this->Pareja1;
		}
		
		function _getPareja2(){
			return $this->Pareja2;
		}
		
		function _getResultado(){
			return $this->Resultado;
		}
		function _getidCampeonato(){
			return $this->idCampeonato;
		}
		
		
		function _getDatosGuardados(){//Para recuperar de la base de datos
			if(($this->idCampeonato == '' || $this->Pareja1 == '' || $this->Pareja2 == '')){
				return 'Clave primaria vacía';
			}else{
				$idCampeonato = mysqli_real_escape_string($this->mysqli, $this->idCampeonato);
				$Pareja1 = mysqli_real_escape_string($this->mysqli, $this->Pareja1);
				$Pareja2 = mysqli_real_escape_string($this->mysqli, $this->Pareja2);
				$sql = "SELECT * FROM Enfrentamiento WHERE idCampeonato = '$idCampeonato' AND Pareja1 = '$Pareja1' AND Pareja2 = '$Pareja2' ";
				
				$resultado = $this->mysqli->query($sql);
				
				if(!$resultado){
					return 'No se ha podido conectar con la BD';
				}else if($resultado->num_rows == 0){
					return 'No existe el enfrentamiento';
				}else{
					$fila = $resultado->fetch_row();
					
					$this->_setFecha($fila[0]);
					$this->_setGrupo($fila[1]);
					$this->_setResultado($fila[4]);
					
				}
			}
		}
		
	
	
	function EDIT(){//Para editar de la BD
		if(($this->idCampeonato == '' || $this->Pareja1 == '' || $this->Pareja2 == '')){
			return 'Clave primaria vacía';
		}else{
			$idCampeonato = mysqli_real_escape_string($this->mysqli, $this->idCampeonato);
			$Pareja1 = mysqli_real_escape_string($this->mysqli, $this->Pareja1);
			$Pareja2 = mysqli_real_escape_string($this->mysqli, $this->Pareja2);
			$sql = "SELECT * FROM Enfrentamiento WHERE idCampeonato = '$idCampeonato' AND Pareja1 = '$Pareja1' AND Pareja2 = '$Pareja2' ";
				
			$resultado = $this->mysqli->query($sql);
			
			if(!$resultado){
				return 'No se ha podido conectar con la BD';
			}else if($resultado->num_rows == 1){				
				$Fecha = mysqli_real_escape_string($this->mysqli, $this->Fecha);
				$Grupo = mysqli_real_escape_string($this->mysqli, $this->Grupo);
				$Resultado = mysqli_real_escape_string($this->mysqli, $this->Resultado);
				
				$sql = "UPDATE Enfrentamiento SET Fecha = '$Fecha', Grupo = '$Grupo', Resultado1 = '$Resultado' WHERE idCampeonato = '$idCampeonato' AND Pareja1 = '$Pareja1' AND Pareja2 = '$Pareja2'";
				
				if(!$this->mysqli->query($sql)){
					return 'Ha fallado la actualización del Enfrentamiento';
				}
				//Partidos jugados Pareja 1
				$sql = "SELECT PartidosJugados FROM Tablaclasificacion WHERE idCampeonato = '$idCampeonato' AND NombrePareja = '$Pareja1';";
				$pj1 = $this->mysqli->query($sql);
				$data = $pj1->fetch_row();
				$pj1 = $data[0]+1;
				//Partidos jugados Pareja 2
				$sql = "SELECT PartidosJugados FROM Tablaclasificacion WHERE idCampeonato = '$idCampeonato' AND NombrePareja = '$Pareja2';";
				$pj2 = $this->mysqli->query($sql);
				$data = $pj2->fetch_row();
				$pj2 = $data[0]+1;
				//Puntuacion Pareja 1
				$sql = "SELECT Puntuacion FROM Tablaclasificacion WHERE idCampeonato = '$idCampeonato' AND NombrePareja = '$Pareja1';";
				$pu1 = $this->mysqli->query($sql);
				$data = $pu1->fetch_row();
				$pu1 = $data[0];
				//Puntuacion Pareja 2
				$sql = "SELECT Puntuacion FROM Tablaclasificacion WHERE idCampeonato = '$idCampeonato' AND NombrePareja = '$Pareja2';";
				$pu2 = $this->mysqli->query($sql);
				$data = $pu2->fetch_row();
				$pu2 = $data[0];
				//Partidos ganados Pareja 1
				$sql = "SELECT PartidosGanados FROM Tablaclasificacion WHERE idCampeonato = '$idCampeonato' AND NombrePareja = '$Pareja1';";
				$pg1 = $this->mysqli->query($sql);
				$data = $pg1->fetch_row();
				$pg1 = $data[0];
				//Partidos ganados Pareja 2
				$sql = "SELECT PartidosGanados FROM Tablaclasificacion WHERE idCampeonato = '$idCampeonato' AND NombrePareja = '$Pareja2';";
				$pg2 = $this->mysqli->query($sql);
				$data = $pg2->fetch_row();
				$pg2 = $data[0];
				//Partidos perdidos Pareja 1
				$sql = "SELECT PartidosPerdidos FROM Tablaclasificacion WHERE idCampeonato = '$idCampeonato' AND NombrePareja = '$Pareja1';";
				$pp1 = $this->mysqli->query($sql);
				$data = $pp1->fetch_row();
				$pp1 = $data[0];
				//Partidos perdidos Pareja 2
				$sql = "SELECT PartidosPerdidos FROM Tablaclasificacion WHERE idCampeonato = '$idCampeonato' AND NombrePareja = '$Pareja2';";
				$pp2 = $this->mysqli->query($sql);
				$data = $pp2->fetch_row();
				$pp2 = $data[0];
				//Partidos empatados Pareja 1
				$sql = "SELECT PartidosEmpatados FROM Tablaclasificacion WHERE idCampeonato = '$idCampeonato' AND NombrePareja = '$Pareja1';";
				$pe1 = $this->mysqli->query($sql);
				$data = $pe1->fetch_row();
				$pe1 = $data[0];
				//Partidos empatados Pareja 2
				$sql = "SELECT PartidosEmpatados FROM Tablaclasificacion WHERE idCampeonato = '$idCampeonato' AND NombrePareja = '$Pareja2';";
				$pe2 = $this->mysqli->query($sql);
				$data = $pe2->fetch_row();
				$pe2 = $data[0];


				if ($Resultado == 1) {
					$pg1=$pg1+1;
					$pu1=$pu1+3;
					$pp2=$pp2+1;
					//Actualizamos clasificacion Pareja 1
					$sql = "UPDATE Tablaclasificacion SET PartidosJugados = '$pj1', PartidosGanados = '$pg1' , Puntuacion = '$pu1' WHERE idCampeonato = '$idCampeonato' AND NombrePareja = '$Pareja1'";

					$this->mysqli->query($sql);

					//Actualizamos clasificacion Pareja 2
					$sql = "UPDATE Tablaclasificacion SET PartidosJugados = '$pj2' , PartidosPerdidos = '$pp2' WHERE idCampeonato = '$idCampeonato' AND NombrePareja = '$Pareja2'";

					$this->mysqli->query($sql);
				}

				if($Resultado == 2) {
					$pg2=$pg2+1;
					$pu2=$pu2+3;
					$pp1=$pp1+1;
					//Actualizamos clasificacion Pareja 1
					$sql = "UPDATE Tablaclasificacion SET PartidosJugados = '$pj1' , PartidosPerdidos = '$pp1' WHERE idCampeonato = '$idCampeonato' AND NombrePareja = '$Pareja1'";

					$this->mysqli->query($sql);

					//Actualizamos clasificacion Pareja 2
					$sql = "UPDATE Tablaclasificacion SET PartidosJugados = '$pj2' , PartidosGanados = '$pg2' , Puntuacion = '$pu2' WHERE idCampeonato = '$idCampeonato' AND NombrePareja = '$Pareja2'";

					$this->mysqli->query($sql);
				}

				if($Resultado == 'X') {
					$pe2=$pe2+1;
					$pu1=$pu1+1;
					$pu2=$pu2+1;
					$pe1=$pe1+1;
					//Actualizamos clasificacion Pareja 1
					$sql = "UPDATE Tablaclasificacion SET PartidosJugados = '$pj1' , PartidosEmpatados = '$pe1' , Puntuacion = '$pu1' WHERE idCampeonato = '$idCampeonato' AND NombrePareja = '$Pareja1'";

					$this->mysqli->query($sql);

					//Actualizamos clasificacion Pareja 2
					$sql = "UPDATE Tablaclasificacion SET PartidosJugados = '$pj2' , PartidosEmpatados = '$pe2' , Puntuacion = '$pu2' WHERE idCampeonato = '$idCampeonato' AND NombrePareja = '$Pareja2'";

					$this->mysqli->query($sql);
				}

				return 'Enfrentamiento y clasificacion actualizados con exito';


			}

			else{
				return 'Login no existe en la base de datos';
			}
		}
	}
	
}
?>