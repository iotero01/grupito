<?php require_once('bbdd/bbdd.php'); ?>
<?php require_once('inc/encabezado.php'); ?>
<?php require_once('inc/funciones.php'); ?>

<?php 
	$idProducto = recoge('id'); 
	$producto = seleccionarProducto($idProducto);
?>

<?php
	$nombre = $producto['nombre'];
	$introDescripcion = $producto['introDescripcion'];
	$descripcion = $producto['descripcion'];
	$imagen = $producto['imagen'];
	$precioOferta = $producto['precioOferta'];
	$precio = $producto['precio'];
?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3"><?php echo $producto['nombre']; ?></h1>
      <p>La tienda con las best ofertas de internet que podrás compartir con tus friends.</p>
      <p><a class="btn btn-primary btn-lg" href="#" role="button">Nuestras ofertas »</a></p>
    </div>
  </div>

  <div class="container">

	<div class="row col-10 mx-auto">
		<div class="col-6 mx-auto">
			<p><?php echo $producto['descripcion']; ?></p>
			<div class="col-12 mx-auto d-flex justify-content-center">
				<a class="btn btn-success text-justify" href="carrito.php" >Añade al carrito</a>
			</div>
		</div>
		
		<div class="col-6 mx-auto">
			<p><img src="imagenes/<?php echo $producto['imagen']; ?>" alt="<?php echo $nombre; ?>" class="card-img-top rounded" /></p>
			<div class="row mx-auto">
				<span class="text-danger col-6 text-justify display-4">
					Antes: <del><?php echo $precio ?>€</del>
				</span>

				<span class="text-success col-6 text-right display-4">
					Ahora: <?php echo $precioOferta ?>€
				</span>
			</div>
		</div>
		
		
	</div>
		
  </div>

    <hr>

  </div> <!-- /container -->

</main>

<?php require_once('inc/pie.php'); ?>