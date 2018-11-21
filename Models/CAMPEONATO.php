<?php
/* Clase de modelo de CAMPEONATO, el cual accederá exclusivamente a la base de datos

*/
class Campeonato{
	
	var $idCampeonato;
	var $Periodo;
	var $LimInscrip;
	var $Categoria;
	var $Sexo;
	
	//Atributos
	
	function __construct($idCampeonato, $Periodo, $LimInscrip, $Categoria, $Sexo){
		//Asignaciones
		$this->_setidCampeonato($idCampeonato);
		$this->_setPeriodo($Periodo);
		$this->_setLimInscrip($LimInscrip);
		$this->_setCategoria($Categoria);
		$this->_setSexo($Sexo);
		
		include_once '../Functions/AccederBD.php';
		$this->mysqli = ConectarBD();
	}
	
		function _setidCampeonato($idCampeonato){
			$this->idCampeonato = $idCampeonato;
		}
		
		function _setPeriodo($Periodo){
			$this->Periodo = $Periodo;
		}
		
		function _setLimInscrip($LimInscrip){
			$this->LimInscrip = $LimInscrip;
		}
		
		function _setCategoria($Categoria){
			$this->Categoria = $Categoria;
		}
		
		function _setSexo($Sexo){
			$this->Sexo = $Sexo;
		}
		
		
		
		function _getidCampeonato(){
			return $this->idCampeonato;
		}
		
		function _getPeriodo(){
			return $this->Periodo;
		}
		
		function _getLimInscrip(){
			return $this->LimInscrip;
		}
		
		function _getCategoria(){
			return $this->Categoria;
		}
		
		function _getSexo(){
			return $this->Sexo;
		}
		
		
		
		function _getDatosGuardados(){//Para recuperar de la base de datos
			if(($this->idCampeonato == '')){
				return 'idCampeonato vacío, introduzca un idCampeonato';
			}else{
				$idCampeonato = mysqli_real_escape_string($this->mysqli, $this->idCampeonato);
				$sql = "SELECT * FROM Campeonato WHERE idCampeonato = '$idCampeonato'";
				
				$resultado = $this->mysqli->query($sql);
				
				if(!$resultado){
					return 'No se ha podido conectar con la BD';
				}else if($resultado->num_rows == 0){
					return 'No existe el idCampeonato';
				}else{
					$fila = $resultado->fetch_row();
					
					$this->_setPeriodo($fila[1]);
					$this->_setLimInscrip($fila[2]);
					$this->_setCategoria($fila[3]);
					$this->_setSexo($fila[4]);
					
				}
			}
		}
		
	
	function ADD(){//Para añadir a la BD
		if(($this->idCampeonato == '')){
			return 'idCampeonato vacío, introduzca un idCampeonato';
		}else{
			$idCampeonato = mysqli_real_escape_string($this->mysqli, $this->idCampeonato);
			$sql = "SELECT * FROM Campeonato WHERE idCampeonato LIKE '$idCampeonato'";
			
			$resultado = $this->mysqli->query($sql);
			
			if(!$resultado){
				return 'No se ha podido conectar con la BD';
			}else{
				if($resultado->num_rows == 0){
					//Strings para idCampeonato depende de la categoría y sexo
					//Masculino
					$ma1 = "MA1";
					$ma2 = "MA2";
					$ma3 = "MA3";
					//Femenino
					$f1 = "F1";
					$f2 = "F2";
					$f3 = "F3";
					//Mixto
					$mi1 = "MI1";
					$mi2 = "MI2";
					$mi3 = "MI3";

					$cma1 = $idCampeonato.$ma1;
					$cma2 = $idCampeonato.$ma2;
					$cma3 = $idCampeonato.$ma3;
					$cf1 = $idCampeonato.$f1;
					$cf2 = $idCampeonato.$f2;
					$cf3 = $idCampeonato.$f3;
					$cmi1 = $idCampeonato.$mi1;
					$cmi2 = $idCampeonato.$mi2;
					$cmi3 = $idCampeonato.$mi3;

					$Periodo = mysqli_real_escape_string($this->mysqli, $this->Periodo);
					$LimInscrip = mysqli_real_escape_string($this->mysqli, $this->LimInscrip);
					
					
					$sql = "INSERT INTO Campeonato (idCampeonato, Periodo, LimInscrip, Categoria, Sexo) VALUES ('$cma1', '$Periodo', '$LimInscrip', '1', 'Masculino');";
					$this->mysqli->query($sql);

					$sql = "INSERT INTO Campeonato (idCampeonato, Periodo, LimInscrip, Categoria, Sexo) VALUES ('$cma2', '$Periodo', '$LimInscrip', '2', 'Masculino');";
					$this->mysqli->query($sql);
					
					$sql = "INSERT INTO Campeonato (idCampeonato, Periodo, LimInscrip, Categoria, Sexo) VALUES ('$cma3', '$Periodo', '$LimInscrip', '3', 'Masculino');";
					$this->mysqli->query($sql);
					
					$sql = "INSERT INTO Campeonato (idCampeonato, Periodo, LimInscrip, Categoria, Sexo) VALUES ('$cf1', '$Periodo', '$LimInscrip', '1', 'Femenino');";
					$this->mysqli->query($sql);
					
					$sql = "INSERT INTO Campeonato (idCampeonato, Periodo, LimInscrip, Categoria, Sexo) VALUES ('$cf2', '$Periodo', '$LimInscrip', '2', 'Femenino');";
					$this->mysqli->query($sql);
					
					$sql = "INSERT INTO Campeonato (idCampeonato, Periodo, LimInscrip, Categoria, Sexo) VALUES ('$cf3', '$Periodo', '$LimInscrip', '3', 'Femenino');";
					$this->mysqli->query($sql);
					
					$sql = "INSERT INTO Campeonato (idCampeonato, Periodo, LimInscrip, Categoria, Sexo) VALUES ('$cmi1', '$Periodo', '$LimInscrip', '1', 'Mixto');";
					$this->mysqli->query($sql);
					
					$sql = "INSERT INTO Campeonato (idCampeonato, Periodo, LimInscrip, Categoria, Sexo) VALUES ('$cmi2', '$Periodo', '$LimInscrip', '2', 'Mixto');";
					$this->mysqli->query($sql);
					
					$sql = "INSERT INTO Campeonato (idCampeonato, Periodo, LimInscrip, Categoria, Sexo) VALUES ('$cmi3', '$Periodo', '$LimInscrip', '3', 'Mixto');";
					$this->mysqli->query($sql);
						
					return 'Campeonato añadido';

				}else{
					return 'El idCampeonato introducido ya existe';
				}
			}
		}
	}
	
