<?php
/* Clase vista showall, para mostrar tuplas y datos que se le pasen a mostrar
	
*/
	
class Campeonato_SHOWALL{  // declaración de clase
	
	var $resultado;//Las tuplas a mostrar
	

	// declaración constructor de la clase
	// se inicializa con los valores del formulario y el valor del botón submit pulsado
	function __construct($respuesta){
		$this->resultado = $respuesta;
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
		<table id="tablaDatos" name="SHOWALL">
		
		<tr>
						<th>idCampeonato</th>
						<th>Periodo</th>
						<th>Limite inscripcion</th>
						<th>Categoria</th>
						<th>Sexo</th>
						
						<th>Acciones</th>
		</tr>
			<?php		
			$i = 0; //Variable para saber el numero de iteraciones e identificar formularios e inputs
			while($fila = $this->resultado->fetch_row()){//Mientras haya filas, se coje una y se muestra
				?>
				<form id='formularioOpcion<?php echo $i; ?>' method='GET' action='../Controllers/Campeonato_CONTROLLER.php'>
					<tr>
						<input type='hidden' name='idCampeonato' value="<?php echo $fila[0]; ?>"><td id='idCampeonato'><?php echo $fila[0]; ?></td></input>
						<td id='Periodo'><?php echo $fila[1]; ?></td>
						<td id='LimInscrip'><?php echo $fila[2]; ?></td>
						<td id='Categoria'><?php echo $fila[3]; ?></td>
						<td id='Sexo'><?php echo $fila[4]; ?></td>
							
						<td>
							<input type='hidden' id="oculto<?php echo $i; ?>" name='orden' value=''/>
							<img onMouseOver="document.getElementById('oculto<?php echo $i; ?>').value='INSCRIBIRSE'" onClick="document.getElementById('formularioOpcion<?php echo $i; ?>').submit()" src='../img/register.png' height='20px;' style='cursor: pointer'/>
							<img onMouseOver="document.getElementById('oculto<?php echo $i; ?>').value='SHOWCURRENT'" onClick="document.getElementById('formularioOpcion<?php echo $i; ?>').submit()" src='../img/detail.png' height='20px;' style='cursor: pointer'/>
							<?php
							if(esAdmin()){ //Si tiene permisos (ADMIN)?> 
							<img onMouseOver="document.getElementById('oculto<?php echo $i; ?>').value='DELETE'" onClick="document.getElementById('formularioOpcion<?php echo $i; ?>').submit()" src='../img/erase.png' height='20px;' style='cursor: pointer'/>
						<?php }
							if(esAdmin()){ //Si tiene permisos (ADMIN)?> 
							<img onMouseOver="document.getElementById('oculto<?php echo $i; ?>').value='GENPARTIDOS'" onClick="document.getElementById('formularioOpcion<?php echo $i; ?>').submit()" src='../img/genpartidos.png' height='20px;' style='cursor: pointer'/>
						<?php } ?>
						</td> 
					</tr>
				</form>
				<?php
				$i++;
			}//Escribir una celda en el orden en el que se presentan los datos del showall, ponemos un input hidden para que al ejecutar las acciones de edit, showcurrent o delete tengamos el input del login o lo que necesitemos. Las acciones al final en la ultima celda, pero además si es showCurrent se cambia a post para no tener una URL de la nasa?>
			</table>
			</div>
<?php		include '../Views/Footer.php';	

} 
	
		
		// fin método pinta()
} //fin de class muestradatos
 ?>