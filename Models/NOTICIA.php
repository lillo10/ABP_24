<?php
	
	class Noticia{
		
		var $idNoticia;
		var $asunto;
		var $mensaje;
		var $fecha;
		
		function __construct($idNoticia, $asunto, $mensaje, $fecha){
			$this -> idNoticia = $idNoticia;
			$this -> asunto = $asunto;
			$this -> mensaje = $mensaje;
			$this -> fecha = $fecha;
			
			include_once '../Functions/AccederBD.php';
			$this -> mysqli = ConectarBD();
		}
		
		function rellenaDatos(){
			$sql = "SELECT * FROM Noticia WHERE (idNoticia = '".$this -> idNoticia."')";
			
			$resultado = $this->mysqli->query($sql);
			
			if(!$resultado){
				return "No se ha podido conectar con la DB";
			}else{
				return $resultado -> fetch_array();
			}
		}
		
		function ADD(){
			$sql = "SELECT * FROM Noticia WHERE idNoticia = '".$this -> idNoticia."' ";
			
			$resultado = $this->mysqli->query($sql);
			
			if(!$resultado){
				return "No se ha podido conectar con la DB";
			}else{
				if($resultado->num_rows == 0){
					$sql = "INSERT INTO Noticia (idNoticia, asunto, mensaje, fecha) VALUES ('$this->idNoticia', '$this->asunto', '$this->mensaje', '$this->fecha' )";
					
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
		
		function obtenerEmail(){
			
			//$sql = "SELECT Email FROM Usuarios u, CampeonatoUsuario c WHERE u.login = c.login and c.idCampeonato='CMP1MA1'";
			$sql = "SELECT Email FROM Usuarios ";
			
			$resultado = $this->mysqli->query($sql);
			
			if(!$resultado){
				return "No se ha podido conectar con la DB";
			}else{
				while($fila=$resultado->fetch_row()){
					$this -> enviarEmail($fila[0]);
				}
				return "Mensajes enviados";
			}
			
		}
		
		function enviarEmail($para){
			//$para      = 'nobody@example.com';
			$titulo = $this -> asunto;
			$contenido = $this -> mensaje;
			$cabeceras = 'From: padelweb@gmail.com' . "\r\n" .
				'Reply-To: padelweb@gmail' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
			
			mail($para, $titulo, $contenido, $cabeceras);
		}
		
		function EDIT(){
			$sql =  "SELECT * FROM Noticia WHERE (idNoticia = '".$this -> idNoticia."')";
			
			$resultado = $this->mysqli->query($sql);
			
			if($resultado->num_rows == 1){
				$sql = "UPDATE Noticia SET asunto = '".$this -> asunto."', mensaje = '".$this -> mensaje."', fecha = '".$this -> fecha."' WHERE idNoticia = ".$this -> idNoticia." ";
				
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
			$sql = "SELECT * FROM Noticia WHERE (idNoticia = '".$this -> idNoticia."')";

			$resultado = $this->mysqli->query($sql);
			
			if($resultado->num_rows == 1){
				$sql = "DELETE FROM Noticia WHERE (idNoticia = '".$this -> idNoticia."')";
				
				$this->mysqli->query($sql);
				
				return "Borrado realizado";
			}else{
				return "La noticia no existe";
			}
		}
		
		function SHOWALL(){
			
			$sql = "SELECT * FROM Noticia WHERE `idNoticia` LIKE '%".$this -> idNoticia."%' and `asunto` LIKE '%".$this -> asunto."%' and `mensaje` LIKE '%".$this -> mensaje."%' and `fecha` LIKE '%".$this -> fecha."%' ";
			
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