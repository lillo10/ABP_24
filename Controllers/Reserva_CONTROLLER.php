<?php
	session_start();
	include_once '../Functions/Autenticacion.php';
	
	if(!autenticado()){
		header('Location: ../index.php');
	}
	
	include_once '../Models/RESERVA.php';
	include_once '../Models/Pista.php';
	include '../Views/Reserva/Reserva_SHOWALL.php';
	include '../Views/Reserva/Show_Pistas.php';
	include '../Views/Reserva/Search_Pistas.php';
	include '../Views/Reserva/Reserva_DELETE.php';
	include '../Views/Reserva/Reserva_SHOWCURRENT.php';
	
	include '../Views/MESSAGE.php';
	
	function get_data_form(){
	
		$idReserva = $_REQUEST['idReserva'];
		$login = $_REQUEST['login'];
		$idPista = $_REQUEST['idPista'];
		
		$action = $_REQUEST['orden'];
		
		$reserva = new Reserva ($idReserva, $login, $idPista);
		
		return $reserva;
	}
	
	if (!isset($_REQUEST['orden'])){ 
		$_REQUEST['orden'] = '';
	}
	
	switch ($_REQUEST['orden']){
		case 'RESERVAR':
			/*$numPista = $_REQUEST['numPista'];
			$fecha = $_REQUEST['fecha'];
			
			$pista = new Pista('',$numPista,'','','','');
			$idPista = $pista -> buscarPista($fecha);*/
			
			$idPista = $_REQUEST['idPista'];
			
			$pista = new Pista($idPista,'','','','','');
			$pista -> pistaOcupada();
			
			$reserva = new Reserva('*',$_SESSION['login'],$idPista);
			$datos = $reserva->RESERVAR();
			
			new Mensaje($datos, '../Controllers/Reserva_CONTROLLER.php');
				
			break;
			
		case 'DELETE1':		
			$idReserva = $_REQUEST['idReserva'];
			
			$reserva = new Reserva($idReserva,'','');
			$datos = $reserva -> SEARCH();
			
			new Reserva_DELETE( array('idReserva','login', 'pista'),$datos,  '../Controllers/Reserva_CONTROLLER.php');
			
			break;
			
		case 'DELETE2':	
			$idPista = $_REQUEST['idPista'];
			
			$pista = new Pista($idPista,'','','','','');
			$pista -> pistaLibre();
			
			$reserva = new Reserva($_REQUEST['idReserva'],'','');
			$datos = $reserva->DELETE();
			
			new Mensaje($datos, '../Controllers/Reserva_CONTROLLER.php');
			
			break;
		
		case 'SHOWCURRENT':
			if(count($_REQUEST) < 4){
				$idPista = $_REQUEST['idPista'];
				$idReserva = $_REQUEST['idReserva'];
				
				$pista = new Pista($idPista,'','','','','');
				$datos = $pista -> rellenaDatos();
				$fechahora = explode(' ', $datos[3]);
			
				$reserva = new Reserva($idReserva,'','');
				$datos2 = $reserva -> SEARCH();
					
				new Reserva_SHOWCURRENT( array('idReserva','login', 'numPista' , 'fecha', 'hora'), array($datos2[0], $datos2[1], $datos[1], $fechahora[0], $fechahora[1] ,),  '../Controllers/Reserva_CONTROLLER.php');
			}
			break;
		
		case 'SEARCH':
			if(count($_REQUEST) < 2){
				$pista = new Search_Pista( array('idReserva', 'dni', 'idPista'),'');
			}else{
				$fecha = $_REQUEST['fecha'];
				$hora = $_REQUEST['hora'];
				
				$pista = new Pista('','','',$fecha,$hora,'');
				$datos = $pista -> SEARCH_RESERVA();
				
				$lista= array('idReserva', 'dni', 'idPista');
				new Show_Pistas($lista, $datos, '');
			}
			break;

		case 'SHOWPISTAS':
			$pista = new Pista('','','','','','');
			$datos = $pista->SHOWPISTAS();
			$lista= array('', '', '');
			new Show_Pistas($lista, $datos, '');
					
			break;
				
		default:
			$reserva = new Reserva('','','');
			$datos = $reserva->SHOWALL();
			$lista= array('', '', '');
			new Reserva_SHOWALL($lista, $datos, '');
			
			break;
	}
?>