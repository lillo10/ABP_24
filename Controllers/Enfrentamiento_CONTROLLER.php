<?php
/* Controller del Enfrentamiento y las acciones que se le podrán realizar
	
*/
	session_start();
	include_once '../Functions/Autenticacion.php';
	if(!autenticado()){
		header('Location: ../index.php');
	}
	
	
	include_once '../Models/ENFRENTAMIENTO.php';
	include '../Views/Enfrentamiento/Enfrentamiento_EDIT.php';
	include '../Views/MESSAGE.php';
	
function get_data_form(){

	$Fecha = $_REQUEST['Fecha'];
	$Grupo = $_REQUEST['Grupo'];
	$Pareja1 = $_REQUEST['Pareja1'];
	$Pareja2 = $_REQUEST['Pareja2'];
	$Resultado = $_REQUEST['Resultado'];
	$idCampeonato = $_REQUEST['idCampeonato'];

	$enfrentamiento = new Enfrentamiento($Fecha, $Grupo, $Pareja1, $Pareja2, $Resultado, $idCampeonato);
 
	return $enfrentamiento;
}
	

if (!isset($_REQUEST['orden'])){ 
	$_REQUEST['orden'] = 'EDIT';
}
		switch ($_REQUEST['orden']){
				
			case 'EDIT':
				
					if(!$_POST){//Si GET
						$idCampeonato = 
						$enfrentamiento = new Enfrentamiento('','',$_REQUEST['Pareja1'],$_REQUEST['Pareja2'],'',$_REQUEST['idCampeonato']);
						$enfrentamiento->_getDatosGuardados();//Rellenar con los datos de la BD
						new Enfrentamiento_EDIT($enfrentamiento);//Mostrar vista
					}else{
						$enfrentamiento = get_data_form();//Coger datos
						$idCampeonato = $enfrentamiento->_getidCampeonato();
						$respuesta = $enfrentamiento->EDIT();//Actualizarlos
						new Mensaje($respuesta, '../Controllers/Campeonato_CONTROLLER.php?orden=SHOWCURRENT&idCampeonato='.$idCampeonato);
					}				
			break;
		}
?>