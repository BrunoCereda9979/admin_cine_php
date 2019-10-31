<?php
    require('conexion.func.php'); //Conecto con la BBDD

    //Establecer el numero de paginas
    $posterPorPagina = 4;
    //Establecer la pagina en la que el usuario se encuentra
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

    $inicio = ($pagina > 1) ? ($pagina * $posterPorPagina - $posterPorPagina) : 0;

    $query_posters = "SELECT SQL_CALC_FOUND_ROWS * FROM peliculas LIMIT $inicio, $posterPorPagina";
    
    $resultado_posters = mysqli_query($conexion, $query_posters);

    while($row = $mysqli_fetch_assoc($resultado_posters)) {
        echo $row;
    }
?>