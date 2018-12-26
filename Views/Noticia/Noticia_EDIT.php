<?php
	class Noticia_EDIT{
		var $lista;
		var $enlace;
		var $datos;
		
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
		<div class="general">	
		<fieldset><legend class="TituloFormulario">Editar Noticia</legend>
			<form method="POST" accept-charset="UTF-8" id="formularioEditNoticia" name="formularioEditNoticia" style="display: inline-block;" action="../Controllers/Noticia_CONTROLLER.php">
				<table class="formulario">
					<trp>
						<tdp> idNoticia </tdp>
						<tdp><input required type="text" value="<?php echo $this->datos[0]; ?>" id="idNoticia" name="idNoticia" size="5" maxlength="5" readonly /></tdp>
					</trp>
					<tri>
						<tdi> Asunto </tdi>
						<tdi><input required type="text" value="<?php echo $this->datos[1]; ?>" id="asunto" name="asunto" size="50" maxlength="50" /></tdi>
					</tri>
					<trp>
						<tdp> Mensaje </tdp>
						<tdp><textarea required rows="10" cols="50" id="mensaje" name="mensaje"> <?php echo $this->datos[2];?> </textarea></trp>
					<tri>
						<tdi> Fecha </tdi>
						<tdi><input required type="date" id="fecha" name="fecha" value="<?php echo $this->datos[3]; ?>" /> </tdi>
					</tri>
					<br/><br/>
					<button type="submit" name="orden" value="EDIT"/><img src="../img/edit.png" height="30px"/>
				</table>
			</form>
		</fieldset>
		</div><?php
		include '../Views/Footer.php';
		}
	}
?>