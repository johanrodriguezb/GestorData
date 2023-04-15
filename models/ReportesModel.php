<?php
class Reportes_model
{
    private $db;
    private $reportes;

    public function __construct()
    {
        $this->db = Conectar::conexion();
        $this->reportes = array();
    }

    public function get_reportes($tipo)
    {
        $validar = $this->db->query("SELECT * FROM usuarios a inner join tipoDocumento b on a.tipoDocumento = b.id_documento inner join rol c on a.idRol = c.id_rol inner join Cursos d on a.Curso = d.id_curso left join instructorescursos e on a.id_usuario = e.id_alumno WHERE a.Curso = $tipo");
        $resultado = $this->db->query($validar);
        while ($row = $resultado->fetch_assoc()) {
            $this->reportes[] = $row;
        }
        return $this->reportes;
    }

    public function get_cursos2()
    {
        $sql = "SELECT * FROM cursos WHERE EstadoCurso = 1";
        $resultado = $this->db->query($sql);
        while ($row = $resultado->fetch_assoc()) {
            $this->reportes[] = $row;
        }
        return $this->reportes;
    }
}
