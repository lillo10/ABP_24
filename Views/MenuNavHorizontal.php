<?php
/* Menu de navegación horizontal debajo de la cabecera
	por 3hh731, kch3f4, j7g9n1, ymh5sa, hgdnog 
	28/11/17
*/
 include_once '../Locales/Strings_'. $_SESSION['idioma'].'.php';//Idioma
if(autenticado()){//Si está autenticado se muestra una desconexion adicional
	?><div class="bajoheader">
		<span>
			<a  class="pag" href="../index.php">
				<botonav><?php echo $strings['Main']; ?></botonav>
			</a>
			<a class="botonavder" href="../Functions/Desconectar.php">
				<botonav><?php echo $strings['Desconectarse']; ?></botonav>
			</a>
		</span>
	</div>
	<?php
}else{//Sino, registro
	?><div class="bajoheader">
				
	
		<span>
			<a class="pag" href="../index.php">
				<botonav><?php echo $strings['Main']; ?></botonav>
			</a>
			<a class="botonavder" href="../Controllers/Registro_CONTROLLER.php">
				<botonav><?php echo $strings['Registrarse']; ?></botonav> 
				 
			</a>

		</span>
	</div>
	<?php
}?>