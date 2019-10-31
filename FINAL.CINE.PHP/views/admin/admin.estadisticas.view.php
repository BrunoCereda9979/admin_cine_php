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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<?php
	echo "<style>";
	include('../../css/admin/estilos.admin.css');
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

	<h2>Clientes Ordenados por nombre</h2>

	<section class="text-center">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">#ID</th>
					<th scope="col">Nombre</th>
					<th scope="col">Apellido</th>
					<th scope="col">Sexo</th>
				</tr>
			</thead>

			<tbody>
			<?php
				require('../../funcs/conexion.func.php');

				$query_consulta = "SELECT cli_idCliente, cli_nombreCliente, cli_apellidoCliente, 
				cli_generoCliente FROM clientes ORDER BY cli_nombreCliente ASC";

				$resultado_consulta = mysqli_query($conexion, $query_consulta);

				while ($row = mysqli_fetch_array($resultado_consulta)) {
			?>

				<tr>
					<th scope="row"><?php echo $row['cli_idCliente']; ?></th>
					<td><?php echo $row['cli_nombreCliente']; ?></td>
					<td><?php echo $row['cli_apellidoCliente']; ?></td>
					<td><?php echo $row['cli_generoCliente']; ?></td>
				</tr>
				<?php
			}
			mysqli_close($conexion);
			?>
			</tbody>
		</table>
	</section>

	<h2>Cantidad de Funciones por pelicula</h2>		

	<section class="text-center">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Cantidad Funciones</th>
					<th scope="col">#ID PELICULA</th>
				</tr>
			</thead>
			<tbody>
				<?php
					require('../../funcs/conexion.func.php');

					$query_consulta = "SELECT COUNT(fun_idFuncion) CF, idPelicula, pel_nombrePelicula FROM funciones F INNER JOIN peliculas P ON F.idPelicula = P.pel_idPelicula GROUP BY idPelicula";

					$resultado_consulta = mysqli_query($conexion, $query_consulta);

					while ($row = mysqli_fetch_array($resultado_consulta)) {
				?>

				<tr>
					<th scope="row"><?php echo $row['CF']; ?></th>
					<td><?php echo $row['pel_nombrePelicula']; ?></td>
				</tr>
				<?php
			}
			mysqli_close($conexion);
			?>
			</tbody>
		</table>
	</section>		

</body>

</html>