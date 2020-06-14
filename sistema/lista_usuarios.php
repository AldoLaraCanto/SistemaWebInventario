<?php 
	session_start();
	if($_SESSION['rol'] != 1){
		header("location: ./");
	}
	include "../conexion.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";  ?>
	<title>Lista de Usuarios</title>
</head>
<body>
	<?php include "includes/header.php";?>
	<section id="container">
		
		<h1><i class="far fa-address-card"></i> Lista de Usuarios</h1>
		<a href="registro_usuario.php" class="btn_new"><i class="fas fa-user-plus"></i> Crear Usuario</a>
		<table>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Correo</th>
				<th>Usuario</th>
				<th>Telefono</th>
				<th>Direccion</th>
				<th>Rol</th>
				<th>Acciones</th>
			</tr>

		<?php 
			$query = mysqli_query($conection,"SELECT u.idusuario, u.nombre, u.correo, u.usuario, u.telefono, u.direccion, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol ORDER BY idusuario ASC");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if($result > 0){
				while ($data = mysqli_fetch_array($query)) {	

			?>

				<tr>
					<td><?php echo $data["idusuario"]; ?></td>
					<td><?php echo $data["nombre"]; ?></td>
					<td><?php echo $data["correo"]; ?></td>
					<td><?php echo $data["usuario"]; ?></td>
					<td><?php echo $data["telefono"]; ?></td>
					<td><?php echo $data["direccion"]; ?></td>
					<td><?php echo $data["rol"] ?></td>
					<td>
						<a class="link_edit" href="editar_usuario.php?id=<?php echo $data["idusuario"]; ?>"><i class="fas fa-edit"></i> Editar</a>
						|
						<a class="link_delete" href="eliminar_confirmar_usuario.php?id=<?php echo $data["idusuario"]; ?>"><i class="fas fa-user-times"></i> Eliminar</a>
					</td>
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