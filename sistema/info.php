<?php 
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";  ?>
	<title>Informacion</title>
</head>

<body>
	<?php include "includes/header.php";?>
	<section id="container">
		<h1><i class="fas fa-info-circle"></i> Informacion Acerca del Sistema Web</h1>
		<a href="manual/manual.pdf" class="btn_new"><i class="fa fa-download" aria-hidden="true"></i> Descargar Manual</a>
	</section>

	<div class="slider">
		<center>
			<ul>
				<li><img style="width: 1000px; height: 500px;" src="img/DesarrolladorWeb.jpg" border="2"></li>
				<li><img style="width: 1000px; height: 500px;" src="img/inventario1.jpg" border="2"></li>
				<li><img style="width: 960px; height: 480px;" src="img/inventario2.jpg" border="2"></li>
			</ul>
		<center>
	</div>
	<br>

	<center>
		<h2>Desarollado por:</h2>
		<h3>Alberto Edai Aldo Lara Canto y Adolfo Edel Adan Lara Canto</h3>
	</center>


	<?php include "includes/footer.php";?>
</body>
</html>