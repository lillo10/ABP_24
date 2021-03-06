<?php
/* Clase vista login, con el fin de logearse desde aquí

*/
	
class Usuario_LOGIN{  // declaración de clase

	// declaración constructor de la clase
	// se inicializa con los valores del formulario y el valor del botón submit pulsado
	function __construct(){
		$this->toString();
	} // fin del constructor

	// declaración de método pinta()
	// muestra por pantall html con los valores de los atributos de la clase
	// y un hiperenlace para volver al script php que la invocó
	function toString(){
		include '../Views/Header.php';
		include '../Views/MenuNavHorizontal.php';
	?>	
		<div class="general">	
		<fieldset><legend class="TituloFormulario">Login</legend>
			<form method="POST" accept-charset="UTF-8" id="formularioLogin" name="formularioLogin" style="display: inline-block;" action="../Controllers/Login_CONTROLLER.php">
				<table class="formulario">
					<tri>
						<tdi>Login</tdi><tdi><input required type="text" id="loginA" name="login" size="20" maxlength="15" /></tdi>

					</tri>
					<trp>
						<tdp>Contraseña</tdp><tdp><input required type="password" id="passwordA" name="password" size="25" maxlength="20" /></tdp>

					</trp>
					<button onClick="document.getElementById('formularioLogin').submit()" type="submit" name="orden" value="LOGIN"/><img src="../img/login.png" height="30px"/>
				</table>
			</form>
		</fieldset>
		</div><?php
		include '../Views/Footer.php';
	} // fin método pinta()
} //fin de class muestradatos
?>