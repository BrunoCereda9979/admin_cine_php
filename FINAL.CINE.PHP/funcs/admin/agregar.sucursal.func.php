<?php
if (isset($_POST['agregar-pelicula'])) {

    require('../conexion.func.php'); //Conecto con la base de datos

    $nomSucursal = filter_var($_POST['nombreSucursal'], FILTER_SANITIZE_STRING);
    $estdSucursal = filter_var($_POST['estadoSucursal'], FILTER_SANITIZE_STRING);
    $deptoSucursal = filter_var($_POST['deptoSucursal'], FILTER_SANITIZE_STRING);
    $telSucursal = filter_var($_POST['telSucursal'], FILTER_SANITIZE_STRING);
    $dirSucursal = filter_var($_POST['dirSucursal'], FILTER_SANITIZE_STRING);
    $nroCalle = filter_var($_POST['nroCalle'], FILTER_SANITIZE_STRING);

    if ($estdSucursal == "act") {
        $estdSucursal = 1;
    }
    elseif ($estdSucursal == "inct") {
        $estdSucursal = 0;
    }

    $query_agregar = "INSERT INTO sucursales (suc_nombreSucursal, suc_estadoSucursal, suc_deptoSucursal, suc_telefonoSucursal, suc_direccionSucursal, suc_nroCalle) 
    VALUES ('$nomSucursal', '$estdSucursal', '$deptoSucursal', '$telSucursal', '$dirSucursal', '$nroCalle')";

    $resultado_agregar = mysqli_query($conexion, $query_agregar);

    if (!$resultado_agregar) {
        header('Location: ../../views/admin/admin.sucursales.view.php?sucursalAgregada=error');
        mysqli_close($conexion); //Cierro la conexion con la BBDD
        exit();
    }
    else {
        header('Location: ../../views/admin/admin.sucursales.view.php?sucursalAgregada=exitosamente');
        mysqli_close($conexion); //Cierro la conexion con la BBDD
        exit();
    }
}