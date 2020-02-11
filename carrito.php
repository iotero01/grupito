<?php session_start(); ?>
<?php include_once "bbdd/bbdd.php"; ?>
<?php include_once "inc/funciones.php"; ?>
<?php
	$pagina = "carrito";
	$titulo = "Tu compra";
?>
<?php require_once('inc/encabezado.php'); ?>

<main role="main">
 
 <?php
	if(empty($_SESSION['carrito'])){
		$mensaje = "Carrito vacío";
		mostrarMensaje($mensaje);
	}
	else{

  ?>
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Carrito de la compra</h1>
	  <a class="btn btn-primary btn-lg" href="productos.php">Seguir comprando</a>
    </div>
  </div>
  
 
  
  <div class="container">
<div class="row px-5">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th class="bg-primary" scope="col">Nombre</th>
      <th class="bg-success" scope="col">Cantidad</th>
      <th class="bg-warning" scope="col">Precio</th>
	  <th class="bg-danger" scope="col">Subtotal</th>
    </tr>
  </thead>
  <tbody>
  <?php
  	$total = 0;
	
	foreach($_SESSION['carrito'] as $id => $cantidad){
		$producto = seleccionarProducto($id);
		$nombre = $producto['nombre'];
		$precio = $producto['precioOferta'];
		$subtotal = $precio * $cantidad;
		$total = $total + $subtotal;
?>
	<tr>
      <td scope="col"><a href="producto.php?id=<?php echo $id; ?>"><?php echo $nombre; ?></a></td>
      <td scope="col"><a href="procesarCarrito.php?id=<?php echo $id; ?>&op=remove"><i class="fas fa-minus-circle"></i></a><?php echo $cantidad; ?><a href="procesarCarrito.php?id=<?php echo $id; ?>&op=add"><i class="fas fa-plus-circle"></i></a></td>
      <td scope="col"><?php echo $precio; ?></td>
	  <td scope="col"><?php echo $subtotal; ?></td>
    </tr>
<?php
	}
?>
	</div>
  </tbody>
  <tfoot>
	<tr>
		<th scope="row" colspan="3" class="text-right">Total: </th>
		<td><?php echo $total; ?>€</td>
	</tr>
</table>
</div>
	<div>
		<a class="btn btn-danger btn-lg" href="procesarCarrito.php?id=<?php echo $id; ?>&op=empty">Vaciar carrito</a>
		
		<a class="btn btn-success btn-lg" href="confirmarPedido.php">Confirmar pedido</a>
	</div>
<?php
	$_SESSION['total'] = $total;
	}
?>

</main>
<?php include_once("inc/pie.php"); ?>