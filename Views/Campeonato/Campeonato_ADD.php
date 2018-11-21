<?php

	
class Campeonato_ADD{  // declaración de clase


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
		include '../Views/MenuLatIzq.php';?>	
		<div class="general">	
		<fieldset><legend class="TituloFormulario">Añadir</legend>
			<form method="POST" accept-charset="UTF-8" id="formularioAdd" name="formularioAdd" style="display: inline-block;" action="../Controllers/Campeonato_CONTROLLER.php">
				<table class="formulario">
					<tri>
						<tdi>idCampeonato</tdi><tdi><input required type="text" id="idCampeonato" name="idCampeonato" size="12" maxlength="9"/></tdi>
					</tri>
					<trp>
						<tdp>Periodo</tdp><tdp><input required type="text" id="Periodo" name="Periodo" size="23" maxlength="23"/></tdp>
					</trp>
					<tri>
						<tdi>Limite de inscripcion</tdi><tdi><input required type="date" id="LimInscrip" name="LimInscrip" size="15" maxlength="10"/></tdi>
					</tri>
					<input required type="hidden" value=" " id="Categoria" name="Categoria" size="10" maxlength="10"/>
					<input required type="hidden" value=" " id="Sexo" name="Sexo" size="10" maxlength="10"/>
					<br/><br/>
					<button onClick="document.getElementById('formularioAdd').submit()" name="orden" value="ADD"/><img src="../img/add.png" height="30px"/>
				</table>
			</form>
		</fieldset>
		</div><?php
		include '../Views/Footer.php';
	} // fin método pinta()
} //fin de class muestradatos
 ?>