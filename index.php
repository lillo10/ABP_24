<?php
/*Si está logeado se le redirecciona a la base de datos, sino a que se logee
*/
session_start();
include_once './Functions/Autenticacion.php';

if(autenticado()){/*Si está autenticado*/
	header('Location: ./Controllers/Index_CONTROLLER.php');//Pa un lao	
}else{//Sino
	header('Location: ./Controllers/Login_CONTROLLER.php');//Pal otro
}
?>