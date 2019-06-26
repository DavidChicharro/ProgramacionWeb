<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Foro | RecomenBook</title>
		<link rel="icon" type="image/png" href="imagenes/icono.png" sizes="16x16">
		<link rel="stylesheet" type="text/css" href="index.css">
		<link rel="stylesheet" type="text/css" href="index2.css">
		<link rel="stylesheet" type="text/css" href="foro.css">
	</head>

	<body>
		<?php
			require_once("template/header_nav.php");
		?>

		<a class="btn-crear-hilo" href="crearhilo.php">Crear un nuevo hilo</a>

		<table>
			<tbody>
				<tr>
				  <td class="creador-hilo">Usuario autor 1</td>
				  <td class="fecha-hilo">20/03/2019 19:59</td>
				</tr>

				<tr>
					<th class="titulo-hilo">
						<a href="hilo3.php">¿Qué libro me recomendáis para leer en Semana Santa?</a>
					</th>
					<th class="num-respuestas">2 respuestas</th>
				</tr>

				<tr>
					<td class="cont-hilo" colspan="2">Me he terminado todos los libros que tenía pendientes hasta ahora, y la verdad es que ando bastante indeciso con qué escoger para las próximas fiestas. ¿Qué me recomendáis?</td>
				</tr>
			</tbody>
		</table>

		<table>
			<tbody>
				<tr>
				  <td class="creador-hilo">Usuario autor 2</td>
				  <td class="fecha-hilo">20/03/2019 19:30</td>
				</tr>

				<tr>
					<th class="titulo-hilo">
						<a href="hilo2.php">Leo un fragmento en inglés, ¿de qué libro se trata?</a>
					</th>
					<th class="num-respuestas">1 respuesta</th>
				</tr>

				<tr>
					<td class="cont-hilo" colspan="2">Now, fair Hippolyta, our nuptial hour draws on apace; four happy days bring in another moon: but, O, methinks, how slow this old moon wanes! She lingers my desires, like to a step-dame or a dowager long withering out a young man revenue.</td>
				</tr>
			</tbody>
		</table>

		<table>
			<tbody>
				<tr>
				  <td class="creador-hilo">Usuario autor 3</td>
				  <td class="fecha-hilo">19/03/2019 10:09</td>
				</tr>

				<tr>
					<th class="titulo-hilo">
						<a href="hilo1.php">¿Qué libro me leo de Bukowski?</a>
					</th>
					<th class="num-respuestas">4 respuestas</th>
				</tr>

				<tr>
					<td class="cont-hilo" colspan="2">Quiero leerme algo de Bukowski y no sé por donde empezar. Estoy dudando entre "Mujeres" y "La Senda del Perdedor", ¿qué me recomendais? "Mujeres" lo escribió cuando era más joven, pero "La Senda del Perdedor" lo escribió más tarde. No se cuál leer. ¡Ayuda!</td>
				</tr>
			</tbody>
		</table>
		
		<footer>
			<a href="mailto:davidcch@correo.ugr.es">Contacto</a>
			<span>&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;</span>
			<a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
		</footer>

	</body>
</html>