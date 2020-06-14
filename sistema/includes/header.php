<?php 

	if(empty($_SESSION['active']))
	{
		header('location: ../login.php');
	} 
?>
<header>
		<div class="header">
			
			<h1>Sistema Web Inventario</h1>
			<div class="optionsBar">
				<p>Boca del Rio, Veracruz, <?php echo fechaC(); ?> </p>
				<span>|</span>
				<span class="user">Usuario: <?php echo $_SESSION['user']; ?></span>
				<img class="photouser" src="img/user.png" alt="Usuario">
				
				<a href="salir.php"><i class="fas fa-sign-out-alt fa-2x" color="white" alt="Salir del sistema" title="Salir"></i></a>
			</div>
		</div>
		<?php include "nav.php"; ?>
</header>