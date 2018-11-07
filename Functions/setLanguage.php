<?php

	session_start();
	$_SESSION['idioma'] = $_POST['idioma'];/*Post del idioma seleccionado*/
	header('Location: '. $_SERVER["HTTP_REFERER"]);/*Redireccionamiento a de donde se viene*/
?>