<?php
	class Pista_ADD{
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
		<fieldset><legend class="TituloFormulario">Añadir Pista</legend>
			<form method="POST" accept-charset="UTF-8" id="formularioAddPista" name="formularioAddPista" style="display: inline-block;" action="../Controllers/Pista_CONTROLLER.php">
				<table class="formulario">
					<tri>
						<tdi> Número de Pista </tdi>
						<tdi><input required type="text" id="<?php echo $this->lista[1];?>" name="<?php echo $this->lista[1];?>" size="5" maxlength="5" /></tdi>
					</tri>
					<trp>
						<tdp> Disponibilidad </tdp>
						<tdp><select required id="<?php echo $this->lista[2];?>" name="<?php echo $this->lista[2];?>">
							  <option value="SI"> SI </option>
							  <option value="NO"> NO </option>
						</select></tdp>
					</trp>
					<tri>
						<tdi> Fecha </tdi>
						<tdi><input required type="date" id="<?php echo $this->lista[3];?>" name="<?php echo $this->lista[3];?>"  onkeydown="return false" /></tdi>
					</tri>
					<trp>
						<tdp> Hora </tdp>
						<tdp><select required id="<?php echo $this->lista[4];?>" name="<?php echo $this->lista[4];?>">
							  <option value="9:00"> 9:00 </option>
							  <option value="10:30"> 10:30 </option>
							  <option value="12:00"> 12:00 </option>
							  <option value="13:30"> 13:30 </option>
							  <option value="15:00"> 15:00 </option>
							  <option value="16:30"> 16:30 </option>
							  <option value="18:00"> 18:00 </option>
							  <option value="19:30"> 19:30 </option>
							  <option value="21:00"> 21:00 </option>
						</select></tdp>
					</trp>
					<tri>
						<tdi> Precio </tdi>
						<tdi><input required type="text" id="<?php echo $this->lista[5];?>" name="<?php echo $this->lista[5];?>" size="5" maxlength="5" /></tdi>
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