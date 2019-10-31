<?php
	echo "<style>";
		include ('../css/estilos.registro.css');
	echo "</style>";

	session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Registro | Cine</title>
	<link rel="shortcut icon" type="icon/x-icon" href="../img/popcorn.png">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="http://localhost/FINAL.CINE.PHP/css/estilos.registro.css">
</head>
<body>
	<div class="main-container">
		<?php
			if (isset($_GET['error'])) //Si hay algun error notificado en la URL
			{
				if ($_GET['error'] == "usuarioTomado") 
				{
					echo '<center><p class="error-msg">¡Ese usuario ya existe!</p></center>';
				}
				elseif ($_GET['error'] == "registroFallo") 
				{
					echo '<center><p class="error-msg">¡Error al registrase!</p></center>';
				}
			}
			/*elseif ($_GET['registro'] == "existoso") 
			{
				echo '<center><p>¡Te registraste correctamente!</p></center>';
			}*/
		?>
		<div class="left-container"><!--Contenedor del Titulo-->
			<div class="title">
				<h1>Registro</h1>
			</div>

			<div class="description">
				<p>Si ya tenes una cuenta creada en el sitio podes iniciar sesion haciendo click abajo.</p>
			</div>

			<a href="iniciar.sesion.view.php">Iniciar Sesion</a>			
		</div>

		<div class="right-container"><!--Contenedor del Formulario-->
			<form class="register-form" action="../funcs/registrar.usuario.func.php" method="POST">

				<input type="text" name="nombreCliente" placeholder="Nombre" required>
				<input type="text" name="apellidoCliente" placeholder="Apellido" required>

				<div class="gender">
					<input type="radio" id="hombre" name="generoCliente" value="hombre" required>
					<label class="label-radio" for="hombre">Hombre</label>

					<input type="radio" id="mujer" name="generoCliente" value="mujer" required>
					<label class="label-radio" for="mujer">Mujer</label>
				</div>
				
				<input type="text" name="nombreUsuario" placeholder="Usuario" required>
				<input type="password" name="pwdUsuario" placeholder="Contraseña" required>

				<input type="submit" name="registrarse" value="¡Registrarse!">
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