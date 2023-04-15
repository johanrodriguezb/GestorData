<<?php
    session_start();
    include 'assets/includes/scripts.html';

    ?> <body>
    <div class="row h-100 w-100">
        <div class="col-md-3">
            <?php include 'assets/includes/sidebarAdmin.php'; ?>
        </div>
        <div class="col-md-8 m-5">
            <?php
            if (isset($_GET['aviso'])) {
            ?>
                <div>
                    <br>
                    <div class="alert <?php echo $_GET['ca'] ?> alert-dismissible fade show" role="alert">
                        <strong><?php echo $_GET['aviso'] ?>!</strong> Correctamente.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php
            }
            ?>
            <h1 class="text-primary">Panel de Cursos</h1>
            <p><b>Señ@r Admin, aquí encontrará una interfaz para la administración de Cursos</b></p>
            <br>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AgregarCurso"><i class="fa-solid fa-plus"></i></button>
            <br>
            <br>
            <table class="table table-bordered">
                <thead class="bg bg-primary text-white text-center">
                    <tr>
                        <th># Curso</th>
                        <th>Nombre Curso</th>
                        <th colspan="2">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($cursos['cursos'] as $cursosD) {
                        $estado = $cursosD['EstadoCurso'];
                        if ($estado == 1) {
                            $txt_estado = 'Eliminar';
                            $color_estado = 'btn-danger';
                            $ruta = 'ejecutar.php?c=Admin&a=elimnarCurso';
                        }
                        if ($estado == 0) {
                            $txt_estado = 'Habilitar';
                            $color_estado = 'btn-success';
                            $ruta = 'ejecutar.php?c=Admin&a=habilitarCurso';
                        }
                    ?>

                        <tr>
                            <th><?php echo $cursosD['id_curso'] ?></th>
                            <th><?php echo $cursosD['NombreCurso'] ?></th>
                            <th class="text-center"><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalCurso<?php echo $cursosD['id_curso'] ?>">Editar</button></th>
                            <th class="text-center"><a href="<?php echo $ruta ?>&id=<?php echo $cursosD['id_curso'] ?>"><button type="submit" class="btn <?php echo $color_estado ?>"><?php echo $txt_estado ?></button></a></th>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade text-dark" id="ModalCurso<?php echo $cursosD['id_curso'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="ejecutar.php?c=Admin&a=actualizarCurso" method="POST">
                                        <div class="modal-header bg bg-primary text-white">
                                            <h5 class="modal-title">Curso: <b><?php echo $cursosD['NombreCurso'] ?></b></h5>
                                        </div>
                                        <div class="modal-body">

                                            <input type="hidden" name="id_curso" value="<?php echo $cursosD['id_curso'] ?>">
                                            <label for="">Nombre del curso</label>
                                            <input type="text" class="form-control" name="NombreCurso" value="<?php echo $cursosD['NombreCurso'] ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Modal para Agregar Cursos-->
        <div class="modal fade text-dark" id="AgregarCurso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="ejecutar.php?c=Admin&a=agregarCurso" method="POST">
                        <div class="modal-header bg bg-primary text-white">
                            <h5 class="modal-title"><b>Agregar Curso</b></h5>
                        </div>
                        <div class="modal-body">
                            <label for="">Nombre del curso</label>
                            <input type="text" class="form-control" name="NombreCurso">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>