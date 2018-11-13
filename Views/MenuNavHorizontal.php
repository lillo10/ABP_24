<?php
/* Menu de navegación horizontal debajo de la cabecera
	
*/

if(autenticado()){//Si está autenticado se muestra una desconexion adicional
	?><div class="bajoheader">
		<span>
			<a  class="pag" href="../index.php">
				<botonav>Pagina Principal</botonav>
			</a>
			<a class="botonavder" href="../Functions/Desconectar.php">
				<botonav>Desconectarse</botonav>
			</a>
		</span>
	</div>
	<?php
}else{//Sino, registro
	?><div class="bajoheader">
				
	
		<span>
			<a class="pag" href="../index.php">
				<botonav>Pagina principal</botonav>
			</a>
			<a class="botonavder" href="../Controllers/Registro_CONTROLLER.php">
				<botonav>Registrarse</botonav> 
				 
			</a>

		</span>
	</div>
	<?php
}?>