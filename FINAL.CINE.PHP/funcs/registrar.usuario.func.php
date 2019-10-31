<?php
	if (isset($_POST['registrarse'])) 
	{
		require ('conexion.func.php'); //Conecto con la BBDD

		$nombre = filter_var($_POST['nombreCliente'], FILTER_SANITIZE_STRING);
		$apellido = filter_var($_POST['apellidoCliente'], FILTER_SANITIZE_STRING);
		$genero = filter_var($_POST['generoCliente'], FILTER_SANITIZE_STRING);
		$usuario = filter_var($_POST['nombreUsuario'], FILTER_SANITIZE_STRING);
		$pwd = filter_var($_POST['pwdUsuario'], FILTER_SANITIZE_STRING);

		$query_revisar = "SELECT * FROM clientes WHERE cli_nombreUsuario='$usuario'";

		$resultado_revisar = mysqli_query($conexion, $query_revisar);

		if (mysqli_num_rows($resultado_revisar) > 0) //Revisamos que el nombre de usuario no este en uso
		{
			header("Location: ../views/registro.usuario.view.php?error=usuarioTomado&nombreCliente=".$nombre.
			"&apellidoCliente=".$apellido."&generoCliente=".$genero);
			exit();
		}
		else
		{
			$query_registrar = "INSERT INTO clientes (cli_idCliente, cli_nombreCliente, cli_apellidoCliente, cli_generoCliente, cli_nombreUsuario, cli_pwdUsuario) VALUES ('null', '$nombre', '$apellido', '$genero', '$usuario', '$pwd')";

			$resultado_registrar = mysqli_query($conexion, $query_registrar);

			if ($resultado_registrar == TRUE) 
			{
				header("Location: ../views/registro.usuario.view.php?registro=exitoso");
				exit();
			}
			else
			{
				header("Location: ../views/registro.usuario.view.php?error=registroFallo");
				exit();
			}
		}

		mysqli_close($conexion); //Cierro la conexion con la BBDD
	}
