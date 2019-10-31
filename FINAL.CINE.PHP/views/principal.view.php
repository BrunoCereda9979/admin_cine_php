<?php
	session_start();
	if (!$_GET) {
		header('Location: principal.view.php?pagina=1');
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>HOME | Cine</title>
	<link rel="shortcut icon" type="icon/x-icon" href="../img/popcorn.png">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<?php 
		echo "<style>";
			include ('../css/estilos.principal.css');
		echo "</style>"; 
	?>
</head>
<body>
	<header>
		<nav>
			<ul class="nav-bar">
				<li class="logo"><h1>CINE</h1></li>
				<li><a href="principal.view.php" class="home">Home</a></li>
				<li><a href="tickets.view.php">Tickets</a></li>
				<li><a href="#">Contacto</a></li>
				<li class="nombre-usuario"><p><img src="../img/profile.png">Bienvenido <?php echo $_SESSION['nombreUsuario'] ?></p></li>
				<li><form action="../funcs/cerrar.sesion.func.php" method="POST"><input class="btn-cerrar-sesion" type="submit" name="cerrar-sesion" value="✖ Cerrar Sesion"></form></li>
			</ul>
		</nav>
	</header>

	<!--Agregar la paginacion de las peliculas-->
	<section class="movie-container">
		<?php
			require('../funcs/conexion.func.php'); //Abro la conexion con la BBDD

			$postersPorPagina = 4; //Posters que muestro por pagina
			$inicio = ($_GET['pagina'] - 1) * $postersPorPagina; 

			$query_peliculas = "SELECT pel_nombrePelicula, pel_posterPelicula FROM peliculas LIMIT $inicio, $postersPorPagina"; 
			$resultado_peliculas = mysqli_query($conexion, $query_peliculas);
			
			$query = "SELECT pel_idPelicula FROM peliculas";
			$resultado = mysqli_query($conexion, $query);

			$cantidadPosters = mysqli_num_rows($resultado); //Cantidad total de posters en la BBDD
			$paginas = ceil($cantidadPosters / $postersPorPagina); //Cantidad total de paginas

			if (mysqli_num_rows($resultado_peliculas) == 0) {
				echo 'No hay ninguna pelicula disponible';
			}

			while($row = mysqli_fetch_assoc($resultado_peliculas)) {
		?>
		
		<div class="movie">
			<div class="thumb">
				<a href="#"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['pel_posterPelicula'] ).'"/>'; ?></a>
			</div>

			<div class="mv-title">
				<h2><?php echo $row['pel_nombrePelicula']; ?></h2>
			</div>
		</div>
		
		<?php } mysqli_close($conexion); ?>
	</section>

	<section>
		<nav aria-label="Page navigation example">
			<ul class="pagination justify-content-center">
				<li class="page-item <?php echo $_GET['pagina'] <= 1 ? "disabled" : ""  ?>">
					<a class="page-link" href="principal.view.php?pagina=<?php echo $_GET['pagina'] - 1 ?>" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</li>

				<?php for($i = 0; $i < $paginas; $i++): ?>
					<li class="page-item <?php echo $_GET['pagina'] == $i+1 ? "active" : "" ?>">
						<a class="page-link" href="principal.view.php?pagina=<?php echo $i+1; ?>"><?php echo $i+1; ?></a>
					</li>
				<?php endfor ?>

				<li class="page-item <?php echo $_GET['pagina'] >= $paginas ? "disabled" : ""  ?>">
					<a class="page-link" href="principal.view.php?pagina=<?php echo $_GET['pagina'] + 1 ?>" aria-label="Next">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</li>
			</ul>
		</nav>
	</section>		

	<footer>
		<div class="copyright">
			<p>Pagina creada por @BrunoCereda | &copy; Todos los derechos reservados</p>
		</div>
	</footer>
</body>
</html>