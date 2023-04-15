<?php

class UsuariosController
{

	public function __construct()
	{
		require_once "models/UsuariosModel.php";
	}


	public function home()
	{
		header("Location:index.php?j=alerta");
	}


	public function verifica()
	{

		$correo = $_POST['correo'];
		$contrasena = $_POST['contrasena'];


		$usuarios = new Usuarios_model();
		$usuarios->ingresa($correo, $contrasena);
	}

	public function registrarE()
	{

		$nombres = $_POST['nombres'];
		$apellido_uno = $_POST['apellido_uno'];
		$apellido_dos = $_POST['apellido_dos'];
		$Tdocumento = $_POST['Tdocumento'];
		$Ndocumento = $_POST['Ndocumento'];
		$Telefono = $_POST['Telefono'];
		$Email = $_POST['Email'];
		$Cursos = $_POST['Cursos'];

		$usuarios_e = new Usuarios_model();
		$usuarios_e->insertarE($nombres, $apellido_uno, $apellido_dos, $Tdocumento, $Ndocumento,$Telefono, $Email, $Cursos);
		//$this->home();
	}


	public function salir(){
		session_start();
		session_destroy();
		header("Location:index.php");
	}
}
