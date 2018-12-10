<?php
/* Clase vista registro, con el fin de poder registrarse. Es casi un ditto de vista registro
	
*/
	
class Usuario_REGISTRO{  // declaración de clase

	// declaración constructor de la clase
	// se inicializa con los valores del formulario y el valor del botón submit pulsado
	function __construct(){
		$this->toString();
	} // fin del constructor


	function toString(){
		include '../Views/Header.php';
		include '../Views/MenuNavHorizontal.php';
	?>	
		<div class="general">	
		<fieldset><legend class="TituloFormulario">Registrarse</legend>
			<form method="POST" accept-charset="UTF-8" id="formularioRegister" name="formularioRegister" style="display: inline-block;" action="../Controllers/Registro_CONTROLLER.php">
				<table class="formulario">
					<tri>
						<tdi>Login</tdi><tdi><input required type="text" id="login" name="login" size="12" maxlength="9" /></tdi>
					</tri>
					<trp>
						<tdp>Contraseña</tdp><tdp><input required type="password" id="password" name="password" size="25" maxlength="20" /></tdp>
					</trp>
					<tri>
						<tdi>DNI</tdi><tdi><input required type="text" id="DNI" name="DNI" size="15" maxlength="9" /></tdi>
					</tri>
					<trp>
						<tdp>Nombre</tdp><tdp><input required type="text" id="Nombre" name="Nombre" size="35" maxlength="30" /></tdp>
					</trp>
					<tri>
						<tdi>Apellidos</tdi><tdi><input required type="text" id="Apellidos" name="Apellidos" size="60" maxlength="50" /></tdi>
					</tri>
					<trp>
						<tdp>Telefono</tdp><tdp><input required type="text" id="Telefono" name="Telefono" size="20" maxlength="13"/></tdp>
					</trp>
					<tri>
						<tdi>Email</tdi><tdi><input required type="text" id="Email" name="Email" size="30" maxlength="40" /></tdi>
					</tri><br/><br/>
					<button onClick="document.getElementById('formularioRegister').submit()" name="orden" value="REGISTRO"/><img src="../img/register.png" height="30px"/>
					
				</table>
			</form>
		</fieldset>
		</div><?php
		include '../Views/Footer.php';
	} // fin método pinta()
} //fin de class muestradatos
 ?>