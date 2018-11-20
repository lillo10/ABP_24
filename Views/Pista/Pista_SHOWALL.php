<?php
	class Pista_SHOWALL{
		var $lista;
		var $datos;
		var $enlace;
		
		function __construct ($lista, $datos, $enlace){
			$this -> lista = $lista;
			$this -> datos = $datos;
			$this -> enlace = $enlace;
			$this -> toString();
		}
		
		function toString(){
			include '../Views/Header.php';
			include '../Views/MenuNavHorizontal.php';
			include '../Views/MenuLatIzq.php';

?>
		<section  id="showall">
			<table>
				<thead> 
					<th colspan="12" > LISTA DE PISTAS 
						<form action="../Controllers/Pista_CONTROLLER.php" method="post" id="formularioShowallPista" name="formularioShowallPista">
							<button onclick="document.forms[0].submit" name="orden" value="SEARCH"> <img src="../img/search.png" height="30px"/> </button> 
							<!-- <button onClick="document.forms[0].submit" name="orden" value="ADD">  <img src="../img/add.png" height="30px"/> </button> -->
						</form>
					</th> 
					<tr>
						<?php
							/*for($i = 0; $i < count($this -> lista)-1; $i++){
								echo "<th>" . $this -> lista[$i] . "</th>";
							}*/
						?>
						<th> idPista </th>
						<th> Número de Pista </th>
						<th> Disponibilidad</th>
						<th> Fecha/Hora </th>
						<th> Precio </th>
						<th> Acciones </th>
					</tr>
				</thead>
				<tbody> 
					<?php
					
					if(!is_string($this->datos)){
						while($fila=$this->datos->fetch_row()){
							echo "<tr>" ;
							for($col=0; $col<count($fila); $col++){
								echo "<td>" . $fila[$col] . "</td>";	
							}?>
							<td> 
								<form action="../Controllers/Pista_CONTROLLER.php" method="post" name="showall">
									<input type="hidden" name="idPista" value="<?php echo $fila[0]; ?>"/>
									
									<button onclick="document.forms[1].submit" name="orden" value="DELETE1">  <img src="../img/erase.png" height="30px"/> </i> </button> 
									<button onclick="document.forms[1].submit" name="orden" value="EDIT">  <img src="../img/edit.png" height="30px"/> </button>  
									<button onclick="document.forms[1].submit" name="orden" value="SHOWCURRENT">  <img src="../img/detail.png" height="30px"/> </button>
								</form>
							</td>
							</tr>
						<?php 
						}
					}?>
				</tbody>
			</table>
			<br><br> <a href='../Controllers/Index_CONTROLLER.php'> Volver </a> 
		</section>

<?php
			include '../Views/Footer.php';
		}
	}
?>