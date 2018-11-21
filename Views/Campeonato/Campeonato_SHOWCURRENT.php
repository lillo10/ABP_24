<?php
/* Clase vista showcurrent, para mostrar tuplas y datos que se le pasen a mostrar
	
*/
	
class Campeonato_SHOWCURRENT{  // declaración de clase
	
	var $resultado;//Las tuplas a mostrar
	var $clasg1;
	var $clasg2;
	var $enfg1;
	var $enfg2;

	// declaración constructor de la clase
	function __construct($respuesta){
		$this->resultado = $respuesta;
		$this->clasg1 = $this->resultado[0];
		$this->clasg2 = $this->resultado[1];
		$this->enfg1 = $this->resultado[2];
		$this->enfg2 = $this->resultado[3];
		$this->toString();
	} // fin del constructor

	// declaración de método pinta()
	// muestra por pantall html con los valores de los atributos de la clase
	// y un hiperenlace para volver al script php que la invocó
	function toString(){
		include '../Views/Header.php';
		include '../Views/MenuNavHorizontal.php';
		include '../Views/MenuLatIzq.php';?>
		
		<div class='general'>
		<h1>Grupo 1</h1>
		<h2>Clasificacion</h2>
		<table id="tablaDatos" name="CLASG1">
		
		<tr>
						<th>Nombre Pareja</th>
						<th>Grupo</th>
						<th>Partidos Jugados</th>
						<th>Partidos Ganados</th>
						<th>Partidos Perdidos</th>
						<th>Partidos Empatados</th>
						<th>Puntuacion</th>
						<th>Id Campeonato</th>
		</tr>
			<?php		
				while($fila = $this->clasg1->fetch_row()){//Mientras haya filas, se coje una y se muestra
				?>
					<tr>
						<td id='NombrePareja'><?php echo $fila[0]; ?></td>
						<td id='Grupo'><?php echo $fila[1]; ?></td>
						<td id='Partidos Jugados'><?php echo $fila[2]; ?></td>
						<td id='Partidos Ganados'><?php echo $fila[3]; ?></td>
						<td id='Partidos Perdidos'><?php echo $fila[4]; ?></td>
						<td id='Partidos Empatados'><?php echo $fila[5]; ?></td>
						<td id='Puntuacion'><?php echo $fila[6]; ?></td>
						<td id='idCampeonato'><?php echo $fila[7]; ?></td>
							
						
					</tr>
				<?php
				
			}?>
			</table>
			<br><br>
			<h2>Enfrentamientos</h2>

			<table id="tablaDatos" name="ENFG1">
		
		<tr>
						<th>Fecha</th>
						<th>Grupo</th>
						<th>Pareja1</th>
						<th>Pareja2</th>
						<th>Resultado</th>
						<th>Id Campeonato</th>
						
						<th>Editar</th>
		</tr>
			<?php		
			$i = 0; //Variable para saber el numero de iteraciones e identificar formularios e inputs
			while($fila = $this->enfg1->fetch_row()){//Mientras haya filas, se coje una y se muestra
				?>
				<form id='formularioOpcion<?php echo $i; ?>' method='GET' action='../Controllers/Enfrentamiento_CONTROLLER.php'>
					<tr>
						<td id='Fecha'><?php echo $fila[0]; ?></td>
						<td id='Grupo'><?php echo $fila[1]; ?></td>
						<input type='hidden' name='Pareja1' value="<?php echo $fila[2]; ?>"><td id='Pareja1'><?php echo $fila[2]; ?></td></input>
						<input type='hidden' name='Pareja2' value="<?php echo $fila[3]; ?>"><td id='Pareja2'><?php echo $fila[3]; ?></td></input>
						<td id='Resultado'><?php echo $fila[4]; ?></td>
						<input type='hidden' name='idCampeonato' value="<?php echo $fila[5]; ?>"><td id='idCampeonato'><?php echo $fila[5]; ?></td></input>
							
						<td>
							<input type='hidden' id="oculto<?php echo $i; ?>" name='orden' value=''/>
							<img onMouseOver="document.getElementById('oculto<?php echo $i; ?>').value='EDIT'" onClick="document.getElementById('formularioOpcion<?php echo $i; ?>').submit()" src='../img/edit.png' height='20px;' style='cursor: pointer'/>
						</td> 
					</tr>
				</form>
				<?php
				$i++;
			}?>
			</table>
			<br><br><br><br>

			<h1>Grupo 2</h1>
		<h2>Clasificacion</h2>
		<table id="tablaDatos" name="CLASG2">
		
		<tr>
						<th>Nombre Pareja</th>
						<th>Grupo</th>
						<th>Partidos Jugados</th>
						<th>Partidos Ganados</th>
						<th>Partidos Perdidos</th>
						<th>Partidos Empatados</th>
						<th>Puntuacion</th>
						<th>Id Campeonato</th>
		</tr>
			<?php		
				while($fila = $this->clasg2->fetch_row()){//Mientras haya filas, se coje una y se muestra
				?>
					<tr>
						<td id='NombrePareja'><?php echo $fila[0]; ?></td>
						<td id='Grupo'><?php echo $fila[1]; ?></td>
						<td id='Partidos Jugados'><?php echo $fila[2]; ?></td>
						<td id='Partidos Ganados'><?php echo $fila[3]; ?></td>
						<td id='Partidos Perdidos'><?php echo $fila[4]; ?></td>
						<td id='Partidos Empatados'><?php echo $fila[5]; ?></td>
						<td id='Puntuacion'><?php echo $fila[6]; ?></td>
						<td id='idCampeonato'><?php echo $fila[7]; ?></td>
							
						
					</tr>
				<?php
				
			}?>
			</table>
			<br><br>
			<h2>Enfrentamientos</h2>

			<table id="tablaDatos" name="ENFG2">
		
		<tr>
						<th>Fecha</th>
						<th>Grupo</th>
						<th>Pareja1</th>
						<th>Pareja2</th>
						<th>Resultado</th>
						<th>Id Campeonato</th>
						
						<th>Editar</th>
		</tr>
			<?php		
			$i = 0; //Variable para saber el numero de iteraciones e identificar formularios e inputs
			while($fila = $this->enfg2->fetch_row()){//Mientras haya filas, se coje una y se muestra
				?>
				<form id='formularioOpcion2<?php echo $i; ?>' method='GET' action='../Controllers/Enfrentamiento_CONTROLLER.php'>
					<tr>
						<td id='Fecha'><?php echo $fila[0]; ?></td>
						<td id='Grupo'><?php echo $fila[1]; ?></td>
						<input type='hidden' name='Pareja1' value="<?php echo $fila[2]; ?>"><td id='Pareja1'><?php echo $fila[2]; ?></td></input>
						<input type='hidden' name='Pareja2' value="<?php echo $fila[3]; ?>"><td id='Pareja2'><?php echo $fila[3]; ?></td></input>
						<td id='Resultado'><?php echo $fila[4]; ?></td>
						<input type='hidden' name='idCampeonato' value="<?php echo $fila[5]; ?>"><td id='idCampeonato'><?php echo $fila[5]; ?></td></input>
							
						<td>
							<input type='hidden' id="oculto<?php echo $i; ?>" name='orden' value=''/>
							<img onMouseOver="document.getElementById('oculto<?php echo $i; ?>').value='EDIT'" onClick="document.getElementById('formularioOpcion2<?php echo $i; ?>').submit()" src='../img/edit.png' height='20px;' style='cursor: pointer'/>
						</td> 
					</tr>
				</form>
				<?php
				$i++;
			}?>
			</table>
			</div>
			<br><br><br><br>
<?php		include '../Views/Footer.php';	

} 
	
		
		// fin método pinta()
} //fin de class muestradatos
 ?>