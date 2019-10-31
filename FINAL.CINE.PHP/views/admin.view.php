<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<title>Administrador | Cine</title>
	<link rel="shortcut icon" type="icon/x-icon" href="../img/popcorn.png">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	
	<?php
	echo "<style>";
		include('../css/admin/estilos.admin.css');
	echo "</style>";
	?>
</head>

<body>
	<header>
		<nav>
			<ul class="nav-bar">
				<li class="nombre-usuario">
					<p>¡Bienvenido Administrador!</p>
				</li>
				<li>
					<form action="../funcs/cerrar.sesion.func.php" method="POST"><input class="btn-cerrar-sesion" type="submit" name="cerrar-sesion" value="✖ Cerrar Sesion"></form>
				</li>
			</ul>
		</nav>
	</header>

	<section class="main-container">
		<div class="container-administrar">
			<h2>Administrar Sucursales</h2>

			<p>Agrega, modifica y borra sucursales del catalogo, tambien hay una lista con todas las sucursales disponibles.</p>

			<a href="../views/admin/admin.sucursales.view.php">Ir al lugar</a>
		</div>
		
		<div class="container-administrar">
			<h2>Administrar Peliculas</h2>

			<p>Agrega, modifica y borra peliculas del catalogo, tambien hay una lista con todas las peliculas disponibles.</p>

			<a href="../views/admin/admin.peliculas.view.php">Ir al lugar</a>
		</div>

		<div class="container-administrar">
			<h2>Administrar Funciones</h2>

			<p>Agrega, modifica y borra funciones del catalogo, tambien hay una lista con todas las funciones disponibles.</p>

			<a href="../views/admin/admin.funciones.view.php">Ir al lugar</a>
		</div>

		<div class="container-administrar">
			<h2>Estadísticas</h2>

			<p>Acá podes ver algunas estadisticas de la pagina web, como la cantidad de clientes o algunas otras estadisticas.</p>

			<a href="../views/admin/admin.estadisticas.view.php">Ir al lugar</a>
		</div>
	</section>

	<footer>
		<div class="copyright">
			<p>Pagina creada por @BrunoCereda | &copy; Todos los derechos reservados</p>
		</div>
	</footer>
</body>

</html>