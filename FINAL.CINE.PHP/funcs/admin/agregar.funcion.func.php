<?php
if (isset($_POST['agregar-pelicula'])) {

    require('../conexion.func.php'); //Conecto con la base de datos

    $sucFuncion = $_POST['sucursalFuncion'];
    $pelFuncion = $_POST['peliculaFuncion'];
    $hraFuncion = $_POST['horaFuncion'];
    $fechaFuncion = $_POST['fechaFuncion'];
    $estFuncion = $_POST['estadoFuncion'];
    $precioFuncion = $_POST['precioFuncion'];

    if ($estFuncion == 'act') {
        $estFuncion = 1;
    }
    elseif ($estFuncion == 'inct') {
        $estFuncion = 0;
    }

    $query_agregar = "INSERT INTO funciones (idSucursal, idPelicula, fun_horarioFuncion, fun_fechaFuncion, fun_estadoFuncion, fun_precioFuncion) 
    VALUES ('$sucFuncion', '$pelFuncion', '$hraFuncion', '$fechaFuncion', '$estFuncion', '$precioFuncion')";

    $resultado_agregar = mysqli_query($conexion, $query_agregar);

    if (!$resultado_agregar) {
        header('Location: ../../views/admin/admin.funciones.view.php?funcionAgregada=error');
        mysqli_close($conexion); //Cierro la conexion con la BBDD
        exit();
    }
    else {
        header('Location: ../../views/admin/admin.funciones.view.php?funcionAgregada=exitosamente');
        mysqli_close($conexion); //Cierro la conexion con la BBDD
        exit();
    }
}