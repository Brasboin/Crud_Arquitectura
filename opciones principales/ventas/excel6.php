<?php 
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=reporte_lista de ventas.xls');

include "../../conexionBase/conexion.php";
$consultar_citas = 'SELECT * from ventas';
$resultado_citas = mysqli_query($conexion,$consultar_citas);
?> 

 
 <table border="2" cellpadding="2" cellspacing="0" width="80%">
	<tr>
	<td style="background-color: green;color:black;">Codigo de venta</td>
		<td style="background-color: green;color:black;">Codigo de encargo</td>
		<td style="background-color: green;color:black;">Identificacion del cliente</td>
		<td style="background-color: green;color:black;">Identificacion del empleado</td>
		<td style="background-color: green;color:black;">Fecha</td>
		<td style="background-color: green;color:black;">Codigo de paquetes</td>
		
		
		
		

	</tr>
	<?php
	while ($mostrar_citas = mysqli_fetch_array($resultado_citas))
	{
	?>
	<tr>
	<td  style="background-color: skyblue;"><?php echo $mostrar_citas['cod_venta']?></td>
				<td style="background-color: skyblue;" ><?php echo  $mostrar_citas['cod_encargo']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['cod_cliente']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['cod_empleado']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['fecha']?></td>
				<td style="background-color: skyblue;" ><?php echo $mostrar_citas['cod_paquetes']?></td>
			
				
	</tr>
	<?php } ?>
	<caption style="color: skyblue">Lista ventas</caption >
</table>