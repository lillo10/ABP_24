<?php
	
class Pista_DELETE{
	
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
	
		<form method="POST" accept-charset="UTF-8" id="formularioDeletePista" name="formularioDeletePista" style="display: inline-block;" action="../Controllers/Pista_CONTROLLER.php">			
			<table id="tuplaDetail" border>
				<tr>
					<th colspan="2" > DATOS DE PISTA A BORRAR </th>
				</tr>
				<tr>
					<th> idPista </th><td><?php echo $this -> datos[0]; ?></td>
				</tr>
				<tr>
					<th> Disponibilidad </th><td><?php echo $this -> datos[1]; ?></td>
				</tr>
				<tr>
					<th> Fecha </th><td><?php echo $this -> datos[2]; ?></td>
				</tr>
				<tr>
					<th> Hora </th><td><?php echo $this -> datos[3]; ?></td>
				</tr>
				<tr>
					<th> Acción </th><td>
						<input type="hidden" name="idPista" value="<?php echo $this -> datos[0]?>"/>
						<input type="hidden" name="fecha" value="<?php echo $this -> datos[2]?>"/>
						<input type="hidden" name="hora" value="<?php echo $this -> datos[3]?>"/>
					<button onClick="submit" type="submit" name="orden" value="DELETE"/><img src="../img/erase.png" height="20px"/></td>
				</tr>
				<tr>
					<th> Volver </th><td><a href="../Controllers/Pista_CONTROLLER.php"><img src="../img/return.png" height="27px"/></a></td>
				</tr>
			</table>
		</form>
		</div><?php
		include '../Views/Footer.php';
	} 
}