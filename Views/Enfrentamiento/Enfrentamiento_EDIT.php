<?php
/* Clase vista edit, con el fin de poder editar un enfrentamiento que se le pase como paramétro
	
*/
	
class Enfrentamiento_EDIT{  // declaración de clase
	
	var $enfrentamiento;//Usuario a editar
	
	function __construct($enfrentamiento){
		$this->enfrentamiento = $enfrentamiento;
		$this->toString();//Imprimir por pantalla el formulario
	} // fin del constructor

	function toString(){
		include '../Views/Header.php';
		include '../Views/MenuNavHorizontal.php';
		include '../Views/MenuLatIzq.php';?>
		<div class="general">		
		<fieldset><legend class="TituloFormulario">Editar</legend>
			<form method="POST" accept-charset="UTF-8" id="formularioEdit" name="formularioEdit" style="display: inline-block;" action="../Controllers/Enfrentamiento_CONTROLLER.php">
				<table class="formulario">
					<tri>
						<tdi>Fecha</tdi><tdi><input type="date" name="Fecha" size="12" value="<?php echo $this->enfrentamiento->_getFecha(); ?>"/></tdi>
					</tri>
					<trp>
						<tdi>Grupo</tdi><tdi><input readonly type="text" name="Grupo" size="12" value="<?php echo $this->enfrentamiento->_getGrupo(); ?>"/></tdi>
					</trp>
					<tri>
						<tdi>Pareja 1</tdi><tdi><input readonly type="text" name="Pareja1" size="12" value="<?php echo $this->enfrentamiento->_getPareja1(); ?>"/></tdi>
					</tri>
					<trp>
						<tdi>Pareja 2</tdi><tdi><input readonly type="text" name="Pareja2" size="12" value="<?php echo $this->enfrentamiento->_getPareja2(); ?>"/></tdi>
					</trp>
					<tri>
						<tdi>Ganador</tdi><tdi>
							<select name="Resultado">
								<option selected value="0"> Elige una opción </option>
									<option value="1">Pareja 1</option> 
       								<option value="2">Pareja 2</option> 
							</select></tdi>
					</tri>
					<trp>
						<tdi>Id Campeonato</tdi><tdi><input readonly type="text" name="idCampeonato" size="12" value="<?php echo $this->enfrentamiento->_getidCampeonato(); ?>"/></tdi>
					</trp>
					<br/><br/>
					<button onClick="document.getElementById('formularioEdit').submit();" name="orden" value="EDIT"/><img src="../img/edit.png" height="30px"/>
				</table>
			</form>
		</fieldset>
		</div><?php
		include '../Views/Footer.php';
	} // fin método pinta()
} //fin de class muestradatos
 ?>