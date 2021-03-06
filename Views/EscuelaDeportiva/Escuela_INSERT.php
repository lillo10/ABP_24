<?php
	
class Escuela_INSERT{  // declaración de clase

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
			<fieldset><legend class="TituloFormulario">Insertar</legend>
				<form method="POST" accept-charset="UTF-8" id="formularioInsertarEscuela" name="formularioInsertarEscuela" style="display: inline-block;" action="../Controllers/EscuelaDeportiva_CONTROLLER.php?action=insert">
					<table class="formulario">
						<tri>
							<tdi>Fecha</tdi><tdi><input required type="date" id="fecha" name="fecha"/></tdi>
						</tri>

						<trp>
							<tdp> Hora </tdp>
						<tdp><select required id="hora" name="hora">
							  <option value="9:00"> 9:00 </option>
							  <option value="10:30"> 10:30 </option>
							  <option value="12:00"> 12:00 </option>
							  <option value="13:30"> 13:30 </option>
							  <option value="15:00"> 15:00 </option>
							  <option value="16:30"> 16:30 </option>
							  <option value="18:00"> 18:00 </option>
							  <option value="19:30"> 19:30 </option>
							  <option value="21:00"> 21:00 </option>
						</select></tdp>
						</trp>

						<tri>
							<tdi>Numero de Pista</tdi>
							<tdi><input  type="text" id="numPista" name="numPista" size="5" maxlength="5"/> </tdi>
						</tri>

						<trp>
							<tdp> Entrenador </tdp>
						<tdp><select required id="idEntrenador" name="idEntrenador">
							  <option value="Roger"> Roger </option>
							  <option value="Pablo"> Pablo </option>
							  <option value="Serena"> Serena </option>
						</select></tdp>
						</trp>

						<button onClick="document.getElementById('formularioInsertarEscuela').submit()" type="submit"/><img src="../img/login.png" height="30px"/>
					</table>
				</form>
			</fieldset>
		</div><?php
	include '../Views/Footer.php';
	} // fin método pinta()
} //fin de class muestradatos
 ?>
