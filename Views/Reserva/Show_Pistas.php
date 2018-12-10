<?php
	class Show_Pistas{
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
			<h1> LISTADO DE PISTAS DISPONIBLES </h1>
			<table>
				<th> BUSCAR PISTA 
					<form action="../Controllers/Reserva_CONTROLLER.php" method="post" id="formularioShowallPista" name="formularioShowallPista">
						<button onclick="document.forms[0].submit" name="orden" value="SEARCH"> <img src="../img/search.png" height="30px"/> </button> 
					</form>
				</th> 
			</table>
		<!--	<table>
				<thead> 
					<th colspan="12" > LISTADO DE PISTAS DISPONIBLES
						<form action="../Controllers/Reserva_CONTROLLER.php" method="post" id="formularioShowallPista" name="formularioShowallPista">
							<button onclick="document.forms[0].submit" name="orden" value="SEARCH"> <img src="../img/search.png" height="30px"/> </button> 
						</form>
					</th> 
					<tr>
						<?php
							/*for($i = 0; $i < count($this -> lista)-1; $i++){
								echo "<th>" . $this -> lista[$i] . "</th>";
							}*/
						?>
						
						<th> Número de Pista </th>
						<th> Disponibilidad</th>
						<th> Fecha/Hora </th>
						<th> Precio </th>
						<th> Acciones </th>
					</tr> 
				</thead>
				<tbody> -->
					<?php
					$actual = "0";
					$primera = true;
					if(!is_string($this->datos)){
						while($fila=$this->datos->fetch_row()){ 
							if(strcmp($fila[1], $actual) == 0){
								echo "<tr>";
								for($col=1; $col<count($fila); $col++){ 
									echo "<td>" . $fila[$col] . "</td>";	
								} ?>
								<td> 
								<form action="../Controllers/Reserva_CONTROLLER.php" method="post" name="showall">
								<input type="hidden" id="idPista" name="idPista" value= "<?php echo $fila[0]; ?>" />
									<!-- <input type="hidden" id="numPista" name="numPista" value= "<?php //echo $fila[1]; ?>" />
									<input type="hidden" id="fecha" name="fecha" value= "<?php //echo $fila[3]; ?>" />
									<!-- <input type="hidden" id="hora" name="hora" value= <?php //echo $fila[4]; ?> /> -->
									
									<button onclick="document.forms[1].submit" name="orden" value="RESERVAR">  <img src="../img/register.png" height="30px" /> RESERVAR </button> 
								</form>
							</td>
								<?php
								echo "</tr>";
							}else{
								if($primera){
									$primera = false;
								}else{
									echo "</table>";
								}
								?>
								<table>
								<th colspan="12" > PISTA <?php echo $fila[1]?> </th>
								<tr>
									<th> Número de Pista </th>
									<th> Disponibilidad</th>
									<th> Fecha/Hora </th>
									<th> Precio </th>
									<th> Acciones </th>
								</tr>  
								<?php
								echo "<tr>";
								for($col=1; $col<count($fila); $col++){ 
									echo "<td>" . $fila[$col] . "</td>";
								} ?>
								<td> 
								<form action="../Controllers/Reserva_CONTROLLER.php" method="post" name="showall">
								<input type="hidden" id="idPista" name="idPista" value= "<?php echo $fila[0]; ?>" />
									<!-- <input type="hidden" id="numPista" name="numPista" value= "<?php //echo $fila[1]; ?>" />
									<input type="hidden" id="fecha" name="fecha" value= "<?php //echo $fila[3]; ?>" />
									<!-- <input type="hidden" id="hora" name="hora" value= <?php //echo $fila[4]; ?> /> -->
									
									<button onclick="document.forms[1].submit" name="orden" value="RESERVAR">  <img src="../img/register.png" height="30px" /> RESERVAR </button> 
								</form>
							</td>
								<?php
								echo "</tr>";
							}
							$actual = $fila[1];
						}
					}
					
					
					
					/*if(!is_string($this->datos)){
						while($fila=$this->datos->fetch_row()){ 
							echo "<tr>";
							for($col=1; $col<count($fila); $col++){ 
								echo "<td>" . $fila[$col] . "</td>";	
							}?>
							<td> 
								<form action="../Controllers/Reserva_CONTROLLER.php" method="post" name="showall">
								<input type="hidden" id="idPista" name="idPista" value= "<?php echo $fila[0]; ?>" />
									<!-- <input type="hidden" id="numPista" name="numPista" value= "<?php //echo $fila[1]; ?>" />
									<input type="hidden" id="fecha" name="fecha" value= "<?php //echo $fila[3]; ?>" />
									<!-- <input type="hidden" id="hora" name="hora" value= <?php //echo $fila[4]; ?> /> -->
									
									<button onclick="document.forms[1].submit" name="orden" value="RESERVAR">  <img src="../img/register.png" height="30px" /> RESERVAR </button> 
								</form>
							</td>
							</tr>
						<?php 
						}
					}*/?>
			<!--	</tbody>
			</table> -->
			
		</section>
		

<?php
			include '../Views/Footer.php';
		}
	}
?>