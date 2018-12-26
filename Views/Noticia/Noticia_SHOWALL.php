<?php
	class Noticia_SHOWALL{
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
					<th colspan="12" style="width:1500px;"> NOTICIAS 
						<form action="../Controllers/Noticia_CONTROLLER.php" method="post" id="formularioShowallNoticia" name="formularioShowallNoticia">
							<!-- <button onclick="document.forms[0].submit" name="orden" value="SEARCH"> <img src="../img/search.png" height="30px"/> </button> -->
							<!-- <button onClick="document.forms[0].submit" name="orden" value="ADD">  <img src="../img/add.png" height="30px"/> </button> -->
						</form>
					</th> 
					<?php if(esAdmin()){ ?>
						<tr>
							<th style="width:1000px;"> Noticia </th>
							<th> Acciones </th>
						</tr>
					<?php } ?>
				</thead>
				<tbody> 
					<?php
					
					if(!is_string($this->datos)){
						echo "<tr>" ;
						while($fila=$this->datos->fetch_assoc()){
							echo "<td>";
							foreach($fila as $col=>$valor){
								if($col != 'idNoticia'){
									echo "<br><b style='text-transform:uppercase;'> " . $col . "</b>" . ": " . $fila[$col] . "<br><br>";
								}
							}
							echo "</td>";?>
							<?php if(esAdmin()){ ?>
								<td> 
								
									<form action="../Controllers/Noticia_CONTROLLER.php" method="post" name="showall">
										<input type="hidden" name="idNoticia" value="<?php echo $fila['idNoticia']; ?>"/>
										
										<button onclick="document.forms[1].submit" name="orden" value="DELETE1">  <img src="../img/erase.png" height="30px"/> </i> </button> 
										<button onclick="document.forms[1].submit" name="orden" value="EDIT">  <img src="../img/edit.png" height="30px"/> </button>  
										<!-- <button onclick="document.forms[1].submit" name="orden" value="SHOWCURRENT">  <img src="../img/detail.png" height="30px"/> </button> -->
									</form>
								</td>
							<?php } ?>
							</tr>
						<?php 
						}
					}?>
				</tbody>
			</table> 
		</section>

<?php
			include '../Views/Footer.php';
		}
	}
?>