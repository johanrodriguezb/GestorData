<?php

if (!$_SESSION['verifica']) {
    header("Location:../index.php");
}
include 'assets/includes/scripts.html';
include 'assets/includes/function.php';
?>

<body>
    <div class="row h-100 w-100">
        <div class="col-md-3">
            <?php include 'assets/includes/sidebarAlumnos.php'; ?>
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
            <h1 class="text-primary">Mis Alumnos</h1>
            <p><b>Señ@r Gestor, aquí encontrará una interfaz para la administración de sus alumnos</b></p>
            <br>
            <button type="button" class="btn btn-success" onclick="exportTableToExcel('tabla_alumnos', 'tabla_alumnos')">Generar Excel</button>
            <br>
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
                        <th>Accion 1</th>
                        <th>Accion 2</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data['alumnos'] as $alumnos) {
                        $documento = $alumnos['NombreDoc'];
                        $estado = $alumnos['EstadoAceptado'];
                        $observacion = $alumnos['Observacion'];
                        $id_alumno = $alumnos['id_usuario'];


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
                            $ruta = 'ejecutar.php?c=Alumnos&a=eliminarAlumno';
                        }
                        if ($estado == 0) {
                            $txt_estado = 'Aceptar';
                            $color_estado = 'btn-success';
                            $ruta = 'ejecutar.php?c=Alumnos&a=aceptarAlumno';
                        }

                        if ($observacion == 'Ninguna') {
                            $txt_observacion = 'Observación';
                            $color_observacion = 'btn-warning';
                            $rutaO = "#ModalObser$id_alumno";
                        }

                        if ($observacion != 'Ninguna') {
                            $txt_observacion = 'Observación';
                            $color_observacion = 'btn-primary';
                            $rutaO = "#ModalObserlisto$id_alumno";
                        }

                    ?>

                        <tr>
                            <th><?php echo $txt_documento ?></th>
                            <th><?php echo $alumnos['NumeroDocmuento'] ?></th>
                            <th><?php echo $alumnos['Nombres'] ?></th>
                            <th><?php echo $alumnos['Primer_Apellido'] . ' ' . $alumnos['Segundo_Apellido'] ?></th>
                            <th><?php echo $alumnos['Telefono'] ?></th>
                            <th><?php echo $alumnos['NombreRol'] ?><abbr title="<?php echo $alumnos['Correo'] ?>"><i class="fa-solid fa-circle-info fa-xs mt-3"></i></abbr> </th>
                            <th><?php echo $alumnos['NombreCurso'] ?></th>
                            <th><a href="<?php echo $ruta ?>&id=<?php echo $alumnos['id_usuario'] ?>"><button type="submit" class="btn <?php echo $color_estado ?>"><?php echo $txt_estado ?></button></a></th>
                            <th><button type="button" class="btn <?php echo $color_observacion ?>" data-bs-toggle="modal" data-bs-target="<?php echo $rutaO ?>"><?php echo $txt_observacion ?></button></th>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade text-dark" id="ModalObser<?php echo $alumnos['id_usuario'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="ejecutar.php?c=Alumnos&a=agregarObser" method="POST">
                                        <div class="modal-header bg bg-primary text-white">
                                            <h5 class="modal-title">Observación para: <b><?php echo $alumnos['Nombres'] ?></b></h5>
                                        </div>
                                        <div class="modal-body">

                                            <input type="hidden" name="id_alumno" value="<?php echo $alumnos['id_usuario'] ?>">
                                            <label for="">Ingrese una Observación</label>
                                            <textarea name="observacion" id="" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-success">Guardar Observación</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal observacion-->
                        <div class="modal fade text-dark" id="ModalObserlisto<?php echo $alumnos['id_usuario'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="ejecutar.php?c=Alumnos&a=agregarObser" method="POST">
                                        <div class="modal-header bg bg-primary text-white">
                                            <h5 class="modal-title">Observación registrada de: <b><?php echo $alumnos['Nombres'] ?></b></h5>
                                        </div>
                                        <div class="modal-body">
                                            <p><b><?php echo $alumnos['Observacion'] ?></b></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
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

    <!--Tabla que genera el excel-->
    <div class="invisible">
        <table id="tabla_alumnos">
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
                </tr>
            </thead>

            <?php
            foreach ($data['alumnos'] as $alumnos) {
                $documento = $alumno['NombreDoc'];
                $estado = $alumno['Estado'];
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
                    <th><?php echo $alumnos['NumeroDocmuento'] ?></th>
                    <th><?php echo $alumnos['Nombres'] ?></th>
                    <th><?php echo $alumnos['Primer_Apellido'] . ' ' . $alumnos['Segundo_Apellido'] ?></th>
                    <th><?php echo $alumnos['Telefono'] ?></th>
                    <th><?php echo $alumnos['NombreRol'] ?></th>
                    <th><?php echo $alumnos['Correo'] ?></th>
                    <th><?php echo $alumnos['NombreCurso'] ?></th>
                </tr>
            <?php } ?>
        </table>

</body>
<script>
    new window.simpleDatatables.DataTable("table")
</script>