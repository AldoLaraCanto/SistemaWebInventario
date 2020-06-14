<?php 

	if(empty($_SESSION['active']))
	{
		header('location: ../login.php');
	} 
?>
<footer>
	<br>
	<hr>
	<br>
	<center>
		<p>© 2020 - Sistema Web Inventario</p>
		<p>Por: Lara Canto</p>
	</center>
	<br>
</footer>