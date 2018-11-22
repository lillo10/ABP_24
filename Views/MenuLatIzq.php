<?php 
/* Menu lateral izquierda para su generación

*/

include_once '../Functions/Autenticacion.php'; /*Autenticacion*/
if(autenticado()){//Se debería usar un switch que de los permisos pero de momento:
	//Esta sería la rama de ADMIN
	?>
	<div class="menulateralizq" >

			<?php if(esAdmin()){ ?>
				<div class="menudespleg">
					<a href=''><button class="menu">Pistas</button></a>
						<div class="opciones">
							<a href="../Controllers/Pista_CONTROLLER.php?orden=ADD">Añadir Pista</a>
							<a href="../Controllers/Pista_CONTROLLER.php">Ver Pistas</a>
						</div>
				</div>
			<?php } ?>
			
			<div class="menudespleg">
				<a href=''><button class="menu"><botonmenuizq>Reservas</botonmenuizq></button></a>
					<div class="opciones">
						<a href="../Controllers/Reserva_CONTROLLER.php">Mis reservas</a>
						<a href="../Controllers/Reserva_CONTROLLER.php?orden=SHOWPISTAS">Reservar</a>
					</div>
			</div>
	
			<div class="menudespleg">
				<a href=''><button class="menu">Campeonatos</button></a>
					<div class="opciones">
						<?php
						if(esAdmin()){?>
							<a href="../Controllers/Campeonato_CONTROLLER.php?orden=ADD">Añadir campeonato</a>

						<?php
						}?>
						<a href="">Mis campeonatos</a>
						<a href="../Controllers/Campeonato_CONTROLLER.php">Lista de campeonatos</a>
					</div>
			</div>

			<div class="menudespleg">
				<a href=''><button class="menu">Partidos</button></a>
					<div class="opciones">
						<a href="../Controllers/Partido_CONTROLLER.php?action=mygames">Mis Partidos</a>
						<a href="../Controllers/Partido_CONTROLLER.php?action=list">Lista de Partidos</a>
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