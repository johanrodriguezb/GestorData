<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark fixed-top" style="width: 290px; height:100%;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <i class="fa-brands fa-slack fa-lg me-2"></i>
        <span class="">Gestión de Datos</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="home.php" class="nav-link text-white active" aria-current="page">
                <i class="fa-solid fa-house fa-lg me-2"></i>
                Inicio
            </a>
        </li>
        <?php
        if ($_SESSION['rol'] == 1) {
        ?>
            <li>
                <a href="../ejecutar.php?c=Admin&a=index" class="nav-link text-white">
                    <i class="fa-solid fa-circle-user fa-lg me-2"></i>
                    Administrador
                </a>
            </li>
        <?php
        }
        ?>
        <?php
        if ($_SESSION['rol'] == 2) {
        ?>
            <li>
                <a href="../ejecutar.php?c=Alumnos&a=indexAlumnos" class="nav-link text-white">
                    <i class="fa-solid fa-hand fa-lg me-2"></i>
                    Mis Alumnos
                </a>
            </li>
        <?php
        }
        ?>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../assets/img/user.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong><?php echo $_SESSION['nombre']; ?></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">Perfil</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="../ejecutar.php?c=Usuarios&a=salir">Salir</a></li>
        </ul>
    </div>
</div>