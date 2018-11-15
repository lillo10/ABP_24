<?php 
/* Menu lateral izquierda para su generación

*/

include_once '../Functions/Autenticacion.php'; /*Autenticacion*/
if(autenticado()){//Se debería usar un switch que de los permisos pero de momento:
	//Esta sería la rama de ADMIN
	?>
	<div class="menulateralizq" >

			<div class="menudespleg">
				<a href="../Controllers/Pista_CONTROLLER.php"><button class="menu"><botonmenuizq>Pistas</botonmenuizq></button></a>
			</div>
			
			<div class="menudespleg">
				<a href=''><button class="menu"><botonmenuizq>Reservas</botonmenuizq></button></a>
					<div class="opciones">
						<a href="">Mis reservas</a>
						<a href="">Reservar</a>
					</div>
			</div>
	
			<div class="menudespleg">
				<a href=''><button class="menu">Campeonatos</button></a>
					<div class="opciones">
						<a href="">Mis campeonatos</a>
						<a href="">Lista de campeonatos</a>
					</div>
			</div>

			<div class="menudespleg">
				<a href=''><button class="menu">Partidos</button></a>
					<div class="opciones">
						<a href="">Mis partidos</a>
						<a href="">Lista de partidos</a>
					</div>
			</div>
	
			<div class="menudespleg">
				<a href=''><button class="menu">Clases</button></a>
					<div class="opciones">
						<a href="">Mis clases</a>
						<a href="">Lista de clases</a>
					</div>
			</div>	
			<div class="menudespleg">
				<a href=''><button class="menu">Gestionar Escuela Deportiva</button></a>
					<div class="opciones">
						<a href="">Consultar Escuela Deportiva</a>
						<a href="">Gestionar Escuela Deportiva</a>
					</div>
			</div>	
	</div>
	<?php
}else{
	?>	
	<div class="menulateralizq" >
		<div class="menudespleg">
			<a href='../Controllers/Registro_CONTROLLER.php'><button class="menu">Registrarse</button></a>
		</div>
	</div>
	<?php
}
?>