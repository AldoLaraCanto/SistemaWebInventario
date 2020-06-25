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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login | Sisteme Web Inventario</title>
	<link rel="stylesheet" type="text/css" href="css/style1.css">
</head>

<body>
	<section id="container">
		<form action="" method="post"><h1>Sistema Web Inventario </h1>
			<h3>Iniciar Sesion</h3>
			<img src="img/login.png" alt="Login">

			<input type="text" name="usuario" placeholder="Usuario">
			<input type="password" name="clave" placeholder="Contraseña">
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<input type="submit" value="INGRESAR">

		</form>
	</section>	
</body>
</html>