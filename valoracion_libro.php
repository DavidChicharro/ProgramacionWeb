<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>RecomenBook</title>
		<link rel="icon" type="image/png" href="imagenes/icono.png" sizes="16x16">
		<link rel="stylesheet" type="text/css" href="index.css">
		<link rel="stylesheet" type="text/css" href="index2.css">
		<link rel="stylesheet" type="text/css" href="libro.css">
		<link rel="stylesheet" type="text/css" href="formulario.css">
		<script src="js/validacion.js" type="text/javascript"></script>

		<script>
			function contador(){
				let written = document.getElementById('opinion').value.length;
				document.getElementById('current').innerHTML = written;
			}
		</script>
	</head>

	<body onload="contador()">
		<?php
		require_once("template/header_nav.php");
		?>

		<!--Libro -->
		<section class="datos-libro">
		<?php
			$isbnLibro = $_GET['vb'];

			require_once ('classes/libro.class.inc');

			$libro = new Libro();
			$libroBD = $libro->obtenerLibro( $isbnLibro );
			
			$dir = "/home/x15520228/public_html/bookrecsysII/imagenes/";
			$file = 'libro-'.$libroBD['isbn'].'.jpeg';
			if (!is_file($dir.$file))
				$file ='icono.png';
			
			echo ('
			<figure class="portada-libro">
				<img class="img-miniatura" src="imagenes/'.$file.'" alt="'.$libroBD['titulo'].'">
			</figure>

			<p class="caracteristicas-libro">
				Título: '.$libroBD['titulo'].'<br>
				Autor: '.$libroBD['autor'].'<br>
				Editorial: '.$libroBD['editorial'].'<br>
				Año: '.$libroBD['anio'].'<br>
				Edición: '.$libroBD['edicion'].'ª<br>
			</p>

			<article class="descripcion">
				<h3>Descripción</h3>
				<p>'.$libroBD['descripcion'].'</p>');

			require_once ('classes/valora.class.inc');
			require_once ('classes/valoraciones.class.inc');

			$valora = new Valora();
			$idsValoraciones = $valora->obtenerIdValoracion( $libroBD['isbn'] );
			$valoraciones = new Valoraciones();

			$cont = 0;
			$sumaValoraciones = 0;
			$strValoraciones = "";
			foreach ($idsValoraciones as $idV) {
				$valoracionesBD = $valoraciones->obtenerValoraciones( $idV['id_valoracion'] );
				$sumaValoraciones += $valoracionesBD['nota'];

				$strValoraciones .= '<article>'.$valoracionesBD['opinion'].'</article>';
				$cont++;
			}
			$notaMedia = ($sumaValoraciones*2.0)/$cont;

			echo ('
				<p class="nota-media">Valoración media: '.number_format($notaMedia, 2, ',', '').'</p>
			</article>
			');
		?>
		</section>

		<!--Formulario para opinar acerca del libro -->
		<section class="opinion-valoracion">
			<h3>Mi opinión</h3>

			<form name="valorar-libro" action="opinion_libro.php" method="post" onkeyup="formValorarValidation(this)">
				<fieldset>	
					<label for="opinion">Opinión</label><br/>
					<textarea id="opinion" name="opinion" rows="6" cols="80" maxlength="500" required onkeyup="contador()"></textarea><br>
					<span id="current">0</span><span>/ 500</span>
								
					<?php
						echo ('							
						<input type="text" id="isbn" name="isbn" hidden required value="'.$isbnLibro.'">
						
						<article class="valoracion">
							<p>Mi valoración</p>
						');

						for ($i=1; $i<=5 ; $i++) {
							echo ('<input type="radio" id="valoracion'.$i.'" name="valoracion" value="'.$i.'" onclick="radioValorarValidation(this)" required/>

								<label class="nota" for="valoracion">'.$i.'</label>');
						}
					?>
					</article>

					<input class="btn-disabled" type="submit" id="btnEnviar" name="valorar" value="Enviar" disabled>
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