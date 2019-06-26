<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Nuevo hilo | RecomenBook</title>
		<link rel="icon" type="image/png" href="imagenes/icono.png" sizes="16x16">
		<link rel="stylesheet" type="text/css" href="index.css">
		<link rel="stylesheet" type="text/css" href="index2.css">
		<link rel="stylesheet" type="text/css" href="formulario.css">
	</head>

	<body>
		<?php
			require_once("template/header_nav.php");
		?>

		<!--Formulario para crear un nuevo hilo -->
		<section>
			<form method="post">
				<fieldset>
					<legend>Crear nuevo tema</legend>

					<article class="form-item-3">
						<label for="titulo">Título</label><br>
						<input type="text" id="titulo" name="titulo" maxlength="80" required><br>
					</article>

					<article class="form-item-3">
						<label for="mensaje">Mensaje</label>
						<textarea id="mensaje" name="mensaje" rows="10" cols="100" maxlength="2000" required></textarea>
					</article>

					<input type="submit" id="btnEnviarTema" value="Crear tema"><br>
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