<?php
    if (isset($_GET['borrar'])) {
        require('../../funcs/conexion.func.php'); //Abro la conexion con la BBDD
        
        $idPelicula = $_GET['borrar'];

        $query_borrar = "DELETE FROM peliculas WHERE pel_idPelicula = $idPelicula";
        $resultado_borrar = mysqli_query($conexion, $query_borrar);
        
        $query_comprobar = "SELECT pel_nombrePelicula FROM peliculas WHERE pel_idPelicula = $idPelicula";
        $resultado_comprobar = mysqli_query($conexion, $query_comprobar);
        
        if (mysqli_num_rows($resultado_comprobar) <= 0) {
            header('Location: ../../views/admin/admin.peliculas.view.php?peliculaEliminada=exitosamente');
            exit();
        }
        else {
            header('Location: ../../views/admin/admin.peliculas.view.php?peliculaEliminada=error');
            exit();
        }

        mysqli_close($conexion); //Cierro la conexion con la BBDD
    }
?>