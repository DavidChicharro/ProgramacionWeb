<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Mis Datos | RecomenBook</title>
		<link rel="icon" type="image/png" href="imagenes/icono.png" sizes="16x16">
		<link rel="stylesheet" type="text/css" href="index.css">
		<link rel="stylesheet" type="text/css" href="index2.css">
		<link rel="stylesheet" type="text/css" href="formulario.css">
		<script src="js/encrypt.js" type="text/javascript"></script>
		<script src="js/validacion.js" type="text/javascript"></script>

		<script>
			function encryptPswd2(el){
				let pswd = el.value;
				return encrypt(pswd);
			}
		</script>
	</head>

	<body>
		<?php
			require_once("template/header_nav.php");
		?>

		<script>
			function alertLibrosSubidos(){
				<?php
				require_once ('classes/libro.class.inc');

				$libro = new Libro();
				$librosBD = $libro->obtenerLibrosSubidos( $_SESSION['id'] );

				$userLibros = "";
				if(is_null($librosBD)){
					$userLibros = "No ha subido ningún libro.";
				}
				else{
					foreach ($librosBD as $librosSubidos) {
						$userLibros .= $librosSubidos['titulo'].",";
					}
				}
				?>

				let libros = <?php echo ('"'.$userLibros.'";'); ?>
				libros = libros.replace(/,/g, "\n");

				alert("Libros subidos: \n"+libros);
			}
		</script>

		<!--Sección de datos personales -->
		<section>
			<form name="datos_personales" action="cambiar_datos.php" method="post" onkeyup="formDatosPersonalesValidation(this)">
				<fieldset>
					<legend>Datos personales</legend>

					<?php
					require_once ('classes/usuario.class.inc');

					$usuario = new Usuario();
					$usuarioBD = $usuario->obtenerDatosUsuario( $_SESSION['id'] );

					echo ('
					<article class="form-item-1">
						<label for="nombre">Nombre</label>
						<input type="text" id="nombre" name="nombre" value="'.$usuarioBD['nombre'].'" required><br>
					</article>

					<article class="form-item-1">
						<label for="apellidos">Apellidos</label>
						<input type="text" id="apellidos" name="apellidos" value="'.$usuarioBD['apellidos'].'" required><br>
					</article>


					<article class="form-item-1">
						<label for="email">Email</label>
						<input type="email" id="email" name="email" value="'.$usuarioBD['email'].'" required><br>
					</article>

					<article class="form-item-1">
						<label for="fNacimiento">Fecha de nacimiento</label>
						<input type="date" id="fNacimiento" name="fecha_nac" value="'.$usuarioBD['fecha_nac'].'" required><br>
					</article>

					<section class="foto-form">	
						<img class="icono-usuario" src="imagenes/'.$fotoUsuario['foto'].'" alt="icono" onmouseover="alertLibrosSubidos()">
					</section>
					');
					?>

					<input class="btn-disabled" type="submit" id="btnGuardarCambios" name="modificarDatos" value="Guardar cambios" disabled><br>
				</fieldset>
			</form>
		</section>

		<section>
			<form name="form_pass" action="cambiar_datos.php" method="post" onsubmit="encryptPswd('passActual'); encryptPswd('password');" onkeyup="formPassValidation(this)">
				<fieldset>
					<legend>Contraseña</legend>
					
					<article class="form-item-1">
						<label for="passActual">Contraseña actual</label>
						<input type="password" id="passActual" name="passActual" minlength="8" required onkeyup="checkPass()"><br>
					</article>

					<article class="form-item-1">
						<label for="passNueva">Contraseña nueva</label>
						<input type="password" id="password" name="passNueva" minlength="8" required onkeyup="checkPass()"><br>
					</article>

					<article class="form-item-1">
						<label for="passRepetir">Repita contraseña</label>
						<input type="password" id="passRepet" name="passRepet" minlength="8" required onkeyup="checkPass()"><br>
					</article>

					<input class="btn-disabled" type="submit" id="btnCambiarPass" name="cambiarPass" value="Cambiar contraseña" disabled><br>
				</fieldset>
			</form>
		</section>

		<footer>
			<a href="mailto:davidcch@correo.ugr.es">Contacto</a>
			<span>&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;</span>
			<a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
		</footer>

	</body>
</html>