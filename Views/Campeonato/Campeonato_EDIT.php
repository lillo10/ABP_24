<?php
/* Clase vista edit, con el fin de poder editar un usuario que se le pase como paramétro
	por 3hh731, kch3f4, j7g9n1, ymh5sa, hgdnog 
	28/11/17
*/
	
class Usuario_EDIT{  // declaración de clase
	
	var $usuario;//Usuario a editar
	
	function __construct($usuario){
		$this->usuario = $usuario;
		$this->toString();//Imprimir por pantalla el formulario
	} // fin del constructor

	// declaración de método pinta()
	// muestra por pantall html con los valores de los atributos de la clase
	// y un hiperenlace para volver al script php que la invocó
	function toString(){
		include '../Views/Header.php';
		include '../Views/MenuNavHorizontal.php';
		include '../Views/MenuLatIzq.php';?>
		<div class="general">		
		<fieldset><legend class="TituloFormulario"><?php echo $strings['Editar']; ?></legend>
			<form method="POST" accept-charset="UTF-8" id="formularioEdit" name="formularioEdit" style="display: inline-block;" action="../Controllers/Usuario_CONTROLLER.php">
				<table class="formulario">
					<tri>
						<tdi><?php echo $strings['Login']; ?></tdi><tdi><input readonly type="text" id="loginA" name="login" size="12" maxlength="9" onBlur="validarLoginUsuario(this)" value="<?php echo $this->usuario->_getLogin(); ?>"/></tdi><tdi><img id="loginABot" height="20px" src="../img/red-button.png"/></tdi><tdi><texto-correccion id="loginABotText"></texto-correccion></tdi>
					</tri>
					<trp>
						<tdp><?php echo $strings['password']; ?></tdp><tdp><input required type="password" id="passwordA" name="password" size="25" maxlength="20" onBlur="validarPasswordUsuario(this)" value="<?php ?>"/></tdp><tdp><img id="passwordABot" height="20px" src="../img/red-button.png"/></tdp><tdp><texto-correccion id="passwordABotText"></texto-correccion></tdp>
					</trp>
					<tri>
						<tdi><?php echo $strings['DNI']; ?></tdi><tdi><input required type="text" id="DNIA" name="DNI" size="15" maxlength="9" onBlur="validarDNIUsuario(this)" value="<?php echo $this->usuario->_getDNI(); ?>"/></tdi><tdi><img id="DNIABot" height="20px" src="../img/red-button.png"/></tdi><tdi><texto-correccion id="DNIABotText"></texto-correccion></tdi>
					</tri>
					<trp>
						<tdp><?php echo $strings['Nombre']; ?></tdp><tdp><input required type="text" id="NombreA" name="Nombre" size="35" maxlength="30" onBlur="validarNombreUsuario('NombreA')" value="<?php echo $this->usuario->_getNombre(); ?>"/></tdp><tdp><img id="NombreABot" height="20px" src="../img/red-button.png"/></tdp><tdp><texto-correccion id="NombreABotText"></texto-correccion></tdp>
					</trp>
					<tri>
						<tdi><?php echo $strings['Apellidos']; ?></tdi><tdi><input required type="text" id="ApellidosA" name="Apellidos" size="60" maxlength="50" onBlur="validarApellidosUsuario('ApellidosA')" value="<?php echo $this->usuario->_getApellidos(); ?>"/></tdi><tdi><img id="ApellidosABot" height="20px" src="../img/red-button.png"/></tdi><tdi><texto-correccion id="ApellidosABotText"></texto-correccion></tdi>
					</tri>
					<trp>
						<tdp><?php echo $strings['Correo']; ?></tdp><tdp><input required type="text" id="CorreoA" name="Correo" size="50" maxlength="40" onBlur="validarCorreoUsuario(this);" value="<?php echo $this->usuario->_getCorreo(); ?>"/></tdp><tdp><img id="CorreoABot" height="20px" src="../img/red-button.png"/></tdp><tdp><texto-correccion id="CorreoABotText"></texto-correccion></tdp>
					</trp>
					<tri>
						<tdi><?php echo $strings['Direccion']; ?></tdi><tdi><input required type="text" id="DireccionA" name="Direccion" size="70" maxlength="60" onBlur="validarDireccionUsuario('DireccionA')" value="<?php echo $this->usuario->_getDireccion(); ?>"/></tdi><tdi><img id="DireccionABot" height="20px" src="../img/red-button.png"/></tdi><tdi><texto-correccion id="DireccionABotText"></texto-correccion></tdi>
					</tri>
					<trp>
						<tdp><?php echo $strings['Telefono']; ?></tdp><tdp><input required type="text" id="TelefonoA" name="Telefono" size="20" maxlength="13" onBlur="validarTelefonoUsuario(this)" value="<?php echo $this->usuario->_getTelefono(); ?>"/></tdp><tdp><img id="TelefonoABot" height="20px" src="../img/red-button.png"/></tdp><tdp><texto-correccion id="TelefonoABotText"></texto-correccion></tdp>
					</trp><br/><br/>
					<button onClick="return validarFormularioUsuarioAER(document.getElementById('formularioEdit'), 'EDIT');" name="orden" value="EDIT"/><img src="../img/edit.png" height="30px"/>
				</table>
			</form>
		</fieldset>
		</div><?php
		include '../Views/Footer.php';
	} // fin método pinta()
} //fin de class muestradatos
 ?>