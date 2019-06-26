<?php
	require_once ('datosObject.class.inc');

	class Libro extends DataObject {
		protected $datos = array(
			"isbn" => "",
			"autor" => "",
			"editorial" => "",
			"anio"=>"",
			"edicion" => "",
			"descripcion" => "");

		public static function obtenerLibro( $isbn ) {
			$conexion = parent::conectar();
			$sql = "SELECT * FROM ".TABLA_LIBRO." WHERE isbn = :isbn";
			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":isbn", $isbn, PDO::PARAM_STR );
				$st->execute();
				$fila = $st->fetch();
				parent::desconectar( $conexion );

				if ( $fila ) return $fila;

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function obtenerLibroPorNombre( $tit ) {
			$conexion = parent::conectar();
			$sql = "SELECT * FROM ".TABLA_LIBRO." WHERE titulo = :tit";
			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":tit", $tit, PDO::PARAM_STR );
				$st->execute();
				$fila = $st->fetch();
				parent::desconectar( $conexion );

				if ( $fila ) return $fila;

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function obtenerTodosLibros( ) {
			$conexion = parent::conectar();
			$sql = "SELECT isbn FROM ".TABLA_LIBRO;
			try {
				$st = $conexion->prepare( $sql );
				$st->execute();

				$libros = array();
				$libros = $st->fetchAll();

				parent::desconectar( $conexion );

				if ( $libros ) return $libros;

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function obtenerLibrosRecientes( ) {
			$conexion = parent::conectar();
			$sql = "SELECT titulo FROM ".TABLA_LIBRO." ORDER BY alta DESC";
			try {
				$st = $conexion->prepare( $sql );
				$st->execute();

				$libros = array();
				$libros = $st->fetchAll();

				parent::desconectar( $conexion );

				if ( $libros ) return $libros;

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function obtenerLibrosSubidos( $mail ) {
			$conexion = parent::conectar();
			$sql = "SELECT titulo FROM ".TABLA_LIBRO." WHERE email = :mail";
			try {
				$st = $conexion->prepare( $sql );				
				$st->bindValue( ":mail", $mail, PDO::PARAM_STR );
				$st->execute();

				$libros = array();
				$libros = $st->fetchAll();

				parent::desconectar( $conexion );

				if ( $libros ) return $libros;

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function insertarLibro( $isbn, $tit, $aut, $edit, $anio, $edic, $desc, $mail){
			$conexion = parent::conectar();
			$sql = "INSERT INTO ".TABLA_LIBRO." VALUES (:isbn, :tit, :aut, :edit, :anio, :edic, :desc, current_timestamp(), :mail)";

			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":isbn", $isbn, PDO::PARAM_STR );
				$st->bindValue( ":tit", $tit, PDO::PARAM_STR );
				$st->bindValue( ":aut", $aut, PDO::PARAM_STR );
				$st->bindValue( ":edit", $edit, PDO::PARAM_STR );
				$st->bindValue( ":anio", $anio, PDO::PARAM_STR );
				$st->bindValue( ":edic", $edic, PDO::PARAM_STR );
				$st->bindValue( ":desc", $desc, PDO::PARAM_STR );
				$st->bindValue( ":mail", $mail, PDO::PARAM_STR );
				$st->execute();

				parent::desconectar( $conexion );

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Inserción de libro fallada: " . $e->getMessage() );
			}
		}

		public static function modificarEmail( $mail, $nuevoMail){
			$conexion = parent::conectar();
			$sql = "UPDATE ".TABLA_LIBRO." SET email = :nuevoMail WHERE email = :mail";
			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":mail", $mail, PDO::PARAM_STR );
				$st->bindValue( ":nuevoMail", $nuevoMail, PDO::PARAM_STR );
				$st->execute();

				parent::desconectar( $conexion );

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Actualización de email fallada: " . $e->getMessage() );
			}
		}
	}
?>
