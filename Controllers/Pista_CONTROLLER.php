<?php
	session_start();
	include_once '../Functions/Autenticacion.php';
	
	if(!autenticado()){
		header('Location: ../index.php');
	}
	
	include_once '../Models/PISTA.php';
	include '../Views/Pista/Pista_ADD.php';
	include '../Views/Pista/Pista_SHOWALL.php';
	include '../Views/Pista/Pista_SEARCH.php';
	include '../Views/Pista/Pista_DELETE.php';
	include '../Views/Pista/Pista_EDIT.php';
	include '../Views/Pista/Pista_SHOWCURRENT.php';
	include '../Views/MESSAGE.php';
	
	function get_data_form(){

		$idPista = $_REQUEST['idPista'];
		$disponibilidad = $_REQUEST['disponibilidad'];
		$fecha = $_REQUEST['fecha'];
		$hora = $_REQUEST['hora'];
		
		$hora = substr($hora,0,5);
		
		$action = $_REQUEST['orden'];
		
		$pista = new Pista ($idPista, $disponibilidad, $fecha, $hora);
		
		return $pista;
	}
	
	if (!isset($_REQUEST['orden'])){ 
		$_REQUEST['orden'] = '';
	}
	//print_r($_REQUEST);
	
	switch ($_REQUEST['orden']){
		case 'ADD':
				if(count($_REQUEST) < 2){
					$pista = new Pista_ADD( array('idPista','disponibilidad', 'fecha', 'hora'),'');
				}else{
					$pista = get_data_form();
					$datos = $pista->ADD();
					new Mensaje($datos, '../Controllers/Pista_CONTROLLER.php');
				}
			break;
			
		case 'DELETE':		//Pendiente de revisar
			if(count($_REQUEST) == 4){
				$idPista = $_REQUEST['idPistas'];
				$disponibilidad = $_REQUEST['disponibilidad'];
				$fecha = $_REQUEST['fechahora'];
				
				$datos = explode(' ', $fecha);
				
				new Pista_DELETE( array('idPista','disponibilidad', 'fecha', 'hora'), array($idPista, $disponibilidad, $datos[0], $datos[1]),  '../Controllers/Pista_CONTROLLER.php');
			}else{
				$pista = get_data_form();
				//print_r($pista);
				$datos = $pista->DELETE();
				//print_r($datos);
				new Mensaje($datos, '../Controllers/Pista_CONTROLLER.php');
			}
			break;
			
		case 'EDIT':
			if(count($_REQUEST) < 5){
				$idPista = $_REQUEST['idPistas'];
				$disponibilidad = $_REQUEST['disponibilidad'];
				$fecha = $_REQUEST['fechahora'];
				
				$datos = explode(' ', $fecha);

				new Pista_EDIT( array('idPista','disponibilidad', 'fecha', 'hora'), array($idPista, $disponibilidad, $datos[0], $datos[1]),  '../Controllers/Pista_CONTROLLER.php');			
			}else{
				$pista = get_data_form();
				$datos = $pista->EDIT();
				new Mensaje($datos, '../Controllers/Pista_CONTROLLER.php');
			}
			
			break;
				
		case 'SEARCH':
			if(count($_REQUEST) < 2){
				$pista = new Pista_SEARCH( array('idPista','disponibilidad', 'fecha', 'hora'),'');
			}else{
				$Pista = get_data_form();
				$datos = $Pista -> SEARCH();
				$lista= array('idPista', 'disponibilidad', 'fechahora','');
				new Pista_SHOWALL($lista, $datos, '');
			}
			break;
		
		case 'SHOWCURRENT':
			if(count($_REQUEST) < 5){
				$idPista = $_REQUEST['idPistas'];
				$disponibilidad = $_REQUEST['disponibilidad'];
				$fecha = $_REQUEST['fechahora'];
				
				$datos = explode(' ', $fecha);
				
				new Pista_SHOWCURRENT( array('idPista','disponibilidad', 'fecha' , 'hora'), array($idPista, $disponibilidad, $datos[0], $datos[1]),  '../Controllers/Pista_CONTROLLER.php');
			}else{
				$pista = get_data_form();
				$datos = $pista->SHOWCURRENT();
				new Mensaje($datos, '../Controllers/Pista_CONTROLLER.php');
			}
		break;
		
		default:
				$pista = new Pista('','','','');
				$datos = $pista->SHOWALL();
				$lista= array('idPista', 'disponibilidad', 'fecha','hora');
				new Pista_SHOWALL($lista, $datos, '');
						
				break;
	}
?>