	function EDIT(){//Para editar de la BD
		if(($this->idCampeonato == '')){
			return 'idCampeonato vacío, introduzca un idCampeonato';
		}else{
			$idCampeonato = mysqli_real_escape_string($this->mysqli, $this->idCampeonato);
			$sql = "SELECT * FROM Campeonato WHERE idCampeonato = '$idCampeonato'";
			
			$resultado = $this->mysqli->query($sql);
			
			if(!$resultado){
				return 'No se ha podido conectar con la BD';
			}else if($resultado->num_rows == 1){				
				$Periodo = mysqli_real_escape_string($this->mysqli, $this->Periodo);
				$LimInscrip = mysqli_real_escape_string($this->mysqli, $this->LimInscrip);
				$Categoria = mysqli_real_escape_string($this->mysqli, $this->Categoria);
				$Sexo = mysqli_real_escape_string($this->mysqli, $this->Sexo);
				
				$sql = "UPDATE Campeonato SET Periodo = '$Periodo', LimInscrip = '$LimInscrip', Categoria = '$Categoria', Sexo = '$Sexo' WHERE idCampeonato = '$idCampeonato'";
				
				if(!$this->mysqli->query($sql)){
					return 'Ha fallado la actualización del Campeonato';
				}else{
					return 'Modificado correcto';
				}
			}else{
				return 'Login no existe en la base de datos';
			}
		}
	}
	
	
	function DELETE(){//Para eliminar de la BD
		$idCampeonato = mysqli_real_escape_string($this->mysqli, $this->idCampeonato);			
		
		$sql = "SELECT * FROM Campeonato WHERE idCampeonato = '$idCampeonato'";
		
		$resultado = $this->mysqli->query($sql);
		
		if(!$resultado){
			return 'No se ha podido conectar con la BD';
		}else if($resultado->num_rows == 0){
			return 'No se ha encontrado al Campeonato';
		}else{
			$sql = "DELETE FROM Campeonato WHERE idCampeonato = '$idCampeonato'";
			
			if(!$this->mysqli->query($sql)){
				return 'Fallo al eliminar al Campeonato';
			}			
			else{
				return 'Campeonato eliminado correctamente';
			}
		}
	}
	
