<?php 
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";  ?>
	<title>SistemaWebInventario</title>
</head>

<body>
	<?php include "includes/header.php";?>
	<section id="container">
		<h1>Bienvenido al Sistema Web Inventario</h1>
	</section>

	<center>
		<img style="width: 1495px; height: 550px;" src="img/inventario.jpg" border="2">
	</center>
	<br>
	<center>
	<h1>Inventario del Inmobiliario Escolar.</h1>
        <p>Aqui se podrá revisar, modificar o eliminar datos/información no solo del inmobiliario, sino tambien de los encargados y de los verificadores.</p>
        <p> Además de el contenido e Información como su ubicacion y en donde se encuentra del inmueble o mueble que se dío de alta en el sistema.</p>
      </center>

	<?php include "includes/footer.php";?>
</body>
</html>