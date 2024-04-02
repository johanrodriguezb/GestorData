<?php
class Admin_model
{
    private $db;
    private $admin;

    public function __construct()
    {
        $this->db = Conectar::conexion();
        $this->admin = array();
    }

    public function redireccionadmin($alerta, $mensaje)
    {
        header("Location:ejecutar.php?c=Admin&a=indexUsuarios&aviso=$mensaje&ca=$alerta");
    }

    public function redireccionadmin2($alerta, $mensaje)
    {
        header("Location:ejecutar.php?c=Admin&a=index&aviso=$mensaje&ca=$alerta");
    }

    public function redireccionadmin3($alerta, $mensaje)
    {
        header("Location:ejecutar.php?c=Admin&a=indexCursos&aviso=$mensaje&ca=$alerta");
    }

    public function get_admin()
    {
        $sql = "SELECT * FROM usuarios a inner join tipodocumento b on a.tipoDocumento = b.id_documento inner join rol c on a.idRol = c.id_rol inner join cursos d on a.Curso = d.id_curso left join instructorescursos e on a.id_usuario = e.id_alumno WHERE a.idRol = 3 ORDER BY e.id_alumno ASC";
        $resultado = $this->db->query($sql);
        while ($row = $resultado->fetch_assoc()) {
            $this->admin[] = $row;
        }
        return $this->admin;
    }

    public function get_doc()
    {
        $sql = "SELECT * FROM tipodocumento";
        $resultado = $this->db->query($sql);
        while ($row = $resultado->fetch_assoc()) {
            $this->admin[] = $row;
        }
        return $this->admin;
    }

    public function get_cursos()
    {
        $sql = "SELECT * FROM cursos";
        $resultado = $this->db->query($sql);
        while ($row = $resultado->fetch_assoc()) {
            $this->admin[] = $row;
        }
        return $this->admin;
    }

    public function get_cursos2()
    {
        $sql = "SELECT * FROM cursos WHERE EstadoCurso = 1";
        $resultado = $this->db->query($sql);
        while ($row = $resultado->fetch_assoc()) {
            $this->admin[] = $row;
        }
        return $this->admin;
    }

    public function get_rol()
    {
        $sql = "SELECT * FROM rol";
        $resultado = $this->db->query($sql);
        while ($row = $resultado->fetch_assoc()) {
            $this->admin[] = $row;
        }
        return $this->admin;
    }


    public function get_usuarios()
    {
        $sql = "SELECT * FROM usuarios a inner join tipodocumento b on a.tipoDocumento = b.id_documento inner join rol c on a.idRol = c.id_rol inner join cursos d on a.Curso = d.id_curso left join instructorescursos e on a.id_usuario = e.id_alumno";
        $resultado = $this->db->query($sql);
        while ($row = $resultado->fetch_assoc()) {
            $this->admin[] = $row;
        }
        return $this->admin;
    }

    public function get_instructores()
    {
        $sql = "SELECT * FROM usuarios a inner join tipodocumento b on a.tipoDocumento = b.id_documento inner join rol c on a.idRol = c.id_rol inner join cursos d on a.Curso = d.id_curso WHERE idRol = 2";
        $resultado = $this->db->query($sql);
        while ($row = $resultado->fetch_assoc()) {
            $this->admin[] = $row;
        }
        return $this->admin;
    }


    public function insertarU($nombres, $apellido_uno, $apellido_dos, $Tdocumento, $Ndocumento, $Telefono, $Email, $Cursos, $Rol)
    {

        $validar = $this->db->query("SELECT * FROM usuarios WHERE NumeroDocmuento = $Ndocumento OR Correo = '$Email'");
        $resultado = mysqli_num_rows($validar);

        if ($resultado > 0) {
            $alerta = 'alert-danger';
            $mensaje = 'Usuario Ya Registrado';
            $this->redireccionadmin($alerta, $mensaje);
        } else {
            $pass_cifrada = password_hash($Ndocumento, PASSWORD_DEFAULT);

            $sql = $this->db->query("INSERT INTO usuarios(tipoDocumento, NumeroDocmuento, Nombres, Primer_Apellido, Segundo_Apellido, Telefono, Correo,Contrasena,idRol, Curso) VALUES ($Tdocumento,$Ndocumento,'$nombres','$apellido_uno','$apellido_dos',$Telefono,'$Email','$pass_cifrada',$Rol,$Cursos)");
            //echo "INSERT INTO usuarios(tipoDocumento, NumeroDocmuento, Nombres, Primer_Apellido, Segundo_Apellido, Telefono, Correo, Curso) VALUES ($Tdocumento,$Ndocumento,'$nombres','$apellido_uno','$apellido_dos',$Telefono,'$Email',$Cursos)";
            $alerta = 'alert-success';
            $mensaje = 'Usuario Registrado';
            $this->redireccionadmin($alerta, $mensaje);
        }
    }

