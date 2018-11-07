<?php 
/* Menu lateral izquierda para su generación

*/

include_once '../Locales/Strings_'. $_SESSION['idioma'].'.php'; 
include_once '../Functions/Autenticacion.php'; /*Autenticacion*/
if(autenticado()){//Se debería usar un switch que de los permisos pero de momento:
	//Esta sería la rama de ADMIN
	?>
	<div class="menulateralizq" >
			<div class="menudespleg">
				<a href=''><button class="menu"><botonmenuizq><?php echo $strings['Reservas']; ?></botonmenuizq></button></a>
					<div class="opciones">
						<a href=""><?php echo $strings['Añadir']; ?>  </a>
						<a href=""><?php echo $strings['Buscar']; ?>  </a>
					</div>
			</div>
	
			<div class="menudespleg">
				<a href=''><button class="menu"><?php echo $strings['Campeonatos']; ?> </button></a>
					<div class="opciones">
						<a href=""><?php echo $strings['Añadir']; ?>  </a>
						<a href=""><?php echo $strings['Buscar']; ?>  </a>
					</div>
			</div>

			<div class="menudespleg">
				<a href=''><button class="menu"><?php echo $strings['Partidos']; ?> </button></a>
					<div class="opciones">
						<a href=""><?php echo $strings['Añadir']; ?>  </a>
						<a href=""><?php echo $strings['Buscar']; ?>  </a>
					</div>
			</div>
	
			<div class="menudespleg">
				<a href=''><button class="menu"><?php echo $strings['Clases']; ?> </button></a>
					<div class="opciones">
						<a href=""><?php echo $strings['Añadir']; ?>  </a>
						<a href=""><?php echo $strings['Buscar']; ?>  </a>
					</div>
			</div>
	
	</div>
	<?php
}else{
	?>	
	<div class="menulateralizq" >
		<div class="menudespleg">
			<a href='../Controllers/Registro_CONTROLLER.php'><button class="menu"><?php echo $strings['Registrarse']; ?> </button></a>
		</div>
	</div>
	<?php
}
?>