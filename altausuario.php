<?php
	class Formulario{
		private $email;
		private $nombre;
		private $apellidos;
		private $password;
		private $fechaNac;
		private $dirFoto;
		private $foto;

		function __construct($file, $atributos){
		  $this->email=$atributos['email'];
		  $this->nombre=$atributos['nombre'];
		  $this->apellidos=$atributos['apellidos'];
		  //$this->password=hash('sha256', $atributos['password']);
		  $this->password=$atributos['password'];
		  $this->fechaNac=$atributos['fecha_nac'];
		  $this->dirFoto="/home/x15520228/public_html/bookrecsysII/imagenes/";
		  //$this->dirFoto="/imagenes/";  
		  $this->foto=basename($file['foto']['name']);
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

		public function getPassword(){
		  return $this->password;
		}

		public function getFechaNac(){
		  return $this->fechaNac;
		}

		public function getDirFoto(){
		  return $this->dirFoto;
		}

		public function getFoto(){
		  return $this->foto;
		}

		public function getFotoWithDir(){
		  return $this->getDirFoto().$this->getFoto();
		}


	}

	$formulario = new Formulario($_FILES, $_POST);

	require_once ('classes/usuario.class.inc');
	$usuario = new Usuario();
	$usuarioBD = $usuario->obtenerUsuario( $formulario->getEmail() );

	/*	Si el email introducido para el registro ya existe en el sistema 
		se muestra una página como la anterior (altausuario.html) donde 
		se avisa al usuario de que el email ya existe en el sistema
	*/
	if($formulario->getEmail() == $usuarioBD['email']){
	    echo ('
	    <!DOCTYPE html>
	    	<html lang="es">
	    	<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
				<title>Registro | RecomenBook</title>
				<link rel="icon" type="image/png" href="imagenes/icono.png" sizes="16x16">
				<link rel="stylesheet" type="text/css" href="index.css">
				<link rel="stylesheet" type="text/css" href="altausuario.css">
				<script src="js/encrypt.js" type="text/javascript"></script>
				<script src="js/validacion.js" type="text/javascript"></script>
				<script>alert("¡El email introducido ya existe en el sistema!");</script>
			</head>

	    	<body>
	    		<main class="todo">
	    			<!--Sección izquierda de bienvenida -->
	    			<section class="izq-pag">
	    				<a class="link-logo-alta" href="index.html">
	    					<img src="imagenes/logo.png" class="logo" alt="Logo">
	    				</a>

	    				<article class="bienvenida">
	    					<ul>
	    						<li>Te recomendamos los mejores libros</li>
	    						<li>Disfruta compartiendo tus lecturas</li>
	    						<li>Descubre nuevos mundos con otros usuarios</li>
	    					</ul>
	    				</article>
	    			</section>

	    			<!--Sección derecha de registro -->
	    			<section class="dcha-pag">
	    				<hgroup>
	    					<h2>Regístrate</h2>
	    					<h3>Empieza a disfrutar de nuestro contenido</h3>
	    				</hgroup>

	    			<form name="formAltaUsuario" action="altausuario.php" method="post" enctype="multipart/form-data" onsubmit="encryptPswd(\'password\')" onkeyup="formValidation(this)">
							<input type="file" id="imagen" name="foto">					
							<input type="text" id="nombre" name="nombre" placeholder="Nombre" minlength="2" maxlength="25" onblur="formElemValidation(\'nombre\')" required><br>
							<input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" minlength="3" maxlength="60" onblur="formElemValidation(\'apellidos\')" required><br>
							<input type="email" class="email-invalido" id="email" name="email" placeholder="¡Email incorrecto! Por favor, introduce otro email"  required onblur="formElemValidation(\'email\'); emailValidation(\'formAltaUsuario\');"><br>
							<input type="password" id="password" name="password" placeholder="Contraseña" minlength="8" required onkeyup="check(); passValidation(\'formAltaUsuario\');"><br>
							<input type="password" id="passRepetir" name="passRepetir" placeholder="Repite la contraseña" minlength="8" required onkeyup="check()"><br>

							<label for="fNacimiento">Fecha de nacimiento</label><br>
							<input type="date" id="fNacimiento" name="fecha_nac" min="1902-01-01" max="2019-12-31" onblur="fechValidation()" required><br>

	    					<input class="btn-disabled" type="submit" id="btnCrearCuenta" value="Crear cuenta" disabled>
							<button class="btn-ini-ses"><a href="index.html">Inicia sesión</a></button>
	    				</form>
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
	else{
		session_start();
		//$uploaddir = '/home/x15520228/public_html/bookrecsysII/imagenes/';
		//$uploadfile = $uploaddir.basename($_FILES['foto']['name']);

		if (move_uploaded_file($_FILES['foto']['tmp_name'], $formulario->getFotoWithDir())) {
			$directorioFoto = "/imagenes/".$formulario->getFoto(); //???
			echo "<p>Subido correctamente</p>";
		}else{
			$directorioFoto = "icono-usuario.png";
			echo "<p>No se ha podido subir</p>";
		}
		echo "<p>".$directorioFoto."</p>";

		$usuario->insertarUsuario( $formulario->getEmail(), $formulario->getNombre(), $formulario->getApellidos(), $formulario->getPassword(), $formulario->getFechaNac(), $directorioFoto);

		$_SESSION["id"] = $formulario->getEmail();
		$_SESSION["nombre"] = $formulario->getNombre();

		header("Location: index.php"); /* Redirección del navegador */

		/* Asegurándonos de que el código interior no será ejecutado cuando se realiza la redirección. */
		exit;
	}
?>
