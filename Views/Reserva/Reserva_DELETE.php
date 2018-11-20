<?php
	
class Reserva_DELETE{
	
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
	
		<form method="POST" accept-charset="UTF-8" id="formularioShowPista" name="formularioShowPista" style="display: inline-block;" action="../Controllers/Reserva_CONTROLLER.php">			
			
			<table id="tuplaDetail" border>
				<tr>
					<th colspan="2" > DATOS DE RESERVA A BORRAR </th>
				</tr>
				<tr>
					<th> idReserva </th><td><?php echo $this -> datos[0]; ?></td>
				</tr>
				<tr>
					<th> Login </th><td><?php echo $this -> datos[1]; ?></td>
				</tr>
				<tr>
					<th> idPista </th><td><?php echo $this -> datos[2]; ?></td>
				</tr>
				<tr>
					<th> Acción </th><td>
					<form method="POST"  action="../Controllers/Reserva_CONTROLLER.php">		
						<input type="hidden" name="idReserva" value="<?php echo $this -> datos[0]?>"/>
						<input type="hidden" name="idPista" value="<?php echo $this -> datos[2]?>"/>

					<button  type="submit" name="orden" value="DELETE2"><img src="../img/erase.png" height="20px"/></button></form></td>
					
				</tr>
				<tr>
					<th> Volver </th><td><a href="../Controllers/Reserva_CONTROLLER.php"><img src="../img/return.png" height="27px"/></a></td>
				</tr>
			</table>
		</form>
		</div><?php
		include '../Views/Footer.php';
	} 
}