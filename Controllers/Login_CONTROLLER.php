<?php
/*Aquí se podrá logear una persona
*/
session_start();
include_once '../Functions/Autenticacion.php';
if(autenticado()){//Si está autenticado, no pinta nada aquí
	header('Location: ../index.php');
}

if(!isset($_REQUEST['login']) && (!isset($_REQUEST['password']))){//Si no se ha llegado mediante el formulario de vistaLogin
	include '../Views/Usuario/Usuario_LOGIN.php';//Incluir vistaLogin
	new Usuario_LOGIN();//Mostrar vistaLogin
}else{//Sino
	include '../Models/USUARIO.php';

		$usuario = new Usuario($_REQUEST['login'],$_REQUEST['password'],'','','','','','');//Se crea un usuario con solamente el login y pass
		$respuesta = $usuario->LOGIN();//Se comprueba que exista en la BD

	if($respuesta == 'true'){//Si se ha encontrado ese login con esa contraseña
		session_start();
		$_SESSION['login'] = $_REQUEST['login'];//Inicializar session login a lo enviado
		header('Location: ../index.php');//Ahora que se ha logeado se vuelve al index
	}else{//Sino
		include '../Views/MESSAGE.php';
		new Mensaje($respuesta, './Login_CONTROLLER.php');//Mednsaje que ha dado la consulta en la BD
	}
}
?>