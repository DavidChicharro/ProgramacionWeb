<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>RecomenBook</title>
		<link rel="icon" type="image/png" href="imagenes/icono.png" sizes="16x16">
		<link rel="stylesheet" type="text/css" href="index.css">
		<link rel="stylesheet" type="text/css" href="index2.css">
		<link rel="stylesheet" type="text/css" href="libro.css">
	</head>

	<body>
		<?php
		require_once("template/header_nav.php");
		?>

		<!--Libro -->
		<section class="datos-libro">
		<?php
			$lastUriSegment = $_GET['b'];
			$nomLibro = str_replace("-", " ", $lastUriSegment);

			require_once ('classes/libro.class.inc');

			$libro = new Libro();
			$libroBD = $libro->obtenerLibroPorNombre( $nomLibro );

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
		
		</section>

		<!--Opiniones -->
		<section class="opiniones">
			<h3>Opiniones</h3>

			<article class="malla-opiniones">
			'.$strValoraciones);
		?>	
			</article>

			<article class="centrado">
				<div class="pagination">
					<a href="#">&laquo;</a>
					<a class="active" href="#">1</a>
					<a href="#">2</a>
					<a href="#">3</a>
					<a href="#">4</a>
					<a href="#">5</a>
					<a href="#">6</a>
					<a href="#">&raquo;</a>
				</div>
				<br/>

			<?php
				require_once ('classes/lee.class.inc');
				$leido = new Lee();
				$libroLeido = $leido->obtenerEmailISBN( $_SESSION["id"], $libroBD['isbn'] );
				
				if($libroLeido['email']==$_SESSION["id"] && $libroLeido['isbn']==$libroBD['isbn'])
					$urlValorar = 'libroleido.php?rb';
				else
					$urlValorar = 'valoracion_libro.php?vb';

				echo ('<a href="'.$urlValorar.'='.$libroBD['isbn'].'">Valorar libro</a>');
			?>
			</article>
		</section>

		<footer>
			<a href="mailto:davidcch@correo.ugr.es">Contacto</a>
			<span>&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;</span>
			<a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
		</footer>

	</body>
</html>
