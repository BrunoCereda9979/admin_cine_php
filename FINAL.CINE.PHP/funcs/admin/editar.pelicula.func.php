<?php
    if (isset($_POST['editar-pelicula'])) {
        require('../../funcs/conexion.func.php'); //Conecto con la BBDD
        
        $id = $_POST['idPelicula'];
        $nomPelicula = filter_var($_POST['nombrePelicula'], FILTER_SANITIZE_STRING);
        $clasPelicula = filter_var($_POST['clasificacionPelicula'], FILTER_SANITIZE_STRING);
        $idiPelicula = filter_var($_POST['idiomaPelicula'], FILTER_SANITIZE_STRING);
        $descPelicula = filter_var($_POST['descripcionPelicula'], FILTER_SANITIZE_STRING);
        
        //print_r($id);
        //exit();
        //echo 'Hola como etas';

        $query_editar = "UPDATE peliculas SET pel_nombrePelicula = '$nomPelicula', pel_clasificacionPelicula = '$clasPelicula',  
        pel_idiomaPelicula = '$idiPelicula', pel_descripcionPelicula = '$descPelicula' WHERE pel_idPelicula = $id";

        echo $query_editar;
        $resultado_editar = mysqli_query($conexion, $query_editar);

        //print_r($resultado_editar);
        //exit();

        if (!$resultado_editar) {
            header('Location: ../../views/admin/admin.peliculas.view.php?editar=error');
            mysqli_close($conexion);
            exit();
        }
        else {
            header('Location: ../../views/admin/admin.peliculas.view.php?editar=exito');
            mysqli_close($conexion);
            exit();
        }
    }
?>