<?php
	
	class Pista{
		var $idPista;
		var $disponibilidad;
		var $fecha;
		var $hora;
		var $fechahora;
		var $mysqli;
		
		function __construct ($idPista, $disponibilidad, $fecha, $hora){
			$this -> idPista = $idPista;
			$this -> disponibilidad = $disponibilidad;
			if($fecha != ""){
				if($hora == ""){
					$f = $fecha;
					$this -> fechahora = DateTime::createFromFormat('Y-m-d', $f);
					$this -> fechahora = $this -> fechahora->format('Y-m-d');
				}else{
					$f = $fecha . " " . $hora;
					$this -> fechahora = DateTime::createFromFormat('Y-m-d H:i', $f);
					$this -> fechahora = $this -> fechahora->format('Y-m-d H:i');
				}
			}else{
				if($hora == ""){
					$f = '';
					$this -> fechahora = $f;
				}else{
					$f = $hora;
					$this -> fechahora = DateTime::createFromFormat('H:i', $f);
					$this -> fechahora = $this -> fechahora->format('H:i');
				}
			}
			
			include_once '../Functions/AccederBD.php';
			$this -> mysqli = ConectarBD();
		}
		
		function ADD(){
			$sql = "SELECT * FROM pista WHERE (idPistas = '".$this -> idPista."' and `Fecha/Hora` = '".$this -> fechahora."')";
			
			$resultado = $this->mysqli->query($sql);
			
			if(!$resultado){
				return "No se ha podido conectar con la DB";
			}else{
				if($resultado->num_rows == 0){
					$sql = "INSERT INTO pista (idPistas, Disponibilidad, `Fecha/Hora`) VALUES ('$this->idPista', '$this->disponibilidad', '$this->fechahora')";
					
					if(!$this->mysqli->query($sql)){
						return "Error en la inserción";
					}else{
						return "Inserción realizada";
					}
				}else{
					return "Ya existe en la base de datos";
				}
			}
		}
		
		function EDIT(){
			$sql = "SELECT * FROM pista WHERE (idPistas = '".$this -> idPista."' and `Fecha/Hora` = '".$this -> fechahora."') ";
			
			$resultado = $this->mysqli->query($sql);
			
			if($resultado->num_rows == 1){
				$sql = "UPDATE pista SET `Disponibilidad` = '".$this -> disponibilidad."' WHERE idPistas = '".$this -> idPista."' and `Fecha/Hora` = '".$this -> fechahora."' ";
				
				$resultado = $this->mysqli->query($sql);
				
				if(!$resultado){
					return "Error en la modificación";
				}else{
					return "Modificado correctamente";
				}
			}else{
				return "La pista no existe";
			}
		}
		
		function DELETE(){
			$sql = "SELECT * FROM pista WHERE (idPistas = '".$this -> idPista."' and `Fecha/Hora` = '".$this -> fechahora."')";
			
			$resultado = $this->mysqli->query($sql);
			
			if($resultado->num_rows == 1){
				$sql = "DELETE FROM pista WHERE (idPistas = '".$this -> idPista."' and `Fecha/Hora` = '".$this -> fechahora."')";
				
				$this->mysqli->query($sql);
				
				return "Borrado realizado";
			}else{
				return "La pista no existe";
			}
		}
		
		function SEARCH(){
			
			$sql = "SELECT * FROM `pista` WHERE `idPistas` LIKE '%".$this -> idPista."%' and `Disponibilidad` LIKE '%".$this -> disponibilidad."%' and `Fecha/Hora` LIKE '%".$this -> fechahora."%'";

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
		
		function SHOWCURRENT(){
			$sql = "SELECT * FROM pista WHERE (idPistas = '".$this -> idPista."' and `Fecha/Hora` = '".$this -> fechahora."')";
			
			$resultado = $this->mysqli->query($sql);
			
			if($resultado->num_rows == 1){
				return $resultado;
			}else{
				return "La pista no existe";
			}
		}
		
		function SHOWALL(){
			
			$sql = "SELECT * FROM `pista` WHERE `idPistas` LIKE '%".$this -> idPista."%' and `Disponibilidad` LIKE '%".$this -> disponibilidad."%' and `Fecha/Hora` LIKE '%".$this -> fechahora."%'";
			
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
	}
?>