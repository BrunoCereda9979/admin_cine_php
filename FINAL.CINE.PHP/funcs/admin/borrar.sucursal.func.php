<?php
    if (isset($_GET['borrar'])) {
        require('../../funcs/conexion.func.php'); //Abro la conexion con la BBDD
        
        $idSucursal = $_GET['borrar'];

        $query_borrar = "DELETE FROM sucursales WHERE suc_idSucursal = '$idSucursal'";
        $resultado_borrar = mysqli_query($conexion, $query_borrar); 

        if ($resultado_borrar == TRUE) {
            header('Location: ../../views/admin/admin.sucursales.view.php?sucursalEliminada=exitosamente');
            mysqli_close($conexion);
            exit();
        }
        else {
            header('Location: ../../views/admin/admin.sucursales.view.php?sucursalEliminada=error');
            mysqli_close($conexion);
            exit();
        }
    }
?>