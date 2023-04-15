<?php
    
class Alumnos_model
{
    private $db;
    private $alumnos;

    public function __construct()
    {
        $this->db = Conectar::conexion();
        $this->alumnos = array();
    }

    public function redireccionalumnos($alerta, $mensaje)
    {
        header("Location:ejecutar.php?c=Alumnos&a=indexAlumnos&aviso=$mensaje&ca=$alerta");
    }

    public function get_alumnos()
    {
        session_start();
        $nombre = $_SESSION["nombreD"];
        $sql = "SELECT * FROM usuarios a inner join tipoDocumento b on a.tipoDocumento = b.id_documento inner join rol c on a.idRol = c.id_rol inner join Cursos d on a.Curso = d.id_curso left join instructorescursos e on a.id_usuario = e.id_alumno WHERE a.idRol = 3 and e.nombre_instructor = '$nombre' ORDER BY e.id_alumno ASC";
        $resultado = $this->db->query($sql);
        while ($row = $resultado->fetch_assoc()) {
            $this->alumnos[] = $row;
        }
        return $this->alumnos;
    }

    public function agregarObser($id,$observacion){
        $sql = $this->db->query("UPDATE instructorescursos SET Observacion = '$observacion' WHERE id_alumno = $id");
        $alerta = 'alert-success';
        $mensaje = 'Observación Agregada';
        $this->redireccionalumnos($alerta, $mensaje);
    }
    
    public function aceptarAlumno($id){
        $sql = $this->db->query("UPDATE instructorescursos SET EstadoAceptado = 1 WHERE id_alumno = $id");
        $alerta = 'alert-success';
        $mensaje = 'Alumno Aceptado';
        $this->redireccionalumnos($alerta, $mensaje);
    }

    public function eliminarAlumno($id){
        $sql = $this->db->query("UPDATE instructorescursos SET EstadoAceptado = 0 WHERE id_alumno = $id");
        $alerta = 'alert-danger';
        $mensaje = 'Alumno Eliminado';
        $this->redireccionalumnos($alerta, $mensaje);
    }

    
}
