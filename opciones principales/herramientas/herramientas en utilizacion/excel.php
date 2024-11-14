<?php 
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=reporte_herramientas utilizadas.xls');

include "../../../conexionBase/conexion.php";
$consultar_citas = 'SELECT * from herramientas_ocupadas';
$resultado_citas = mysqli_query($conexion,$consultar_citas);
?> 

 
 <table border="2" cellpadding="2" cellspacing="0" width="80%">
	<tr>
		<td style="background-color: green;color:black;">Codigo de salida</td>
		<td style="background-color: green;color:black;">Codigo de empleado</td>
		<td style="background-color: green;color:black;">Cantidad</td>
		<td style="background-color: green;color:black;">Lugar</td>
		<td style="background-color: green;color:black;">Fecha de salida</td>
		<td style="background-color: green;color:black;">codigo de la herramienta</td>
		
		

	</tr>
	<?php
	while ($mostrar_citas = mysqli_fetch_array($resultado_citas))
	{
	?>
	<tr>
		<td  style="background-color: skyblue;"><?php echo $mostrar_citas['id_reg_salida']?></td>
				<td style="background-color: skyblue;" ><?php echo  $mostrar_citas['cod_emp']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['cantidad']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['lugar']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['fecha_salida']?></td>
				<td style="background-color: skyblue;" ><?php echo $mostrar_citas['cod_herramienta']?></td>
				
	</tr>
	<?php } ?>
	<caption style="color: skyblue">Herramientas utilizadas</caption >
</table>