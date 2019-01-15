<?php
/*Aquí el administrador podrá añadir una clase a la escuela deportiva
*/
session_start();
include_once '../Functions/Autenticacion.php';
if(!autenticado()){
	header('Location: ../index.php');
}
include_once '../Models/ESCUELADEPORTIVA.php';
include '../Views/EscuelaDeportiva/Escuela_SHOWALL.php';

$escuela = new Escueladeportiva();

if(!$_POST){
	switch ($_GET["action"]){
		case 'myEscuelas'://funciona
			$datos = $escuela->_showAllEscuela();
			$lista = array('idClase', 'Pista', 'Fecha', 'Precio', 'Jugadores', 'Entrenador_login', 'Tipo');
			new Escuela_SHOWALL($lista, $datos, '');
		break;

		case 'misClases'://funciona
		$datos = $escuela->_escuelaMisClases();
			$lista = array('idClase', 'Pista', 'Fecha', 'Precio', 'Jugadores', 'Entrenador_login', 'Tipo');
			new Escuela_SHOWALL($lista, $datos, '');
		break;

		case 'clasePriv':
		$datos = $escuela->_showAllEscuelaEntrenador();
			$lista = array('idClase', 'Pista', 'Fecha', 'Precio', 'Jugadores', 'Entrenador_login', 'Tipo');
			new Escuela_SHOWALL($lista, $datos, '');
		break;
	}
}
else{
	switch ($_REQUEST["action"]){
		case 'insert'://funciona
			if(count($_REQUEST) == 1){
				include '../Views/EscuelaDeportiva/Escuela_INSERT.php';
				new Escuela_INSERT();
			}
			else{
				$fecha=$_REQUEST['fecha'];
				$hora=$_REQUEST['hora'];
				$fecha_hora = "$fecha $hora:00";
				$escuela->_setPeriodo($fecha_hora);
				$escuela->_setPista($_REQUEST['numPista']);
				$escuela->_setEntrenador($_REQUEST['idEntrenador']);
				include_once '../Functions/Autenticacion.php';
				if(esEntrenador()){
					$respuesta = $escuela->_insertarClasePrivada();
				}else{
					$respuesta = $escuela->_insertarClase();
				}
				include '../Views/MESSAGE.php';
				new Mensaje($respuesta, '../Controllers/Index_CONTROLLER.php');
			}
		break;

		

		case 'putUser'://Funciona
			$respuesta = $escuela->_apuntarUsuarioClaseEscuela($_REQUEST['idClase']);
			include '../Views/MESSAGE.php';
			new Mensaje($respuesta, "../Controllers/EscuelaDeportiva_CONTROLLER.php?action=myEscuelas");
		break;

		case 'search'://Funciona
			if(count($_REQUEST) == 1){
				include '../Views/EscuelaDeportiva/Escuela_SEARCH.php';
				new Escuela_SEARCH( array('idClase','Fecha', 'Pista', 'Entrenador'),'');
			}
			else{
				$fecha=$_REQUEST['fecha'];
				$hora=$_REQUEST['hora'];
				$fecha_hora = "$fecha $hora:00";
				$escuela->_setPeriodo($fecha_hora);
				$escuela->_setPista($_REQUEST['idPista']);
				$escuela->_setEntrenador($_REQUEST['idEntrenador']);
				$datos = $escuela->_searchEscuela();
				$lista= array('idClase', 'Pista', 'Fecha', 'Precio', 'Jugadores', 'Entrenador');
				new Escuela_SHOWALL($lista, $datos, '');
			}
		break;

		case 'showUsers'://funciona
			$datos = $escuela-> _showUsersEscuela($_REQUEST['idClase']);
			$lista= array('Jugadores');
			include '../Views/EscuelaDeportiva/Escuela_SHOWUSERS.php';
			new Escuela_SHOWUSERS($lista, $datos, '');
		break;

		case 'delete'://Funciona
			$respuesta = $escuela->_deletePartidoEscuela($_REQUEST['idClase'], TRUE);
			include '../Views/MESSAGE.php';
			new Mensaje($respuesta, '../Controllers/Index_CONTROLLER.php');
		break;

		case 'delete2'://Funciona
			$respuesta = $escuela->_deletePartidoEscuela($_REQUEST['idClase'], FALSE);
			include '../Views/MESSAGE.php';
			new Mensaje($respuesta, '../Controllers/Index_CONTROLLER.php');
		break;
	}
}
?>