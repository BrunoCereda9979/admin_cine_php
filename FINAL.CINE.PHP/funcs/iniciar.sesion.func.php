<?php
	if (isset($_POST['iniciar-sesion'])) 
	{
		require('conexion.func.php');

		$usuario = filter_var($_POST['nombreUsuario'], FILTER_SANITIZE_STRING);
		$pwd = filter_var($_POST['pwdUsuario'], FILTER_SANITIZE_STRING);

		$query_revisar = "SELECT cli_idCliente FROM clientes WHERE cli_nombreUsuario='$usuario'";

		$resultado_revisar = mysqli_query($conexion, $query_revisar);

		if (mysqli_num_rows($resultado_revisar) > 0) //El usuario existe
		{
			$query_datos = "SELECT * FROM clientes WHERE cli_nombreUsuario='$usuario'"; //Recupero los datos del usuario

			$resultado_datos = mysqli_query($conexion, $query_datos);

			$datosUsuario_BBDD = mysqli_fetch_assoc($resultado_datos);

			if ($pwd == $datosUsuario_BBDD['cli_pwdUsuario']) //Si la contraseña de la BBDD coincide con la que se ingreso
			{
				session_start(); //Creo una sesion
				
				$_SESSION['idUsuario'] = $datosUsuario_BBDD['cli_idCliente'];
				$_SESSION['nombreUsuario'] = $datosUsuario_BBDD['cli_nombreUsuario'];

				header("Location: ../index.php"); //Redirijo al index
				exit();
			}
			else
			{
				header("Location: ../views/iniciar.sesion.view.php?error=contraErronea&nombreUsuario=".$usuario);
				exit();
			}
		}
		else
		{
			header("Location: ../views/iniciar.sesion.view.php?error=usuarioInexistente");
			exit();
		}

		mysqli_close($conexion);
	}