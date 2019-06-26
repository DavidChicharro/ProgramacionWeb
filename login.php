<?php
	session_start();

	function webLogin(){
		/*html de login*/
		echo ('
		<!DOCTYPE html>
		<html lang="es">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
				<title>RecomenBook</title>
				<link rel="icon" type="image/png" href="imagenes/icono.png" sizes="16x16">
				<link rel="stylesheet" type="text/css" href="index.css">
				<link rel="stylesheet" type="text/css" href="altausuario.css">
				<script src="js/encrypt.js" type="text/javascript"></script>
				<script src="js/validacion.js" type="text/javascript"></script>
			</head>

			<body>
				<header>
					<a class="link-logo" href="index.html">
						<img class="header-logo" src="imagenes/logo.png" alt="Logo">
					</a>

					<h1 class="titulo-web">RecomenBook</h1>

				</header>

				<main>
					<section class="inicio-sesion">
						<form name="formLogin" action="login.php" method="post" onsubmit="encryptPswd(\'password\')" onkeyup="formLoginValidation(this)">
							<fieldset>
								<legend>Inicia sesión en RecomenBook</legend>
								<input type="email" id="email" name="email" placeholder="Email" required><br>
								<input type="password" id="password" name="password" placeholder="Contraseña" minlength="8" required><br>

								<input type="submit" id="botonEnviar" value="Acceder" disabled onload="formLoginValidation(\'formLogin\')">
							</fieldset>
						</form>
						<a href="altausuario.html">Regístrate</a>
					</section>
				</main>

				<footer>
					<a href="mailto:davidcch@correo.ugr.es">Contacto</a>
					<span>&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;</span>
					<a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
				</footer>

			</body>
		</html>
		');
	}

	class Formulario{
		private $email;
		private $password;

		function __construct($atributos){
			$this->email=$atributos['email'];
			$this->password=$atributos['password'];
		}

		public function getEmail(){
			return $this->email;
		}

		public function getPassword(){
			return $this->password;
		}
	}

	$formulario = new Formulario($_POST);

	require_once ('classes/usuario.class.inc');
	$usuario = new Usuario();
	$usuarioBD = $usuario->obtenerUsuario( $formulario->getEmail() );

	if($formulario->getEmail() == $usuarioBD['email']){
		$passUsuarioBD = $usuario->obtenerPassword( $formulario->getEmail() );

		if($formulario->getPassword() == $passUsuarioBD['password']){
			$nombreUsuarioBD = $usuario->obtenerNombre( $formulario->getEmail() );
			$_SESSION["id"] = $usuarioBD['email'];
			$_SESSION["nombre"] = $nombreUsuarioBD['nombre'];
			echo "<p>Redireccionando a la pagina principal</p>";
			header("Location: index.php"); /* Redirección del navegador */
		}
		else webLogin();
	}
	else webLogin();

?>
