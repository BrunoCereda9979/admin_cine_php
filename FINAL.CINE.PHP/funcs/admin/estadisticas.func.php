<?php
    if (isset($_POST['btn-consultar'])) {
        require('../conexion.func.php');

        $consulta = $_POST['opcion-consulta'];
        $idCliente;
        $nombreCliente;
        $apellidoCliente;
        $generoCliente;

        //Traer clientes ordenados por nombre
        if ($consulta == 'order-by') {

        }
    }
?>