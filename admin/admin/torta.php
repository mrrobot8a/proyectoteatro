<?php
	require_once "php/conexion.php";
	$conexion=conexion();
	$sql="SELECT v.fecha , p.nombre FROM ventas as v INNER JOIN detalleventa as dv on dv.idVenta = v.id INNER JOIN productos as p on p.id = dv.idProd order by fecha";
	$result=mysqli_query($conexion,$sql);
	$valoresY=array();//montos
	$valoresX=array();//fechas

	while ($ver=mysqli_fetch_row($result)) {
		$valoresY[]=$ver[1];
		$valoresX[]=$ver[0];
	}

	$datosX=json_encode($valoresX);
	$datosY=json_encode($valoresY);
 ?>

<div id="graficaBarras"></div>

<script type="text/javascript">
	function crearCadenaBarras(json){
		var parsed = JSON.parse(json);
		var arr = [];
		for(var x in parsed){
			arr.push(parsed[x]);
		}
		return arr;
	}
</script>

<script type="text/javascript">

	datosX=crearCadenaBarras('<?php echo $datosX ?>');
	datosY=crearCadenaBarras('<?php echo $datosY ?>');

	var data = [
		{
			x: datosX,
			y: datosY,
			type: 'bar'
		}
	];

	Plotly.newPlot('graficaBarras', data);
</script>