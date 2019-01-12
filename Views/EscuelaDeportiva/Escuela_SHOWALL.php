<?php
	class Escuela_SHOWALL{
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
					<th colspan="12" > ESCUELA DEPORTIVA
						
						<form action="../Controllers/EscuelaDeportiva_CONTROLLER.php" method="post" id="formularioShowallEscuela" name="formularioShowallEscuela">
							<button onclick="document.forms[0].submit" name="action" value="search"> <img src="../img/search.png" height="30px"/> </button> 
							<?php
							include_once '../Functions/Autenticacion.php';
						if(esAdmin() || esEntrenador()){
						?>
							<button onClick="document.forms[0].submit" name="action" value="insert">  <img src="../img/add.png" height="30px"/> </button>
							<?php
						}
						?>
						<?php
						include_once '../Functions/Autenticacion.php';
						
						?>
						</form>
						
					</th> 
					<tr>
						<?php
							for($i = 0; $i < count($this -> lista); $i++){
								echo "<th>" . $this -> lista[$i] . "</th>";
							}
						?>
						<th></th>
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
								<form action="../Controllers/EscuelaDeportiva_CONTROLLER.php" method="post" name="showall">
									<input type="hidden" name="idClase" value="<?php echo $fila[0]?>"/>
									<input type="hidden" name="Pista" value="<?php echo $fila[1]?>"/>
									<input type="hidden" name="Fecha" value="<?php echo $fila[2]?>"/>
									<input type="hidden" name="Precio" value="<?php echo $fila[3]?>"/>
									<input type="hidden" name="Entrenador_login" value="<?php echo $fila[4]?>"/>
									<?php
										include_once '../Functions/Autenticacion.php';
										if(!esEntrenador()){
									?>
											<button onclick="document.forms[1].submit" name="action" value="putUser">  <img src="../img/edit.png" height="15px"/> </button> 
									
										<button onclick="document.forms[1].submit" name="action" value="delete2">  <img src="../img/delete.png" height="15px"/> </i> </button> 
										<?php
											}
									?> 
									<button onclick="document.forms[1].submit" name="action" value="showUsers">  <img src="../img/detail.png" height="15px"/> </button>

									<?php
									include_once '../Functions/Autenticacion.php';
									if(esAdmin() || esEntrenador()){
									echo "<button onclick=\"document.forms[1].submit\" name=\"action\" value=\"delete\">  <img src=\"../img/erase.png\" height=\"15px\"/> </i> </button>";
									}?>
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
