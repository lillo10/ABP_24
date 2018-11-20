<?php

	
class Pista_SHOWCURRENT{  
	var $lista;
	var $datos;
	var $enlace;
	
	function __construct ($lista, $datos, $enlace){
		$this -> lista = $lista;
		$this -> datos = $datos;
		$this -> enlace = $enlace;
		$this->toString();
	}

	function toString(){		
		include '../Views/Header.php';
		include '../Views/MenuNavHorizontal.php';
		include '../Views/MenuLatIzq.php';

?>
	
		<form method="POST" accept-charset="UTF-8" id="formularioShowPista" name="formularioShowPista" style="display: inline-block;" action="../Controllers/Pista_CONTROLLER.php">			
			<table id="tuplaDetail" border>
				<tr>
					<th colspan="2" > DATOS DE PISTA </th>
				</tr>
				<tr>
					<th> idPista </th><td><?php echo $this -> datos[0]; ?></td>
				</tr>
				<tr>
					<th> Número de Pista </th><td><?php echo $this -> datos[1]; ?></td>
				</tr>
				<tr>
					<th> Disponibilidad </th><td><?php echo $this -> datos[2]; ?></td>
				</tr>
				<tr>
					<th> Fecha </th><td><?php echo $this -> datos[3]; ?></td>
				</tr>
				<tr>
					<th> Hora </th><td><?php echo $this -> datos[4]; ?></td>
				</tr>
				<tr>
					<th> Precio </th><td><?php echo $this -> datos[5]; ?></td>
				</tr>
				<tr>
					<th><?php echo 'Volver'; ?></th><td><a href="../Controllers/Pista_CONTROLLER.php"><img src="../img/return.png" height="27px"/></a></td>
				</tr>
			</table>
		</form>
		
		</div>
		<?php
		include '../Views/Footer.php';
	}
} ?>