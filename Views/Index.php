<?php
/* Clase vista index para la página principal
*/
	
class Index{  // declaración de clase


	// declaración constructor de la clase
	// se inicializa con los valores del formulario y el valor del botón submit pulsado
	function __construct(){
		$this->toString();
	} // fin del constructor

	// declaración de método pinta()
	// muestra por pantall html con los valores de los atributos de la clase
	// y un hiperenlace para volver al script php que la invocó
	function toString(){
		include '../Views/Header.php';
		include '../Views/MenuNavHorizontal.php';
		include '../Views/MenuLatIzq.php';?>
		
		<html height="100%">
			<body height="100%">
			<div style="background-image: url('http://flamingtext.com/net-fu/proxy_form.cgi?script=supermarket-logo&text=<?php echo 'Bienvenido'. "%20" .$_SESSION['login']."%0D%0D%0D%0D"; ?>&doScale=true&scaleWidth=1900&scaleHeight=1080&_loc=generate&imageoutput=true') ;
						height: 100%; background-position: center; background-repeat: no-repeat; background-size: auto;"></div>
			</body>
		</html>

		<?php
	}

}