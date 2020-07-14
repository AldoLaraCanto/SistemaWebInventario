<?php 
	session_start();
	include "../conexion.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";  ?>
	<title>Lista de Datos</title>
</head>
<body>
	<?php include "includes/header.php";?>
	<section id="container">
		
		<h1><i class="fas fa-clipboard-list"></i> Lista de Datos</h1>
		<a href="registro_datos.php" class="btn_new"><i class="far fa-calendar-plus"></i> Crear Dato</a>
		
		<form action="buscar_dato.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<button type="submit" class="btn_search"><i class="fas fa-search"></i></button>
		</form>

		<table>
			<tr>
				<th>ID</th>
				<th>Numero de Reporte</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Numero de Serie</th>
				<th>Descripcion</th>
				<th>Tipo de Registro</th>
				<th>Nombre del Motivo</th>
				<th>Area/Departamento</th>
				<th>Ubicacion Fisica</th>
				<th>Ubicacion del Sistema</th>
				<th>Fecha</th>
				<th>Acciones</th>

			</tr>

		<?php 
			$sql_register = mysqli_query($conection,"SELECT COUNT(*) as iddatos FROM datos");
			$result_register = mysqli_fetch_array($sql_register);
			$iddatos = $result_register['iddatos'];

			$por_pagina = 4;

			if(empty($_GET['pagina'])){
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}
			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($iddatos / $por_pagina);

			$query = mysqli_query($conection,"SELECT d.iddatos, d.num_reporte, d.marca, d.modelo, d.no_serie, d.descripcion, t.tipo_registro, m.motivo, d.departamento, d.ubicacion_fisica, d.ubicacion_sistema, d.dateadd FROM datos d INNER JOIN motivo m ON d.motivo = m.idmotivo INNER JOIN tipo_registro t ON d.tipo_registro = t.idtipo_registro ORDER BY iddatos ASC LIMIT $desde,$por_pagina");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {	
					if($data["no_serie"] == null){
						$no_serie = 'Sin Numero de Serie';
					}else{
						$no_serie = $data["no_serie"];
					}
			?>

				<tr>
					<td><?php echo $data["iddatos"]; ?></td>
					<td><?php echo $data["num_reporte"]; ?></td>
					<td><?php echo $data["marca"]; ?></td>
					<td><?php echo $data["modelo"]; ?></td>
					<td><?php echo $no_serie; ?></td>
					<td><?php echo $data["descripcion"]; ?></td>
					<td><?php echo $data["tipo_registro"]; ?></td>
					<td><?php echo $data["motivo"]; ?></td>
					<td><?php echo $data["departamento"]; ?></td>
					<td><?php echo $data["ubicacion_fisica"]; ?></td>
					<td><?php echo $data["ubicacion_sistema"]; ?></td>
					<td><?php echo $data["dateadd"]; ?></td>

					<td>
						<a class="link_edit" href="editar_datos.php?id=<?php echo $data["iddatos"]; ?>"><i class="fas fa-edit"></i> Editar</a>
						|<br>
						<a class="link_delete" href="eliminar_confirmar_dato.php?id=<?php echo $data["iddatos"]; ?>"><i class="fas fa-calendar-times"></i> Eliminar</a>
					</td>
				</tr>

		<?php
				}
			}
		?>	
		</table>

		<div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			?>
				<li><a href="?pagina=<?php echo 1; ?>"><i class="fas fa-step-backward"></i></a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><i class="fas fa-backward"></i></a></li>
			<?php 
				}
				for($i=1; $i <= $total_paginas; $i++){
					if($i == $pagina){
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}
				if($pagina != $total_paginas)
				{
			?>
				<li><a href="?pagina=<?php echo $pagina+1; ?>"><i class="fas fa-forward"></i></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?>"><i class="fas fa-step-forward"></i></a></li>
			<?php } ?>
			</ul>
		</div>

	</section>

	<?php include "includes/footer.php";?>
</body>
</html>