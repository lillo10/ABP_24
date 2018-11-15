<?php
/* Clase vista showall, para mostrar tuplas y datos que se le pasen a mostrar
	
*/
	
class Campeonato_SHOWALL{  // declaración de clase
	
	var $resultado;//Las tuplas a mostrar
	var $datosAMostrar;//Los datos de esas tuplas a mostrar

	// declaración constructor de la clase
	// se inicializa con los valores del formulario y el valor del botón submit pulsado
	function __construct($respuesta, $datosAMostrar){
		$datosAMostrarS = array();
		
		$datosAMostrarS["EDIT"] = array_search('EDIT', $datosAMostrar, true);		
		
		
		$this->datosAMostrar = $datosAMostrarS;
		$this->resultado = $respuesta;
		$this->toString();
	} // fin del constructor

	// declaración de método pinta()
	// muestra por pantall html con los valores de los atributos de la clase
	// y un hiperenlace para volver al script php que la invocó
	function toString(){
		include '../Views/Header.php';
		include '../Views/MenuNavHorizontal.php';
		include '../Views/MenuLatIzq.php';
		echo "<div class='general'>";
		
		if(is_string($this->resultado)){
			echo '<table id="tablaDatos" name="SHOWALL">';
			if(tienePermisosPara('TRABAJ', 'SHOWAL')){ //Si tiene permisos (ADMIN)							
				echo '<tr style="margin-bottom: 20px">
						<td style="background-color: white;"></td>
						<td style="background-color: white;"><center><img src="../img/add.png" onClick=document.getElementById("ADD").submit() height="40px"> <form id="ADD" onSubmit="controlador.php"><input type="hidden" name="orden" value="ADD"></form> </center></td>
						<td style="background-color: white;"></td>
						<td style="background-color: white;"></td>
						<td style="background-color: white;"><center><img src="../img/search.png" onClick=document.getElementById("SEARCH").submit() height="40px"> <form id="SEARCH" onSubmit="controlador.php"><input type="hidden" name="orden" value="SEARCH"></form> </center></td>
						<td style="background-color: white;"></td>
					</tr>';
			}
			?>
			<table id="tuplaDetail">
				<tr>
					<th><?php echo $strings['Informacion']; ?></th><td><?php echo $this->resultado; ?></td>
				</tr>
				<tr>
					<th><?php echo $strings['Volver']; ?></th><td><a href="../Controllers/Entrega_CONTROLLER.php"><?php echo $strings['Volver']; ?></a></td>
				</tr>
			</table>
			<?php
		}else{			
			echo '<table id="tablaDatos" name="SHOWALL">';
			if(tienePermisosPara('TRABAJ', 'SHOWAL')){ //Si tiene permisos (ADMIN)							
				echo '<tr style="margin-bottom: 20px">
						<td style="background-color: white;"></td>
						<td style="background-color: white;"><center><img src="../img/add.png" onClick=document.getElementById("ADD").submit() height="40px"> <form id="ADD" onSubmit="controlador.php"><input type="hidden" name="orden" value="ADD"></form> </center></td>
						<td style="background-color: white;"></td>
						<td style="background-color: white;"></td>
						<td style="background-color: white;"><center><img src="../img/search.png" onClick=document.getElementById("SEARCH").submit() height="40px"> <form id="SEARCH" onSubmit="controlador.php"><input type="hidden" name="orden" value="SEARCH"></form> </center></td>
						<td style="background-color: white;"></td>
					</tr>';
			}
			echo   '<tr>
						<th>'. $strings['Login'] .'</th>
						<th>'. $strings['IdTrabajo'] .'</th>
						<th>'. $strings['Alias'] .'</th>
						<th>'. $strings['Horas'] .'</th>
						<th>'. $strings['Ruta'] .'</th>
						
						<th>'. $strings['Acciones'] .'</th>
					</tr>';/*Nombre de los datos*/
					
			$i = 0; //Variable para saber el numero de iteraciones e identificar formularios e inputs
			while($fila = $this->resultado->fetch_row()){//Mientras haya filas, se coje una y se muestra
				?>
				<form id='formularioOpcion<?php echo $i; ?>' method='GET' action='../Controllers/Entrega_CONTROLLER.php'>
					<tr>
						<input type='hidden' name='login' value="<?php echo $fila[0]; ?>"><td id='login'><?php echo $fila[0]; ?></td></input>
						<input type='hidden' name='IdTrabajo' value="<?php echo $fila[1]; ?>"><td id='IdTrabajo'><?php echo $fila[1]; ?></td></input>
						<td id='Alias'><?php echo $fila[2]; ?></td>
						<td id='Horas'><?php echo $fila[3]; ?></td>
						<td id='Ruta'>
							<a href="<?php echo $fila[4];?>">
								<?php echo $fila[4]; ?>
								<img src="../img/fichero.png" height="20px"/>
							</a>
						</td>
						
						<td>
							<input type='hidden' id="oculto<?php echo $i; ?>" name='orden' value=''/>
							<?php
							if($this->datosAMostrar["EDIT"]){
								?>
								<img onMouseOver="document.getElementById('oculto<?php echo $i; ?>').value='EDIT'" onClick="document.getElementById('formularioOpcion<?php echo $i; ?>').submit()" src='../img/edit.png' height='20px;' style='cursor: pointer'/>
								<?php
							}
							if(tienePermisosPara('ENTREG', 'SHOWAL')){ //Si tiene permisos (ADMIN)?> 
							<img onMouseOver="document.getElementById('oculto<?php echo $i; ?>').value='DELETE'" onClick="document.getElementById('formularioOpcion<?php echo $i; ?>').submit()" src='../img/erase.png' height='20px;' style='cursor: pointer'/>
							<img onMouseOver="document.getElementById('oculto<?php echo $i; ?>').value='SHOWCURRENT'" onClick="document.getElementById('formularioOpcion<?php echo $i; ?>').submit()" src='../img/detail.png' height='20px;' style='cursor: pointer'/>
						<?php } ?>
						</td> 
					</tr>
				</form>
			<?php
			$i++;
			}//Escribir una celda en el orden en el que se presentan los datos del showall, ponemos un input hidden para que al ejecutar las acciones de edit, showcurrent o delete tengamos el input del login o lo que necesitemos. Las acciones al final en la ultima celda, pero además si es showCurrent se cambia a post para no tener una URL de la nasa
			echo '</table>';
		}
		echo '</div>';
		include '../Views/Footer.php';	
	}
		// fin método pinta()
} //fin de class muestradatos
 ?>