<?php
	require_once ('datosObject.class.inc');

	class Valoraciones extends DataObject {
		protected $datos = array(
			"id_valoracion" => "",
			"nota" => "",
			"opinion" => "",
			"email" => "");

		public static function obtenerValoraciones( $idVal ) {
			$conexion = parent::conectar();
			$sql = "SELECT * FROM ".TABLA_VALORACIONES." WHERE id_valoracion = :idVal";
			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":idVal", $idVal, PDO::PARAM_INT );
				$st->execute();
				$fila = $st->fetch();
				parent::desconectar( $conexion );

				if ( $fila ) return $fila;

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function obtenerOpinionUsuario( $email, $isbn ) {
			$conexion = parent::conectar();
			$sql = "SELECT A.id_valoracion,opinion,nota FROM ".TABLA_VALORACIONES." A INNER JOIN ".TABLA_VALORA." B WHERE (A.email=:email AND isbn=:isbn AND A.id_valoracion=B.id_valoracion)";
			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":email", $email, PDO::PARAM_STR );
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

		public static function insertarValoracion( $nota, $opin, $mail){
			$conexion = parent::conectar();
			$sql = "INSERT INTO ".TABLA_VALORACIONES." (nota, opinion, email) VALUES (:nota, :opin, :mail)";

			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":nota", $nota, PDO::PARAM_INT );
				$st->bindValue( ":opin", $opin, PDO::PARAM_STR );
				$st->bindValue( ":mail", $mail, PDO::PARAM_STR );
				$st->execute();

				parent::desconectar( $conexion );

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Inserción fallada: " . $e->getMessage() );
			}
		}

		public static function modificarValoracion( $idV, $nota, $opin){
			$conexion = parent::conectar();
			$sql = "UPDATE ".TABLA_VALORACIONES." SET nota = :nota, opinion = :opin WHERE id_valoracion = :idV";
			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":idV", $idV, PDO::PARAM_INT );
				$st->bindValue( ":nota", $nota, PDO::PARAM_INT );
				$st->bindValue( ":opin", $opin, PDO::PARAM_STR );
				$st->execute();

				parent::desconectar( $conexion );

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Actualización fallada: " . $e->getMessage() );
			}
		}
		
		public static function obtenerAutoincremento( ) {
			$conexion = parent::conectar();
			$sql = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'db15520228_pw1819' AND TABLE_NAME = 'valoraciones'";
			try {
				$st = $conexion->prepare( $sql );
				$st->execute();
				$fila = $st->fetch();
				parent::desconectar( $conexion );

				if ( $fila ) return $fila;

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Consulta fallada, no se pudo obtener AUTO_INCREMENT: " . $e->getMessage() );
			}
		}

		public static function modificarEmail( $mail, $nuevoMail){
			$conexion = parent::conectar();
			$sql = "UPDATE ".TABLA_VALORACIONES." SET email = :nuevoMail WHERE email = :mail";
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
