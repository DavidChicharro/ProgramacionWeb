<?php
session_start();
if (!isset($_SESSION["id"])){
	header("Location: index.html");
	exit;
}

if( isset($_POST["modificarDatos"]) || isset($_POST["cambiarPass"]) ){

	class FormularioDatos{
		private $email;
		private $nombre;
		private $apellidos;
		private $fechaNac;

		function __construct($atributos){
		  $this->email=$atributos['email'];
		  $this->nombre=$atributos['nombre'];
		  $this->apellidos=$atributos['apellidos'];
		  $this->fechaNac=$atributos['fecha_nac'];
		}

		public function getEmail(){
		  return $this->email;
		}

		public function getNombre(){
		  return $this->nombre;
		}

		public function getApellidos(){
		  return $this->apellidos;
		}

		public function getFechaNac(){
		  return $this->fechaNac;
		}
	}

	class FormularioPass{
		private $password;
		private $newPassword;

		function __construct($atributos){
		  $this->password=$atributos['passActual'];
		  $this->newPassword=$atributos['passNueva'];
		}

		public function getPassword(){
		  return $this->password;
		}

		public function getPasswordNueva(){
		  return $this->newPassword;
		}
	}

	require_once ('classes/usuario.class.inc');
	$usuario = new Usuario();

	if( isset($_POST["modificarDatos"]) ) {
		$formulario = new FormularioDatos($_POST);
		$usuarioBD = $usuario->obtenerDatosUsuario( $_SESSION['id'] );
		$usuarioSys = $usuario->obtenerUsuario( $formulario->getEmail() );

		if($formulario->getEmail() != $usuarioBD['email'] ){
			if( $formulario->getEmail() == $usuarioSys['email'] ) {			
				echo "<script> alert('Email inválido.');
	        	window.location.replace(\"datospersonales.php\");</script>";
			}
			
			$usuario->modificarEmail( $_SESSION['id'], $formulario->getEmail() );

			require_once ('classes/libro.class.inc');
			$libro = new Libro();
			$libro->modificarEmail( $_SESSION['id'], $formulario->getEmail() );

			require_once ('classes/lee.class.inc');
			$lee = new Lee();
			$lee->modificarEmail( $_SESSION['id'], $formulario->getEmail() );

			require_once ('classes/valoraciones.class.inc');
			$valoraciones = new Valoraciones();
			$valoraciones->modificarEmail( $_SESSION['id'], $formulario->getEmail() );

			$_SESSION['id'] = $formulario->getEmail();
		}
		
		$usuario->modificarDatosPersonales( $formulario->getEmail(), $formulario->getNombre(), $formulario->getApellidos(), $formulario->getFechaNac() );

		$usuarioBD = $usuario->obtenerDatosUsuario( $_SESSION['id'] );
		$_SESSION["nombre"] = $usuarioBD["nombre"];

		$message = "Los datos han sido cambiados correctamente.";

	}else if ( isset($_POST["cambiarPass"]) ){
		$formulario = new FormularioPass($_POST);

		$passwordUser = $usuario->obtenerPassword( $_SESSION['id'] );
		if( $passwordUser['password'] == $formulario->getPassword() ){
			if( $formulario->getPassword() != $formulario->getPasswordNueva()){
				$usuario->modificarPassword( $_SESSION["id"], $formulario->getPasswordNueva() );
				$message = "La contraseña ha sido cambiada correctamente.";
			}
		}else{
			$message = "La contraseña introducida es incorrecta.";
		}
		
	}

	echo "<script> //not showing me this
        alert('$message');
        window.location.replace(\"datospersonales.php\");
    </script>";

}else{
	header("Location: index.php");
	exit;
}

?>