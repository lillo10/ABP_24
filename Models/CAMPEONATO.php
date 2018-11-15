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
			$sql = "SELECT * FROM Campeonato WHERE idCampeonato = '$idCampeonato'";
			
			$resultado = $this->mysqli->query($sql);
			
			if(!$resultado){
				return 'No se ha podido conectar con la BD';
			}else{
				if($resultado->num_rows == 0){
					$Periodo = mysqli_real_escape_string($this->mysqli, $this->Periodo);
					$LimInscrip = mysqli_real_escape_string($this->mysqli, $this->LimInscrip);
					$Categoria = mysqli_real_escape_string($this->mysqli, $this->Categoria);
					$Sexo = mysqli_real_escape_string($this->mysqli, $this->Sexo);
					
					$sql = "INSERT INTO Campeonato (idCampeonato, Periodo, LimInscrip, Categoria, Sexo) VALUES ('$idCampeonato', '$Periodo', '$LimInscrip', '$Categoria', '$Sexo');";
				
					if(!$this->mysqli->query($sql)){
						return 'Ha fallado el insertar al usuario';
					}

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
		
		$sql = "SELECT * FROM Campeonato WHERE idCampeonato = '$idCampeonato'";
		
		$resultado = $this->mysqli->query($sql);
		
		if(!$resultado){
			return 'No se ha podido conectar con la BD';
		}else if($resultado->num_rows == 0){
			return 'No existe el idCampeonato';
		}else{
			return $resultado;
		}
	}
	
	function SHOWALL(){//Para mostrar la BD
		$sql = "SELECT * FROM Campeonato";
	
		$resultado = $this->mysqli->query($sql);
		
		if(!$resultado){
			return 'No se ha podido conectar con la BD';
		}
		
		return $resultado;
	}
	
}
?>