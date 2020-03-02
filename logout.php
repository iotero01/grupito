<?php session_start(); ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "bbdd/bbdd.php"; ?>
<?php $pagina = "Sesión finalizada"; ?>
<?php $titulo = "Cierre de sesión"; ?>
<?php require_once "inc/encabezado.php"; ?> 

<?php
	session_destroy();
		echo "<p>Se ha cerrado la sesión correctamente</p>";
		echo "<a href='login.php'>Volver al login</a>";
?>