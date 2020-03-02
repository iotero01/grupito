<?php session_start();
	if(empty($_SESSION['name'])){
		header("Location: login.php?redirect=1");
	}
?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "bbdd/bbdd.php"; ?>
<?php $pagina = "Tramitación"; ?>
<?php $titulo = "Tramita tu pedido"; ?>
<?php require_once "inc/encabezado.php"; ?> 
<?php include_once("misPedidos.php"); ?>

<?php