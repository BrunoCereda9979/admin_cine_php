<?php
	echo "<style>";
		include ('../css/estilos.iniciar.sesion.css');
	echo "</style>";

	session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Iniciar Sesion | Cine</title>
	<link rel="shortcut icon" type="icon/x-icon" href="../img/popcorn.png">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
</head>
<body>
	<?php
		if (isset($_GET['error'])) 
		{
			if ($_GET['error'] == "usuarioInexistente") 
			{
				echo '<center><p class="error-msg">¡El usuario que ingresaste no existe!</p></center>';
			}
			elseif ($_GET['error'] == "contraErronea") 
			{
				echo '<center><p class="error-msg">¡La contraseña no es correcta!</p></center>';
			}
		}
	?>
	<div class="main-container">
		<div class="left-container"><!--Contenedor del Titulo-->
			<div class="title">
				<h1>Inicio Sesion</h1>
			</div>

			<div class="description">
				<p>No podras iniciar sesion si no tienes una cuenta creada en el sitio.</p>
			</div>

			<a href="registro.usuario.view.php">Registrarse</a>			
		</div>

		<div class="right-container"><!--Contenedor del Formulario-->
			<form class="register-form" action="../funcs/iniciar.sesion.func.php" method="POST">

				<input type="text" name="nombreUsuario" placeholder="Usuario" required>
				<input type="password" name="pwdUsuario" placeholder="Contraseña" required>

				<input type="submit" name="iniciar-sesion" value="¡Logearse!">
			</form>
		</div>
	</div>

	<footer>
		<div class="copyright">
			<p>Pagina creada por @BrunoCereda | &copy; Todos los derechos reservados</p>
		</div>
	</footer>
</body>
</html>