<?php

class ReportesController
{

    public function __construct()
    {
        require_once "models/ReportesModel.php";
    }

    public function reporte()
    {
        $cursos = new Reportes_model();
        $data2["cursos"] = $cursos->get_cursos2();
        require_once "views/reportes.php";
    }
}
