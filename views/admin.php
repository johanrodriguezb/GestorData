<?php
session_start();
include 'assets/includes/scripts.html';

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
            <h1 class="text-primary">Bienvenido Administrador</h1>
            <p><b>Señ@r Admin, aquí encontrará una interfaz para la administración de gestores</b></p>
            <br>
            <table class="table table-bordered">
                <thead class="bg bg-primary text-white text-center">
                    <tr>
                        <th>Tipo Doc.</th>
                        <th># Doc.</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Telefono</th>
                        <th>Rol</th>
                        <th>Curso</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data['admin'] as $admins) {
                        $documento = $admins['NombreDoc'];
                        $inscrito = $admins['id_alumno'];
                        $id_usuario = $admins['id_usuario'];
                        if ($documento == 'Cedula de Ciudadania') {
                            $txt_documento = 'CC';
                        }
                        if ($documento == 'Tarjeta de Identidad') {
                            $txt_documento = 'TI';
                        }
                        if ($documento == 'Cedula Extranjera') {
                            $txt_documento = 'CE';
                        }

                        if (empty($inscrito)) {
                            $color_inscrito = 'btn btn-warning';
                            $txt_inscrito = 'Asignar';
                            $url = "#ModalAsignar$id_usuario";
                        }

                        if (isset($inscrito)) {
                            $color_inscrito = 'btn btn-success';
                            $txt_inscrito = 'Asignado';
                            $url = '';
                        }

                    ?>
                        <tr>
                            <th><?php echo $txt_documento ?></th>
                            <th><?php echo $admins['NumeroDocmuento'] ?></th>
                            <th><?php echo $admins['Nombres'] ?></th>
                            <th><?php echo $admins['Primer_Apellido'] . ' ' . $admins['Segundo_Apellido'] ?></th>
                            <th><?php echo $admins['Telefono'] ?></th>
                            <th><?php echo $admins['NombreRol'] ?><abbr title="<?php echo $admins['Correo'] ?>"><i class="fa-solid fa-circle-info fa-xs mt-3"></i></abbr> </th>
                            <th><?php echo $admins['NombreCurso'] ?></th>
                            <th><button type="button" class="btn <?php echo $color_inscrito ?>" data-bs-toggle="modal" data-bs-target="<?php echo $url ?>"><?php echo $txt_inscrito ?></button></th>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade text-dark" id="ModalAsignar<?php echo $admins['id_usuario'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="ejecutar.php?c=Admin&a=asignarI" method="POST">
                                        <div class="modal-header bg bg-primary text-white">
                                            <h5 class="modal-title">Asignar Instructor a <?php echo $admins['Nombres'] ?></h5>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id_alumno" value="<?php echo $admins['id_usuario'] ?>">
                                            <input type="hidden" name="id_curso" value="<?php echo $admins['Curso'] ?>">
                                            <label for="">Instructor</label>
                                            <select name="instructor" class="form-control">
                                                <option value="">Selecciona ...</option>
                                                <?php
                                                foreach ($datains['ins'] as $ins) {
                                                ?>
                                                    <option value="<?php echo $ins['Nombres'] . ' ' . $ins['Primer_Apellido'] ?>"><?php echo $ins['Nombres'] . ' ' . $ins['Primer_Apellido']  ?></option>

                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-success">Guardar</button>
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

</body>
<script>
    new window.simpleDatatables.DataTable("table")
</script>