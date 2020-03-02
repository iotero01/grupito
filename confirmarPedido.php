<?php session_start();
	if(empty($_SESSION['usuario'])){
		header("Location: login.php?redirect=1");
	}
?>
<?php include_once("bbdd/bbdd.php"); ?>
<?php include_once("inc/funciones.php"); ?>
<?php $pagina = "Confirmación del pedido"; ?>
<?php $titulo = "Confirma tu pedido"; ?>
<?php require_once ("inc/encabezado.php"); ?>

<main role="main">

	<div class="jumbotron">
		<div class="container">
		<h1 class="display-3">Confirmación del pedido</h1>
		</div>
	</div>
	
<?php
	if(!isset($_SESSION['usuario'])){
		echo "Tienes que loguearte";
	}
	else{
		$usuario = seleccionarUsuario($_SESSION['usuario']);
		$idUsuario = $usuario['idUsuario'];
		$carrito = $_SESSION['carrito'];
		$total = recoge('total');

		$ok = insertarPedido($idUsuario, $carrito, $total);
		if($ok){
			unset($_SESSION['carrito']);
			unset($_SESSION['cantidad']);
  ?>
	<p>Se ha confirmado tu pedido correctamente</p>
	<a href="index.php">Volver a la página principal</a>
<?php
		}
		else{
			echo "Ha habido un problema con la confirmación";
		}
	}
?>

</main>

<?php include_once("inc/pie.php"); ?>