<?php
session_start();
include 'assets/includes/scripts.html';
include 'assets/includes/function.php';
?>

<body>
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
            <h1 class="text-primary">Administración de Usuarios</h1>
            <p><b>Señ@r Admin, aquí encontrará una interfaz para la administración de Administradores o Instructores</b></p>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalAgregar"><i class="fa-solid fa-plus"></i></button>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-success" onclick="exportTableToExcel('tabla_usuarios', 'tabla_usuarios')">Excel General</button>
                </div>
                <div class="col-md-3">
                    <form action="views/reportes.php" method="POST">
                        <button type="submit" class="btn btn-success">
                            Excel Matriculados
                        </button>
                    </form>
                </div>
                <div class="col-md-3">
                    <form action="views/gestores.php" method="POST">
                        <button type="submit" class="btn btn-success">
                            Excel Gestores
                        </button>
                    </form>
                </div>
            </div>
            <br>

            <table class="table table-bordered">
                <thead class="bg bg-primary text-white text-center">
                    <tr>
                        <th>Tipo Doc</th>
                        <th>Numero Doc</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Telefono</th>
                        <th>Rol</th>
                        <th>Curso</th>
                        <th colspan="2">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data['usuarios'] as $usuarios) {
                        $documento = $usuarios['NombreDoc'];
                        $estado = $usuarios['Estado'];
                        if ($documento == 'Cedula de Ciudadania') {
                            $txt_documento = 'CC';
                        }
                        if ($documento == 'Tarjeta de Identidad') {
                            $txt_documento = 'TI';
                        }
                        if ($documento == 'Cedula Extranjera') {
                            $txt_documento = 'CE';
                        }
                        if ($estado == 1) {
                            $txt_estado = 'Eliminar';
                            $color_estado = 'btn-danger';
                            $ruta = 'ejecutar.php?c=Admin&a=eliminarUsuarios';
                        }
                        if ($estado == 0) {
                            $txt_estado = 'Habilitar';
                            $color_estado = 'btn-success';
                            $ruta = 'ejecutar.php?c=Admin&a=habilitarUsuarios';
                        }
                    ?>
                        <tr>
                            <th><?php echo $txt_documento ?></th>
                            <th><?php echo $usuarios['NumeroDocmuento'] ?></th>
                            <th><?php echo $usuarios['Nombres'] ?></th>
                            <th><?php echo $usuarios['Primer_Apellido'] . ' ' . $usuarios['Segundo_Apellido'] ?></th>
                            <th><?php echo $usuarios['Telefono'] ?></th>
                            <th><?php echo $usuarios['NombreRol'] ?><abbr title="<?php echo $usuarios['Correo'] ?>"><i class="fa-solid fa-circle-info fa-xs mt-3"></i></abbr> </th>
                            <th><?php echo $usuarios['NombreCurso'] ?></th>
                            <th><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalEditar<?php echo $usuarios['id_usuario'] ?>">Editar</button></th>
                            <th><a href="<?php echo $ruta ?>&id=<?php echo $usuarios['id_usuario'] ?>"><button type="submit" class="btn <?php echo $color_estado ?>"><?php echo $txt_estado ?></button></a></th>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade text-dark" id="ModalEditar<?php echo $usuarios['id_usuario'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form class="needs-validation" action="ejecutar.php?c=Admin&a=editarUsuarios" method="POST">
                                        <div class="modal-header bg bg-primary text-white">
                                            <h5 class="modal-title">Editar Info de <?php echo $usuarios['Nombres'] ?></h5>
                                        </div>
                                        <div class="modal-body">

                                            <input type="hidden" name="id" value="<?php echo $usuarios['id_usuario'] ?>">
                                            <input type="hidden" name="rol" value="<?php echo $usuarios['idRol'] ?>">

                                            <label for="">Nombres</label>
                                            <input type="text" name="nombres" id="validationCustom01" class="form-control" value="<?php echo $usuarios['Nombres'] ?>" required>

                                            <label for="">Primer Apellido</label>
                                            <input type="text" name="apellido_uno" class="form-control" value="<?php echo $usuarios['Primer_Apellido'] ?>" required>

                                            <label for="">Segundo Apellido</label>
                                            <input type="text" name="apellido_dos" class="form-control" value="<?php echo $usuarios['Segundo_Apellido'] ?>" required>

                                            <label for="">Tipo Documento</label>
                                            <select name="Tdoc" class="form-control">
                                                <option value="<?php echo $usuarios['id_documento'] ?>"><?php echo $usuarios['NombreDoc'] ?></option>
                                                <?php
                                                foreach ($data['doc'] as $ins) {
                                                ?>
                                                    <option value="<?php echo $ins['id_documento'] ?>"><?php echo $ins['NombreDoc'] ?></option>

                                                <?php
                                                }
                                                ?>
                                            </select>

                                            <label for="">Número Documento</label>
                                            <input type="number" class="form-control" name="Ndocumento" value="<?php echo $usuarios['NumeroDocmuento'] ?>" required>

                                            <label for="">Telefono</label>
                                            <input type="number" class="form-control" name="Telefono" value="<?php echo $usuarios['Telefono'] ?>" required>

                                            <label for="">Correo Electrnico</label>
                                            <input type="email" class="form-control" name="Email" value="<?php echo $usuarios['Correo'] ?>" required>

                                            <label for="">Curso</label>
                                            <input type="text" class="form-control" name="curso" value="<?php echo $usuarios['NombreCurso'] ?>" disabled>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
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
    </div>

    <!-- Modal de registro -->
    <div class="modal fade text-dark" id="ModalAgregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="needs-validation" action="ejecutar.php?c=Admin&a=registrarU" method="POST">
                    <div class="modal-header bg bg-primary text-white">
                        <h5 class="modal-title">Registrar Usuarios</h5>
                    </div>
                    <div class="modal-body">

                        <label for="">Nombres</label>
                        <input type="text" name="nombres" id="validationCustom01" class="form-control" required>

                        <label for="">Primer Apellido</label>
                        <input type="text" name="apellido_uno" class="form-control" required>

                        <label for="">Segundo Apellido</label>
                        <input type="text" name="apellido_dos" class="form-control" required>

                        <label for="">Tipo Documento</label>
                        <select name="Tdocumento" class="form-control">
                            <option value="">Selecciona ...</option>
                            <?php
                            foreach ($data['doc'] as $ins) {
                            ?>
                                <option value="<?php echo $ins['id_documento'] ?>"><?php echo $ins['NombreDoc'] ?></option>

                            <?php
                            }
                            ?>
                        </select>

                        <label for="">Número Documento</label>
                        <input type="number" class="form-control" name="Ndocumento" required>

                        <label for="">Rol</label>
                        <select name="Rol" class="form-control">
                            <option value="">Selecciona...</option>
                            <?php
                            foreach ($data3['rol'] as $rol) {
                            ?>
                                <option value="<?php echo $rol['id_rol'] ?>"><?php echo $rol['NombreRol'] ?></option>

                            <?php
                            }
                            ?>
                        </select>

                        <label for="">Telefono</label>
                        <input type="number" class="form-control" name="Telefono" required>

                        <label for="">Correo Electrnico</label>
                        <input type="email" class="form-control" name="Email" required>

                        <label for="">Curso</label>
                        <select name="Cursos" class="form-control">
                            <option value="">Selecciona...</option>
                            <?php
                            foreach ($data2['cursos'] as $cursos) {
                            ?>
                                <option value="<?php echo $cursos['id_curso'] ?>"><?php echo $cursos['NombreCurso'] ?></option>

                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Registrar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<!--Tabla que genera el excel-->
<div class="invisible">
    <table id="tabla_usuarios">
        <thead class="bg bg-primary text-white text-center">
            <tr>
                <th>Tipo Doc</th>
                <th>Numero Doc</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Telefono</th>
                <th>Rol</th>
                <th>Correo</th>
                <th>Curso</th>
                <th>Observaciones</th>
            </tr>
        </thead>

        <?php
        foreach ($data['usuarios'] as $usuarios) {
            $documento = $usuarios['NombreDoc'];
            $estado = $usuarios['Estado'];
            if ($documento == 'Cedula de Ciudadania') {
                $txt_documento = 'CC';
            }
            if ($documento == 'Tarjeta de Identidad') {
                $txt_documento = 'TI';
            }
            if ($documento == 'Cedula Extranjera') {
                $txt_documento = 'CE';
            }
        ?>
            <tr>
                <th><?php echo $txt_documento ?></th>
                <th><?php echo $usuarios['NumeroDocmuento'] ?></th>
                <th><?php echo $usuarios['Nombres'] ?></th>
                <th><?php echo $usuarios['Primer_Apellido'] . ' ' . $usuarios['Segundo_Apellido'] ?></th>
                <th><?php echo $usuarios['Telefono'] ?></th>
                <th><?php echo $usuarios['NombreRol'] ?></th>
                <th><?php echo $usuarios['Correo'] ?></th>
                <th><?php echo $usuarios['NombreCurso'] ?></th>
                <th><?php echo $usuarios['Observacion'] ?></th>
            </tr>
        <?php } ?>
    </table>
</div>