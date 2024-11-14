<?php 
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=reporte_herramientas editadas.xls');

include "../../../conexionBase/conexion.php";
$consultar_citas = 'SELECT * from actualizaciones';
$resultado_citas = mysqli_query($conexion,$consultar_citas);
?> 

 
 <table border="2" cellpadding="2" cellspacing="0" width="80%">
	<tr>
		<td style="background-color: green;color:black;">Codigo</td>
		<td style="background-color: green;color:black;">Codigo de herramienta</td>
		<td style="background-color: green;color:black;">identificación empleado</td>
		<td style="background-color: green;color:black;">fecha</td>
		<td style="background-color: green;color:black;">cantidad antigua de herramienta</td>
		<td style="background-color: green;color:black;">marca antigua</td>
        <td style="background-color: green;color:black;">descripcion antigua</td>
        <td style="background-color: green;color:black;">tipo antigua</td>
        <td style="background-color: green;color:black;">cantidad nueva de herramienta</td>
		<td style="background-color: green;color:black;">marca nueva</td>
        <td style="background-color: green;color:black;">descripcion nueva</td>
        <td style="background-color: green;color:black;">tipo nueva</td>
		
		

	</tr>
	<?php
	while ($mostrar_citas = mysqli_fetch_array($resultado_citas))
	{
	?>
	<tr>
		<td  style="background-color: skyblue;"><?php echo $mostrar_citas['id_actualizacion']?></td>
				<td style="background-color: skyblue;" ><?php echo  $mostrar_citas['cod_herramienta']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['iden_emp']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['fecha']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['cantidad_ant']?></td>
				<td style="background-color: skyblue;" ><?php echo $mostrar_citas['marca_ant']?></td>

                <td style="background-color: skyblue;" ><?php echo  $mostrar_citas['descrip_ant']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['tipo_ant']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['cantidad_new']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['marca_new']?></td>
				<td style="background-color: skyblue;" ><?php echo $mostrar_citas['descrip_new']?></td>
				<td style="background-color: skyblue;" ><?php echo $mostrar_citas['tipo_new']?></td>
	</tr>
	<?php } ?>
	<caption style="color: skyblue">Herramientas Editadas</caption >
</table>