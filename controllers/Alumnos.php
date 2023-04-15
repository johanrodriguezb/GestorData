<?php

class AlumnosController
{

    public function __construct()
    {
        require_once "models/AlumnosModel.php";
    }

    public function indexAlumnos()
    {   
        $alumnos = new Alumnos_model();
        
        $data["alumnos"] = $alumnos->get_alumnos();
        require_once "views/alumnos.php";
    }

    public function aceptarAlumno($id){
        $alumnosA = new Alumnos_model();
		$alumnosA->aceptarAlumno($id);
    }

    public function eliminarAlumno($id){
        $alumnosD = new Alumnos_model();
		$alumnosD->eliminarAlumno($id);
    }

    public function agregarObser(){

        $id = $_POST['id_alumno'];
        $observacion = $_POST['observacion'];

        $alumnosOb = new Alumnos_model();
		$alumnosOb->agregarObser($id,$observacion);
    }


}
?>