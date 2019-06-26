<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<title>Mis libros | RecomenBook</title>
		<link rel="icon" type="image/png" href="imagenes/icono.png" sizes="16x16">
		<link rel="stylesheet" type="text/css" href="index.css">
		<link rel="stylesheet" type="text/css" href="index2.css">
		<link rel="stylesheet" type="text/css" href="mislibros.css">
	</head>

	<body>
		<?php
			require_once("template/header_nav.php");
		?>

		<main>
			<!--Sección izquierda - Libros leídos-->
			<section class="libros-leidos">

				<button class="btn-menu"></button>
				<nav class="menu-desplegable">
					<a class="active" href="mislibros.php">Mis libros</a>
					<a href="foro.php">Foro</a>
					<a href="datospersonales.php">Mis datos</a>
					<a href="recomendaciones.php">Mis recomendaciones</a>
				</nav>


				<h2>Libros leídos</h2>
				<?php
					require_once ('classes/libro.class.inc');
					require_once ('classes/lee.class.inc');

					$leido = new Lee();
					$librosBD = $leido->obtenerLibros( $_SESSION["id"] );
					$libro = new Libro();

					if(is_null($librosBD)){
					    echo ('<article class="libro">
								<p class="no-libros-leidos titulo-libro">Aún no ha leído ningún libro</p>
							</article>');
					}else{
						foreach ($librosBD as $isbnLibro) {
							$libroBD = $libro->obtenerLibro( $isbnLibro['isbn'] );

							echo ('
								<article class="libro">
									<a href="libroleido.php?rb='.$isbnLibro['isbn'].'">
										<img class="img-miniatura" src="imagenes/libro-'.$isbnLibro['isbn'].'.jpeg" alt="'.$libroBD['titulo'].'">
									</a>
									<article class="libro-autor">
										<p class="titulo-libro">'.$libroBD['titulo'].'</p>
										<p class="autor">'.$libroBD['autor'].'</p>
									</article>
								</article>'
							);
						}
					}
				?>
			</section>

			<!--Sección derecha - Últimos libros-->
			<section class="ultimos-libros">
				<h2>Últimos libros</h2>

				<?php
				function seoUrl($string) {
				    //Convierte a minúscula
				    $string = strtolower($string);

				    //Reemplaza los caracteres acentuados por el mismo sin acentuar
				    //$string = iconv('UTF-8','ASCII//TRANSLIT',$string);
				    $string = htmlentities($string);

				    //Borra múltiples espacios
				    $string = preg_replace("/[\s-]+/", " ", $string);

				    //Convierte los espacios en guiones
				    $string = preg_replace("/[\s_]/", "-", $string);

				    return $string;
				}

				$librosRecientes = new Libro();
				$ultimosLibrosBD = $librosRecientes->obtenerLibrosRecientes( );
				for($i=1 ; $i<6 ; $i++){
					$lib = $ultimosLibrosBD[$i-1];
					$linkLibro = seoUrl($lib['titulo']);

					echo ('<a class="tit-ult-lib" href="libro.php?b='.$linkLibro.'">'.$lib['titulo'].'</a><br>');
				}
				?>

				<a class="alta-libro" href="altalibro.php">Dar de alta nuevo libro</a>
			</section>
		</main>

		<footer>
			<a href="mailto:davidcch@correo.ugr.es">Contacto</a>
			<span>&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;</span>
			<a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
		</footer>

	</body>
</html>
