<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Hilo | RecomenBook</title>
		<link rel="icon" type="image/png" href="imagenes/icono.png" sizes="16x16">
		<link rel="stylesheet" type="text/css" href="index.css">
		<link rel="stylesheet" type="text/css" href="index2.css">
		<link rel="stylesheet" type="text/css" href="hilo.css">
	</head>

	<body>
		<?php
			require_once("template/header_nav.php");
		?>

		<a class="btn-respuesta" href="#respuesta">Responder</a>

		<table class="tema">
			<tbody>
				<tr>
					<td class="fecha-hilo-2">20/03/2019 19:59</td>
					<td class="orden-respuesta">#1</td>
				</tr>

				<tr>
					<td class="creador-hilo">
						<p class="usuario-autor">Usuario autor 1</p>
						<img class="icono-usuario" src="imagenes/icono-usuario.png" alt="Icono de usuario">
						<p class="fecha-registro">Mar 2019</p>
					</td>

					<td class="cont-hilo">
						<h3 class="titulo-hilo-2">¿Qué libro me recomendáis para leer en Semana Santa?</h3>
						<p class="cont-hilo-2">Me he terminado todos los libros que tenía pendientes hasta ahora, y la verdad es que ando bastante indeciso con qué escoger para las próximas fiestas. ¿Qué me recomendáis?</p>					
					</td>
				</tr>
			</tbody>
		</table>

		<table>
			<tbody>
				<tr>
					<td class="fecha-hilo-2">20/03/2019 20:01</td>
					<td class="orden-respuesta">#2</td>
				</tr>

				<tr>
					<td class="creador-hilo">
						<p class="usuario-autor">Usuario autor 2</p>
						<img class="icono-usuario" src="imagenes/icono-usuario.png" alt="Icono de usuario">
						<p class="fecha-registro">Abr 2019</p>
					</td>

					<td class="cont-hilo">
						<p class="cont-hilo-2">Hay un libro nuevo de Blue Jeans llamado "El puzzle de cristal" que está muy bien. Es la segunda parte de la Trilogía "La chicha invisible". Te lo recomiendo.</p>	
					</td>
				</tr>
			</tbody>
		</table>

		<table>
			<tbody>
				<tr>
					<td class="fecha-hilo-2">20/03/2019 20:40</td>
					<td class="orden-respuesta">#3</td>
				</tr>

				<tr>
					<td class="creador-hilo">
						<p class="usuario-autor">Usuario autor 3</p>
						<img class="icono-usuario" src="imagenes/icono-usuario.png" alt="Icono de usuario">
						<p class="fecha-registro">Abr 2019</p>
					</td>

					<td class="cont-hilo">
						<p class="cont-hilo-2">Te recomiendo el nuevo libro de Rayden (el rapero). Se llama "El Mundo es un gato jugando con Australia" (cuando veas la portada entenderás el porqué). A mí me ha encantado, y la verdad es que tiene muy buen precio.</p>	
					</td>
				</tr>
			</tbody>
		</table>
		
		<form id="respuesta">
			<fieldset>
				<legend>Respuesta</legend>
				<label for="mensaje">Mensaje</label><br>
				<textarea id="mensaje" name="mensaje" rows="8" cols="100" maxlength="2000" required></textarea><br>

				<input type="submit" id="buttonResponder" value="Responder">
				<input type="reset" id="buttonReset" value="Limpiar">
			</fieldset>
		</form>
		
		<footer>
			<a href="mailto:davidcch@correo.ugr.es">Contacto</a>
			<span>&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;</span>
			<a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
		</footer>

	</body>
</html>