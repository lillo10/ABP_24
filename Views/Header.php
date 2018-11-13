<?php
/* Header generador de html con el head y el header

	*/
	if (session_status() == PHP_SESSION_NONE) {//Sino existe la sesion, se comienza
		session_start();
	}
?>

<html>
<head>
	<meta charset="utf-8">
	
	<link href="../css/style.css" type="text/css" rel="stylesheet"  media="(min-width:380px)">	
	<title>PadelClub</title>
	<div style="min-width: 960px; margin: 0 auto;">
	<script type="text/javascript" src="../js/md5.js"></script>
	<link rel="stylesheet" type="text/css" href="../js/tigra-calendar/tcal.css">
	<script type="text/javascript" src="../js/tigra-calendar/tcal.js"></script>
	<?php 
	?>
	<script type="text/javascript" src="../js/javascript.php"></script><!--Esto es el js, pero como php para poder meter los $string-->
	<script type="text/javascript" src="../js/Usuario_JAVASCRIPT.php"></script>
	
</head>

<?php
//include '../Functions/Autenticacion.php';
if(autenticado()){//Si autenticado se muestra usuario 
?>
<header>
	<headertext>Padel Club</headertext><br/>
	<span class="botonavder">
			<a href="#">
					<boton-header><?php echo $_SESSION['login']; ?></boton-header>
			</a>
			<a href="../Functions/Desconectar.php">
					<boton-header><img height="20" src="../img/logout.png"/></boton-header>
			</a>
	</span>
</header><?php
}else{/*Sino no, solo usuario desconectado */
	?>
	<header>
		
				<a class="favicon">
					
		  </a>
		<headertext>Padel CLub</headertext><br/>
		<span class="botonavder">
				<a href="#">
						<boton-header>Usuario: Desconectado</boton-header>
				</a>
				<a href="../Controllers/Login_CONTROLLER.php">
						<boton-header><img height="20" src="../img/login.png"/></boton-header>
				</a>
		</span>
</header>
<?php
}?>