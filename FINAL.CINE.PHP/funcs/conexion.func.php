<?php
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpwd = "";
	$dbname = "finalcine";

	$conexion = mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);

	if (!$conexion) 
	{
    	die("La conexion con el servidor fallo: " . mysqli_connect_error());
	}