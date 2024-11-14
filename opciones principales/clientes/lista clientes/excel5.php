<?php 
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=reporte_lista de clientes.xls');

include "../../../conexionBase/conexion.php";
$consultar_citas = 'SELECT * from clientes';
$resultado_citas = mysqli_query($conexion,$consultar_citas);
?> 

 
 <table border="2" cellpadding="2" cellspacing="0" width="80%">
	<tr>
	<td style="background-color: green;color:black;">Identificacion</td>
		<td style="background-color: green;color:black;">Nombre</td>
		<td style="background-color: green;color:black;">Apellido</td>
		<td style="background-color: green;color:black;">Direccion</td>
		<td style="background-color: green;color:black;">Telefono</td>
		<td style="background-color: green;color:black;">Correo</td>
		
		
		
		

	</tr>
	<?php
	while ($mostrar_citas = mysqli_fetch_array($resultado_citas))
	{
	?>
	<tr>
	<td  style="background-color: skyblue;"><?php echo $mostrar_citas['iden_cli']?></td>
				<td style="background-color: skyblue;" ><?php echo  $mostrar_citas['nom_cli']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['ape_cli']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['direc_cli']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['tel_cli']?></td>
				<td style="background-color: skyblue;" ><?php echo $mostrar_citas['correo']?></td>
			
				
	</tr>
	<?php } ?>
	<caption style="color: skyblue">Lista de clientes</caption >
</table>