<?php 
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=reporte_empleados.xls');

include "../../../conexionBase/conexion.php";
$consultar_citas = 'SELECT * from empleados';
$resultado_citas = mysqli_query($conexion,$consultar_citas);
?> 

 
 <table border="2" cellpadding="2" cellspacing="0" width="80%">
	<tr>
		<td style="background-color: green;color:black;">Identificacion></td>
		<td style="background-color: green;color:black;">Nombre</td>
		<td style="background-color: green;color:black;">Apellido</td>
		<td style="background-color: green;color:black;">Direccion</td>
		<td style="background-color: green;color:black;">Telefono</td>
		<td style="background-color: green;color:black;">RH</td>
		
		

	</tr>
	<?php
	while ($mostrar_citas = mysqli_fetch_array($resultado_citas))
	{
	?>
	<tr>
		<td  style="background-color: skyblue;"><?php echo $mostrar_citas['iden_emp']?></td>
				<td style="background-color: skyblue;" ><?php echo  $mostrar_citas['nom_emp']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['ape_emp']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['direc_emp']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['tel_emp']?></td>
				<td style="background-color: skyblue;" ><?php echo $mostrar_citas['rh']?></td>
				
	</tr>
	<?php } ?>
	<caption style="color: skyblue">Empleados Contratados</caption >
</table>