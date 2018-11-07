<?php
/* Clase de modelo de USUARIO, el cual accederá exclusivamente a la base de datos
*/
class Usuario{
	
	var $login;
	var $password;
	var $DNI;
	var $Nombre;
	var $Apellidos;
	var $Telefono;
	var $Administrador;
	var $mysqli;
	//Atributos
	
	function __construct($login, $password, $DNI, $Nombre, $Apellidos, $Telefono, $Administrador){
		//Asignaciones
		$this->_setLogin($login);
		$this->_setPassword($password);
		$this->_setDNI($DNI);
		$this->_setNombre($Nombre);
		$this->_setApellidos($Apellidos);
		$this->_setTelefono($Telefono);
		$this->_setAdministrador($Administrador);
		
		include_once '../Functions/AccederBD.php';
		$this->mysqli = ConectarBD();
	}
	
		function _setLogin($login){
			$this->login = $login;
		}
		
		function _setPassword($password){
			$this->password = $password;
		}
		
		function _setDNI($DNI){
			$this->DNI = $DNI;
		}
		
		function _setNombre($Nombre){
			$this->Nombre = $Nombre;
		}
		
		function _setApellidos($Apellidos){
			$this->Apellidos = $Apellidos;
		}
		
		
		function _setTelefono($Telefono){
			$this->Telefono = $Telefono;
		}

		function _setAdministrador($Administrador){
			$this->Administrador = $Administrador;
		}
		
		
		function _getLogin(){
			return $this->login;
		}
		
		function _getPassword(){
			return $this->password;
		}
		
		function _getDNI(){
			return $this->DNI;
		}
		
		function _getNombre(){
			return $this->Nombre;
		}
		
		function _getApellidos(){
			return $this->Apellidos;
		}
		
		function _getAdministrador(){
			return $this->Administrador;
		}
		
		function _getTelefono(){
			return $this->Telefono;
		}
		
		
		function _getDatosGuardados(){//Para recuperar de la base de datos
			if(($this->login == '')){
				return 'Login vacío, introduzca un login';
			}else{
				$login = mysqli_real_escape_string($this->mysqli, $this->login);
				$sql = "SELECT * FROM Usuarios WHERE login = '$login'";
				
				$resultado = $this->mysqli->query($sql);
				
				if(!$resultado){
					return 'No se ha podido conectar con la BD';
				}else if($resultado->num_rows == 0){
					return 'No existe el login';
				}else{
					$fila = $resultado->fetch_row();
					
					$this->_setPassword($fila[1]);
					$this->_setDNI($fila[2]);
					$this->_setNombre($fila[3]);
					$this->_setApellidos($fila[4]);
					$this->_setTelefono($fila[5]);
					$this->_setAdministrador($fila[6]);
				}
			}
		}
	
	function EDIT(){//Para editar de la BD
		if(($this->login == '')){
			return 'Login vacío, introduzca un login';
		}else{
			$login = mysqli_real_escape_string($this->mysqli, $this->login);
			$sql = "SELECT * FROM USUARIO WHERE login = '$login'";
			
			$resultado = $this->mysqli->query($sql);
			
			if(!$resultado){
				return 'No se ha podido conectar con la BD';
			}else if($resultado->num_rows == 1){				
				$password = mysqli_real_escape_string($this->mysqli, $this->password);
				$DNI = mysqli_real_escape_string($this->mysqli, $this->DNI);
				$Nombre = mysqli_real_escape_string($this->mysqli, $this->Nombre);
				$Apellidos = mysqli_real_escape_string($this->mysqli, $this->Apellidos);
				$Correo = mysqli_real_escape_string($this->mysqli, $this->Correo);
				$Direccion = mysqli_real_escape_string($this->mysqli, $this->Direccion);
				$Telefono = mysqli_real_escape_string($this->mysqli, $this->Telefono);
				
				$sql = "UPDATE USUARIO SET password = '$password', DNI = '$DNI', Nombre = '$Nombre', Apellidos = '$Apellidos', Correo = '$Correo', Direccion = '$Direccion', Telefono = '$Telefono' WHERE login = '$login'";
				
				if(!$this->mysqli->query($sql)){
					return 'Ha fallado la actualización del usuario';
				}else{
					return 'Modificado correcto';
				}
			}else{
				return 'Login no existe en la base de datos';
			}
		}
	}
	

	
	function LOGIN(){//Para buscar de la BD y comparar con la pass
		$login = mysqli_real_escape_string($this->mysqli, $this->login);	
		
		$sql = "SELECT password FROM Usuarios WHERE login = '$login'";
		
		$resultado = $this->mysqli->query($sql);
		
		if(!$resultado){
			return 'No se ha podido conectar con la BD';
		}else if($resultado->num_rows == 0){
			return 'Login incorrecto';
		}else{
			if($this->password == $resultado->fetch_assoc()["password"]){
				return 'true';
			}else{
				return 'Contraseña incorrecta';
			}
		}
		
	}

	function REGISTRAR(){
		if(($this->login == '')){
			return 'Login vacío, introduzca un login';
		}else{
			$login = mysqli_real_escape_string($this->mysqli, $this->login);	
		
			$sql = "SELECT * FROM usuarios WHERE login = '$login'";
			
			$resultado = $this->mysqli->query($sql);
			
			if($resultado->num_rows != 0){
				return 'Ya existe un usuario con ese login';
			}else{	
				$password = mysqli_real_escape_string($this->mysqli, $this->password);
				$DNI = mysqli_real_escape_string($this->mysqli, $this->DNI);
				$Nombre = mysqli_real_escape_string($this->mysqli, $this->Nombre);
				$Apellidos = mysqli_real_escape_string($this->mysqli, $this->Apellidos);
				$Telefono = mysqli_real_escape_string($this->mysqli, $this->Telefono);
				$Administrador = mysqli_real_escape_string($this->mysqli, $this->Administrador);
				
				$sql = "INSERT INTO Usuarios (login, password, DNI, Nombre, Apellido, Telefono, Administrador) VALUES ('$login','$password','$DNI','$Nombre',
				'$Apellidos','$Telefono','$Administrador')";

				/*$sql = "INSERT INTO Usuarios (login, password, DNI, Nombre, Apellido, Telefono, Administrador) VALUES ('lillo10','hola','15492083N','Angel', 'Lillo','648737151','FALSE')";*/
				
				$respuesta = $this->mysqli->query($sql);
				
				if(!$respuesta){
					return 'No se ha podido conectar con la BD';
				}else{
					return 'Usuario añadido correctamente';
				}
			}
		}
	}

}
?>