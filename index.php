<!DOCTYPE html>
<html lang="es">


<?php
include 'assets/includes/scripts.html';
include 'config/database.php';
?>
<title>Control de Datos</title>


<body class="text-white" background="assets/img/fondo.jpg">
    <div class="container">
        <div class="row">

            <div class="col-md-5">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="text-center">
                    <h3 class="text-center m-5">Registrate</h3>
                    <!-- Boton Modal para Registrarse -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistro">
                        Registrame !
                    </button>
                </div>
                <?php
                if (isset($_GET['aviso2'])) {
                ?>
                    <div>
                        <br>
                        <div class="alert <?php echo $_GET['ca'] ?> alert-dismissible fade show" role="alert">
                            <strong><?php echo $_GET['aviso2'] ?>!</strong> Intente de nuevo.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

            <div class="col-md-5 m-5">
                <form action="ejecutar.php?c=Usuarios&a=verifica" method="POST">
                    <div class="container">
                        <br>
                        <?php
                        if (isset($_GET['aviso'])) {
                        ?>
                            <div>
                                <br>
                                <div class="alert <?php echo $_GET['ca'] ?> alert-dismissible fade show" role="alert">
                                    <strong><?php echo $_GET['aviso'] ?>!</strong> Intente de nuevo.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <br>
                        <br>
                        <br>
                        <br>
                        <h3 class="text-center">Ingreso</h3>

                        <label for="">Correo</label>
                        <input type="text" name="correo" class="form-control" required>

                        <label for="">Contraseña</label>
                        <input type="password" name="contrasena" class="form-control" required>
                        <label class="text-white"> (Recuerde que su contraseña es su número de Cedula)</label>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-warning">Ingresar !</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>


<!-- Modal de registro -->
<div class="modal fade text-dark" id="modalRegistro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="needs-validation" action="ejecutar.php?c=Usuarios&a=registrarE" method="POST">
                <div class="modal-header bg bg-primary text-white">
                    <h5 class="modal-title">Registrarme</h5>
                </div>
                <div class="modal-body">

                    <label for="">Nombres</label>
                    <input type="text" name="nombres" id="validationCustom01" class="form-control" required>

                    <label for="">Primer Apellido</label>
                    <input type="text" name="apellido_uno" class="form-control" required>

                    <label for="">Segundo Apellido</label>
                    <input type="text" name="apellido_dos" class="form-control" required>

                    <label for="">Tipo de documento</label>
                    <select name="Tdocumento" id="" class="form-control" required>
                        <option value="">Selecciona...</option>
                        <?php
                        $sql = mysqli_query($con, "SELECT * FROM tipodocumento");
                        $resultado = mysqli_num_rows($sql);
                        if ($resultado > 0) {
                            while ($doc = mysqli_fetch_array($sql)) {
                        ?>
                                <option value="<?php echo $doc['id_documento'] ?>"><?php echo $doc['NombreDoc'] ?></option>

                        <?php
                            }
                        }
                        ?>
                    </select>

                    <label for="">Número Documento</label>
                    <input type="number" class="form-control" name="Ndocumento" required>

                    <label for="">Telefono</label>
                    <input type="number" class="form-control" name="Telefono" required>

                    <label for="">Correo Electrnico</label>
                    <input type="email" class="form-control" name="Email" required>

                    <label for="">Cursos o Materias</label>
                    <select name="Cursos" id="" class="form-control" required>
                        <option value="">Selecciona...</option>
                        <?php
                        $sql = mysqli_query($con, "SELECT * FROM cursos where EstadoCurso = 1");
                        $resultado = mysqli_num_rows($sql);
                        if ($resultado > 0) {
                            while ($curso = mysqli_fetch_array($sql)) {
                        ?>
                                <option value="<?php echo $curso['id_curso'] ?>"><?php echo $curso['NombreCurso'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Registrarme !</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>