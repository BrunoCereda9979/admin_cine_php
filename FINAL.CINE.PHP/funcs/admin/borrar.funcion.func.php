<?php
    if (isset($_GET['borrar'])) {
        require('../conexion.func.php'); //Conecto con la BBDD

        $idFuncion = $_GET['borrar'];

        $query_borrar = "DELETE FROM funciones WHERE fun_idFuncion = '$idFuncion'";
        $resultado_borrar = mysqli_query($conexion, $query_borrar);

        if ($resultado_borrar == TRUE) {
            header('Location: ../../views/admin/admin.funciones.view.php?funcionEliminada=exitosamente');
            mysqli_close($conexion);
            exit();
        }
        else {
            header('Location: ../../views/admin/admin.funciones.view.php?funcionEliminada=error');
            mysqli_close($conexion);
            exit();
        }
    }
?>