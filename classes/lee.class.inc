<?php
	require_once ('datosObject.class.inc');

	class Lee extends DataObject {
		protected $datos = array(
			"email" => "",
			"isbn" => "");

		/*Devuelve el ISBN de los libros que ha leído un usuario*/
		public static function obtenerLibros( $mail ) {
			$conexion = parent::conectar();
			$sql = "SELECT isbn FROM ".TABLA_LEE." WHERE email = :mail";
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

		/*Devuelve el email y el ISBN de un libro leido por un usuario*/
		public static function obtenerEmailISBN( $mail, $isbn ) {
			$conexion = parent::conectar();
			$sql = "SELECT * FROM ".TABLA_LEE." WHERE email=:mail and isbn=:isbn";
			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":mail", $mail, PDO::PARAM_STR );
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

		public static function insertarLeido( $mail, $isbn ){
			$conexion = parent::conectar();
			$sql = "INSERT INTO ".TABLA_LEE." VALUES (:mail, :isbn)";

			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":mail", $mail, PDO::PARAM_STR );
				$st->bindValue( ":isbn", $isbn, PDO::PARAM_STR );
				$st->execute();

				parent::desconectar( $conexion );

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Inserción fallada: " . $e->getMessage() );
			}
		}

		public static function modificarEmail( $mail, $nuevoMail){
			$conexion = parent::conectar();
			$sql = "UPDATE ".TABLA_LEE." SET email = :nuevoMail WHERE email = :mail";
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
