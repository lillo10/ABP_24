<?php
/* Controller del Campeonato y las acciones que se le podrán realizar
	
*/
	session_start();
	include_once '../Functions/Autenticacion.php';
	if(!autenticado()){
		header('Location: ../index.php');
	}
	
	
	include_once '../Models/CAMPEONATO.php';
	include '../Views/Usuario/Campeonato_ADD.php';
	include '../Views/Usuario/Campeonato_EDIT.php';
	include '../Views/Usuario/Campeonato_DELETE.php';
	include '../Views/Usuario/Campeonato_SHOWCURRENT.php';
	include '../Views/Usuario/Campeonato_SHOWALL.php';
	include '../Views/MESSAGE.php';
	
function get_data_form(){

	$idCampeonato = $_REQUEST['idCampeonato'];
	$Periodo = $_REQUEST['Periodo'];
	$LimInscrip = $_REQUEST['LimInscrip'];
	$Categoria = $_REQUEST['Categoria'];
	$Sexo = $_REQUEST['Sexo'];

	$campeonato = new Campeonato($idCampeonato, $Periodo, $LimInscrip, $Categoria, $Sexo);
 
	return $campeonato;
}
	

if (!isset($_REQUEST['orden'])){ //si no viene del formulario, no existe array POST
	$_REQUEST['orden'] = 'SHOWALL';
}
		switch ($_REQUEST['orden']){
			
			case 'ADD':
					if(!$_POST){//Si GET
						$muestraADD = new Campeonato_ADD();//Mostrar vista add
					}else{
						$campeonato = get_data_form();//Si post cogemos campeonato
						$respuesta = $campeonato->ADD();//Y lo añadimos
						new Mensaje($respuesta, '../Controllers/Campeonato_CONTROLLER.php');// y a ver qué ha pasado en la BD
					}
				
			break;
				
			case 'EDIT':
				
					if(!$_POST){//Si GET
						$campeonato = new Campeonato($_REQUEST['idCampeonato'],'','','','');
						$campeonato->_getDatosGuardados();//Rellenar con los datos de la BD
						new Campeonato_EDIT($campeonato);//Mostrar vista
					}else{
						$campeonato = get_data_form();//Coger datos
						$respuesta = $campeonato->EDIT();//Actualizarlos
						new Mensaje($respuesta, '../Controllers/Campeonato_CONTROLLER.php');//A ver que pasa con la BD, qué intrigante
					}				
			break;
				
			case 'DELETE':
					if(!$_POST){//Si GET
						$campeonato = new Campeonato($_REQUEST['idCampeonato'],'','','','');//Coger campeonato guardado a eliminar
						$campeonato->_getDatosGuardados();//Rellenar datos
						new Campeonato_DELETE($campeonato);//Mostrar vissta 
					}else{//Si confirma borrado llega por post
						$campeonato = new Campeonato($_POST['idCampeonato'],'','','','');//Clave
						$respuesta = $campeonato->DELETE();//Borrar campeonato con dicha clave
						new Mensaje($respuesta, '../Controllers/Campeonato_CONTROLLER.php');//A ver qué pasa en la BD
					}				
			break;
				
			case 'SHOWCURRENT':
					if(!$_POST){//Si GET
						$campeonato = new Campeonato($_REQUEST['idCampeonato'],'','','','');//Coger clave del campeonato
						$respuesta = $campeonato->SHOWCURRENT();
						if(!is_string($respuesta)){//NO debería ser posible pedir un showcurrent de algo no existente pero si esp osible retornará un string, así que si no es un string es un campeonato
							$campeonato->_getDatosGuardados();
							new Campeonato_SHOWCURRENT($campeonato);//Mostrar al usuario rellenado
						}else{//sino
							new Mensaje($respuesta, '../Controllers/Campeonato_CONTROLLER.php');//Mensaje de error, que hay muchos
						}
					}				
			break;
				
			case 'SHOWALL':
					$campeonato = new Campeonato('','','','','');//No necesitamos campeonato para buscar (pero sí para acceder a la BD)
					$respuesta = $campeonato->SHOWALL();//Todos los datos de la BD estarán aqúi
					new Campeonato_SHOWALL($respuesta, '');//Le pasamos todos los datos de la BD			
			break;
				
			default:// default, se hace un showall
					$campeonato = new Campeonato('','','','','');//No necesitamos campeonato para buscar (pero sí para acceder a la BD)
					$respuesta = $campeonato->SHOWALL();//Todos los datos de la BD estarán aqúi
					new Campeonato_SHOWALL($respuesta, '');//Le pasamos todos los datos de la BD			
			break;
		}
?>