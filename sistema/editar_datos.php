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

			$idDatos = $_POST['id'];
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

			$result = 0;

			if(is_numeric($num_reporte) and $num_reporte !=0)
			{
				$query = mysqli_query($conection,"SELECT * FROM datos WHERE (num_reporte= '$num_reporte' AND iddatos != $idDatos) ");	

				$result = mysqli_fetch_array($query);
				$result = count($result);
			}

			if($result > 0){
				$alert='<p class="msg_error">El Numero de Reporte ya existe, ingrese otro</p>';
			}else{

				if($num_reporte == '')
				{
					$num_reporte = 0;
				}

				$sql_update = mysqli_query($conection,"UPDATE datos SET num_reporte = $num_reporte, marca = '$marca', modelo = '$modelo', no_serie = '$no_serie', descripcion = '$descripcion', tipo_registro = '$tipo_registro', motivo = '$motivo', departamento = '$departamento', ubicacion_fisica = '$ubicacion_fisica', ubicacion_sistema = '$ubicacion_sistema' WHERE iddatos = $idDatos");


				if($sql_update){
					$alert='<p class="msg_save">Dato Actualizado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al Actualizar el Dato</p>';
				}
			}
		}
	}

	//Mostrar datos 
	if(empty($_REQUEST['id']))
	{
		header('Location: lista_datos.php');
		mysqli_close($conection);
	}
	$iddatos = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT d.iddatos, d.num_reporte, d.marca, d.modelo, d.no_serie, d.descripcion, (d.tipo_registro) AS idtipo_registro, (t.tipo_registro) AS tipo_registro, (d.motivo) AS idmotivo, (m.motivo) AS motivo, d.departamento, d.ubicacion_fisica, d.ubicacion_sistema, d.dateadd FROM datos d INNER JOIN motivo m ON d.motivo = m.idmotivo INNER JOIN tipo_registro t ON d.tipo_registro = t.idtipo_registro WHERE iddatos = $iddatos");
	
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_datos.php');
	}else{
		
		while ($data = mysqli_fetch_array($sql)) {
			$iddatos  = $data['iddatos'];
			$num_reporte = $data['num_reporte'];
			$marca = $data['marca'];
			$modelo = $data['modelo'];
			$no_serie = $data['no_serie'];
			$descripcion = $data['descripcion'];
			$tipo_registro = $data['tipo_registro'];
			$motivo = $data['motivo'];
			$departamento = $data['departamento'];
			$ubicacion_fisica = $data['ubicacion_fisica'];
			$ubicacion_sistema = $data['ubicacion_sistema'];

		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";  ?>
	<title>Actualizar Dato</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1><i class="fas fa-edit"></i> Actualizar Dato</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">

				<input type="hidden" name="id" value="<?php echo $iddatos; ?>">

				<label for="num_reporte">Numero de Reporte</label>
				<input type="number" name="num_reporte" id="num_reporte" placeholder="Numero de Reporte" value="<?php echo $num_reporte; ?>">

				<label for="marca">Marca</label>
				<input type="text" name="marca" id="marca" placeholder="Marca" value="<?php echo $marca; ?>">

				<label for="modelo">Modelo</label>
				<input type="text" name="modelo" id="modelo" placeholder="Modelo" value="<?php echo $modelo; ?>">

				<label for="no_serie">Numero de Serie</label>
				<input type="text" name="no_serie" id="no_serie" placeholder="Numero de Serie" value="<?php echo $no_serie; ?>">

				<label for="descripcion">Descripcion</label>
				<input type="text" name="descripcion" id="descripcion" placeholder="Descripcion" value="<?php echo $descripcion; ?>">

				<label for="tipo_registro">Tipo de Registro</label>
				<?php 

					include "../conexion.php";
					$query_tipo_registro = mysqli_query($conection,"SELECT * FROM tipo_registro");
					mysqli_close($conection);
					$result_tipo_resgistro = mysqli_num_rows($query_tipo_registro);

				?>
				<select name="tipo_registro" id="tipo_registro" class="notItemOne">
					<?php 
					echo $option;
						if($result_tipo_resgistro > 0)
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

					include "../conexion.php";
					$query_motivo = mysqli_query($conection,"SELECT * FROM motivo");
					mysqli_close($conection);
					$result_motivo = mysqli_num_rows($query_motivo);

				?>
				<select name="motivo" id="motivo" class="notItemOne">
					<?php 
					echo $option;
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
				<input type="text" name="departamento" id="departamento" placeholder="Departamento" value="<?php echo $departamento; ?>">

				<label for="ubicacion_fisica">Ubicacion Fisica</label>
				<input type="text" name="ubicacion_fisica" id="ubicacion_fisica" placeholder="Ubicacion Fisica" value="<?php echo $ubicacion_fisica; ?>">

				<label for="ubicacion_sistema">Ubicacion Sistema</label>
				<input type="text" name="ubicacion_sistema" id="ubicacion_sistema" placeholder="Ubicacion Sistema" value="<?php echo $ubicacion_sistema; ?>">

				<button type="submit"  class="btn_save"><i class="fas fa-save"></i> Actualizar Dato</button>

			</form>

		</div>

	</section>
	<?php include "includes/footer.php";?>
</body>
</html>