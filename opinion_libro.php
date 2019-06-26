<?php
	session_start();
 	if (!isset($_SESSION["id"])){
 		header("Location: index.html");
 		exit;
 	}

	if( isset($_POST["modificar"]) || isset($_POST["valorar"]) ){
		class Formulario{
			private $idValoracion;
			private $opinion;
			private $valoracion;
			private $isbn;
			private $tipo;

			function __construct($atributos){
				$this->idValoracion=$atributos['id_valoracion'];
				$this->opinion=$atributos['opinion'];
				$this->valoracion=$atributos['valoracion'];
				$this->isbn=$atributos['isbn'];
				$this->tipo=$atributos['tipo'];
			}

			public function getIdValoracion(){
				return $this->idValoracion;
			}

			public function getOpinion(){
				return $this->opinion;
			}

			public function getValoracion(){
				return $this->valoracion;
			}

			public function getISBN(){
				return $this->isbn;
			}

			public function getTipo(){
				return $this->tipo;
			}
		}

		$formulario = new Formulario($_POST);

		require_once ('classes/valoraciones.class.inc');
		$valoracion = new Valoraciones();

		if( isset($_POST["modificar"]) ) {
			$valoracionBD = $valoracion->modificarValoracion( $formulario->getIdValoracion(), $formulario->getValoracion(), $formulario->getOpinion() );

		}else if( isset($_POST["valorar"]) ){
			require_once ('classes/lee.class.inc');
			require_once ('classes/valora.class.inc');
			$lee = new Lee();
			$lee->insertarLeido( $_SESSION['id'], $formulario->getISBN() );

			$valoracion->insertarValoracion( $formulario->getValoracion(), $formulario->getOpinion(), $_SESSION['id'] );

			$autoinc = $valoracion->obtenerAutoincremento();
			$autoincBD = $autoinc['AUTO_INCREMENT'];
			
			$valora = new Valora();
			$valora->insertarValora( $formulario->getISBN(), $autoincBD-1 );
		}

		header("Location: libroleido.php?rb=".$formulario->getISBN());
		exit;
		
	}else{
		header("Location: index.php");
 		exit;
	}

?>