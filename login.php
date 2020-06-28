<?php

$alert = '';
session_start();
if(!empty($_SESSION['active']))
{
	header('location: sistema/');
}else{

	if(!empty($_POST)){
		if (empty($_POST['usuario']) || empty($_POST['clave'])){
			$alert = 'Ingrese su usuario y su clave';
		}else{
			require_once "conexion.php";

			$user = $_POST['usuario'];
			$pass = $_POST['clave'];

			$query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario= '$user' AND clave = '$pass'");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if ($result > 0) {

				$data = mysqli_fetch_array($query);
				$_SESSION['active'] = true;
				$_SESSION['idUser'] = $data['idusuario'];
				$_SESSION['nombre'] = $data['nombre'];
				$_SESSION['email'] = $data['email'];
				$_SESSION['user'] = $data['usuario'];
				$_SESSION['rol'] = $data['rol'];

				header('location: sistema/');
			}else{
				$alert = 'El usuario o la clave son incorrectos';
				session_destroy();
			}
		}
	}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Login | Sistema Web Inventario UV</title>
	<link rel="stylesheet" type="text/css" href="css/style1.css">
</head>

<body>
	<div id="contenedor_carga">
		<div id="carga"></div>
	</div>

	<section id="container">
		<form action="" method="post"><h1>Sistema Web Inventario UV</h1>
			<h3>Iniciar Sesion</h3>
			<img src="img/login.png" alt="Login">

			<input type="text" name="usuario" placeholder="Usuario">
			<input type="password" name="clave" placeholder="Contraseña">
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<input type="submit" value="INGRESAR">

		</form>
	</section>

	<script>
	window.onload = function(){
		var contenedor = document.getElementById('contenedor_carga');

		contenedor.style.visibility = 'hidden';
		contenedor.style.opacity = '100';
	}
	</script>

</body>
</html>