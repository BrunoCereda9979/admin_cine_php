<?php
if (isset($_POST['agregar-pelicula'])) {

    require('../conexion.func.php'); //Conecto con la base de datos

    $nomPelicula = filter_var($_POST['nombrePelicula'], FILTER_SANITIZE_STRING);
    $clasPelicula = filter_var($_POST['clasificacionPelicula'], FILTER_SANITIZE_STRING);
    $idiPelicula = filter_var($_POST['idiomaPelicula'], FILTER_SANITIZE_STRING);
    $descPelicula = filter_var($_POST['descripcionPelicula'], FILTER_SANITIZE_STRING);

    //Esta es la imagen que vamos a subir a la BBDD
    $nombreArchivo = $_FILES['posterPelicula']['name']; //Obtengo el nombre del archivo
    $tipoArchivo = $_FILES['posterPelicula']['type']; //Obtengo el tipo de archivo
    $poster = mysqli_real_escape_string($conexion, file_get_contents($_FILES['posterPelicula']['tmp_name']));

    if (substr($tipoArchivo, 0, 5) == "image") { //Si el archivo es una imagen

        $query_agregar = "INSERT INTO peliculas (pel_nombrePelicula, pel_clasificacionPelicula, pel_idiomaPelicula, pel_descripcionPelicula, pel_posterPelicula) 
        VALUES ('$nomPelicula', '$clasPelicula', '$idiPelicula', '$descPelicula', '$poster')";

        $resultado_agregar = mysqli_query($conexion, $query_agregar);

        if (!$resultado_agregar) {
            echo mysqli_error($conexion);
        }
        else {
            header('Location: ../../views/admin/admin.peliculas.view.php?peliculaAgregada=exitosamente');
            exit();
        }
    } 
    else {
        header('Location: ../../views/admin/admin.peliculas.view.php?peliculaAgregada=error');
        exit();
    }

    mysqli_close($conexion); //Cierro la conexion con la BBDD
}