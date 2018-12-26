<?php
	session_start();
	include_once '../Functions/Autenticacion.php';
	
	if(!autenticado()){
		header('Location: ../index.php');
	}

	include_once '../Models/NOTICIA.php';
	include '../Views/Noticia/Noticia_ADD.php';
	include '../Views/Noticia/Noticia_SHOWALL.php';
	include '../Views/Noticia/Noticia_DELETE.php';
	include '../Views/Noticia/Noticia_EDIT.php';
	include '../Views/MESSAGE.php';

	
	if (!isset($_REQUEST['orden'])){ 
		$_REQUEST['orden'] = '';
	}
	
	function get_data_form(){
	
		$asunto = $_REQUEST['asunto'];
		$mensaje = $_REQUEST['mensaje'];
		$fecha = $_REQUEST['fecha'];
		
		$noticia = new Noticia ('', $asunto, $mensaje, $fecha);
		
		return $noticia;
	}
	
	function get_data_form2(){
	
		$idNoticia = $_REQUEST['idNoticia'];
		$asunto = $_REQUEST['asunto'];
		$mensaje = $_REQUEST['mensaje'];
		$fecha = $_REQUEST['fecha'];
		
		$noticia = new Noticia ($idNoticia, $asunto, $mensaje, $fecha);
		
		return $noticia;
	}
	
	switch ($_REQUEST['orden']){
		case 'ADD':
				if(count($_REQUEST) < 2){
					$noticia = new Noticia_ADD( array('idNoticia', 'asunto' ,'mensaje', 'fecha'),'');
				}else{
					$noticia = get_data_form();
					$datos = $noticia->ADD();
					$respuesta = $noticia -> obtenerEmail();
				
					new Mensaje($datos, '../Controllers/Noticia_CONTROLLER.php');
				}
			break;
		
		case 'DELETE1':
			$idNoticia = $_REQUEST['idNoticia'];
			
			$noticia = new Noticia($idNoticia, '','','');
			$datos = $noticia -> rellenaDatos();
		
			new Noticia_DELETE( array('idNoticia','asunto','mensaje', 'fecha'), $datos,  '../Controllers/Noticia_CONTROLLER.php');

			break;
		
		case 'DELETE2':		
			$idNoticia = $_REQUEST['idNoticia'];
			
			$noticia = new Noticia($idNoticia, '','','');
			$datos = $noticia->DELETE();
			new Mensaje($datos, '../Controllers/Noticia_CONTROLLER.php');
		
			break;
		
		case 'EDIT':
			if(count($_REQUEST) < 3){
				$idNoticia = $_REQUEST['idNoticia'];
				
				$noticia = new Noticia($idNoticia,'','','');
				$datos = $noticia -> rellenaDatos();
				
				new Noticia_EDIT( array('idNoticia', 'asunto', 'mensaje', 'fecha'), $datos,  '../Controllers/Noticia_CONTROLLER.php');
			}else{
				$noticia = get_data_form2();
				$datos = $noticia->EDIT();
				new Mensaje($datos, '../Controllers/Noticia_CONTROLLER.php');
			}
			
			break;
		
		default:
			$noticia = new Noticia('','','','');
			$datos = $noticia->SHOWALL();
			$lista= array('idNoticia', 'asunto','mensaje', 'fecha');
			new Noticia_SHOWALL($lista, $datos, '');
					
			break;
				/*$noticia = new Noticia();
				$respuesta = $noticia -> obtenerEmail();
				
				new Mensaje($respuesta, '../Controllers/Noticia_CONTROLLER.php');*/
				/*$para      = 'gofrango96@gmail.com';
				$titulo    = 'TITULO';
				$mensaje   = 'MENSAJE DE PRUEBA';
				$cabeceras = 'From: webmaster@example.com' . "\r\n" .
					'Reply-To: webmaster@example.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();

				mail($para, $titulo, $mensaje, $cabeceras);*/
			break;
	}
	
?>