<?php
/*Aquí se podrá registrar una persona
*/

session_start();
include_once '../Functions/Autenticacion.php';
if(autenticado()){//Si está autenticado, no pinta nada aquí
	header('Location: ../index.php');
}

function get_data_form(){

	$login = $_REQUEST['login'];
	$password = $_REQUEST['password'];
	$DNI = $_REQUEST['DNI'];
	$Nombre = $_REQUEST['Nombre'];
	$Apellidos = $_REQUEST['Apellidos'];
	$Telefono = $_REQUEST['Telefono'];

	$usuario = new Usuario($login, $password, $DNI, $Nombre, $Apellidos, $Telefono, 'FALSE','FALSE');
 
	return $usuario;
}

if(!$_POST){//Si no se ha llegado mediante el formulario de vistaRegistro
	include '../Views/Usuario/Usuario_REGISTRO.php';//Incluir vistaRegistro
	new Usuario_REGISTRO();//Mostrar vistaRegistro	
}else{//Sino
	include '../Models/USUARIO.php';
	include '../Views/MESSAGE.php';
	$usuario = get_data_form();//Se crea un usuario
	$respuesta = $usuario->REGISTRAR();//Se registra
	
	if($respuesta != 'Usuario añadido correctamente'){//Si es un mensaje de error
		new Mensaje($respuesta, '../Controllers/Registro_CONTROLLER.php');//Se muestra
	}else{//Sino
		new Mensaje($respuesta, '../index.php');//Mensaje de registro
	}
}
?>