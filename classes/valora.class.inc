<?php
	require_once ('datosObject.class.inc');

	class Valora extends DataObject {
		protected $datos = array(
			"isbn" => "",
			"id_valoracion" => "");

		public static function obtenerIdValoracion( $isbn ) {
			$conexion = parent::conectar();
			$sql = "SELECT id_valoracion FROM ".TABLA_VALORA." WHERE isbn = :isbn";
			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":isbn", $isbn, PDO::PARAM_STR );
				$st->execute();

				$idsVal = array();
				$idsVal = $st->fetchAll();

				parent::desconectar( $conexion );

				if ( $idsVal ) return $idsVal;

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function insertarValora( $isbn, $autoinc ){
			$conexion = parent::conectar();
			$sql = "INSERT INTO ".TABLA_VALORA." VALUES (:isbn, :autoinc)";

			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":isbn", $isbn, PDO::PARAM_STR );
				$st->bindValue( ":autoinc", $autoinc, PDO::PARAM_INT );
				$st->execute();

				parent::desconectar( $conexion );

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Inserción fallada: " . $e->getMessage() );
			}
		}
	}
?>
