<?php
	
	class Reserva{
		var $idReserva;
		var $login;
		var $idPista;
		var $mysqli;
		
		function generarCodigo(){
			$sql = "SELECT max(idReserva) FROM Reserva ";
			
			$resultado = $this->mysqli->query($sql);
		
			$num = $resultado->fetch_row()[0];
			
			$this->idReserva= ($num+1);
		}
		
		function __construct ($idReserva, $login, $idPista){
			include_once '../Functions/AccederBD.php';
			$this -> mysqli = ConectarBD();
			
			if($idReserva == '*'){
				$this -> generarCodigo();
			}else{
				$this -> idReserva = $idReserva;
			}
			
			$this -> login = $login;
			$this -> idPista = $idPista;
		}
		
		function RESERVAR(){
			
			$contar = "SELECT COUNT(*) FROM Reserva";
			
			$resultado_contar = $this->mysqli->query($contar);
			$reservas = intval($resultado_contar->fetch_row()[0]+1);
			if($reservas < 6){
			
				$sql = "SELECT * FROM Reserva WHERE (idReserva = '".$this -> idReserva."' )";
				
				$resultado = $this->mysqli->query($sql);
				
				if(!$resultado){
					return "No se ha podido conectar con la DB";
				}else{
					if($resultado->num_rows == 0){
						$sql = "INSERT INTO Reserva (idReserva, Deportista_login, Pista_idPistas) VALUES ('$this->idReserva', '$this->login', '$this->idPista')";
						
						if(!$this->mysqli->query($sql)){
							return "Error al realizar la reserva";
						}else{
							return "Reserva realizada";
						}
					}else{
						return "Ya existe en la base de datos";
					}
				}
			}else{
				return "No se pueden reservar más de 5 pistas";
			}
		}
		
		
		function DELETE(){
			$sql = "SELECT * FROM Reserva WHERE (idReserva = '".$this -> idReserva."')";
			
			$resultado = $this->mysqli->query($sql);
			
			if($resultado->num_rows == 1){
				$sql = "DELETE FROM Reserva WHERE (idReserva = '".$this -> idReserva."')";
				
				$this->mysqli->query($sql);
				
				return "Reserva cancelada";
			}else{
				return "La reserva no existe";
			}
		}
		
		function SEARCH(){
			
			$sql = "SELECT * FROM Reserva WHERE `idReserva` = '".$this -> idReserva."' ";
		
			$resultado = $this->mysqli->query($sql);
			
			if(!$resultado || $resultado->num_rows == 0){
				return 'No se ha encontrado ningun dato';
			}
			if(!$resultado){
				return "No se ha podido conectar con la DB";
			}else{
				return $resultado->fetch_row();
			}
		}
		/*
		function SHOWCURRENT(){
			$sql = "SELECT * FROM pista WHERE (idPistas = '".$this -> idPista."' and `Fecha/Hora` = '".$this -> fechahora."')";
			
			$resultado = $this->mysqli->query($sql);
			
			if($resultado->num_rows == 1){
				return $resultado;
			}else{
				return "La pista no existe";
			}
		}*/
		
		function SHOWALL(){
			if(esAdmin()){
				$sql2 = "SELECT * FROM Reserva ";
				
				$resultado2 = $this->mysqli->query($sql2);
				
				if(!$resultado2 || $resultado2->num_rows == 0){
					return 'No se ha encontrado ningun dato';
				}
				if(!$resultado2){
					return "No se ha podido conectar con la DB";
				}else{
					return $resultado2;
				}
			}else{
				$sql2 = "SELECT * FROM Reserva WHERE  `Deportista_login` = '".$_SESSION['login']."' ";
				
				$resultado2 = $this->mysqli->query($sql2);
				
				if(!$resultado2 || $resultado2->num_rows == 0){
					return 'No se ha encontrado ningun dato';
				}
				if(!$resultado2){
					return "No se ha podido conectar con la DB";
				}else{
					return $resultado2;
				}
			}
			
		}
			
		function borrarReservaDePista(){
			$sql = "SELECT * FROM Reserva WHERE (Pista_idPistas = '".$this -> idPista."')";
			
			$resultado = $this->mysqli->query($sql);
			
			if($resultado->num_rows > 0){
				$sql = "DELETE FROM Reserva WHERE (Pista_idPistas = '".$this -> idPista."')";
				
				$this->mysqli->query($sql);
				
				return "Borrado realizado";
			}else{
				return "La pista no existe";
			}
		}
		
		/**function SHOWPISTAS(){
			$sql = "SELECT * FROM `pista` WHERE `Disponibilidad` = 'SI'";
			
			$resultado = $this->mysqli->query($sql);
			
			if(!$resultado || $resultado->num_rows == 0){
				return 'No se ha encontrado ningun dato';
			}
			if(!$resultado){
				return "No se ha podido conectar con la DB";
			}else{
				return $resultado;
			}
		}*/
	}
	
?>