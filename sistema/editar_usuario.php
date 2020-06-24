<?php 
	session_start();
	if($_SESSION['rol'] != 1){
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['telefono']) || empty($_POST['direccion']) || empty($_POST['rol']) || empty($_POST['foto_actual']) || empty($_POST['foto_remove']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios</p>';
		}else{

			$idUsuario = $_POST['id'];
			$nombre = $_POST['nombre'];
			$email = $_POST['correo'];
			$user = $_POST['usuario'];
			$clave = $_POST['clave'];
			$telefono = $_POST['telefono'];
			$direccion = $_POST['direccion'];
			$rol = $_POST['rol'];

			$imgUsuario = $_POST['foto_actual'];
			$imgRemove = $_POST['foto_remove'];

			$foto = $_FILES['foto'];
			$nombre_foto = $foto['name'];
			$type = $foto['type'];
			$url_temp = $foto['tmp_name'];

			$upd = '';

			if($nombre_foto != ''){

				$destino = 'img/uploads/';
				$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
				$imgUsuario = $img_nombre.'.jpg';
				$src = $destino.$imgUsuario;
			}else{
				if($_POST['foto_actual'] != $_POST['foto_remove']){
					$imgUsuario = 'img_usuario.png';
				}
			}


			$query = mysqli_query($conection,"SELECT * FROM usuario WHERE (usuario= '$user' AND idusuario != $idUsuario) OR (correo = '$email' AND idusuario != $idUsuario) ");	

			$result = mysqli_fetch_array($query);
			$result = count($result);

			if($result > 0){
				$alert='<p class="msg_error">El correo o el usuario ya existe</p>';
			}else{
				if(empty($_POST['clave']))
				{

					$query_update = mysqli_query($conection,"UPDATE usuario
															SET nombre = '$nombre', correo = '$email', usuario = '$user', telefono = '$telefono' , direccion = '$direccion' , rol = '$rol', foto = '$imgUsuario'
															WHERE idusuario = $idUsuario");
				}else{
					$query_update = mysqli_query($conection,"UPDATE usuario
															SET nombre = '$nombre', correo = '$email', usuario = '$user', clave = '$clave', telefono = '$telefono' , direccion = '$direccion' , rol = '$rol', foto = '$imgUsuario' 
															WHERE idusuario = $idUsuario");
				}

				if($query_update){
					if(($nombre_foto != '' && ($_POST['foto_actual'] != 'img_usuario.png')) || ($_POST['foto_actual'] != $_POST['foto_remove']))
					{
						unlink('img/uploads/'.$_POST['foto_actual']);
					}

					if($nombre_foto != ''){
						move_uploaded_file($url_temp, $src);
					}
					$alert='<p class="msg_save">Usuario Actualizado correctamente</p>';
				}else{
					$alert='<p class="msg_error">Error al Actualizar el usuario</p>';
				}
			}
		}
	}

	if(empty($_REQUEST['id'])){
		header("location: lista_usuarios.php");
	}else{
		$idusuario = $_REQUEST['id'];
		if(!is_numeric($idusuario)){
			header("location: lista_usuarios.php");
		}

		$query_usuario = mysqli_query($conection,"SELECT u.idusuario, u.nombre, u.correo, u.usuario, u.clave, u.telefono, u.direccion, (u.rol) AS idrol, (r.rol) AS rol, u.foto
                                   FROM usuario u 
                                   INNER JOIN rol r 
                                   ON u.rol = r.idrol 
                                   WHERE u.idusuario = $idusuario");
		$result_usuario = mysqli_num_rows($query_usuario);

		$foto = '';
		$classRemove = 'notBlock';

		if($result_usuario > 0){
			$data_usuario = mysqli_fetch_assoc($query_usuario);

			if($data_usuario['foto'] != 'img_usuario.png'){
				$classRemove = '';
				$foto = '<img id="img" src="img/uploads/'.$data_usuario['foto'].'" alt="Foto">';
			}

			//print_r($data_usuario);
		}else{
			header("location: lista_usuarios.php");
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";  ?>
	<title>Actualizar Usuario</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1><i class="fas fa-edit"></i> Actualizar Usuario</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $data_usuario['idusuario']; ?>">
				<input type="hidden" id="foto_actual" name="foto_actual" value="<?php echo $data_usuario['foto']; ?>">
				<input type="hidden" id="foto_remove" name="foto_remove" value="<?php echo $data_usuario['foto']; ?>">

				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre Completo" value="<?php echo $data_usuario['nombre']; ?>">

				<label for="correo">Correo Electronico</label>
				<input type="email" name="correo" id="correo" placeholder="Correo Electronico" value="<?php echo $data_usuario['correo']; ?>"> 

				<label for="usuario">Usuario</label>
				<input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $data_usuario['usuario']; ?>">

				<label for="clave">Clave</label>
				<input type="password" name="clave" id="clave" placeholder="Clave de acceso" value="<?php echo $data_usuario['clave']; ?>">

				<label for="telefono">Telefono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $data_usuario['telefono']; ?>">

				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion" value="<?php echo $data_usuario['direccion']; ?>">

				<label for="rol">Tipo de Usuario</label>

				<?php 

					include "../conexion.php";
					$query_rol = mysqli_query($conection,"SELECT * FROM rol");
					$result_rol = mysqli_num_rows($query_rol);
					mysqli_close($conection);

				?>
				<select name="rol" id="rol" class="notItemOne">
					<option value="<?php echo $data_usuario['idrol']; ?>" selected><?php echo $data_usuario['rol']; ?></option>
					option
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
					<label for="foto">Foto del Usuario</label>
		        		<div class="prevPhoto">
		        			<span class="delPhoto <?php echo $classRemove; ?>">X</span>
		        			<label for="foto"></label>
		        			<?php echo $foto; ?>
		        		</div>
		        		<div class="upimg">
		        			<input type="file" name="foto" id="foto">
		        		</div>
		        		<div id="form_alert"></div>
				</div>
				
				<button type="submit"  class="btn_save"><i class="fas fa-save"></i> Actualizar Usuario</button>

			</form>
		</div>

	</section>
	<?php include "includes/footer.php";?>
</body>
</html>