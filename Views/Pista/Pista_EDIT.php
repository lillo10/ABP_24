<?php
	class Pista_EDIT{
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
	?>	
		<div class="general">	
		<fieldset><legend class="TituloFormulario">Editar Pista</legend>
			<form method="POST" accept-charset="UTF-8" id="formularioEditPista" name="formularioEditPista" style="display: inline-block;" action="../Controllers/Pista_CONTROLLER.php">
				<table class="formulario">
					<trp>
						<tdp> idPista </tdp>
						<tdp><input required type="text" value="<?php echo $this->datos[0]; ?>" id="<?php echo $this->lista[0];?>" name="<?php echo $this->lista[0];?>" size="5" maxlength="5" readonly /></tdp>
					</trp>
					<tri>
						<tdi> Número de Pista </tdi>
						<tdi><input required type="text" value="<?php echo $this->datos[1];?>" id="<?php echo $this->lista[1];?>" name="<?php echo $this->lista[1];?>" size="5" maxlength="5" /></tdi>
					</tri>
					<trp>
						<tdp> Disponibilidad </tdp>
						<tdp><input required type="text"  value="<?php echo $this->datos[2];?>" id="<?phpecho $this->lista[2];?>" name="<?php echo $this->lista[2];?>"  size="5" maxlength="5" /></tdp> 
					</trp>
					<tri>
						<tdi> Fecha </tdi>
						<tdi><input required type="date" value="<?php echo $this->datos[3];?>" id="<?php echo $this->lista[3];?>" name="<?php echo $this->lista[3];?>"/> </tdi>
					</tri>
					<trp>
						<tdp> Hora </tdp>
						<tdp><input required type="time" value="<?php echo $this->datos[4];?>" id="<?php echo $this->lista[4];?>" name="<?php echo $this->lista[4];?>" /></tdp>
					</trp>
					<tri>
						<tdi> Precio </tdi>
						<tdi><input required type="text" value="<?php echo $this->datos[5];?>"  id="<?php echo $this->lista[5];?>" name="<?php echo $this->lista[5];?>" size="5" maxlength="5" /></tdi>
					</tri>
					<br/><br/>
					<button type="submit" name="orden" value="EDIT"/><img src="../img/edit.png" height="30px"/>
				</table>
			</form>
			<br><br> <a href='../Controllers/Pista_CONTROLLER.php'>Volver </a> 
		</fieldset>
		</div><?php
		include '../Views/Footer.php';
		}
	}
?>