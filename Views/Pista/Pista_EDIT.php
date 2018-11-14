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
					<tri>
						<tdi><?php echo $this->lista[0];?></tdi>
						<tdi><input required type="text" value="<?php echo $this->datos[0]; ?>" id="<?php echo $this->lista[0];?>" name="<?php echo $this->lista[0];?>" size="5" maxlength="5" /></tdi>
						<tdi><img id="loginABot" height="20px" src="../img/red-button.png"/></tdi><tdi><texto-correccion id="loginABotText"></texto-correccion></tdi>
					</tri>
					<trp>
						<tdp><?php echo $this->lista[1];?></tdp>
						<tdp><input required type="text"  value="<?php echo $this->datos[1];?>" id="<?php echo $this->lista[1];?>" name="<?php echo $this->lista[1];?>" size="10" maxlength="10" value="<?php ?>"/></tdp>
						<tdp><img id="passwordABot" height="20px" src="../img/red-button.png"/></tdp><tdp><texto-correccion id="passwordABotText"></texto-correccion></tdp>
					</trp>
					<tri>
						<tdi><?php echo $this->lista[2];?></tdi>
						<tdi><input required type="date" value="<?php echo $this->datos[2];?>" id="<?php echo $this->lista[2];?>" name="<?php echo $this->lista[2];?>"/> </tdi>
						<tdi><img id="DNIABot" height="20px" src="../img/red-button.png"/></tdi><tdi><texto-correccion id="DNIABotText"></texto-correccion></tdi>
					</tri>
					<trp>
						<tdp><?php echo $this->lista[3];?></tdp>
						<tdp><input required type="time" value="<?php echo $this->datos[3];?>" id="<?php echo $this->lista[3];?>" name="<?php echo $this->lista[3];?>" /></tdp>
						<tdi><img id="DNIABot" height="20px" src="../img/red-button.png"/></tdi><tdi><texto-correccion id="DNIABotText"></texto-correccion></tdi>
					</trp>
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