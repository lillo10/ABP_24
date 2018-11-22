<?php
/*Aquí el administrador podrá añadir un partido y el usuario apuntarse a un partido
*/
session_start();
include_once '../Functions/Autenticacion.php';
if(!autenticado()){
	header('Location: ../index.php');
}
include_once '../Models/PARTIDO.php';
include '../Views/Partido/Partido_SHOWALL.php';

$partido = new Partido();

if(!$_POST){
	switch ($_GET["action"]){
		case 'mygames':
			$datos = $partido->_mygames();
			$lista = array('idPartido', 'Fecha/hora', 'idPista', 'Jugadores');
			new Partido_SHOWALL($lista, $datos, '');
		break;

		case 'list':
			$datos = $partido->_showAll();
			$lista = array('idPartido', 'Fecha/hora', 'idPista', 'Jugadores');
			new Partido_SHOWALL($lista, $datos, '');
		break;
	}
}
else{
	switch ($_REQUEST["action"]){
		case 'insert':
			if(esAdmin()){
				if(count($_REQUEST) == 1){
					include '../Views/Partido/Partido_INSERT.php';
					new Partido_INSERT();
				}
				else{
					$fecha=$_REQUEST['fecha'];
					$hora=$_REQUEST['hora'];
					$fecha_hora = "$fecha $hora:00";
					$partido->_setFecha_Hora($fecha_hora);
					$partido->_setNumPista($_REQUEST['idPista']);
					$partido->_setJugadores(0);
					$respuesta = $partido->_insertarPartido();
					include '../Views/MESSAGE.php';
					new Mensaje($respuesta, '../Controllers/Index_CONTROLLER.php');
				}
			}
			else{
				include '../Views/MESSAGE.php';
				new Mensaje("Solo un administrador puede crear partidos", '../Controllers/Index_CONTROLLER.php');
			}
		break;

		case 'putUser':
			$respuesta = $partido->_apuntarUsuario($_REQUEST['idPartido']);
			include '../Views/MESSAGE.php';
			new Mensaje($respuesta, '../Controllers/Index_CONTROLLER.php');
		break;

		case 'search':
			if(count($_REQUEST) == 1){
				include '../Views/Partido/Partido_SEARCH.php';
				new Partido_SEARCH( array('NumeroPista','Jugadores', 'Fecha', 'Hora'),'');
			}
			else{
				$fecha=$_REQUEST['fecha'];
				$hora=$_REQUEST['hora'];
				$fecha_hora = "$fecha $hora:00";
				$partido->_setFecha_Hora($fecha_hora);
				$partido->_setNumPista($_REQUEST['idPista']);
				$partido->_setJugadores($_REQUEST['jugadores']);
				$datos = $partido->_search();
				$lista= array('idPartido', 'Fecha/hora', 'idPista', 'Jugadores');
				new Partido_SHOWALL($lista, $datos, '');
			}
		break;

		case 'showUsers':
			$datos = $partido->_showUsers($_REQUEST['idPartido']);
			$lista= array('Jugadores');
			include '../Views/Partido/Partido_SHOWUSERS.php';
			new Partido_SHOWUSERS($lista, $datos, '');
		break;

		case 'delete':
			$respuesta = $partido->_deletePartido($_REQUEST['idPartido']);
			include '../Views/MESSAGE.php';
			new Mensaje($respuesta, '../Controllers/Index_CONTROLLER.php');
		break;
	}
}
?>