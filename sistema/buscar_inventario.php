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
		<?php 
			$busqueda = strtolower($_REQUEST['busqueda']);
			if(empty($busqueda))
			{
				header("location: lista_inventario.php");
			}
		?>

		
		<h1><i class="fas fa-warehouse"></i> Reporte General del Inventario</h1>

		<form action="buscar_inventario.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<button type="submit" class="btn_search"><i class="fas fa-search"></i></button>
		</form>
		<br>
		<br>
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
			$rol = '';
			if($busqueda == 'encargado'){
				$rol = "OR rol LIKE '%1%' ";
			}else if($busqueda == 'verificador'){
				$rol = "OR rol LIKE '%2%' ";
			}

			$tipo_registro = '';
			if($busqueda == 'mueble'){
				$tipo_registro = "OR tipo_registro LIKE '%1%' ";
			}else if($busqueda == 'inmueble'){
				$tipo_registro = "OR tipo_registro LIKE '%2%' ";
			}

			$motivo = '';
			if($busqueda == 'por cambio de vice-rector'){
				$motivo = "OR motivo LIKE '%1%' ";
			}else if($busqueda == 'cambio de secretario academico'){
				$motivo = "OR motivo LIKE '%2%' ";
			}else if($busqueda == 'cambio de administrador'){
				$motivo = "OR motivo LIKE '%3%' ";
			}else if($busqueda == 'revision de rutina'){
				$motivo = "OR motivo LIKE '%4%' ";
			}else if($busqueda == 'por cambio de coordinador'){
				$motivo = "OR motivo LIKE '%5%' ";
			}else if($busqueda == 'cambio jefatura'){
				$motivo = "OR motivo LIKE '%6%' ";
			}else if($busqueda == 'por cambio de director'){
				$motivo = "OR motivo LIKE '%7%' ";
			}else if($busqueda == 'solicitado por la dependencia'){
				$motivo = "OR motivo LIKE '%8%' ";
			}else if($busqueda == 'revision por prueba selectiva'){
				$motivo = "OR motivo LIKE '%9%' ";
			}else if($busqueda == 'cambio por el secretario de rectoria'){
				$motivo = "OR motivo LIKE '%10%' ";
			}else if($busqueda == 'por revision periodica'){
				$motivo = "OR motivo LIKE '%11%' ";
			}else if($busqueda == 'por revision programada'){
				$motivo = "OR motivo LIKE '%12%' ";
			}else if($busqueda == 'por cambio de rector'){
				$motivo = "OR motivo LIKE '%13%' ";
			}

			$sql_register = mysqli_query($conection,"SELECT COUNT(*) as idusuario FROM usuario AND iddatos FROM datos
																	WHERE
																	(
																	    iddatos LIKE '%$busqueda%' OR
																	    num_reporte LIKE '%$busqueda%' OR
																	    marca LIKE '%$busqueda%' OR
																	    modelo LIKE '%$busqueda%' OR
																	    no_serie LIKE '%$busqueda%' OR
																	    descripcion LIKE '%$busqueda%' OR
																	    departamento LIKE '%$busqueda%' OR
																	    ubicacion_fisica LIKE '%$busqueda%' OR
																	    ubicacion_sistema LIKE '%$busqueda%' OR
																	    dateadd LIKE '%$busqueda%' OR
																	    idusuario LIKE '%$busqueda%' OR
																	    nombre LIKE '%$busqueda%' OR
																	    correo LIKE '%$busqueda%' OR
																	    usuario LIKE '%$busqueda%' OR
																	    telefono LIKE '%$busqueda%' OR
																	    direccion LIKE '%$busqueda%' 
																	    $tipo_registro
																	    $motivo
																	    $rol
																	)");

			$query = mysqli_query($conection,"SELECT d.iddatos, d.num_reporte, d.marca, d.modelo, d.no_serie, d.descripcion, t.tipo_registro, m.motivo, d.departamento, d.ubicacion_fisica, d.ubicacion_sistema, d.dateadd, u.idusuario, u.nombre, u.foto, u.correo, u.usuario, u.telefono, u.direccion, r.rol FROM usuario u INNER JOIN datos d ON d.usuario_id = u.idusuario INNER JOIN motivo m ON d.motivo = m.idmotivo INNER JOIN rol r ON u.rol = r.idrol INNER JOIN tipo_registro t ON d.tipo_registro = t.idtipo_registro WHERE(
																				d.iddatos LIKE '%$busqueda%' OR
																				d.num_reporte LIKE '%$busqueda%' OR
																				d.marca LIKE '%$busqueda%' OR
																				d.modelo LIKE '%$busqueda%' OR
																				d.no_serie LIKE '%$busqueda%' OR
																				d.descripcion LIKE '%$busqueda%' OR
																				t.tipo_registro LIKE '%$busqueda%' OR
																				m.motivo LIKE '%$busqueda%' OR
																				d.departamento LIKE '%$busqueda%' OR
																				d.ubicacion_fisica LIKE '%$busqueda%' OR
																				d.ubicacion_sistema LIKE '%$busqueda%' OR
																				d.dateadd LIKE '%$busqueda%' OR
																				u.idusuario LIKE '%$busqueda%' OR
																				u.nombre LIKE '%$busqueda%' OR
																				u.correo LIKE '%$busqueda%' OR
																				u.telefono LIKE '%$busqueda%' OR
																				u.direccion LIKE '%$busqueda%' OR
																				r.rol LIKE '%$busqueda%')
																				ORDER BY d.iddatos ASC");
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
					<td><img src="<?php echo $foto; ?>" style="width: 70px; height: 70px;"></td>
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