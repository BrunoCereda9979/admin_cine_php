<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Funciones | Cine</title>
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
                    <p>¡Aca podes administrar las funciones!</p>
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
                if (isset($_GET['funcionAgregada'])) {
                    if ($_GET['funcionAgregada'] == 'error') {
                        echo '<p class="msg-error">¡No se puede agregar la funcion!</p>';
                    } elseif ($_GET['funcionAgregada'] == 'exitosamente') {
                        echo '<p class="msg-success">¡Funcion agregada correctamente!</p>';
                    }
                }
            ?>

            <h2>Formulario para agregar funciones</h2>

            <form action="../../funcs/admin/agregar.funcion.func.php" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="sucursalFuncion">Sucursal</label>
                        <select class="custom-select mr-sm-2" name="sucursalFuncion" id="inlineFormCustomSelect">
                            <option selected>Sucursal...</option>
                            <?php
                                require('../../funcs/conexion.func.php'); //Conecto con la BBDD

                                $query_obtener = "SELECT suc_idSucursal, suc_nombreSucursal FROM sucursales";
                                $resultado_obtener = mysqli_query($conexion, $query_obtener);

                                while ($row = mysqli_fetch_array($resultado_obtener)) {
                            ?>

                            <option value="<?php echo $row['suc_idSucursal']; ?>"><?php echo $row['suc_nombreSucursal']; ?></option>                

                            <?php
                                }
                                mysqli_close($conexion); //Cierro la conexion con la BBDD
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="peliculaFuncion">Pelicula</label>
                        <select class="custom-select mr-sm-2" name="peliculaFuncion" id="inlineFormCustomSelect">
                            <option selected>Pelicula...</option>
                            <?php
                                require('../../funcs/conexion.func.php'); //Conecto con la BBDD

                                $query_obtener = "SELECT pel_idPelicula, pel_nombrePelicula FROM peliculas";
                                $resultado_obtener = mysqli_query($conexion, $query_obtener);

                                while ($row = mysqli_fetch_array($resultado_obtener)) {
                            ?>

                            <option value="<?php echo $row['pel_idPelicula']; ?>"> <?php echo $row['pel_nombrePelicula']; ?></option>

                            <?php
                                }
                                mysqli_close($conexion); //Cierro la conexion con la BBDD
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fecha">Fecha</label>
                        <input type="date" name="fechaFuncion" class="form-control" id="fecha" placeholder="Fecha de la funcion">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="hora">Hora</label>
                        <input type="time" name="horaFuncion" class="form-control" id="hora" placeholder="Fecha de la funcion">
                    </div>
                </div>

                <div class="form-group">
                    <label for="selectEstado">Estado</label>
                    <select class="custom-select mr-sm-2" name="estadoFuncion" id="selectEstado">
                        <option selected>Estado...</option>
                        <option value="act">Activa</option>                
                        <option value="inct">Inactiva</option>                
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="text" name="precioFuncion" class="form-control" id="precio" placeholder="Precio de la funcion">
                </div>

                <input type="submit" name="agregar-pelicula" class="btn btn-success btn-block" value="Agregar Funcion">
            </form>
        </div>

        <div class="table-container">
            <?php
                if (isset($_GET['funcionEliminada'])) {
                    if ($_GET['funcionEliminada'] == 'exitosamente') {
                        echo '<p class="msg-success">¡Funcion eliminada correctamente!</p>';
                    } elseif ($_GET['funcionEliminada'] == 'error') {
                        echo '<p class="msg-error">¡No se puede eliminar la funcion!</p>';
                    }
                }
            ?>

            <h2>Lista con todas la funciones disponibles</h2>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Sucursal</th>
                        <th scope="col">Pelicula</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Borrar</th>
                    </tr>
                </thead>

                <?php
                    require('../../funcs/conexion.func.php');

                    $query_obtener = "SELECT * FROM funciones F, sucursales S, peliculas P WHERE F.idSucursal = S.suc_idSucursal AND F.idPelicula = P.pel_idPelicula";
                    $resultado_obtener = mysqli_query($conexion, $query_obtener);

                    while ($row = mysqli_fetch_array($resultado_obtener)) {
                ?>

                <tbody>
                    <tr>
                        <th scope="row"><?php echo $row['fun_idFuncion']; ?></th>
                        <td><?php echo $row['suc_nombreSucursal']; ?></td>
                        <td><?php echo $row['pel_nombrePelicula']; ?></td>
                        <td><?php echo $row['fun_horarioFuncion']; ?></td>
                        <!--<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editarModal" data-whatever="@mdo">Editar</button></td>-->
                        <td><a class="btn btn-warning" href=""><i class="far fa-edit"></i></i> Editar</a></td>
                        <td><a class="btn btn-danger" href="../../funcs/admin/borrar.funcion.func.php?borrar=<?php echo $row['fun_idFuncion']; ?>"><i class="far fa-trash-alt"></i> Borrar</a></td>
                    </tr>
                </tbody>
                <?php
                    }
                    mysqli_close($conexion);
                ?>
            </table>
        </div>

        <!--Formulario Popup para editar peliculas-->
        <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Formulario para editar peliculas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="../../funcs/admin/editar.pelicula.func.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="inputAddress">Nombre</label>
                                <input type="text" name="nombrePelicula" value="" class="form-control" id="inputAddress" placeholder="Nombre de la pelicula">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Clasificacion</label>
                                    <select class="custom-select mr-sm-2" name="clasificacionPelicula" id="inlineFormCustomSelect">
                                        <option selected>Clasificacion...</option>
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
                                    <select class="custom-select mr-sm-2" name="idiomaPelicula" id="inlineFormCustomSelect">
                                        <option selected>Idioma...</option>
                                        <option value="ing">Ingles Subtitulada</option>
                                        <option value="esp">Español Latino</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Descripcion</label>
                                <textarea class="form-control" name="descripcionPelicula" placeholder="Descripcion de la pelicula" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlFile1">Poster de la pelicula</label>
                                <input type="file" name="posterPelicula" class="form-control-file" id="exampleFormControlFile1">
                            </div>

                            <input type="submit" name="editar-pelicula" class="btn btn-info btn-block" value="Editar">
                        </form>
                    </div>
                </div>
            </div>
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