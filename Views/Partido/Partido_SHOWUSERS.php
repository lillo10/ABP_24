<?php
	class Partido_SHOWUSERS{
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
					<th colspan="12" > LISTA DE USUARIOS PARA ESTE PARTIDO
					</th> 
					<tr>
						<?php
								echo "<th>" . $this -> lista[0] . "</th>";
						?>
					</tr>
				</thead>
				<tbody> 
					<?php
					
					if(!is_string($this->datos)){
						while($fila=$this->datos->fetch_row()){
							echo "<tr>" ;
							echo "<td>" . $fila[0] . "</td>";
							echo "</tr>";
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