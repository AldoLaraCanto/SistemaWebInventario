<?php 
	session_start();
	include "../conexion.php";

	if(!empty($_POST))
	{
		$iddatos = $_POST['iddatos'];

		$query_delete = mysqli_query($conection,"DELETE FROM datos WHERE iddatos = $iddatos");
		mysqli_close($conection);

		if($query_delete){
			header("location: lista_datos.php");
		}else{
			echo "Error al Eliminar";
		}
	}



	if(empty($_REQUEST['id']))
	{
		header("location: lista_datos.php");
		mysqli_close($conection);
	}else{
	
		$iddatos = $_REQUEST['id'];

		$query = mysqli_query($conection, "SELECT d.iddatos, d.num_reporte, d.marca, d.modelo, d.no_serie, d.descripcion, t.tipo_registro, m.motivo, d.departamento, d.ubicacion_fisica, d.ubicacion_sistema, d.dateadd FROM datos d INNER JOIN motivo m ON d.motivo = m.idmotivo INNER JOIN tipo_registro t ON d.tipo_registro = t.idtipo_registro WHERE d.iddatos = $iddatos");
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				$num_reporte = $data['num_reporte'];
				$descripcion =$data['descripcion'];
				$tipo_registro = $data['tipo_registro'];
				$num_reporte = $data['num_reporte'];
				$descripcion = $data['descripcion'];
				$tipo_registro = $data['tipo_registro'];
				$motivo = $data['motivo'];
				$departamento = $data['departamento'];
				$ubicacion_fisica = $data['ubicacion_fisica'];
				$ubicacion_sistema = $data['ubicacion_sistema'];


			}
		}else{
			header("location: lista_datos.php");
		}
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";  ?>
	<title>Eliminar Dato</title>
</head>
<body>
	<?php include "includes/header.php";?>
	<section id="container">
		<div class="data_delete">

			<i class="fas fa-calendar-times fa-7x" style="color: red"></i>
			<br>
			<br>
			<h2>¿Estas seguro de eliminar el siguiente registro?</h2>
			<p>Numero de Reporte: <span><?php echo $num_reporte; ?></span></p>
			<p>Descripcion: <span><?php echo $descripcion; ?></span></p>
			<p>Tipo de Registro: <span><?php echo $tipo_registro; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="iddatos" value="<?php echo $iddatos; ?>">
				<a href="lista_datos.php" class="btn_cancel"><i class="fas fa-ban"></i> Cancelar</a>
				<button type="submit" class="btn_ok"><i class="fas fa-trash-alt"></i> Eliminar</button>
			</form>
		</div>


	</section>

	<?php include "includes/footer.php";?>
</body>
</html>