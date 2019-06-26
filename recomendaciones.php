<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Recomendaciones | RecomenBook</title>
		<link rel="icon" type="image/png" href="imagenes/icono.png" sizes="16x16">
		<link rel="stylesheet" type="text/css" href="index.css">
		<link rel="stylesheet" type="text/css" href="index2.css">
		<link rel="stylesheet" type="text/css" href="recomendaciones.css">
	</head>

	<body>
		<?php
			require_once("template/header_nav.php");
		?>

		<!--Lista de libros recomendados-->
		<ul class="lista-recom">
			<li class="elem-recom">
				<a class="link-libro" href="libro.php?b=los-girasoles-ciegos">
					<img class="img-recom" src="imagenes/libro-9788433968555.jpeg" alt="Memorias de una salvaje">
					<p class="titulo">Los girasoles ciegos</p>
				</a>
			</li>


			<li class="elem-recom">
				<a class="link-libro" href="libro.php?b=memorias-de-una-salvaje">
					<img class="img-recom" src="imagenes/libro-9788408194453.jpeg" alt="Memorias de una salvaje">
					<p class="titulo">Memorias de una salvaje</p>		
				</a>
			</li>			

			
			<li class="elem-recom">
				<a class="link-libro" href="libro.php?b=la-metamorfosis">
					<img class="img-recom" src="imagenes/libro-9788420651361.jpeg" alt="La metamorfosis">
					<p class="titulo">La metamorfosis</p>				
				</a>
			</li>

			
			<li class="elem-recom">
				<a class="link-libro" href="libro.php?b=la-casa-de-los-espíritus">
					<img class="img-recom" src="imagenes/libro-9788483462034.jpeg" alt="La casa de los espíritus">
					<p class="titulo">La casa de los espíritus</p>				
				</a>
			</li>

			
			<li class="elem-recom">
				<a class="link-libro" href="libro.php?b=el-puzzle-de-cristal">
					<img class="img-recom" src="imagenes/libro-9788408205692.jpeg" alt="El puzzle de cristal">
					<p class="titulo">El puzzle de cristal</p>				
				</a>
			</li>

			
			<li class="elem-recom">
				<a class="link-libro" href="libro.php?b=el-jugador">
					<img class="img-recom" src="imagenes/libro-9788420641942.jpeg" alt="El jugador">
					<p class="titulo">El jugador</p>				
				</a>
			</li>

			
			<li class="elem-recom">
				<a class="link-libro" href="libro.php?b=memorias-de-una-salvaje">
					<img class="img-recom" src="imagenes/libro-9788408194453.jpeg" alt="Memorias de una salvaje">
					<p class="titulo">Memorias de una salvaje</p>		
				</a>
			</li>
		</ul>
		
		<footer>
			<a href="mailto:davidcch@correo.ugr.es">Contacto</a>
			<span>&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;</span>
			<a href="como_se_hizo.pdf" target="_blank">Cómo se hizo</a>
		</footer>

	</body>
</html>