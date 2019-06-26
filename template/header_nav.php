<?php
	session_start();
 	if (!isset($_SESSION["id"])){
 		header("Location: index.html");
 		exit;
 	}
?>

<header>
	<a class="link-logo" href="index.php">
		<img class="header-logo" src="imagenes/logo.png" alt="Logo">
	</a>

	<h1 class="titulo-web">RecomenBook</h1>

	<section class="header-right">
	<?php
		require_once ('classes/usuario.class.inc');
		$usuario = new Usuario();
		$fotoUsuario = $usuario->obtenerFoto( $_SESSION["id"] );
		echo ('
			<img class="icono-usuario" src="imagenes/'.$fotoUsuario['foto'].'" alt="icono">
			<p class="usuario">'.$_SESSION["nombre"].'</p>
		');
	?>
				
		<a class="desconectar" href="logout.php">Desconectar</a>
	</section>
</header>

<nav>
	<ul>
		<li><a href="mislibros.php">Mis libros</a></li>
		<li><a href="foro.php">Foro</a></li>
		<li><a href="datospersonales.php">Mis datos</a></li>
		<li><a href="recomendaciones.php">Mis recomendaciones</a></li>
	</ul>
</nav>