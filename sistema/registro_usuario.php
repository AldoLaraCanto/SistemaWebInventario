<?php 
	session_start();
	if($_SESSION['rol'] != 1){
		header("location: ./");
	}

	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['telefono']) || empty($_POST['direccion']) || empty($_POST['rol']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		}else{

			$nombre = $_POST['nombre'];
			$email = $_POST['correo'];
			$user = $_POST['usuario'];
			$clave = $_POST['clave'];
			$telefono = $_POST['telefono'];
			$direccion = $_POST['direccion'];
			$rol = $_POST['rol'];

			$foto = $_FILES['foto'];
			$nombre_foto = $foto['name'];
			$type = $foto['type'];
			$url_temp = $foto['tmp_name'];

			$imgUsuario = 'img_usuario.png';

			if($nombre_foto != ''){

				$destino = 'img/uploads/';
				$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
				$imgUsuario = $img_nombre.'.jpg';
				$src = $destino.$imgUsuario;
			}

			$query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario= '$user' AND correo = '$email' ");

			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El correo o el usuario ya existe</p>';
			}else{
				$query_insert = mysqli_query($conection,"INSERT INTO usuario(nombre,correo,usuario,clave,telefono,direccion,rol,foto) VALUES('$nombre','$email','$user','$clave','$telefono','$direccion','$rol','$imgUsuario')");
				if($query_insert){
					
					if($nombre_foto != '') {
						move_uploaded_file($url_temp,$src);
					}

					$alert='<p class="msg_save">Usuario creado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al crear el usuario</p>';
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
	<title>Registro Usuario</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1><i class="fas fa-user-plus"></i> Registro Usuario</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post" enctype="multipart/form-data">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">

				<label for="correo">Correo Electronico</label>
				<input type="email" name="correo" id="correo" placeholder="Correo Electronico">

				<label for="usuario">Usuario</label>
				<input type="text" name="usuario" id="usuario" placeholder="Usuario">

				<label for="clave">Clave</label>
				<input type="password" name="clave" id="clave" placeholder="Clave de acceso">

				<label for="telefono">Telefono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Telefono">

				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion">

				<label for="rol">Tipo de Usuario</label>

				<?php 
					$query_rol = mysqli_query($conection,"SELECT * FROM rol");
					mysqli_close($conection);
					$result_rol = mysqli_num_rows($query_rol);

				?>
				<select name="rol" id="rol">
					<?php 
						if($result_rol > 0)
						{
							while ($rol = mysqli_fetch_array($query_rol)) {
					?>
							<option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"] ?></option>
					<?php
							}
						}	 
					?>

				</select>

				<div class="photo">
					<label for="foto">Foto</label>
		        		<div class="prevPhoto">
		        		<span class="delPhoto notBlock">X</span>
		        		<label for="foto"></label>
		        		</div>
		        		<div class="upimg">
		        		<input type="file" name="foto" id="foto">
		        		</div>
		        		<div id="form_alert"></div>
				</div>

				<button type="submit"  class="btn_save"><i class="fas fa-save"></i> Crear Usuario</button>
			</form>
		</div>

	</section>
	<?php include "includes/footer.php";?>
</body>
</html>