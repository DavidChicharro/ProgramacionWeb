<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Alta de un libro | RecomenBook</title>
		<link rel="icon" type="image/png" href="imagenes/icono.png" sizes="16x16">
		<link rel="stylesheet" type="text/css" href="index.css">
		<link rel="stylesheet" type="text/css" href="index2.css">
		<link rel="stylesheet" type="text/css" href="formulario.css">
		<script src="js/validacion.js" type="text/javascript"></script>

		<script>
			function contador( idTextArea ){
				let written = document.getElementById(idTextArea).value.length;
				document.getElementById('current-'+idTextArea).innerHTML = written;
			}
		</script>
	</head>

	<body>
		<?php
			require_once("template/header_nav.php");
		?>

		<!--Formulario para dar de alta un nuevo libro -->
		<section>
			<h2>Sube un nuevo libro</h2>
			
			<form name="altalibro" action="altalibro.php" method="post" onkeyup="formAltaLibroValidation(this)">
				<fieldset>
					<legend>Datos del libro</legend>

					<article class="form-item-1">
						<input type="file" id="imagen" name="imagenLibro">
					</article>

					<article class="form-item-1">
						<label for="isbn">ISBN</label>
						<input type="text" id="isbn" name="isbn" maxlength="13" autofocus required><br>
					</article>

					<article class="form-item-1">
						<label for="titulo">Título</label>
						<input type="text" id="titulo" name="titulo" maxlength="80" required><br>
					</article>

					<article class="form-item-1">
						<label for="autor">Autor</label>
						<input type="text" id="autor" name="autor" required>
					</article>

					<article class="form-item-1">
						<label for="editorial">Editorial</label>
						<select name="editorial" id="editorial" required>
							<option selected disabled>Editorial</option>
							<option value="Alianza Editorial">Alianza Editorial</option>
							<option value="Planeta">Planeta</option>
							<option value="Austral">Austral</option>
							<option value="Plaza & Jane Editores">Plaza & Jane Editores</option>
							<option value="Anagrama">Anagrama</option>
						</select>
					</article>

					<article class="form-item-1">
						<label for="anio">Año</label>
						<input type="number" id="anio" name="anio" min="1000" max="2019" required><br/><br/>
					</article>

					<article class="form-item-1">
						<label for="edicion">Edición</label>
						<input type="number" id="edicion" name="edicion" min="1" required>
					</article>
				</fieldset>

				<fieldset>
					<legend>Descripción y valoración personal</legend>

					<article class="form-item-2">
						<label for="descripcion">Descripción</label><br/>
						<textarea id="descripcion" name="descripcion" rows="6" cols="80" maxlength="800" onkeyup="contador('descripcion')" required></textarea><br>
						<span id="current-descripcion">0</span><span>/ 800</span>
					</article>

					<article class="form-item-2">
						<label for="opinion">Opinión</label><br/>
						<textarea id="opinion" name="opinion" rows="6" cols="80" maxlength="500" onkeyup="contador('opinion')" required></textarea><br>
						<span id="current-opinion">0</span><span>/ 500</span>
					</article>

					<article class="valoracion">
						<p>Valoración</p>

						<input type="radio" id="valoracion1" name="valoracion" value="1" onclick="radioValidation(this)" required/>
						<label class="nota" for="valoracion1">1</label>

						<input type="radio" id="valoracion2" name="valoracion" value="2" onclick="radioValidation(this)"/>
						<label class="nota" for="valoracion2">2</label>

						<input type="radio" id="valoracion3" name="valoracion" value="3" onclick="radioValidation(this)"/>
						<label class="nota" for="valoracion3">3</label>

						<input type="radio" id="valoracion4" name="valoracion" value="4" onclick="radioValidation(this)"/>
						<label class="nota" for="valoracion4">4</label>

						<input type="radio" id="valoracion5" name="valoracion" value="5" onclick="radioValidation(this)"/>
						<label class="nota" for="valoracion5">5</label>
					</article>

					<input class="btn-disabled" type="submit" id="enviar" name="enviar" value="Enviar" disabled="">
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

<?php
if(isset($_POST['enviar'])) {
	class Formulario{
		private $isbn;
		private $titulo;
		private $autor;
		private $editorial;
		private $anio;
		private $edicion;
		private $descripcion;
		private $opinion;
		private $valoracion;


		function __construct($atributos){
			$this->isbn=$atributos['isbn'];
			$this->titulo=$atributos['titulo'];
			$this->autor=$atributos['autor'];
			$this->editorial=$atributos['editorial'];
			$this->edicion=$atributos['edicion'];
			$this->anio=$atributos['anio'];
			$this->descripcion=$atributos['descripcion'];
			$this->opinion=$atributos['opinion'];
			$this->valoracion=$atributos['valoracion'];
		}

		public function getISBN(){
			return $this->isbn;
		}

		public function getTitulo(){
			return $this->titulo;
		}

		public function getAutor(){
			return $this->autor;
		}

		public function getEditorial(){
			return $this->editorial;
		}

		public function getAnio(){
			return $this->anio;
		}

		public function getEdicion(){
			return $this->edicion;
		}

		public function getDescripcion(){
			return $this->descripcion;
		}

		public function getOpinion(){
			return $this->opinion;
		}

		public function getValoracion(){
			return $this->valoracion;
		}
	}

	$formulario = new Formulario($_POST);

	require_once ('classes/libro.class.inc');
	require_once ('classes/lee.class.inc');
	require_once ('classes/valoraciones.class.inc');
	require_once ('classes/valora.class.inc');
	$libro = new Libro();
	$libroBD = $libro->obtenerLibro( $formulario->getISBN() );


	//Comprobar que el libro no existe en la BD
	if (is_null($libroBD)){
		//Subir libro
		$libro->insertarLibro( $formulario->getISBN(), $formulario->getTitulo(), $formulario->getAutor(), $formulario->getEditorial(), $formulario->getAnio(), $formulario->getEdicion(), $formulario->getDescripcion(), $_SESSION['id'] );

		$lee = new Lee();
		//Indicar que el usuario ha leído el libro
		$lee->insertarLeido( $_SESSION['id'], $formulario->getISBN() );
		
		//Crear la valoración
		$valoracion = new Valoraciones();
		$valoracion->insertarValoracion( $formulario->getValoracion(), $formulario->getOpinion(), $_SESSION['id'] );

		$autoinc = $valoracion->obtenerAutoincremento();
		$autoincBD = $autoinc['AUTO_INCREMENT'];
		
		//Asignar la valoración al libro
		$valora = new Valora();
		$valora->insertarValora( $formulario->getISBN(), $autoincBD-1 );

		echo ('<script>alert("El libro se ha introducido correctamente en el sistema");</script>');

	}else{
		echo ('<script>alert("¡El libro ya existe en el sistema!");</script>');
	}
}
?>
