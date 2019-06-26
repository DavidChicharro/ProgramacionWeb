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
					<td class="fecha-hilo-2">19/03/2019 10:09</td>
					<td class="orden-respuesta">#1</td>
				</tr>

				<tr>
					<td class="creador-hilo">
						<p class="usuario-autor">Usuario autor 1</p>
						<img class="icono-usuario" src="imagenes/icono-usuario.png" alt="Icono de usuario">
						<p class="fecha-registro">Abr 2019</p>
					</td>

					<td class="cont-hilo">
						<h3 class="titulo-hilo-2">¿Qué libro me leo de Bukowski?</h3>
						<p class="cont-hilo-2">Quiero leerme algo de Bukowski y no sé por donde empezar. Estoy dudando entre "Mujeres" y "La Senda del Perdedor", ¿qué me recomendais? "Mujeres" lo escribió cuando era más joven, pero "La Senda del Perdedor" lo escribió más tarde. No se cuál leer. ¡Ayuda!</p>					
					</td>
				</tr>
			</tbody>
		</table>

		<table>
			<tbody>
				<tr>
					<td class="fecha-hilo-2">19/03/2019 10:21</td>
					<td class="orden-respuesta">#2</td>
				</tr>

				<tr>
					<td class="creador-hilo">
						<p class="usuario-autor">Usuario autor 5</p>
						<img class="icono-usuario" src="imagenes/icono-usuario.png" alt="Icono de usuario">
						<p class="fecha-registro">Abr 2019</p>
					</td>

					<td class="cont-hilo">
						<p class="cont-hilo-2">Ni uno ni otro, mi preferido es sin duda "Cartero".</p>	
					</td>
				</tr>
			</tbody>
		</table>

		<table>
			<tbody>
				<tr>
					<td class="fecha-hilo-2">19/03/2019 10:25</td>
					<td class="orden-respuesta">#3</td>
				</tr>

				<tr>
					<td class="creador-hilo">
						<p class="usuario-autor">Usuario autor 6</p>
						<img class="icono-usuario" src="imagenes/icono-usuario.png" alt="Icono de usuario">
						<p class="fecha-registro">Mar 2019</p>
					</td>

					<td class="cont-hilo">
						<p class="cont-hilo-2">Recomiendo empezar por "La senda del perdedor". Es una auténtica obra maestra.</p>	
					</td>
				</tr>
			</tbody>
		</table>

		<table>
			<tbody>
				<tr>
					<td class="fecha-hilo-2">19/03/2019 10:27</td>
					<td class="orden-respuesta">#4</td>
				</tr>

				<tr>
					<td class="creador-hilo">
						<p class="usuario-autor">Usuario autor 7</p>
						<img class="icono-usuario" src="imagenes/icono-usuario.png" alt="Icono de usuario">
						<p class="fecha-registro">Mar 2019</p>
					</td>

					<td class="cont-hilo">
						<p class="cont-hilo-2">Para empezar te recomiendo "Cartero" y "Factotum". De los más ligeros y amenos.</p>	
					</td>
				</tr>
			</tbody>
		</table>

		<table>
			<tbody>
				<tr>
					<td class="fecha-hilo-2">19/03/2019 11:00</td>
					<td class="orden-respuesta">#5</td>
				</tr>

				<tr>
					<td class="creador-hilo">
						<p class="usuario-autor">Usuario autor 8</p>
						<img class="icono-usuario" src="imagenes/icono-usuario.png" alt="Icono de usuario">
						<p class="fecha-registro">Abr 2019</p>
					</td>

					<td class="cont-hilo">
						<p class="cont-hilo-2">Yo te recomendaría "La senda del perderdor". Y bueno, leerte un par o tres, tampoco todos, al final se hacen un poco repetitivos.</p>	
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