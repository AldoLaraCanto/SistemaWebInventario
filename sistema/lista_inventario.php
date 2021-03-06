<?php 
	session_start();
	include "../conexion.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";  ?>
	<title>Reporte General del Inventario</title>
</head>
<body>
	<?php include "includes/header.php";?>
	<section id="container">
		
		<h1><i class="fas fa-warehouse"></i>  Reporte General del Inventario</h1>
		<a href="imprimir_reporte.php" class="btn_new"><i class="fa fa-download" aria-hidden="true"></i> Imprimir Reporte  <i class="fas fa-file-pdf"></i></a> 

		<form action="buscar_inventario.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<button type="submit" class="btn_search"><i class="fas fa-search"></i></button>
		</form>
		<br>

		<table>
			<tr>
				<th>ID Datos</th>
				<th>Numero de Reporte</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Numero de Serie</th>
				<th>Descripcion</th>
				<th>Tipo de Registro</th>
				<th>Nombre Motivo</th>
				<th>Area/Departamento</th>
				<th>Ubicacion Fisica</th>
				<th>Ubicacion del Sistema</th>
				<th>Fecha</th>

				<th>ID Usuarios</th>
				<th>Nombre</th>
				<th>Foto</th>
				<th>Correo</th>
				<th>Usuario</th>
				<th>Telefono</th>
				<th>Direccion</th>
				<th>Rol</th>
			</tr>

		<?php 

			$query = mysqli_query($conection,"SELECT d.iddatos, d.num_reporte, d.marca, d.modelo, d.no_serie, d.descripcion, t.tipo_registro, m.motivo, d.departamento, d.ubicacion_fisica, d.ubicacion_sistema, d.dateadd, u.idusuario, u.nombre, u.foto, u.correo, u.usuario, u.telefono, u.direccion, r.rol FROM usuario u INNER JOIN datos d ON d.usuario_id = u.idusuario INNER JOIN motivo m ON d.motivo = m.idmotivo INNER JOIN rol r ON u.rol = r.idrol INNER JOIN tipo_registro t ON d.tipo_registro = t.idtipo_registro ORDER BY iddatos ASC");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if($result > 0){
				while ($data = mysqli_fetch_array($query)) {
					if($data["no_serie"] == null){
						$no_serie = 'Sin Numero de Serie';
					}else{
						$no_serie = $data["no_serie"];
					}	
					if($data['foto'] != 'img_usuario.png') {
						$foto = 'img/uploads/'.$data['foto'];
					}else{
						$foto = 'img/'.$data['foto'];
					}
			?>

				<tr>
					<td><?php echo $data["iddatos"]; ?></td>
					<td><?php echo $data["num_reporte"]; ?></td>
					<td><?php echo $data["marca"]; ?></td>
					<td><?php echo $data["modelo"]; ?></td>
					<td><?php echo $no_serie; ?></td>
					<td><?php echo $data["descripcion"] ?></td>
					<td><?php echo $data["tipo_registro"] ?></td>
					<td><?php echo $data["motivo"] ?></td>
					<td><?php echo $data["departamento"] ?></td>
					<td><?php echo $data["ubicacion_fisica"] ?></td>
					<td><?php echo $data["ubicacion_sistema"] ?></td>
					<td><?php echo $data["dateadd"] ?></td>

					<td><?php echo $data["idusuario"]; ?></td>
					<td><?php echo $data["nombre"]; ?></td>
					<td><img src="<?php echo $foto; ?>"  style="width: 70px; height: 70px;"></td>
					<td><?php echo $data["correo"]; ?></td>
					<td><?php echo $data["usuario"]; ?></td>
					<td><?php echo $data["telefono"]; ?></td>
					<td><?php echo $data["direccion"]; ?></td>
					<td><?php echo $data["rol"] ?></td>

				</tr>

		<?php
				}
			}
		?>	
		</table>
	</section>

	<?php include "includes/footer.php";?>
</body>
</html>