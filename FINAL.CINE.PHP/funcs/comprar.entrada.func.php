<?php
if (isset($_POST['comprar-entrada'])) {

    require('conexion.func.php'); //Conecto con la base de datos

    $idFuncion = $_POST['funcionSeleccionada'];
    $idCliente = $_SESSION['idUsuario'];
    $cantEntradas = $_POST['cantidadEntradas'];
    $costo = 500;

    $query_agregar = "INSERT INTO entradas (idFuncion, idCliente, ent_cantidadEntradas, ent_costoFinal) 
    VALUES ('$idFuncion', '$idCliente', '$cantEntradas', '$costo')";

    $resultado_agregar = mysqli_query($conexion, $query_agregar);

    if (!$resultado_agregar) {
        header('Location: ../views/tickets.view.php?ticketComprado=error');
        mysqli_close($conexion); //Cierro la conexion con la BBDD
        exit();
    }
    else {
        header('Location: ../views/tickets.view.php?ticketComprado=exitosamente');
        mysqli_close($conexion); //Cierro la conexion con la BBDD
        exit();
    }
}