<?php
/* Clase vista delete, con el fin de poder eliminar un usuario que se le pase como parámetro. Con la clave es suficiente

*/
	
class Campeonato_DELETE{  // declaración de clase
	
	var $campeonato;//Usuario a Deletear
	
	function __construct($campeonato){
		$this->campeonato = $campeonato;
		$this->toString();//Imprimir por pantalla el formulario
	} // fin del constructor

	function toString(){		
		include '../Views/Header.php';
		include '../Views/MenuNavHorizontal.php';
		include '../Views/MenuLatIzq.php';?>
		<div class="general">
		
		<form method="POST" accept-charset="UTF-8" id="formularioDelete" name="formularioDelete" style="display: inline-block;" action="../Controllers/Campeonato_CONTROLLER.php">			
			<input type="hidden" id="idCampeonato" name="idCampeonato" value="<?php echo $this->campeonato->_getidCampeonato(); ?>"/>
			
			<table id="tuplaDetail">
				<tr>
					<th>idCampeonato</th><td><?php echo $this->campeonato->_getidCampeonato(); ?></td>
				</tr>
				<tr>
					<th>Periodo</th><td><?php echo $this->campeonato->_getPeriodo(); ?></td>
				</tr>
				<tr>
					<th>Limite Inscripcion</th><td><?php echo $this->campeonato->_getLimInscrip(); ?></td>
				</tr>
				<tr>
					<th>Categoria</th><td><?php echo $this->campeonato->_getCategoria(); ?></td>
				</tr>
				<tr>
					<th>Sexo</th><td><?php echo $this->campeonato->_getSexo(); ?></td>
				</tr>
				<tr>
					<th>Accion</th><td><button onClick="document.getElementById('idCampeonato').value='<?php echo $this->campeonato->_getidCampeonato(); ?>'" onClick="submit" type="submit" name="orden" value="DELETE"/><img src="../img/erase.png" height="20px"/></td>
				</tr>
				<tr>
					<th>Volver</th><td><a href="../Controllers/Campeonato_CONTROLLER.php"><img src="../img/return.png" height="27px"/></a></td>
				</tr>
			</table>
		
		</form>
		</div><?php
		include '../Views/Footer.php';
	} // fin método pinta()
} //fin de class muestradatos
 ?>