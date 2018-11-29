<?php
	
	class Pista{
		var $idPista;
		var $numPista;
		var $disponibilidad;
		var $fecha;
		var $hora;
		var $fechahora;
		var $precio;
		var $mysqli;
		
		function __construct ($idPista, $numPista, $disponibilidad, $fecha, $hora, $precio){
			$this -> idPista = $idPista;
			$this -> numPista = $numPista;
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
			$this -> precio = $precio;
			
			include_once '../Functions/AccederBD.php';
			$this -> mysqli = ConectarBD();
		}
		
		function rellenaDatos(){
			$sql = "SELECT * FROM pista WHERE (idPistas = '".$this -> idPista."')";
			
			$resultado = $this->mysqli->query($sql);
			
			if(!$resultado){
				return "No se ha podido conectar con la DB";
			}else{
				return $resultado -> fetch_array();
			}
		}
		
		function ADD(){
			$sql = "SELECT * FROM Pista WHERE num_Pista = '".$this -> numPista."' and `Fecha/Hora` = '".$this -> fechahora."'";
			
			$resultado = $this->mysqli->query($sql);
			
			if(!$resultado){
				return "No se ha podido conectar con la DB";
			}else{
				if($resultado->num_rows == 0){
					$sql = "INSERT INTO Pista (idPistas, num_Pista, Disponibilidad, `Fecha/Hora`, Precio) VALUES ('$this->idPista', '$this->numPista', '$this->disponibilidad', '$this->fechahora', '$this->precio')";
					
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
			$sql = "SELECT * FROM pista WHERE (idPistas = '".$this -> idPista."') ";

			$resultado = $this->mysqli->query($sql);
			
			if($resultado->num_rows == 1){
				
				$sql = "SELECT * FROM Pista WHERE num_Pista = '".$this -> numPista."' and `Fecha/Hora` = '".$this -> fechahora."'";
			
				$resultado = $this->mysqli->query($sql);
				
				if(!$resultado){
					return "No se ha podido conectar con la DB";
				}else{
					if($resultado->num_rows == 0){
						$sql = "UPDATE Pista SET `num_Pista` = '".$this -> numPista."', `Disponibilidad` = '".$this -> disponibilidad."', `Fecha/Hora` = '".$this -> fechahora."', `Precio` = '".$this -> precio."' WHERE idPistas = '".$this -> idPista."' ";
				
						$resultado = $this->mysqli->query($sql);
				
						if(!$resultado){
							return "Error en la modificación";
						}else{
							return "Modificado correctamente";
						}
					}else{
						return "Ya existe en la base de datos";
					}
				}
			}else{
				return "La pista no existe";
			}
		}
		
		function DELETE(){
			$sql = "SELECT * FROM Pista WHERE (idPistas = '".$this -> idPista."')";

			$resultado = $this->mysqli->query($sql);
			
			if($resultado->num_rows == 1){
				$sql = "DELETE FROM pista WHERE (idPistas = '".$this -> idPista."')";
				
				$this->mysqli->query($sql);
				
				return "Borrado realizado";
			}else{
				return "La pista no existe";
			}
		}
		
		function SEARCH(){
			
			$sql = "SELECT * FROM Pista WHERE `idPistas` LIKE '%".$this -> idPista."%' and `num_Pista` LIKE '%".$this -> numPista."%' and `Disponibilidad` LIKE '%".$this -> disponibilidad."%' and `Fecha/Hora` LIKE '%".$this -> fechahora."%' and `Precio` LIKE '%".$this -> precio."%'";
			
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
			$sql = "SELECT * FROM Pista WHERE (idPistas = '".$this -> idPista."')";
			
			$resultado = $this->mysqli->query($sql);
			
			if($resultado->num_rows == 1){
				return $resultado;
			}else{
				return "La pista no existe";
			}
		}
		
		function SHOWALL(){
			
			$sql = "SELECT * FROM Pista WHERE `idPistas` LIKE '%".$this -> idPista."%' and `num_Pista` LIKE '%".$this -> numPista."%' and `Disponibilidad` LIKE '%".$this -> disponibilidad."%' and `Fecha/Hora` LIKE '%".$this -> fechahora."%' and `Precio` LIKE '%".$this -> precio."%'";
			
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
		
		function SEARCH_RESERVA(){
			$sql = "SELECT * FROM Pista WHERE `Fecha/Hora` LIKE '%".$this -> fechahora."%' and Disponibilidad = 'SI' ";
			
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
		
		function SHOWPISTAS(){
			$sql = "SELECT * FROM Pista WHERE `Disponibilidad` = 'SI'";
			
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
		
		/*function buscarPista($fecha){
			$sql = "SELECT idPistas FROM `pista` WHERE `num_Pista` = '".$this -> numPista."' and  `Fecha/Hora` LIKE '%".$fecha."%' ";
			echo $sql;
			$resultado = $this->mysqli->query($sql);
			
			if(!$resultado || $resultado->num_rows == 0){
				return 'No se ha encontrado ningun dato';
			}
			if(!$resultado){
				return "No se ha podido conectar con la DB";
			}else{
				return $resultado->fetch_row()[0];
			}
		}*/
		
		function pistaOcupada(){
			$sql = "UPDATE Pista SET `Disponibilidad` = 'NO' WHERE idPistas = '".$this -> idPista."' ";
			
			$resultado = $this->mysqli->query($sql);
			
			if(!$resultado){
					return "Error en la modificación";
				}else{
					return "Modificado correctamente";
				}
		}
		
		function pistaLibre(){
			$sql = "UPDATE Pista SET `Disponibilidad` = 'SI' WHERE idPistas = '".$this -> idPista."' ";
			
			$resultado = $this->mysqli->query($sql);
			
			if(!$resultado){
					return "Error en la modificación";
				}else{
					return "Modificado correctamente";
				}
		}
				
		
	}
?>