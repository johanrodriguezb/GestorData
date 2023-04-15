<?php
class Usuarios_model
{
    private $db;
    private $usuarios;

    public function __construct()
    {
        $this->db = Conectar::conexion();
        $this->usuarios = array();
    }

    public function redireccion($alerta, $mensaje)
    {
        header("Location:index.php?aviso=$mensaje&ca=$alerta");
    }

    public function redireccion2($alerta, $mensaje)
    {
        header("Location:index.php?aviso2=$mensaje&ca=$alerta");
    }

    public function ingresa($correo, $contrasena)
    {
        if (isset($correo)) {
            $i = 0;
            $sql = $this->db->query("SELECT * FROM usuarios WHERE Correo = '$correo'");
            $resultado = mysqli_num_rows($sql);
            if ($resultado > 0) {
                while ($data = mysqli_fetch_array($sql)) {
                    if (password_verify($contrasena, $data['Contrasena'])) {
                        $i++;
                        $nombre = $data['Nombres'];
                        $rol = $data['idRol'];
                        $txt_nombre = $data['Nombres'] . ' ' . $data['Primer_Apellido'];
                    }
                }
                if ($i > 0) {
                    session_start();
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['rol'] = $rol;
                    $_SESSION['nombreD'] = $txt_nombre;
                    $_SESSION['verifica'] = true;
                    header("Location:views/home.php");
                } else {
                    $alerta = 'alert-danger';
                    $mensaje = 'Contraseña Incorrecta';
                    $this->redireccion($alerta, $mensaje);
                }
            } else {
                $alerta = 'alert-warning';
                $mensaje = 'Correo no Registrado';
                $this->redireccion($alerta, $mensaje);
            }
        }
    }

    public function insertarE($nombres, $apellido_uno, $apellido_dos, $Tdocumento, $Ndocumento, $Telefono, $Email, $Cursos)
    {
        $validar = $this->db->query("SELECT * FROM usuarios WHERE NumeroDocmuento = $Ndocumento OR Correo = '$Email'");
        $resultado = mysqli_num_rows($validar);

        if ($resultado > 0) {
            $alerta = 'alert-danger';
            $mensaje = 'Usuario Ya Registrado';
            $this->redireccion2($alerta, $mensaje);
        } else {

            $pass_cifrada = password_hash($Ndocumento, PASSWORD_DEFAULT);

            $sql = $this->db->query("INSERT INTO usuarios(tipoDocumento, NumeroDocmuento, Nombres, Primer_Apellido, Segundo_Apellido, Telefono, Correo,Contrasena,idRol, Curso) VALUES ($Tdocumento,$Ndocumento,'$nombres','$apellido_uno','$apellido_dos',$Telefono,'$Email','$pass_cifrada',3,$Cursos)");
            //echo "INSERT INTO usuarios(tipoDocumento, NumeroDocmuento, Nombres, Primer_Apellido, Segundo_Apellido, Telefono, Correo, Curso) VALUES ($Tdocumento,$Ndocumento,'$nombres','$apellido_uno','$apellido_dos',$Telefono,'$Email',$Cursos)";
            $alerta = 'alert-success';
            $mensaje = 'Usuario Registrado';
            $this->redireccion2($alerta, $mensaje);
        }
    }
}
