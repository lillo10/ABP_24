<?php
/* Controller del USUARIO y las acciones que se le podrán realizar
	por 3hh731, kch3f4, j7g9n1, ymh5sa, hgdnog 
	28/11/17
*/
	session_start();
	include_once '../Functions/Autenticacion.php';
	if(!autenticado()){
		header('Location: ../index.php');
	}
	
	
	include_once '../Models/USUARIO.php';
	include '../Views/Usuario/Usuario_ADD.php';
	include '../Views/Usuario/Usuario_EDIT.php';
	include '../Views/Usuario/Usuario_SEARCH.php';
	include '../Views/Usuario/Usuario_DELETE.php';
	include '../Views/Usuario/Usuario_SHOWCURRENT.php';
	include '../Views/Usuario/Usuario_SHOWALL.php';
	include '../Views/MESSAGE.php';
	
function get_data_form(){

	$login = $_REQUEST['login'];
	$password = $_REQUEST['password'];
	$DNI = $_REQUEST['DNI'];
	$Nombre = $_REQUEST['Nombre'];
	$Apellidos = $_REQUEST['Apellidos'];
	$Telefono = $_REQUEST['Telefono'];
	$Administrador = $_REQUEST['Administrador'];

	$usuario = new Usuario($login, $password, $DNI, $Nombre, $Apellidos, $Telefono, $Administrador);
 
	return $usuario;
}
	

