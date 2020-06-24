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
		<?php 
			$busqueda = strtolower($_REQUEST['busqueda']);
			if(empty($busqueda))
			{
				header("location: lista_usuarios.php");
			}
		?>

		
		<h1><i class="far fa-address-card"></i> Lista de Usuarios</h1>
		<a href="registro_usuario.php" class="btn_new"><i class="fas fa-user-plus"></i> Crear Usuario</a>

		<form action="buscar_usuario.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<button ype="submit" class="btn_search"><i class="fas fa-search"></i></button>
		</form>

		<table>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Correo</th>
				<th>Usuario</th>
				<th>Telefono</th>
				<th>Direccion</th>
				<th>Rol</th>
				<th>Foto</th>
				<th>Acciones</th>
			</tr>

		<?php 

			$rol = '';
			if($busqueda == 'encargado'){
				$rol = "OR rol LIKE '%1%' ";
			}else if($busqueda == 'verificador'){
				$rol = "OR rol LIKE '%2%' ";
			}
			$sql_register = mysqli_query($conection,"SELECT COUNT(*) as idusuario FROM usuario
																	WHERE
																	(
																	    idusuario LIKE '%$busqueda%' OR
																	    nombre LIKE '%$busqueda%' OR
																	    correo LIKE '%$busqueda%' OR
																	    usuario LIKE '%$busqueda%' OR
																	    telefono LIKE '%$busqueda%' OR
																	    direccion LIKE '%$busqueda%'
																	    $rol
																	)");
			$result_register = mysqli_fetch_array($sql_register);
			$idusuario = $result_register['idusuario'];

			$por_pagina = 4;

			if(empty($_GET['pagina'])){
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}
			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($idusuario / $por_pagina);


			$query = mysqli_query($conection,"SELECT u.idusuario, u.nombre, u.correo, u.usuario, u.telefono, u.direccion, r.rol, u.foto FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE (
																	    u.idusuario LIKE '%$busqueda%' OR
																	    u.nombre LIKE '%$busqueda%' OR
																	    u.correo LIKE '%$busqueda%' OR
																	    u.usuario LIKE '%$busqueda%' OR
																	    u.telefono LIKE '%$busqueda%' OR
																	    u.direccion LIKE '%$busqueda%' OR
																	    r.rol LIKE '%$busqueda%') 
																		ORDER BY u.idusuario ASC LIMIT $desde,$por_pagina");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if($result > 0){
				
				while ($data = mysqli_fetch_array($query)) {	
					if($data['foto'] != 'img_usuario.png') {
						$foto = 'img/uploads/'.$data['foto'];
					}else{
						$foto = 'img/'.$data['foto'];
					}
			?>

				<tr>
					<td><?php echo $data["idusuario"]; ?></td>
					<td><?php echo $data["nombre"]; ?></td>
					<td><?php echo $data["correo"]; ?></td>
					<td><?php echo $data["usuario"]; ?></td>
					<td><?php echo $data["telefono"]; ?></td>
					<td><?php echo $data["direccion"]; ?></td>
					<td><?php echo $data["rol"] ?></td>
					<td><img src="<?php echo $foto; ?>" style="width: 70px; height: 70px;"></td>
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
		<?php 
			if($idusuario != 0)
			{
		?>
		<div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			?>
				<li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>"><i class="fas fa-step-backward"></i></a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>"><i class="fas fa-backward"></i></a></li>
			<?php 
				}
				for($i=1; $i <= $total_paginas; $i++){
					if($i == $pagina){
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
					}
				}
				if($pagina != $total_paginas)
				{
			?>
				<li><a href="?pagina=<?php echo $pagina+1; ?>&busqueda=<?php echo $busqueda; ?>"><i class="fas fa-forward"></i></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?>"><i class="fas fa-step-forward"></i></a></li>
			<?php } ?>
			</ul>
		</div>
		<?php } ?>
	</section>
	<?php include "includes/footer.php";?>
</body>
</html>