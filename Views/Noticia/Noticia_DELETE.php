<?php	
class Noticia_DELETE{
	
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
	
		<form method="POST" accept-charset="UTF-8" id="formularioDeleteNoticia" name="formularioDeleteNoticia" style="display: inline-block;" action="../Controllers/Noticia_CONTROLLER.php">			
			<table id="tuplaDetail" border>
				<tr>
					<th colspan="2" > DATOS DE NOTICIA A BORRAR </th>
				</tr>
				<tr>
					<th> idNoticia </th><td><?php echo $this -> datos[0]; ?></td>
				</tr>
				<tr>
					<th> Asunto </th><td><?php echo $this -> datos[1]; ?></td>
				</tr>
				<tr>
					<th> Mensaje </th><td><?php echo $this -> datos[2]; ?></td>
				</tr>
				<tr>
					<th> Fecha </th><td><?php echo $this -> datos[3]; ?></td>
				</tr>
				<tr>
					<th> Acción </th><td>
					<form>
						<input type="hidden" name="idNoticia" value="<?php echo $this -> datos[0]?>"/>

					<button onClick="submit" type="submit" name="orden" value="DELETE2"/><img src="../img/erase.png" height="20px"/></form></td>
				</tr>
				<tr>
					<th> Volver </th><td><a href="../Controllers/Noticia_CONTROLLER.php"><img src="../img/return.png" height="27px"/></a></td>
				</tr>
			</table>
		</form>
		</div><?php
		include '../Views/Footer.php';
	} 
}