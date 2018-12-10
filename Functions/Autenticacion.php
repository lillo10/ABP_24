<?php

function autenticado(){
	if(isset($_SESSION['login'])){//Si existe, existe
		return true;
	}else{//Si no existe, no existe
		return false;
	}
}

function esAdmin(){	
	include_once '../Models/USUARIO.php';
	
	if(!autenticado()){
		return false;
	}
	
	$usuario = new Usuario($_SESSION['login'],'','','','','','','','');
	
	$usuario->_getDatosGuardados();
	if ($usuario->_getAdministrador() == 'TRUE') {
		return true;		
	}
	else{
		return false;
	}
	
}

function esEntrenador(){	
	include_once '../Models/USUARIO.php';
	
	if(!autenticado()){
		return false;
	}
	
	$usuario = new Usuario($_SESSION['login'],'','','','','','','','');
	
	$usuario->_getDatosGuardados();
	if ($usuario->_getEntrenador() == 'TRUE') {
		return true;		
	}
	else{
		return false;
	}
	
}
?>
