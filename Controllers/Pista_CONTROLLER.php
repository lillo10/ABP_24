<?php
	session_start();
	include_once '../Functions/Autenticacion.php';
	
	if(!autenticado()){
		header('Location: ../index.php');
	}
	
	include_once '../Models/PISTA.php';
	include_once '../Models/RESERVA.php';
	include '../Views/Pista/Pista_ADD.php';
	include '../Views/Pista/Pista_SHOWALL.php';
	include '../Views/Pista/Pista_SEARCH.php';
	include '../Views/Pista/Pista_DELETE.php';
	include '../Views/Pista/Pista_EDIT.php';
	include '../Views/Pista/Pista_SHOWCURRENT.php';
	include '../Views/MESSAGE.php';
	
	function get_data_form(){
	
		if(!isset($_REQUEST['idPistas'])){
			$idPista = '';
		}else{
			$idPista = $_REQUEST['idPistas'];
		}
		$numPista = $_REQUEST['numPista'];
		$disponibilidad = $_REQUEST['disponibilidad'];
		$fecha = $_REQUEST['fecha'];
		$hora = $_REQUEST['hora'];
		$hora = substr($hora,0,5);
		$precio = $_REQUEST['precio'];
		
		$action = $_REQUEST['orden'];
		
		$pista = new Pista ($idPista, $numPista, $disponibilidad, $fecha, $hora, $precio);
		
		return $pista;
	}
	
	if (!isset($_REQUEST['orden'])){ 
		$_REQUEST['orden'] = '';
	}
	
	switch ($_REQUEST['orden']){
		case 'ADD':
				if(count($_REQUEST) < 2){
					$pista = new Pista_ADD( array('idPista', 'numPista' ,'disponibilidad', 'fecha', 'hora', 'precio'),'');
				}else{
					$pista = get_data_form();
					$datos = $pista->ADD();
					new Mensaje($datos, '../Controllers/Pista_CONTROLLER.php');
				}
			break;
			
		case 'DELETE1':	
			$idPista = $_REQUEST['idPista'];
			
			$pista = new Pista($idPista, '','','','','');
			$datos = $pista -> rellenaDatos();
			$fechahora = explode(' ', $datos[3]);
		
			new Pista_DELETE( array('idPistas','numPista','disponibilidad', 'fecha', 'hora', 'precio'), array($datos[0], $datos[1], $datos[2], $fechahora[0], $fechahora[1], $datos[4]),  '../Controllers/Pista_CONTROLLER.php');

			break;
			
		case 'DELETE2':		
			$reserva = new Reserva('','',$_REQUEST['idPista']);
			$pista = new Pista ($_REQUEST['idPista'],'','','','','');
			$reserva -> borrarReservaDePista();
			$datos = $pista->DELETE();
			new Mensaje($datos, '../Controllers/Pista_CONTROLLER.php');
		
			break;
			
		case 'EDIT':
			if(count($_REQUEST) < 3){
				$idPista = $_REQUEST['idPista'];
				
				$pista = new Pista($idPista, '','','','','');
				$datos = $pista -> rellenaDatos();
				$fechahora = explode(' ', $datos[3]);
				
				new Pista_EDIT( array('idPistas','numPista','disponibilidad', 'fecha', 'hora', 'precio'), array($datos[0], $datos[1], $datos[2], $fechahora[0], $fechahora[1], $datos[4]),  '../Controllers/Pista_CONTROLLER.php');
			}else{
				$pista = get_data_form();
				$datos = $pista->EDIT();
				new Mensaje($datos, '../Controllers/Pista_CONTROLLER.php');
			}
			
			break;
				
		case 'SEARCH':
			if(count($_REQUEST) < 2){
				$pista = new Pista_SEARCH( array('idPistas','numPista','disponibilidad', 'fecha', 'hora', 'precio'),'');
			}else{
				$pista = get_data_form();
				$datos = $pista -> SEARCH();
				$lista= array('idPistas','numPista','disponibilidad', 'fecha', 'hora', 'precio');
				new Pista_SHOWALL($lista, $datos, '');
			}
			break;
		
		case 'SHOWCURRENT':
			if(count($_REQUEST) < 3){
				$idPista = $_REQUEST['idPista'];
				
				$pista = new Pista($idPista, '','','','','');
				$datos = $pista -> rellenaDatos();
				$fechahora = explode(' ', $datos[3]);
				new Pista_SHOWCURRENT( array('idPistas','numPista','disponibilidad', 'fecha', 'hora', 'precio'), array($datos[0], $datos[1], $datos[2], $fechahora[0], $fechahora[1], $datos[4]),  '../Controllers/Pista_CONTROLLER.php');
			}else{
				$pista = get_data_form();
				$datos = $pista->SHOWCURRENT();
				new Mensaje($datos, '../Controllers/Pista_CONTROLLER.php');
			}
		break;
		
		default:
				$pista = new Pista('','','','','','');
				$datos = $pista->SHOWALL();
				$lista= array('idPista', 'numPistas','disponibilidad', 'fecha','hora', 'precio');
				new Pista_SHOWALL($lista, $datos, '');
						
				break;
	}
?>