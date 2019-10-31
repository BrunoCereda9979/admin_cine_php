<?php
	session_start();

	if (isset($_SESSION['nombreUsuario'])) //Si ya hay una sesion iniciada
	{
		if ($_SESSION['nombreUsuario'] == 'admin') { //Si es el administrador redirijo a admin
			header('Location: views/admin.view.php?login=exitoso');
		}

		else {
			header("Location: views/principal.view.php?login=exitoso&pagina=1"); //Redirijo a la pagina principal
		}
	}
	else
	{
		header("Location: views/iniciar.sesion.view.php?sesion=cerrada"); //Sino redirijo al inicio de sesion
	}