<?php
/*Si está logeado se le redirecciona a la base de datos, sino a que se logee
*/
session_start();
include_once '../Functions/Autenticacion.php';

include '../Views/Index.php';

if(autenticado()){/*Si está autenticado*/
	new Index();
}else{//Sino
	header('Location: ../Controllers/Login_CONTROLLER.php');//Pal otro
}
?>