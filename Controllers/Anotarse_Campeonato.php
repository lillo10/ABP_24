<?php
/*Si está logeado se le redirecciona a la base de datos, sino a que se logee
*/
session_start();
include_once '../Functions/Autenticacion.php';
include '../Views/Campeonato/Campeonato_SHOWALL.php';
include '../Models/CAMPEONATO.php';

if(autenticado()){/*Si está autenticado*/
	echo $_GET['idCampeonato'];
	$campeonato = new Campeonato($_GET['idCampeonato'],'','','','');
	$respuesta = $campeonato->SHOWALL_INSCRIPCION();
	new Campeonato_SHOWALL($respuesta, '');
}else{//Sino
	header('Location: ../Controllers/Login_CONTROLLER_2.php');//Pal otro
}
?>