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
					<td class="fecha-hilo-2">20/03/2019 19:30</td>
					<td class="orden-respuesta">#1</td>
				</tr>

				<tr>
					<td class="creador-hilo">
						<p class="usuario-autor">Usuario autor 2</p>
						<img class="icono-usuario" src="imagenes/icono-usuario.png" alt="Icono de usuario">
						<p class="fecha-registro">Mar 2019</p>
					</td>

					<td class="cont-hilo">
						<h3 class="titulo-hilo-2">Leo un fragmento en inglés, ¿de qué libro se trata?</h3>
						<p class="cont-hilo-2">Now, fair Hippolyta, our nuptial hour draws on apace; four happy days bring in another moon: but, O, methinks, how slow this old moon wanes! She lingers my desires, like to a step-dame or a dowager long withering out a young man revenue.</p>					
					</td>
				</tr>
			</tbody>
		</table>

		<table>
			<tbody>
				<tr>
					<td class="fecha-hilo-2">220/03/2019 19:45</td>
					<td class="orden-respuesta">#2</td>
				</tr>

				<tr>
					<td class="creador-hilo">
						<p class="usuario-autor">Usuario autor 5</p>
						<img class="icono-usuario" src="imagenes/icono-usuario.png" alt="Icono de usuario">
						<p class="fecha-registro">Abr 2019</p>
					</td>

					<td class="cont-hilo">
						<p class="cont-hilo-2">¡Claramente es el primer fragmento de "Sueño de una noche de verano", del gran Shakespeare! Recuerdo que la interpreté en inglés hace mucho años cuando estudiaba arte dramático en Madrid.</p>	
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