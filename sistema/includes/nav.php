<nav>
			<ul>
				<li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
			<?php 
				if($_SESSION['rol'] == 1){

			?>
				<li class="principal">
					<a><i class="fas fa-users"></i> Usuarios</a>
					<ul>
						<li><a href="registro_usuario.php"><i class="fas fa-user-plus"></i> Nuevo Usuario</a></li>
						<li><a href="lista_usuarios.php"><i class="far fa-address-card"></i> Lista de Usuarios</a></li>
					</ul>
				</li>
				<?php } ?>

				<li class="principal">
					<a><i class="fas fa-database"></i> Datos</a>
					<ul>
						<li><a href="registro_datos.php"><i class="far fa-calendar-plus"></i> Nuevo Dato</a></li>
						<li><a href="lista_datos.php"><i class="fas fa-clipboard-list"></i> Lista de Datos</a></li>
					</ul>
				</li>

				<li class="principal">
					<a href="lista_inventario.php"><i class="fas fa-book"></i> Inventario</a>	
				</li>

				<li class="principal">
					<a href="info.php"><i class="fas fa-info-circle"></i> Informacion</a>	
				</li>
				
			</ul>
		</nav>