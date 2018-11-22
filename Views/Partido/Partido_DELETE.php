<?php
/* Clase vista registro, con el fin de poder registrarse. Es casi un ditto de vista registro
	
*/
	
class Partido_DELETE{  // declaración de clase

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
		<fieldset><legend class="TituloFormulario">Eliminar Partido</legend>
			<form method="POST" accept-charset="UTF-8" id="formularioDeletePartido" name="formularioDeletePartido" style="display: inline-block;" action="../Controllers/Partido_CONTROLLER.php?action=delete">
				<table class="formulario">
					<tri>
						<tdi>Id-Partido</tdi><tdi><input required type="text" id="idPartido" name="idPartido"/></tdi>
					</tri>
					<button onClick="document.getElementById('formularioDeletePartido').submit()" type="submit"/><img src="../img/login.png" height="30px"/>
				</table>
			</form>
		</fieldset>
	</div>
<?php
		include '../Views/Footer.php';
	} // fin método pinta()
} //fin de class muestradatos
 ?>