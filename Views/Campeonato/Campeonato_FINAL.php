<?php

	
class Campeonato_FINAL{  // declaración de clase
	
	var $resultado;//Las tuplas a mostrar
	var $clasg1;
	var $clasg2;

	// declaración constructor de la clase
	function __construct($respuesta){
		$this->resultado = $respuesta;
		$this->clasg1 = $this->resultado[0];
		$this->clasg2 = $this->resultado[1];
		

		$this->toString();
	} // fin del constructor

	// declaración de método pinta()
	// muestra por pantall html con los valores de los atributos de la clase
	// y un hiperenlace para volver al script php que la invocó
	function toString(){
		include '../Views/Header.php';
		include '../Views/MenuNavHorizontal.php';
		include '../Views/MenuLatIzq.php';

		$grupo1;
		$grupo2;
		$i = 0;
		
		while($i<4){
			$fila=$this->clasg1->fetch_row();
			$grupo1[$i] = $fila[0];

			$fila2=$this->clasg2->fetch_row();
			$grupo2[$i] = $fila2[0];

			$i++;
		}

		?>
		<div class='general'>
		<h1>Fase Final</h1>
		<table border='1' cellspacing='1' cellpadding='1'>
		<tr><td colspan='2' width='120'><b>Cuartos</b></td></td><td colspan='2' width='120'><b>Semifinal</b></td></td><td colspan='2' width='120'><b>Final</b></td><td width='120'><b>Ganador</b></td></tr>
		<tr><td colspan='2'>&nbsp;</td><td colspan='2' rowspan='2'></td><td colspan='2' rowspan='4'></td><td rowspan='8'></td></tr>
		<tr><td><b><?php echo $grupo1[0]; ?></b></td><td width='20'></td></tr>
		<tr><td align='center'>VS</td><td></td><td>Ganador Cuartos 1</td><td width='20'></td></tr>
		<tr><td><b><?php echo $grupo2[3]; ?></b></td><td></td><td rowspan='3' align='center'>VS</td><td></td></tr>
		<tr><td colspan='2'></td><td></td><td>Ganador Semifinal 1</td><td width='20'></td></tr>
		<tr><td><b><?php echo $grupo1[2]; ?></b></td><td></td><td></td><td rowspan='7' align='center'>VS</td><td></td></tr>
		<tr><td align='center'>VS</td><td></td><td>Ganador Cuartos 2<td></td><td></td></tr>
		<tr><td><b><?php echo $grupo2[1]; ?></b></td><td></td><td colspan='2' rowspan='3'></td><td></td></tr>
		<tr><td colspan='2'></td><td></td><td>Campeón</td></tr>
		<tr><td><b><?php echo $grupo1[1]; ?></b></td><td></td><td></td><td rowspan='8'></td></tr>
		<tr><td align='center'>VS</td><td></td><td>Ganador Cuartos 3</td><td></td><td></td></tr>
		<tr><td><b><?php echo $grupo2[2]; ?></b></td><td></td><td rowspan='3' align='center'>VS</td><td></td><td></td></tr>
		<tr><td colspan='2'></td><td></td><td>Ganador Semifinal 2</td><td></td></tr>
		<tr><td><b><?php echo $grupo1[3]; ?></b></td><td></td><td></td><td colspan='2' rowspan='3'></td></tr>
		<tr><td align='center'>VS</td><td></td><td>Ganador Cuartos 4</td><td></td></tr>
		<tr><td><b><?php echo $grupo2[0]; ?></b></td><td></td><td colspan='2'></td></tr>
		</table>

		<br><br><br><br><br><br><br><br>
		</div>
			
<?php		include '../Views/Footer.php';	

} 
	
		
		// fin método pinta()
} //fin de class muestradatos
 ?>