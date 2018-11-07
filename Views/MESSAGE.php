<?php 
/* Clase vista message, con el fin de poder mostrar un mensaje por pantalla y une nlace de retorno, ambos pasados como parámetros
	por 3hh731, kch3f4, j7g9n1, ymh5sa, hgdnog 
	28/11/17
*/
class Mensaje{
	var $mensaje;
	var $retorno;
	
	function __construct($mensaje, $retorno){
		$this->mensaje = $mensaje;
		$this->retorno = $retorno;
		$this->toString();
	}
	
	function toString(){		
		include '../Views/Header.php';
		include '../Views/MenuNavHorizontal.php';
		include '../Views/MenuLatIzq.php';?>
		<div class="general">
		<table id='tuplaDetail'>
			<tr>
					<th><?php echo $strings['Informacion']; ?></th><td><?php echo $strings[$this->mensaje]; ?></td>
				</tr>
				<tr>
					<th><?php echo $strings['Volver']; ?></th><td><a href="<?php echo $this->retorno; ?>"><img src="../img/return.png" height="27px"/></a></td>
				</tr>
		</table>
		</div><?php
		include '../Views/Footer.php';
	}	
}?>