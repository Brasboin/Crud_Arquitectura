<?php 
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=reporte_encargos.xls');

include "../../../../conexionBase/conexion.php";
$consultar_citas = 'SELECT * from encargos';
$resultado_citas = mysqli_query($conexion,$consultar_citas);
?> 

 
 <table border="2" cellpadding="2" cellspacing="0" width="80%">
	<tr>
		<td style="background-color: green;color:black;">Codigo encargo</td>
		<td style="background-color: green;color:black;">Identificacion del cliente</td>
		<td style="background-color: green;color:black;">codigo de empleado</td>
		<td style="background-color: green;color:black;">Fecha</td>
		<td style="background-color: green;color:black;">Codigo del paquete</td>
		
		
		

	</tr>
	
	<?php
	while ($mostrar_citas = mysqli_fetch_array($resultado_citas))
	{
	?>
	<tr>
		<td  style="background-color: skyblue;"><?php echo $mostrar_citas['cod_encargo']?></td>
				<td style="background-color: skyblue;" ><?php echo  $mostrar_citas['cod_cliente']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['cod_empleado']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['fecha']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['cod_paquetes']?></td>
				
				
				
	</tr>
	
	<?php } ?>
	<caption style="color: skyblue">Encargos registrados</caption >
</table>

