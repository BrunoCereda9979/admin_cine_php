<?php
	session_start(); //Inicio sesion
	session_unset(); //Borro todos los datos de la sesion
	session_destroy(); //Destruyo la sesion

	header("Location: ../index.php");