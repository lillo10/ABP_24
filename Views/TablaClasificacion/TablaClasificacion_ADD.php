<?php

class TablaClasificacion_ADD{  // declaración de clase


	var $idCampeonato;


	function __construct($idCampeonato){
		$this->idCampeonato = $idCampeonato;
		$this->toString();
	} // fin del constructor

	// declaración de método pinta()
	// muestra por pantall html con los valores de los atributos de la clase
	// y un hiperenlace para volver al script php que la invocó
	function toString(){
		include '../Views/Header.php';
		include '../Views/MenuNavHorizontal.php';
		include '../Views/MenuLatIzq.php';?>	
		<div class="general">	
		<fieldset><legend class="TituloFormulario">Añadir</legend>
			<form method="POST" accept-charset="UTF-8" id="formularioAdd" name="formularioAdd" style="display: inline-block;" action="../Controllers/Campeonato_CONTROLLER.php">
				<table class="formulario">
					<input type='hidden' name='idCampeonato' value="<?php echo $this->idCampeonato; ?>">
					<tri>
						<tdi>Nombre Pareja</tdi><tdi><input required type="text" id="NombrePareja" name="NombrePareja" size="12" maxlength="20"/></tdi>
					</tri>
					<br/><br/>
					<button onClick="document.getElementById('formularioAdd').submit()" name="orden" value="INSCRIBIRSE"/><img src="../img/add.png" height="30px"/>
				</table>
			</form>
		</fieldset>
		</div><?php
		include '../Views/Footer.php';
	} // fin método pinta()
} //fin de class muestradatos
 ?>