<?php 
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=reporte_herramientas entregadas.xls');

include "../../../conexionBase/conexion.php";
$consultar_citas = 'SELECT * from herramientas_entregadas';
$resultado_citas = mysqli_query($conexion,$consultar_citas);
?> 

 
 <table border="2" cellpadding="2" cellspacing="0" width="80%">
	<tr>
		<td style="background-color: green;color:black;">Codigo de entrega </td>
		<td style="background-color: green;color:black;">Codigo de herramienta</td>
		<td style="background-color: green;color:black;">Codigo de solicitud</td>
		<td style="background-color: green;color:black;">Codigo empleado</td>
		<td style="background-color: green;color:black;">Fecha de entrega</td>
		<td style="background-color: green;color:black;">Cantidad</td>
		
		

	</tr>
	<?php
	while ($mostrar_citas = mysqli_fetch_array($resultado_citas))
	{
	?>
	<tr>
		<td  style="background-color: skyblue;"><?php echo $mostrar_citas['codigo_entrega']?></td>
				<td style="background-color: skyblue;" ><?php echo  $mostrar_citas['codigo_herramienta']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['codigo_solicitud']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['codigo_empleado']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['fecha_entregado']?></td>
				<td style="background-color: skyblue;" ><?php echo $mostrar_citas['cantidad']?></td>
				
	</tr>
	<?php } ?>
	<caption style="color: skyblue">Herramientas Entregadas</caption >
</table>