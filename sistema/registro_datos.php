<?php 
	session_start();

	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['num_reporte']) || empty($_POST['descripcion']) || empty($_POST['tipo_registro']) || empty($_POST['motivo']) || empty($_POST['departamento']) || empty($_POST['ubicacion_fisica']) || empty($_POST['ubicacion_sistema']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		}else{

			$num_reporte = $_POST['num_reporte'];
			$marca = $_POST['marca'];
			$modelo = $_POST['modelo'];
			$no_serie = $_POST['no_serie'];
			$descripcion = $_POST['descripcion'];
			$tipo_registro = $_POST['tipo_registro'];
			$motivo = $_POST['motivo'];
			$departamento = $_POST['departamento'];
			$ubicacion_fisica = $_POST['ubicacion_fisica'];
			$ubicacion_sistema = $_POST['ubicacion_sistema'];
			$usuario_id = $_SESSION['idUser'];

			$result = 0;

			if(is_numeric($num_reporte) and $num_reporte !=0)
			{
				$query = mysqli_query($conection,"SELECT * FROM datos WHERE num_reporte= '$num_reporte' ");
				$result = mysqli_fetch_array($query);
			}
			if($result > 0){
				$alert='<p class="msg_error">El Numero de Reporte ya existe</p>';
			}else{
				$query_insert = mysqli_query($conection,"INSERT INTO datos(num_reporte,marca,modelo,no_serie,descripcion,tipo_registro,motivo,departamento,ubicacion_fisica,ubicacion_sistema,usuario_id) VALUES('$num_reporte','$marca','$modelo','$no_serie','$descripcion','$tipo_registro','$motivo','$departamento','$ubicacion_fisica','$ubicacion_sistema','$usuario_id')");

				if($query_insert){
					$alert='<p class="msg_save">Dato Creado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al crear el Dato</p>';
				}
			}
		}
		
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";  ?>
	<title>Registro Dato</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1><i class="far fa-calendar-plus"></i> Registro Dato</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="num_reporte">Numero de Reporte</label>
				<input type="number" name="num_reporte" id="num_reporte" placeholder="Numero de Reporte">

				<label for="marca">Marca</label>
				<input type="text" name="marca" id="marca" placeholder="Marca">

				<label for="modelo">Modelo</label>
				<input type="text" name="modelo" id="modelo" placeholder="Modelo">

				<label for="no_serie">Numero de Serie</label>
				<input type="number" name="no_serie" id="no_serie" placeholder="Numero de Serie">

				<label for="descripcion">Descripcion</label>
				<input type="text" name="descripcion" id="descripcion" placeholder="Descripcion">

				<label for="tipo_registro">Tipo de Registro</label>

				<?php 
				
					$query_tipo_registro = mysqli_query($conection,"SELECT * FROM tipo_registro");
					
					$result_tipo_registro = mysqli_num_rows($query_tipo_registro);

				?>
				<select name="tipo_registro" id="tipo_registro">
					<?php 
						if($result_tipo_registro > 0)
						{
							while ($tipo_registro = mysqli_fetch_array($query_tipo_registro)) {
					?>
							<option value="<?php echo $tipo_registro["idtipo_registro"]; ?>"><?php echo $tipo_registro["tipo_registro"] ?></option>
					<?php
							}
						}	 
					?>

				</select>

				<label for="motivo">Motivo</label>

				<?php 
					$query_motivo = mysqli_query($conection,"SELECT * FROM motivo");

					$result_motivo = mysqli_num_rows($query_motivo);

				?>
				<select name="motivo" id="motivo">
					<?php 
						if($result_motivo > 0)
						{
							while ($motivo = mysqli_fetch_array($query_motivo)) {
					?>
							<option value="<?php echo $motivo["idmotivo"]; ?>"><?php echo $motivo["motivo"] ?></option>
					<?php
							}
						}	 
					?>

				</select>

				<label for="departamento">Departamento</label>
				<input type="text" name="departamento" id="departamento" placeholder="Departamento">

				<label for="ubicacion_fisica">Ubicacion Fisica</label>
				<input type="text" name="ubicacion_fisica" id="ubicacion_fisica" placeholder="Ubicacion Fisica">

				<label for="ubicacion_sistema">Ubicacion Sistema</label>
				<input type="text" name="ubicacion_sistema" id="ubicacion_sistema" placeholder="Ubicacion Sistema">


				<button type="submit"  class="btn_save"><i class="fas fa-save"></i> Crear Dato</button>

			</form>
		</div>

	</section>
	<?php include "includes/footer.php";?>
</body>
</html>