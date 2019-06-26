<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>RecomenBook</title>
		<link rel="icon" type="image/png" href="imagenes/icono.png" sizes="16x16">
		<link rel="stylesheet" type="text/css" href="index.css">
		<link rel="stylesheet" type="text/css" href="index2.css">
	</head>

	<body>
		<?php
		require_once("template/header_nav.php");
		?>

		<main>
			<section class="img-relacionada">
				<ul>
					<li>
						<img src="imagenes/libros_portada-1.jpg" alt="Imagen portada 1">
					</li>
					<li>
						<img src="imagenes/libros_portada-2.jpg" alt="Imagen portada 2">
					</li>
					<li>
						<img src="imagenes/libros_portada-3.png" alt="Imagen portada 3">
					</li>
				</ul>
			</section>

			<section class="mejores-libros">
				<h2>Libros mejor valorados</h2>

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
				require_once ('classes/valora.class.inc');
				require_once ('classes/valoraciones.class.inc');
				require_once ('classes/libro.class.inc');

				$libro = new Libro();
				$librosBD = $libro->obtenerTodosLibros( );
				$arrLibros = array();

				foreach ($librosBD as $isbnLibro) {
					$valora = new Valora();
					$idsValoraciones = $valora->obtenerIdValoracion( $isbnLibro['isbn'] );
					$valoraciones = new Valoraciones();

					$cont = 0;
					$sumaValoraciones = 0;
					$strValoraciones = "";
					foreach ($idsValoraciones as $idV) {
						$valoracionesBD = $valoraciones->obtenerValoraciones( $idV['id_valoracion'] );
						$sumaValoraciones += $valoracionesBD['nota'];

						$cont++;
					}

					$notaMedia = ($sumaValoraciones*1.0)/$cont;
					$arrLibros[ $isbnLibro['isbn'] ] = $notaMedia;
				}

				arsort($arrLibros);

				if(sizeof($arrLibros) < 4)
				    $arrSize = sizeof($ar);
				else
				    $arrSize = 4;

				$cont = 1;
				foreach ($arrLibros as $isbn => $nota){
					$libroBD = $libro->obtenerLibro($isbn);
				    echo ('<article class="libro">
						<a href="libro.php?b='.seoUrl($libroBD['titulo']).'">
							<img class="img-miniatura" src="imagenes/libro-'.$isbn.'.jpeg" alt="'.$libroBD['titulo'].'">
						</a>
						<article class="libro-autor">
							<p class="titulo-libro">'.$libroBD['titulo'].'</p>
							<p class="autor">'.$libroBD['autor'].'</p>
						</article>
					</article>');

				    $cont++;
				    if ($cont > $arrSize)
				        break;
				}
				?>
				
			</section>
		</main>

		<footer>
			<a href="mailto:davidcch@correo.ugr.es">Contacto</a>
			<span>&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;</span>
			<a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
		</footer>

	</body>
</html>
