<?php

class AdminController
{

    public function __construct()
    {
        require_once "models/AdminModel.php";
    }

    public function index()
    {

        $admin = new Admin_model();
        $instructores = new Admin_model();
        

        $data["admin"] = $admin->get_admin();
        $datains["ins"] = $instructores->get_instructores();

        require_once "views/admin.php";
    }
    
    public function indexCursos(){

        $admin = new Admin_model();
        
        $cursos['cursos'] = $admin->get_cursos();
        require_once "views/cursos.php";
    }

    public function indexUsuarios()
    {
        $admin = new Admin_model();
        $documentos = new Admin_model();
        $cursos = new Admin_model();
        $rol = new Admin_model();

        $data["usuarios"] = $admin->get_usuarios();
        $data["doc"] = $documentos->get_doc();
        $data2["cursos"] = $cursos->get_cursos2();
        $data3["rol"] = $rol->get_rol();

        require_once "views/usuarios.php";
    }

    
    public function registrarU(){

        $nombres = $_POST['nombres'];
		$apellido_uno = $_POST['apellido_uno'];
		$apellido_dos = $_POST['apellido_dos'];
		$Tdocumento = $_POST['Tdocumento'];
		$Ndocumento = $_POST['Ndocumento'];
		$Telefono = $_POST['Telefono'];
		$Email = $_POST['Email'];
		$Cursos = $_POST['Cursos'];
        $Rol = $_POST['Rol'];

		$usuariosA = new Admin_model();
		$usuariosA->insertarU($nombres, $apellido_uno, $apellido_dos, $Tdocumento, $Ndocumento,$Telefono, $Email, $Cursos,$Rol);
    }

    public function editarUsuarios(){

        $id = $_POST['id'];
        $nombres = $_POST['nombres'];
		$apellido_uno = $_POST['apellido_uno'];
		$apellido_dos = $_POST['apellido_dos'];
		$Tdocumento = $_POST['Tdoc'];
		$Ndocumento = $_POST['Ndocumento'];
		$Telefono = $_POST['Telefono'];
		$Email = $_POST['Email'];
		$Cursos = $_POST['curso'];
        $Rol = $_POST['rol'];

		$usuariosE = new Admin_model();
		$usuariosE->editarU($id,$nombres, $apellido_uno, $apellido_dos, $Tdocumento, $Ndocumento,$Telefono, $Email, $Cursos,$Rol);
    }

    public function eliminarUsuarios($id){
        
        $usuariosD = new Admin_model();
		$usuariosD->eliminarU($id);
    }

    public function habilitarUsuarios($id){
        
        $usuariosH = new Admin_model();
		$usuariosH->habilitarU($id);
    }

    public function asignarI(){
        $id_alumno = $_POST['id_alumno'];
        $id_curso = $_POST['id_curso'];
        $instructor = $_POST['instructor'];

        $usuariosAsignar = new Admin_model();
		$usuariosAsignar->asignarIns($id_alumno,$id_curso,$instructor);
    }

    public function agregarCurso(){
        $NombreCurso = $_POST['NombreCurso'];
        $cursosA = new Admin_model();
		$cursosA->agregarCurso($NombreCurso);
    }

    public function actualizarCurso(){
        $id_curso = $_POST['id_curso'];
        $NombreCurso = $_POST['NombreCurso'];
        $cursosU = new Admin_model();
		$cursosU->actualizarCurso($id_curso,$NombreCurso);
    }

    public function elimnarCurso($id){
        $cursosD = new Admin_model();
		$cursosD->eliminarCurso($id);
    }

    public function habilitarCurso($id){
        $cursosUC = new Admin_model();
		$cursosUC->habilitarcurso($id);
    }
}
