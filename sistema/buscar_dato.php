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
		<?php 
			$busqueda = strtolower($_REQUEST['busqueda']);
			if(empty($busqueda))
			{
				header("location: lista_datos.php");
			}
		?>

		
		<h1><i class="far fa-address-card"></i> Lista de Datos</h1>
		<a href="registro_datos.php" class="btn_new"><i class="fas fa-user-plus"></i> Crear Dato</a>

		<form action="buscar_dato.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<button ype="submit" class="btn_search"><i class="fas fa-search"></i></button>
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
				<th>Departamento</th>
				<th>Ubicacion Fisica</th>
				<th>Ubicacion del Sistema</th>
				<th>Fecha</th>
				<th>Acciones</th>
			</tr>

		<?php 

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

			$sql_register = mysqli_query($conection,"SELECT COUNT(*) as iddatos FROM datos
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
																	    dateadd LIKE '%$busqueda%'
																	    $tipo_registro
																	    $motivo
																	)");
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


			$query = mysqli_query($conection,"SELECT d.iddatos, d.num_reporte, d.marca, d.modelo, d.no_serie, d.descripcion, t.tipo_registro, m.motivo, d.departamento, d.ubicacion_fisica, d.ubicacion_sistema, d.dateadd FROM datos d INNER JOIN motivo m ON d.motivo = m.idmotivo INNER JOIN tipo_registro t ON d.tipo_registro = t.idtipo_registro WHERE(
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
																				d.dateadd LIKE '%$busqueda%')
																				ORDER BY d.iddatos ASC LIMIT $desde,$por_pagina");
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
		<?php 
			if($iddatos != 0)
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