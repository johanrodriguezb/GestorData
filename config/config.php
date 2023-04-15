<?php

// variables globales para ejecutar el inicio de sesion

define("CONTROLADOR_PRINCIPAL", "Usuarios");
define("ACCION_PRINCIPAL", "index");

// variables globales para el registro de externos
define("CONTROLADOR_PRINCIPAL_E", "Usuarios");
define("ACCION_PRINCIPAL_E", "registrarE");

// variables globales para destruir la sesion de inicio
define("CONTROLADOR_PRINCIPAL_D", "Usuarios");
define("ACCION_PRINCIPAL_D", "salir");


// variables globales para el panel de Admin
define("CONTROLADOR_PRINCIPAL_A", "Admin");
define("ACCION_PRINCIPAL_A", "index");

// variables globales para el panel de Admin de usuarios
define("CONTROLADOR_PRINCIPAL_U", "Admin");
define("ACCION_PRINCIPAL_U", "indexUsuarios");

// variables globales para registrar usuarios
define("CONTROLADOR_PRINCIPAL_RU", "Admin");
define("ACCION_PRINCIPAL_RU", "registrarU");

// variables globales para editar usuarios
define("CONTROLADOR_PRINCIPAL_EU", "Admin");
define("ACCION_PRINCIPAL_EU", "editarUsuarios");

// variables globales para eliminar usuarios
define("CONTROLADOR_PRINCIPAL_DU", "Admin");
define("ACCION_PRINCIPAL_DU", "eliminarUsuarios");

// variables globales para habilitar usuarios
define("CONTROLADOR_PRINCIPAL_HU", "Admin");
define("ACCION_PRINCIPAL_HU", "habilitarUsuarios");

// variables globales para asignar instructores
define("CONTROLADOR_PRINCIPAL_AI", "Admin");
define("ACCION_PRINCIPAL_AI", "asignarI");

// variables globales para index de cursos
define("CONTROLADOR_PRINCIPAL_CURSOS", "Admin");
define("ACCION_PRINCIPAL_CURSOS", "indexCursos");

// variables globales para agregar cursos
define("CONTROLADOR_PRINCIPAL_AC", "Admin");
define("ACCION_PRINCIPAL_AC", "agregarCurso");

// variables globales para editar cursos
define("CONTROLADOR_PRINCIPAL_EC", "Admin");
define("ACCION_PRINCIPAL_EC", "actualizarCurso");

// variables globales para eliminar cursos
define("CONTROLADOR_PRINCIPAL_DC", "Admin");
define("ACCION_PRINCIPAL_DC", "elimnarCurso");

// variables globales para habilitar cursos
define("CONTROLADOR_PRINCIPAL_HC", "Admin");
define("ACCION_PRINCIPAL_HC", "habilitarCurso");

// variables globales para index mis alumnos
define("CONTROLADOR_PRINCIPAL_AL", "Alumnos");
define("ACCION_PRINCIPAL_AL", "indexAlumnos");

// variables globales para aceptar mis alumnos
define("CONTROLADOR_PRINCIPAL_AA", "Alumnos");
define("ACCION_PRINCIPAL_AA", "aceptarAlumno");

// variables globales para eliminar mis alumnos
define("CONTROLADOR_PRINCIPAL_DA", "Alumnos");
define("ACCION_PRINCIPAL_DA", "eliminarAlumno");

// variables globales para eliminar mis alumnos
define("CONTROLADOR_PRINCIPAL_AO", "Alumnos");
define("ACCION_PRINCIPAL_AO", "agregarObser");

// variables globales para reportes
define("CONTROLADOR_PRINCIPAL_R", "Reportes");
define("ACCION_PRINCIPAL_R", "reporte");