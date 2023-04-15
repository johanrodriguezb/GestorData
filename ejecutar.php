<?php

require_once("config/config.php");
require_once("core/routes.php");
require_once ("config/database.php");


$comodin = $_GET['a'];

if ($comodin == 'verifica') {
    $accionC = ACCION_PRINCIPAL;
    $controladorC = CONTROLADOR_PRINCIPAL;
    $ruta = 'controllers/Usuarios.php';
}

if ($comodin == 'registrarE') {
    $accionC = ACCION_PRINCIPAL_E;
    $controladorC = CONTROLADOR_PRINCIPAL_E;
    $ruta = 'controllers/Usuarios.php';
}

if ($comodin == 'salir') {
    $accionC = ACCION_PRINCIPAL_D;
    $controladorC = CONTROLADOR_PRINCIPAL_D;
    $ruta = 'controllers/Usuarios.php';
}

if ($comodin == 'index') {
    $accionC = ACCION_PRINCIPAL_A;
    $controladorC = CONTROLADOR_PRINCIPAL_A;
    $ruta = 'controllers/Admin.php';
}

if ($comodin == 'indexUsuarios') {
    $accionC = ACCION_PRINCIPAL_U;
    $controladorC = CONTROLADOR_PRINCIPAL_U;
    $ruta = 'controllers/Admin.php';
}


if ($comodin == 'registrarU') {
    $accionC = ACCION_PRINCIPAL_RU;
    $controladorC = CONTROLADOR_PRINCIPAL_RU;
    $ruta = 'controllers/Admin.php';
}


if ($comodin == 'editarUsuarios') {
    $accionC = ACCION_PRINCIPAL_EU;
    $controladorC = CONTROLADOR_PRINCIPAL_EU;
    $ruta = 'controllers/Admin.php';
}

if ($comodin == 'eliminarUsuarios') {
    $accionC = ACCION_PRINCIPAL_DU;
    $controladorC = CONTROLADOR_PRINCIPAL_DU;
    $ruta = 'controllers/Admin.php';
}

if ($comodin == 'habilitarUsuarios') {
    $accionC = ACCION_PRINCIPAL_HU;
    $controladorC = CONTROLADOR_PRINCIPAL_HU;
    $ruta = 'controllers/Admin.php';
}

if ($comodin == 'asignarI') {
    $accionC = ACCION_PRINCIPAL_AI;
    $controladorC = CONTROLADOR_PRINCIPAL_AI;
    $ruta = 'controllers/Admin.php';
}

if ($comodin == 'indexCursos') {
    $accionC = ACCION_PRINCIPAL_CURSOS;
    $controladorC = CONTROLADOR_PRINCIPAL_CURSOS;
    $ruta = 'controllers/Admin.php';
}

if ($comodin == 'agregarCurso') {
    $accionC = ACCION_PRINCIPAL_AC;
    $controladorC = CONTROLADOR_PRINCIPAL_AC;
    $ruta = 'controllers/Admin.php';
}

if ($comodin == 'actualizarCurso') {
    $accionC = ACCION_PRINCIPAL_EC;
    $controladorC = CONTROLADOR_PRINCIPAL_EC;
    $ruta = 'controllers/Admin.php';
}

if ($comodin == 'elimnarCurso') {
    $accionC = ACCION_PRINCIPAL_DC;
    $controladorC = CONTROLADOR_PRINCIPAL_DC;
    $ruta = 'controllers/Admin.php';
}

if ($comodin == 'habilitarCurso') {
    $accionC = ACCION_PRINCIPAL_HC;
    $controladorC = CONTROLADOR_PRINCIPAL_HC;
    $ruta = 'controllers/Admin.php';
}

if ($comodin == 'indexAlumnos') {
    $accionC = ACCION_PRINCIPAL_AL;
    $controladorC = CONTROLADOR_PRINCIPAL_AL;
    $ruta = 'controllers/Alumnos.php';
}

if ($comodin == 'aceptarAlumno') {
    $accionC = ACCION_PRINCIPAL_AA;
    $controladorC = CONTROLADOR_PRINCIPAL_AA;
    $ruta = 'controllers/Alumnos.php';
}

if ($comodin == 'eliminarAlumno') {
    $accionC = ACCION_PRINCIPAL_DA;
    $controladorC = CONTROLADOR_PRINCIPAL_DA;
    $ruta = 'controllers/Alumnos.php';
}

if ($comodin == 'agregarObser') {
    $accionC = ACCION_PRINCIPAL_AO;
    $controladorC = CONTROLADOR_PRINCIPAL_AO;
    $ruta = 'controllers/Alumnos.php';
}

if ($comodin == 'reporte') {
    $accionC = ACCION_PRINCIPAL_R;
    $controladorC = CONTROLADOR_PRINCIPAL_R;
    $ruta = 'controllers/Reportes.php';
}
require_once("$ruta");


if(isset($_GET['c'])){
		
    $controlador = cargarControlador($_GET['c']);
    
    if(isset($_GET['a'])){
        if(isset($_GET['id'])){
            cargarAccion($controlador, $_GET['a'], $_GET['id']);
            } else {
            cargarAccion($controlador, $_GET['a']);
        }
        } else {
        cargarAccion($controlador, $accionC);
    }
    
    } else {
    
    $controlador = cargarControlador($controladorC);
    $accionTmp = $accionC;
    $controlador->$accionTmp();
}

?>
