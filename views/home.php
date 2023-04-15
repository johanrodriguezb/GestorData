<?php
session_start();
if (!$_SESSION['verifica']) {
    header("Location:../index.php");
}
include '../assets/includes/scripts.html';
include '../config/database.php';
?>

<body>
    <div class="row h-100 w-100">
        <div class="col-md-3">
            <?php include '../assets/includes/sidebar.php'; ?>
        </div>
        <div class="col-md-8 m-5">
            <h1 class="text-primary">DashBoard Principal</h1>
            <div class="row">
                <div class="col-md-5 me-3 mt-5 alert alert-success">
                    <h4 class="text-dark">Alumnos Inscritos</h4><br>
                    <i class="fa-solid fa-face-smile fa-2xl text-dark"></i>
                    <?php
                    $sql = mysqli_query($con, "SELECT COUNT(id_usuario) as total_alunmos FROM usuarios where idRol = 3");
                    $resultado = mysqli_num_rows($sql);
                    if ($resultado > 0) {
                        while ($alumno = mysqli_fetch_array($sql)) {
                    ?>
                            <span class="mt-4 text-dark text-xl-left m-4 h3"><?php echo $alumno['total_alunmos'] ?></span>
                    <?php
                        }
                    }
                    ?>
                </div>
                <div class="col-md-5 me-3 mt-5 alert alert-success">
                    <h4 class="text-dark">Instructores Inscritos</h4><br>
                    <i class="fa-solid fa-people-group fa-2xl text-dark"></i>
                    <?php
                    $sql = mysqli_query($con, "SELECT COUNT(id_usuario) as total_ins FROM usuarios where idRol = 2");
                    $resultado = mysqli_num_rows($sql);
                    if ($resultado > 0) {
                        while ($instructores = mysqli_fetch_array($sql)) {
                    ?>
                            <span class="mt-4 text-dark text-xl-left m-4 h3"><?php echo $instructores['total_ins'] ?></span>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <?php
                $sql = mysqli_query($con, "SELECT b.NombreCurso ,COUNT(id_usuario) as total FROM usuarios a inner join cursos b on a.Curso = b.id_curso where Curso <> 7 group by curso order by total ASC limit 3");
                $resultado = mysqli_num_rows($sql);
                if ($resultado > 0) {
                    while ($curso = mysqli_fetch_array($sql)) {
                ?>
                        <div class="col-md-3 me-5 mt-5 alert alert-danger">
                            <h5 class="text-dark"><?php echo $curso['NombreCurso'] ?></h5><br>
                            <i class="fa-solid fa-people-group fa-2xl text-dark"></i>
                            <span class="mt-4 text-dark text-xl-left m-4 h3"><?php echo $curso['total'] ?></span>
                        </div>

                <?php
                    }
                }
                ?>
            </div>
        </div>


    </div>

</body>