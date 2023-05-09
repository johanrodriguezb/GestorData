<?php
session_start();
include '../assets/includes/scripts.html';
include '../assets/includes/function.php';
include '../config/database.php';
?>

<body>
    <div class="row h-100 w-100">
        <div class="col-md-3">
            <?php include '../assets/includes/sidebarReportes.php'; ?>
        </div>
        <div class="col-md-8 m-5">
            <h1 class="text-primary">Administración de Reportes de gestores</h1>
            <p><b>Señ@r Admin, aquí encontrará una interfaz para la descarga del reporte seleccionado</b></p>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <form action="gestores.php" method="POST">
                        <label for="">Seleccione Curso</label>
                        <select name="tipoG" id="" class="form-control" required>
                            <option value="">Selecciona...</option>
                            <?php
                            $sql = mysqli_query($con, "SELECT * FROM usuarios where idRol = 2");
                            $resultado = mysqli_num_rows($sql);
                            if ($resultado > 0) {
                                while ($curso = mysqli_fetch_array($sql)) {
                            ?>
                                    <option value="<?php echo $curso['Nombres'] . ' ' . $curso['Primer_Apellido'] ?>"><?php echo $curso['Nombres'] . ' ' . $curso['Primer_Apellido'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <br>
                        <input type="hidden" name="reportes" value="reporte">
                        <button type="submit" class="btn btn-success">Consultar</button>
                    </form>
                </div>
            </div>
            <?php
            if (isset($_POST['reportes'])) {
                
               
            ?>
            <div class="">
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
                    $nombre = $_POST['tipoG'];
                    $sql = mysqli_query($con, "SELECT * FROM usuarios a inner join tipoDocumento b on a.tipoDocumento = b.id_documento inner join rol c on a.idRol = c.id_rol inner join Cursos d on a.Curso = d.id_curso left join instructorescursos e on a.id_usuario = e.id_alumno WHERE a.idRol = 3 and e.nombre_instructor = '$nombre' GROUP BY e.id_alumno  ORDER BY e.id_alumno ASC");
                    $resultado = mysqli_num_rows($sql);
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>

                        <?php
                        $documento = $data['NombreDoc'];
                        $estado = $data['Estado'];
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
                            <th><?php echo $data['NumeroDocmuento'] ?></th>
                            <th><?php echo $data['Nombres'] ?></th>
                            <th><?php echo $data['Primer_Apellido'] . ' ' . $data['Segundo_Apellido'] ?></th>
                            <th><?php echo $data['Telefono'] ?></th>
                            <th><?php echo $data['NombreRol'] ?></th>
                            <th><?php echo $data['Correo'] ?></th>
                            <th><?php echo $data['NombreCurso'] ?></th>
                            <th><?php echo $data['Observacion'] ?></th>
                        </tr>
                    <?php } ?>
                </table>
            </div>
                <hr>
                <p class="text-danger"><b>Señ@r Administrador va a generar una descarga para el curso de <?php echo $nombre?></b></p>
                <button type="button" class="btn btn-success" onclick="exportTableToExcel('tabla_usuarios', 'gestores')">Descargar Excel</button>       
            <?php
            }


            ?>
        </div>
    </div>
</body>