if (!isset($_REQUEST['orden'])){ //si no viene del formulario, no existe array POST
	$_REQUEST['orden'] = 'SHOWALL';
}
		switch ($_REQUEST['orden']){
			
			case 'ADD':
				if(tienePermisosPara('USUARI', 'ADD')){
					if(!$_POST){//Si GET
						$muestraADD = new Usuario_ADD();//Mostrar vista add
					}else{
						$usuario = get_data_form();//Si post cogemos usuario
						$respuesta = $usuario->ADD();//Y lo añadimos
						new Mensaje($respuesta, '../Controllers/Usuario_CONTROLLER.php');// y a ver qué ha pasado en la BD
					}
				}else{
					new Mensaje('Permisos insuficientes', '../index.php');
				}
			break;
				
			case 'EDIT':
				if(tienePermisosPara('USUARI', 'EDIT')){
					if(!$_POST){//Si GET
						$usuario = new Usuario($_REQUEST['login'],'','','','','','','','','');//Editar usuario seleccionado
						$usuario->_getDatosGuardados();//Rellenar con los datos de la BD
						new Usuario_EDIT($usuario);//Mostrar vista
					}else{
						$usuario = get_data_form();//Coger datos
						$respuesta = $usuario->EDIT();//Actualizarlos
						new Mensaje($respuesta, '../Controllers/Usuario_CONTROLLER.php');//A ver que pasa con la BD, qué intrigante
					}
				}else{
					new Mensaje($strings['Permisos insuficientes'], '../index.php');
				}				
			break;
				
			case 'SEARCH':
				if(tienePermisosPara('USUARI', 'SEARCH')){
					if(!$_POST){//Si GET
					$muestraSEARCH = new Usuario_SEARCH();//Mostrar vista buscadora
					}else{
						$usuario = get_data_form();//Creamos un usuario con los datos introducidos (que no insertarlo en la BD)
						$respuesta = $usuario->SEARCH();//Buscamos los datos que se parezcan a los introducidos
						new Usuario_SHOWALL($respuesta, '');//Mostramos todos los datos recuperados de la BD (showall muestra todos los datos que se le pasan)
					}
				}else{
					new Mensaje('Permisos insuficientes', '../index.php');
				}
			break;
				
			case 'DELETE':
				if(tienePermisosPara('USUARI', 'DELETE')){
					if(!$_POST){//Si GET
						$usuario = new Usuario($_REQUEST['login'],'','','','','','','','','');//Coger usuario guardado a eliminar
						$usuario->_getDatosGuardados();//Rellenar datos
						new Usuario_DELETE($usuario);//Mostrar vissta 
					}else{//Si confirma borrado llega por post
						$usuario = new Usuario($_POST['login'],'','','','','','','','','');//Clave
						$respuesta = $usuario->DELETE();//Borrar usuario con dicha clave
						new Mensaje($respuesta, '../Controllers/Usuario_CONTROLLER.php');//A ver qué pasa en la BD
					}
				}else{
					new Mensaje('Permisos insuficientes', '../index.php');
				}				
			break;
				
			case 'SHOWCURRENT':
				if(tienePermisosPara('USUARI', 'SHOWCU')){
					if(!$_POST){//Si GET
						$usuario = new Usuario($_REQUEST['login'],'','','','','','','','','');//Coger clave del usuario
						$respuesta = $usuario->SHOWCURRENT();
						if(!is_string($respuesta)){//NO debería ser posible pedir un showcurrent de algo no existente pero si esp osible retornará un string, así que si no es un string es un usuario
							$usuario->_getDatosGuardados();
							new Usuario_SHOWCURRENT($usuario);//Mostrar al usuario rellenado
						}else{//sino
							new Mensaje($respuesta, '../Controllers/Usuario_CONTROLLER.php');//Mensaje de error, que hay muchos
						}
					}
				}else{
					new Mensaje('Permisos insuficientes', '../index.php');
				}				
			break;
				
			case 'SHOWALL':
				if(tienePermisosPara('USUARI', 'SHOWAL')){
					$usuario = new Usuario('','','','','','','','','','');//No necesitamos usuario para buscar (pero sí para acceder a la BD)
					$respuesta = $usuario->SHOWALL();//Todos los datos de la BD estarán aqúi
					new Usuario_SHOWALL($respuesta, '');//Le pasamos todos los datos de la BD
				}else{
					new Mensaje('Permisos insuficientes', '../index.php');
				}				
			break;
				
			case 'ASIGNA':
				if(tienePermisosPara('USUARI', 'ASIGNA')){
					$usuario = new Usuario($_REQUEST['login'],'','','','','','','','','');//Coger clave del usuario
					if(!isset($_REQUEST['IdGrupo'])){
						new Mensaje('No se ha indicado grupo', '../Controllers/Usuario_CONTROLLER.php');//Mensaje de el grupo no existe
					}
					$respuesta = $usuario->ASIGNARGRUPO($_REQUEST['IdGrupo']);//Cambiar el grupo del usuario
					new Mensaje($respuesta, '../Controllers/Usuario_CONTROLLER.php');//Mensaje de cambiar el grupo, tanto sea fallido como no
				}else{
					new Mensaje('Permisos insuficientes', '../index.php');
				}				
			break;
			
			case 'DESASI':
				if(tienePermisosPara('USUARI', 'DESASI')){
					$usuario = new Usuario($_REQUEST['login'],'','','','','','','','','');//Coger clave del usuario
					if(!isset($_REQUEST['IdGrupo'])){
						new Mensaje('No se ha indicado grupo', '../Controllers/Usuario_CONTROLLER.php');//Mensaje de el grupo no existe
					}
					$respuesta = $usuario->DESASIGNARGRUPO($_REQUEST['IdGrupo']);//Cambiar el grupo del usuario
					new Mensaje($respuesta, '../Controllers/Usuario_CONTROLLER.php');//Mensaje de cambiar el grupo, tanto sea fallido como no
				}else{
					new Mensaje('Permisos insuficientes', '../index.php');
				}
				
				break;
				
			default:// default, se hace un showall
				if(tienePermisosPara('USUARI', 'SHOWAL')){
					$usuario = new Usuario('','','','','','','','','','');//No necesitamos usuario para buscar (pero sí para acceder a la BD)
					$respuesta = $usuario->SHOWALL();//Todos los datos de la BD estarán aqúi
					new Usuario_SHOWALL($respuesta, '');//Le pasamos todos los datos de la BD
				}else{
					new Mensaje('Permisos insuficientes', '../index.php');
				}				
			break;
		}
?>