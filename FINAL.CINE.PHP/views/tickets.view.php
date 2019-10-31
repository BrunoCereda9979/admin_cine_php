<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Tickets | Cine</title>
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
				<li><a href="principal.view.php">Home</a></li>
				<li><a href="tickets.view.php" class="home">Tickets</a></li>
				<li><a href="#">Contacto</a></li>
				<li class="nombre-usuario"><p><img src="../img/profile.png">Bienvenido <?php echo $_SESSION['nombreUsuario'] ?></p></li>
				<li><form action="../funcs/cerrar.sesion.func.php" method="POST"><input class="btn-cerrar-sesion" type="submit" name="cerrar-sesion" value="✖ Cerrar Sesion"></form></li>
			</ul>
		</nav>
	</header>

    <section class="main-container row">
        <div class="formulario form-container col-sm-4">
            <?php
                if (isset($_GET['ticketComprado'])) {
                    if ($_GET['ticketComprado'] == 'error') {
                        echo '<p class="msg-error">¡No se puede comprar ticket!</p>';
                    } elseif ($_GET['ticketComprado'] == 'exitosamente') {
                        echo '<p class="msg-success">Ticket comprado correctamente!</p>';
                    }
                }
            ?>

            <h2>Comprar tickets</h2>

            <form action="../funcs/comprar.entrada.func.php" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="funcionSeleccionada">Funcion</label>
                        <select class="custom-select mr-sm-2" name="funcionSeleccionada" id="inlineFormCustomSelect">
                            <option selected>Funcion...</option>

                            <?php
                                require('../funcs/conexion.func.php');

                                $query_obtener = "SELECT pel_nombrePelicula, fun_idFuncion FROM funciones F INNER JOIN peliculas P ON F.idPelicula = P.pel_idPelicula";
                                $resultado_obtener = mysqli_query($conexion, $query_obtener);

                                while ($row = mysqli_fetch_array($resultado_obtener)) {
                            ?>
                            <option value="<?php echo $row['fun_idFuncion'] ?>"><?php echo $row['pel_nombrePelicula']; ?></option>

                            <?php
                                }
                                mysqli_close($conexion);
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-md-7">
                        <label for="cantidadEntradas">Cantidad</label>
                        <input type="number" name="cantidadEntradas" id="cantidadEntradas" min="1" max="4">
                    </div>
                </div>

                <input type="submit" name="comprar-entrada" class="btn btn-success btn-block" value="Comprar Entrada">
            </form>
        </div>

        <div class="table-container col-sm-6 lista">
            <?php
                if (isset($_GET['peliculaEliminada'])) {
                    if ($_GET['peliculaEliminada'] == 'exitosamente') {
                        echo '<p class="msg-success">¡Pelicula eliminada correctamente!</p>';
                    } elseif ($_GET['peliculaEliminada'] == 'error') {
                        echo '<p class="msg-error">¡No se puede eliminar la pelicula!</p>';
                    }
                }
            ?>

            <h2>Lista con todas la peliculas disponibles</h2>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Funcion</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Total</th>
                        <th scope="col">Cancelar</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><a class="btn btn-danger" href="../../funcs/admin/borrar.pelicula.func.php?borrar=<?php echo $row['pel_idPelicula']; ?>"><i class="far fa-trash-alt"></i> Cancelar</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>	

	<!--<footer>
		<div class="copyright">
			<p>Pagina creada por @BrunoCereda | &copy; Todos los derechos reservados</p>
		</div>
    </footer>-->
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>