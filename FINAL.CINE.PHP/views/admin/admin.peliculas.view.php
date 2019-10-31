<?php
    session_start();

    $nomPelicula = '';
    $clasPelicula = '';
    $idiPelicula = '';
    $descPelicula = '';
    $actualizar = false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Peliculas | Cine</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="icon/x-icon" href="../../img/popcorn.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <?php
        echo "<style>";
            include('../../css/admin/estilos.admin.peliculas.css');
        echo "</style>";
    ?>
</head>

<body>
    <header>
        <nav>
            <ul class="nav-bar">
                <li class="nombre-usuario">
                    <p>¡Aca podes administrar las peliculas!</p>
                </li>
                <li>
                    <form action="../../funcs/cerrar.sesion.func.php" method="POST"><input class="btn-cerrar-sesion" type="submit" name="cerrar-sesion" value="✖ Cerrar Sesion"></form>
                </li>
            </ul>
        </nav>
    </header>

    <section class="main-container">
        <div class="form-container">
            <?php
                if (isset($_GET['peliculaAgregada'])) {
                    if ($_GET['peliculaAgregada'] == 'error') {
                        echo '<p class="msg-error">¡No se puede agregar la pelicula!</p>';
                    } elseif ($_GET['peliculaAgregada'] == 'exitosamente') {
                        echo '<p class="msg-success">¡Pelicula agregada correctamente!</p>';
                    }
                }
                elseif (isset($_GET['editar'])) {
                    if ($_GET['editar'] == 'error') {
                        echo '<p class="msg-error">¡No se puede editar la pelicula!</p>';
                    }
                    elseif ($_GET['editar'] == 'exito') {
                        echo '<p class="msg-success">¡Pelicula editada exitosamente!</p>';
                    }
                }
            ?>

            <!--EDITAR UNA PELICULA-->
            <?php
                if (isset($_GET['editar'])) {
                    require('../../funcs/conexion.func.php');

                    $idPelicula = $_GET['editar'];
                    $actualizar = true;
                    $query = "SELECT * FROM peliculas WHERE pel_idPelicula = $idPelicula";
                    $resultado = mysqli_query($conexion, $query);

                    if ($resultado) {
                        $row = $resultado->fetch_array();
                        $nomPelicula = $row['pel_nombrePelicula'];
                        $clasPelicula = $row['pel_clasificacionPelicula'];
                        $idiPelicula = $row['pel_idiomaPelicula'];
                        $descPelicula = $row['pel_descripcionPelicula'];
                    }
                    else {
                        echo "ERROR";
                    }
                }
            ?>
            <h2>Formulario para agregar peliculas</h2>

            <form action="<?php if (isset($_GET['editar'])) {echo '../../funcs/admin/editar.pelicula.func.php';} else {echo '../../funcs/admin/agregar.pelicula.func.php';}?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idPelicula" value="<?php echo $idPelicula; ?>">

                <div class="form-group">
                    <label for="inputAddress">Nombre</label>
                    <input type="text" name="nombrePelicula" value="<?php echo $nomPelicula ?>" class="form-control" id="inputAddress" placeholder="Nombre de la pelicula">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Clasificacion</label>
                        <select class="custom-select mr-sm-2" value="<?php echo $clasPelicula ?>" name="clasificacionPelicula" id="inlineFormCustomSelect">
                            <option selected><?php if (isset($_GET['editar'])) {echo $clasPelicula; } else {echo 'Clasificacion...';}  ?></option>
                            <option value="accion">Accion</option>
                            <option value="suspenso">Suspenso</option>
                            <option value="comedia">Comedia</option>
                            <option value="drama">Drama</option>
                            <option value="ciencia-ficcion">Ciencia Ficcion</option>
                            <option value="musical">Musical</option>
                            <option value="romance">Romance</option>
                            <option value="guerra">Guerra</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Idioma</label>
                        <select class="custom-select mr-sm-2" value="<?php echo $idiPelicula ?>" name="idiomaPelicula" id="inlineFormCustomSelect">
                            <option selected><?php if (isset($_GET['editar'])) {echo $idiPelicula; } else {echo 'Idioma...';} ?></option>
                            <option value="ing">Ingles Subtitulada</option>
                            <option value="esp">Español Latino</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descripcion</label>
                    <textarea class="form-control" name="descripcionPelicula" placeholder="Descripcion de la pelicula" id="exampleFormControlTextarea1" rows="3"><?php if (isset($_GET['editar'])) { echo htmlspecialchars($descPelicula); } ?></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1">Poster de la pelicula</label>
                    <input type="file" name="posterPelicula" class="form-control-file" id="exampleFormControlFile1">
                </div>

                <?php
                    if ($actualizar == true) {
                        echo '<input type="submit" name="editar-pelicula" class="btn btn-info btn-block" value="Editar Pelicula">';
                    } 
                    else {
                        echo '<input type="submit" name="agregar-pelicula" class="btn btn-success btn-block" value="Agregar Pelicula">';
                    }
                ?>    
            </form>
        </div>

        <div class="table-container">
            <?php
                if (isset($_GET['peliculaEliminada'])) {
                    if ($_GET['peliculaEliminada'] == 'exitosamente') {
                        echo '<p class="msg-success">¡Pelicula eliminada correctamente!</p>';
                    } elseif ($_GET['peliculaEliminada'] == 'error') {
                        echo '<p class="msg-error">¡No se puede eliminar la pelicula!</p>';
                    }
                }
            ?>

            <h2>Lista con todas la peliculas disponibles</h2>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Clasificacion</th>
                        <th scope="col">Idioma</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Borrar</th>
                    </tr>
                </thead>

                <?php
                    require('../../funcs/conexion.func.php');

                    $query_obtener = "SELECT * FROM peliculas";
                    $resultado_obtener = mysqli_query($conexion, $query_obtener);

                    while ($row = mysqli_fetch_array($resultado_obtener)) {
                ?>

                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $row['pel_idPelicula']; ?></th>
                            <td><?php echo $row['pel_nombrePelicula']; ?></td>
                            <td>
                                <?php
                                    if ($row['pel_clasificacionPelicula'] == 'ciencia-ficcion') :
                                        echo 'Ciencia Ficcion';
                                    elseif ($row['pel_clasificacionPelicula'] == 'musical') :
                                        echo 'Musical';
                                    elseif ($row['pel_clasificacionPelicula'] == 'accion') :
                                        echo 'Accion';
                                    elseif ($row['pel_clasificacionPelicula'] == 'suspenso') :
                                        echo 'Suspenso';
                                    elseif ($row['pel_clasificacionPelicula'] == 'comedia') :
                                        echo 'Comedia';
                                    elseif ($row['pel_clasificacionPelicula'] == 'drama') :
                                        echo 'Drama';
                                    elseif ($row['pel_clasificacionPelicula'] == 'romance') :
                                        echo 'Romance';
                                    elseif ($row['pel_clasificacionPelicula'] == 'guerra') :
                                        echo 'Guerra';
                                    endif
                                ?>
                            </td>

                            <td>
                                <?php
                                if ($row['pel_idiomaPelicula'] == 'ing') :
                                    echo 'Ingles Subtitulada';
                                else :
                                    echo 'Español Latino';
                                endif
                                ?>
                            </td>

                            <td><a class="btn btn-warning" href="../../views/admin/admin.peliculas.view.php?editar=<?php echo $row['pel_idPelicula']; ?>"><i class="far fa-edit"></i></i> Editar</a></td>
                            <td><a class="btn btn-danger" href="../../funcs/admin/borrar.pelicula.func.php?borrar=<?php echo $row['pel_idPelicula']; ?>"><i class="far fa-trash-alt"></i> Borrar</a></td>
                        </tr>
                    </tbody>
                <?php
                    }
                    mysqli_close($conexion);
                ?>
            </table>
        </div>
    </section>

    <!--<footer>
        <div class="copyright">
            <p>Pagina creada por @BrunoCereda | &copy; Todos los derechos reservados</p>
        </div>
    </footer>-->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>