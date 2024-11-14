<?php 
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=reporte_lista de paquetes.xls');

include "../../../conexionBase/conexion.php";
$consultar_citas = 'SELECT * from paquetes';
$resultado_citas = mysqli_query($conexion,$consultar_citas);
?> 

 
 <table border="2" cellpadding="2" cellspacing="0" width="80%">
	<tr>
		<td style="background-color: green;color:black;">Codigo de paquete </td>
		<td style="background-color: green;color:black;">Valor</td>
		<td style="background-color: green;color:black;">Descripcion</td>
		
		
		

	</tr>
	<?php
	while ($mostrar_citas = mysqli_fetch_array($resultado_citas))
	{
	?>
	<tr>
		<td  style="background-color: skyblue;"><?php echo $mostrar_citas['cod_paquete']?></td>
				<td style="background-color: skyblue;" ><?php echo  $mostrar_citas['valor']?></td>
				<td style="background-color: skyblue;"><?php echo $mostrar_citas['descrip']?></td>
			
				
	</tr>
	<?php } ?>
	<caption style="color: skyblue">Lista de paquetes</caption >
</table>