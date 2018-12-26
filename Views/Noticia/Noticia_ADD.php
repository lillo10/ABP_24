<?php
	class Noticia_ADD{
		var $lista;
		var $enlace;
		
		function __construct ($lista, $enlace){
			$this -> lista = $lista;
			$this -> enlace = $enlace;
			$this -> toString();
		}
		function toString(){
			include '../Views/Header.php';
			include '../Views/MenuNavHorizontal.php';
			include '../Views/MenuLatIzq.php';
	?>	
		<div class="general">	
		<fieldset><legend class="TituloFormulario">Añadir Noticia</legend>
			<form method="POST" accept-charset="UTF-8" id="formularioAddNoticia" name="formularioAddNoticia" style="display: inline-block;" action="../Controllers/Noticia_CONTROLLER.php">
				<table class="formulario">
					<tri>
						<tdi> Asunto </tdi>
						<tdi><input required type="text" id="asunto" name="asunto" size="50" maxlength="50" /></tdi>
					</tri>
					<trp>
						<tdp> Mensaje </tdp>
						<tdi><textarea required rows="10" cols="50" id="mensaje" name="mensaje"> </textarea></tdi>
					</trp>
					<tri>
						<tdi> Fecha </tdi>
						<tdi><input required type="date" id="fecha" name="fecha" value="<?php echo date("Y-m-d"); ?>" /></tdi>
					</tri>
					<br/><br/>
					<button type="submit" name="orden" value="ADD"/><img src="../img/add.png" height="30px"/>
				</table>
			</form>
			<br><br> <a href='../Controllers/Index_CONTROLLER.php'>Volver </a> 
		</fieldset>
		</div><?php
		include '../Views/Footer.php';
		}
	}
?>