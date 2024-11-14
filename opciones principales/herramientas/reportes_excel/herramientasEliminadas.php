<?php 
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=reporte_herramientas eliminadas.xls');

include "../../../conexionBase/conexion.php";
$consultar_citas = 'SELECT * from herramienta_eliminada';
$resultado_citas = mysqli_query($conexion,$consultar_citas);

?> 

 
 <table border="2" cellpadding="2" cellspacing="0" width="80%">
	<tr>
		<td style="background-color: green;color:black;">Codigo</td>
		<td style="background-color: green;color:black;">Codigo de herramienta</td>
		<td style="background-color: green;color:black;">fecha</td>
		<td style="background-color: green;color:black;">cantidad que existia</td>
		<td style="background-color: green;color:black;">tipo</td>
		<td style="background-color: green;color:black;">descripcion</td>
        <td style="background-color: green;color:black;">identificacion empleado</td>
		
		

	</tr>
	<?php
	while ($mostrar_citas = mysqli_fetch_array($resultado_citas))
	{
	?>
	<tr>
		        <td  style="background-color: skyblue;"><?php echo $mostrar_citas['id_elimina']?></td>
				<td style="background-color: skyblue;" ><?php echo  $mostrar_citas['cod_herra']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['fecha_elimina']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['cantidad_existia']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['tipo']?></td>
				<td style="background-color: skyblue;" ><?php echo $mostrar_citas['descrip']?></td>
                <td style="background-color: skyblue;" ><?php echo  $mostrar_citas['iden_emp']?></td>
				
				
	</tr>
	<?php } ?>
	<caption style="color: skyblue">Herramientas Eliminadas</caption >
</table>