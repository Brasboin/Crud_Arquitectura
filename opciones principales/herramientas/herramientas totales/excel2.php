<?php 
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=reporte_herramientas totales.xls');

include "../../../conexionBase/conexion.php";
$consultar_citas = 'SELECT * from herramientas_totales';
$resultado_citas = mysqli_query($conexion,$consultar_citas);
?> 

 
 <table border="2" cellpadding="2" cellspacing="0" width="80%">
	<tr>
		<td style="background-color: green;color:black;">Codigo</td>
		<td style="background-color: green;color:black;">Cantidad en empresa</td>
		<td style="background-color: green;color:black;">Tipo</td>
		<td style="background-color: green;color:black;">Marca</td>
		<td style="background-color: green;color:black;">Descripcion</td>
		<td style="background-color: green;color:black;">Cantidad Stock</td>
		
		

	</tr>
	<?php
	while ($mostrar_citas = mysqli_fetch_array($resultado_citas))
	{
	?>
	<tr>
		<td  style="background-color: skyblue;"><?php echo $mostrar_citas['cod_herramienta']?></td>
				<td style="background-color: skyblue;" ><?php echo  $mostrar_citas['cantidad_empresa']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['tipo']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['marca']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['descrip']?></td>
				<td style="background-color: skyblue;" ><?php echo $mostrar_citas['cant_stock']?></td>
				
	</tr>
	<?php } ?>
	<caption style="color: skyblue">Herramientas Totales</caption >
</table>