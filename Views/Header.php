<?php
/* Header generador de html con el head y el header

	*/
	if (session_status() == PHP_SESSION_NONE) {//Sino existe la sesion, se comienza
		session_start();
	}
	if (!isset($_SESSION['idioma'])) {//Si no existe idioma, se pone español
		$_SESSION['idioma'] = 'es';
	}
	include_once '../Locales/Strings_'. $_SESSION['idioma'].'.php';//Idioma
?>

<html>
<head>
	<meta charset="utf-8">
	
	<link href="../css/style.css" type="text/css" rel="stylesheet"  media="(min-width:380px)">	
	<title><?php echo $strings['Titulo']; ?></title>
	<div style="min-width: 960px; margin: 0 auto;">
	<script type="text/javascript" src="../js/md5.js"></script>
	<link rel="stylesheet" type="text/css" href="../js/tigra-calendar/tcal.css">
	<script type="text/javascript" src="../js/tigra-calendar/tcal.js"></script>
	<?php //Con el fin de cargar mensajes de error en el idioma elegido, o todo lo que tenga que ver con el .js
	/*if($_SESSION['idioma'] == 'es'){
	
	}else if($_SESSION['idioma'] == 'gal'){
		
	}else{
	
	}*/
	?>
	<script type="text/javascript" src="../js/javascript.php"></script><!--Esto es el js, pero como php para poder meter los $string-->
	<script type="text/javascript" src="../js/Usuario_JAVASCRIPT.php"></script>
	
</head>

<?php
//include '../Functions/Autenticacion.php';
if(autenticado()){//Si autenticado se muestra usuario 
?>
<header>
	<form id="formularioIdioma" name="formularioIdioma" method="post" action="../Functions/setLanguage.php">
		<input type="hidden" id="idioma" name="idioma" value="es"/>
	</form>
	<span class="botonavder">
			<a href="#">
				<img src="../img/es.png"  alt="<?php echo $strings['español']; ?>" onClick="document.getElementById('idioma').value='es', document.getElementById('formularioIdioma').submit()" height="14" width="25"/>
			</a>
			<a href="#">
				<img src="../img/en.png"  alt="<?php echo $strings['ingles']; ?>" onClick="document.getElementById('idioma').value='en', document.getElementById('formularioIdioma').submit()" height="13" width="25"/>
			</a>
			<a href="#">
				<img src="../img/gal.png"  alt="<?php echo $strings['gallego']; ?>" onClick="document.getElementById('idioma').value='gal', document.getElementById('formularioIdioma').submit()" height="13" width="25"/>
			</a>
	</span>

	<headertext><?php echo $strings['header']; ?></headertext><br/>
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
		<form id="formularioIdioma" name="formularioIdioma" method="post" action="../Functions/setLanguage.php">
			<input type="hidden" id="idioma" name="idioma" value="es"/>
		</form>
		<span class="botonavder">
				<a href="#">
					<img src="../img/es.png"  alt="<?php echo $strings['español']; ?>" onClick="document.getElementById('idioma').value='es', document.getElementById('formularioIdioma').submit()" height="14" width="25"/>
				</a>
				<a href="#">
					<img src="../img/en.png"  alt="<?php echo $strings['ingles']; ?>" onClick="document.getElementById('idioma').value='en', document.getElementById('formularioIdioma').submit()" height="13" width="25"/>
				</a>
				<a href="#">
					<img src="../img/gal.png"  alt="<?php echo $strings['gallego']; ?>" onClick="document.getElementById('idioma').value='gal', document.getElementById('formularioIdioma').submit()" height="13" width="25"/>
				</a>
		
		</span>
				<a class="favicon">
					
		  </a>
		<headertext><?php echo $strings['header']; ?></headertext><br/>
		<span class="botonavder">
				<a href="#">
						<boton-header><?php echo $strings['Usuario'], ' '; echo $strings['Desconectado']; ?></boton-header>
				</a>
				<a href="../Controllers/Login_CONTROLLER.php">
						<boton-header><img height="20" src="../img/login.png"/></boton-header>
				</a>
		</span>
</header>
<?php
}?>