    public function editarU($id, $nombres, $apellido_uno, $apellido_dos, $Tdocumento, $Ndocumento, $Telefono, $Email, $Cursos, $Rol)
    {

        $sql = $this->db->query("UPDATE usuarios SET tipoDocumento = $Tdocumento, NumeroDocmuento = $Ndocumento, Nombres = '$nombres', Primer_Apellido = '$apellido_uno', Segundo_Apellido = '$apellido_dos', Telefono = $Telefono, Correo = '$Email' WHERE id_usuario = $id");
        //echo "UPDATE usuarios SET tipoDocumento = $Tdocumento, NumeroDocmuento = $Ndocumento, Nombres = '$nombres', Primer_Apellido = '$apellido_uno', Segundo_Apellido = '$apellido_dos', Telefono = $Telefono, Correo = '$Email' WHERE id_usuario = $id";
        $alerta = 'alert-success';
        $mensaje = 'Usuario Actualizado';
        $this->redireccionadmin($alerta, $mensaje);
    }


    public function eliminarU($id)
    {
        $sql = $this->db->query("UPDATE usuarios SET Estado = 0 WHERE id_usuario = $id");
        $alerta = 'alert-danger';
        $mensaje = 'Usuario Eliminado';
        $this->redireccionadmin($alerta, $mensaje);
    }

    public function habilitarU($id)
    {
        $sql = $this->db->query("UPDATE usuarios SET Estado = 1 WHERE id_usuario = $id");
        $alerta = 'alert-success';
        $mensaje = 'Usuario Habilitado';
        $this->redireccionadmin($alerta, $mensaje);
    }

    public function asignarIns($id_alumno, $id_curso, $instructor)
    {
        $sql = $this->db->query("INSERT INTO instructorescursos(id_alumno, id_curso, nombre_instructor) VALUES ($id_alumno,$id_curso,'$instructor')");
        $alerta = 'alert-success';
        $mensaje = 'Instructor Asignado';
        $this->redireccionadmin2($alerta, $mensaje);
    }

    public function agregarCurso($NombreCurso)
    {
        $validar = $this->db->query("SELECT * FROM cursos WHERE NombreCurso = '$NombreCurso'");
        $resultado = mysqli_num_rows($validar);

        if ($resultado > 0) {
            $alerta = 'alert-danger';
            $mensaje = 'Curso Ya Registrado';
            $this->redireccionadmin3($alerta, $mensaje);
        } else {

            $sql = $this->db->query("INSERT INTO cursos(NombreCurso) VALUES ('$NombreCurso')");
            $alerta = 'alert-success';
            $mensaje = 'Curso Registrado';
            $this->redireccionadmin3($alerta, $mensaje);
        }
    }

    public function actualizarCurso($id_curso, $NombreCurso)
    {

        $sql = $this->db->query("UPDATE cursos SET NOmbreCurso = '$NombreCurso' WHERE id_curso = $id_curso");
        $alerta = 'alert-success';
        $mensaje = 'Curso Actualizado';
        $this->redireccionadmin3($alerta, $mensaje);
    }

    public function eliminarCurso($id)
    {
        $sql = $this->db->query("UPDATE cursos SET EstadoCurso = 0 WHERE id_curso = $id");
        $alerta = 'alert-danger';
        $mensaje = 'Curso Eliminado';
        $this->redireccionadmin3($alerta, $mensaje);
    }

    public function habilitarcurso($id)
    {

        $sql = $this->db->query("UPDATE cursos SET EstadoCurso = 1 WHERE id_curso = $id");
        $alerta = 'alert-success';
        $mensaje = 'Curso Habilitado';
        $this->redireccionadmin3($alerta, $mensaje);
    }
}
