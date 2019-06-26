<?php
	require_once ('datosObject.class.inc');

	class Usuario extends DataObject {
		protected $datos = array(
			"email" => "",
			"nombre" => "",
			"apellidos" => "",
			"password"=>"",
			"fecha_nac" => "",
			"fecha_reg" => "",
			"foto" => "");

		public static function obtenerUsuarios( $filaInicio, $numeroFilas, $orden ) {
			$conexion = parent::conectar();
			$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".TABLA_USUARIO." ORDER BY ".$orden."LIMIT :filaInicio, :numeroFilas";
			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":filaInicio", $filaInicio, PDO::PARAM_INT );
				$st->bindValue( ":numeroFilas", $numeroFilas, PDO::PARAM_INT );
				$st->execute();
				$usuarios = array();

				foreach ( $st->fetchAll() as $fila ) {
					$usuarios[] = new Usuario( $fila );
				}

				$st = $conexion->query( "SELECT found_rows() AS filasTotales" );
				$fila = $st->fetch();
				parent::desconectar( $conexion );

				return array( $usuarios, $fila["filasTotales"] );
			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Consulta fallida: " . $e->getMessage() );
			}
		}

		public static function obtenerUsuario( $mail ) {
			$conexion = parent::conectar();
			$sql = "SELECT email FROM ".TABLA_USUARIO." WHERE email = :mail";
			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":mail", $mail, PDO::PARAM_STR );
				$st->execute();
				$fila = $st->fetch();
				parent::desconectar( $conexion );

				if ( $fila ) return $fila;

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function obtenerDatosUsuario( $mail ) {
			$conexion = parent::conectar();
			$sql = "SELECT * FROM ".TABLA_USUARIO." WHERE email = :mail";
			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":mail", $mail, PDO::PARAM_STR );
				$st->execute();
				$fila = $st->fetch();
				parent::desconectar( $conexion );

				if ( $fila ) return $fila;

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function obtenerPassword( $mail ) {
			$conexion = parent::conectar();
			$sql = "SELECT password FROM ".TABLA_USUARIO." WHERE email = :mail";
			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":mail", $mail, PDO::PARAM_STR );
				$st->execute();
				$fila = $st->fetch();
				parent::desconectar( $conexion );

				if ( $fila ) return $fila;

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function obtenerNombre( $mail ) {
			$conexion = parent::conectar();
			$sql = "SELECT nombre FROM ".TABLA_USUARIO." WHERE email = :mail";
			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":mail", $mail, PDO::PARAM_STR );
				$st->execute();
				$fila = $st->fetch();
				parent::desconectar( $conexion );

				if ( $fila ) return $fila;

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function obtenerFoto( $mail ) {
			$conexion = parent::conectar();
			$sql = "SELECT foto FROM ".TABLA_USUARIO." WHERE email = :mail";
			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":mail", $mail, PDO::PARAM_STR );
				$st->execute();
				$fila = $st->fetch();
				parent::desconectar( $conexion );

				if ( $fila ) return $fila;

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function insertarUsuario( $mail, $nom, $apll, $pswd, $fNac, $foto){
			$conexion = parent::conectar();
			$sql = "INSERT INTO ".TABLA_USUARIO." VALUES (:mail, :nom, :apll, :pswd, :fNac, CURDATE(), :foto)";

			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":mail", $mail, PDO::PARAM_STR );
				$st->bindValue( ":nom", $nom, PDO::PARAM_STR );
				$st->bindValue( ":apll", $apll, PDO::PARAM_STR );
				$st->bindValue( ":pswd", $pswd, PDO::PARAM_STR );
				$st->bindValue( ":fNac", $fNac, PDO::PARAM_STR );
				$st->bindValue( ":foto", $foto, PDO::PARAM_STR );
				$st->execute();

				parent::desconectar( $conexion );

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Inserción de usuario fallada: " . $e->getMessage() );
			}
		}

		public static function modificarEmail( $mail, $nuevoMail){
			$conexion = parent::conectar();
			$sql = "UPDATE ".TABLA_USUARIO." SET email = :nuevoMail WHERE email = :mail";
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

		public static function modificarDatosPersonales( $mail, $nom, $aplls, $fNac){
			$conexion = parent::conectar();
			$sql = "UPDATE ".TABLA_USUARIO." SET nombre = :nom, apellidos = :aplls, fecha_nac = :fNac WHERE email = :mail";
			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":mail", $mail, PDO::PARAM_STR );
				$st->bindValue( ":nom", $nom, PDO::PARAM_STR );
				$st->bindValue( ":aplls", $aplls, PDO::PARAM_STR );
				$st->bindValue( ":fNac", $fNac, PDO::PARAM_STR );
				$st->execute();

				parent::desconectar( $conexion );

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Actualización de datos personales fallada: " . $e->getMessage() );
			}
		}

		public static function modificarPassword( $mail, $pass){
			$conexion = parent::conectar();
			$sql = "UPDATE ".TABLA_USUARIO." SET password = :pass WHERE email = :mail";
			try {
				$st = $conexion->prepare( $sql );
				$st->bindValue( ":mail", $mail, PDO::PARAM_STR );
				$st->bindValue( ":pass", $pass, PDO::PARAM_STR );
				$st->execute();

				parent::desconectar( $conexion );

			} catch ( PDOException $e ) {
				parent::desconectar( $conexion );
				die( "Actualización de contraseña fallada: " . $e->getMessage() );
			}
		}
	}
?>
