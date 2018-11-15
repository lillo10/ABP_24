<?php 
/* Clase vista showcurrent, para mostrar una tupla en detalle
	por 3hh731, kch3f4, j7g9n1, ymh5sa, hgdnog 
	28/11/17
*/
	
class Usuario_SHOWCURRENT{  // declaración de clase
	var $usuario;//Usuario recibido
	
	// declaración constructor de la clase
	// se inicializa con los valores del formulario y el valor del botón submit pulsado
	function __construct($usuario){
		$this->usuario = $usuario;
		$this->toString();
	} // fin del constructor

	function toString(){
		include '../Views/Header.php';
		include '../Views/MenuNavHorizontal.php';
		include '../Views/MenuLatIzq.php'; ?>	
		<div class="general">
		<table id="tuplaDetail">
			<tr>
				<th><?php echo $strings['Login']; ?></th><td><?php echo $this->usuario->_getLogin(); ?></td>
			</tr>
			<tr>
				<th><?php echo $strings['password']; ?></th><td><?php echo $this->usuario->_getpassword(); ?></td>
			</tr>
			<tr>
				<th><?php echo $strings['DNI']; ?></th><td><?php echo $this->usuario->_getDNI(); ?></td>
			</tr>
			<tr>
				<th><?php echo $strings['Nombre']; ?></th><td><?php echo $this->usuario->_getNombre(); ?></td>
			</tr>
			<tr>
				<th><?php echo $strings['Apellidos']; ?></th><td><?php echo $this->usuario->_getApellidos(); ?></td>
			</tr>
			<tr>
				<th><?php echo $strings['Correo']; ?></th><td><?php echo $this->usuario->_getCorreo(); ?></td>
			</tr>
			<tr>
				<th><?php echo $strings['Direccion']; ?></th><td><?php echo $this->usuario->_getDireccion(); ?></td>
			</tr>
			<tr>
				<th><?php echo $strings['Telefono']; ?></th><td><?php echo $this->usuario->_getTelefono(); ?></td>
			</tr>
			<tr>
				<th><?php echo $strings['Volver']; ?></th><td><a href="../Controllers/Usuario_CONTROLLER.php"><img src="../img/return.png" height="27px"/></a></td>
			</tr>
		</table>
		</div>
		<?php 
		include '../Views/Footer.php';
	} // fin método pinta()
} //fin de class muestradatos
?>