	function SHOWCURRENT(){//Para mostrar de la base de datos
		$idCampeonato = mysqli_real_escape_string($this->mysqli, $this->idCampeonato);	
		
		//Tabla clasificacion grupo 1
		$sql = "SELECT * FROM Tablaclasificacion WHERE idCampeonato = '$idCampeonato' AND Grupo = 1 ORDER BY Puntuacion DESC";
		$clasg1 = $this->mysqli->query($sql);

		//Tabla clasificacion grupo 2
		$sql = "SELECT * FROM Tablaclasificacion WHERE idCampeonato = '$idCampeonato' AND Grupo = 2 ORDER BY Puntuacion DESC";
		$clasg2 = $this->mysqli->query($sql);

		//Enfrentamientos grupo 1
		$sql = "SELECT * FROM Enfrentamiento WHERE idCampeonato = '$idCampeonato' AND Grupo = 1";
		$enfg1 = $this->mysqli->query($sql);

		//Enfrentamientos grupo 2
		$sql = "SELECT * FROM Enfrentamiento WHERE idCampeonato = '$idCampeonato' AND Grupo = 2";
		$enfg2 = $this->mysqli->query($sql);

		return array ($clasg1, $clasg2, $enfg1, $enfg2);
		
	
	}
	
	function SHOWALL(){//Para mostrar la BD
		$sql = "SELECT * FROM Campeonato";
	
		$resultado = $this->mysqli->query($sql);
		
		if(!$resultado){
			return 'No se ha podido conectar con la BD';
		}
		
		return $resultado;
	}

	function INSCRIBIRSE(){
		$idCampeonato = mysqli_real_escape_string($this->mysqli, $this->idCampeonato);
		$login = $_SESSION['login'];
		$sql = "INSERT INTO campeonatousuario (idCampeonato, login) VALUES ('$idCampeonato', '$login');";
	
		$resultado = $this->mysqli->query($sql);
		
		if(!$resultado){
			return 'No se ha podido conectar con la BD';
		}
		
		return 'Inscripcion realizada correctamente';
	}
	
	function GENPARTIDOS(){
		$idCampeonato = mysqli_real_escape_string($this->mysqli, $this->idCampeonato);
		//Parejas grupo 1
		$sql = "SELECT NombrePareja FROM Tablaclasificacion WHERE Grupo = 1 AND idCampeonato = '$idCampeonato';";
		$resultado = $this->mysqli->query($sql);
		$grupo1;
		$i=0;
		while($fila = $resultado->fetch_row()){
			$grupo1[$i] = $fila[0];
			$i++; 
		}
		//Parejas grupo 2
		$sql = "SELECT NombrePareja FROM Tablaclasificacion WHERE Grupo = 2 AND idCampeonato = '$idCampeonato';";
		$resultado = $this->mysqli->query($sql);
		$grupo2;
		$i=0;
		while($fila = $resultado->fetch_row()){
			$grupo2[$i] = $fila[0];
			$i++; 
		}

		//Generar enfrentamientos grupo 1
		$longitud = count($grupo1);
		for ($i=0; $i <($longitud-1) ; $i++) { 
			for ($j=($i+1); $j <$longitud ; $j++) {
				$pareja1 = $grupo1[$i];
				$pareja2 = $grupo1[$j]; 
				$sql = "INSERT INTO Enfrentamiento (Fecha, Grupo, Pareja1, Pareja2, Resultado1, idCampeonato) VALUES (' ', 1, '$pareja1', '$pareja2', '','$idCampeonato');";
				$this->mysqli->query($sql); 
			}
		}

		//Generar enfentamientos grupo 2
		$longitud = count($grupo2);
		for ($i=0; $i <($longitud-1) ; $i++) { 
			for ($j=($i+1); $j <$longitud ; $j++) {
				$pareja1 = $grupo2[$i];
				$pareja2 = $grupo2[$j]; 
				$sql = "INSERT INTO Enfrentamiento (Fecha, Grupo, Pareja1, Pareja2, Resultado1, idCampeonato) VALUES (' ', 2, '$pareja1', '$pareja2', '','$idCampeonato');";
				$this->mysqli->query($sql); 
			}
		}
		
		return 'Enfrentamientos generados correctamente';
	}
}
?>