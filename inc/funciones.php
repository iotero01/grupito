<!----------FUNCION MOSTRAR PRODUCTOS---------->
<?php
	function mostrarProductos($productos){
?>
			    <!-- Example row of columns -->
	<div class="row row-cols-1 row-cols-md-3 card-deck">
	<?php
	foreach($productos as $producto){
	?>
	  <div class="col mb-4">
		<div class="card">
		  <img src="imagenes/<?php echo $producto['imagen']; ?>" class="card-img-top" alt="Invernalia">
		  <div class="card-body">
			<h5 class="card-title"><?php echo $producto['nombre']; ?></h5>
			<p class="card-text"><?php echo $producto['introDescripcion']; ?></p>
			<a href="producto.php?id=<?php echo $producto['idProducto']; ?>" class="btn btn-success">Ahora <?php echo $producto['precioOferta']; ?>€</a>
			<span class="card-text text-danger float-right"><del>Antes <?php echo $producto['precio']; ?>€<del></span>
		  </div>
		</div>
	  </div>
	<?php
		}
	?>
 
	</div> <!-- col rows -->
	
<?php
	}
?>
<!----------FIN FUNCION MOSTRAR PRODUCTOS---------->


<!----------FUNCION RECOGER DATOS---------->
<?php
// FUNCIÓN DE RECOGIDA DE DATOS
function recoge($var, $m = ""){
    if (!isset($_REQUEST[$var])) {
        $tmp = (is_array($m)) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
        });
    }
    return $tmp;
}
?>
<!----------FIN FUNCION RECOGER DATOS---------->

<?php
	function mostrarMensaje($mensaje){
?>
		<div class="jumbotron">
			<div class="container">
			  <h1 class="display-3"><?php echo $mensaje; ?></h1>
			  <p><a class="btn btn-primary btn-lg" href="productos.php" role="button">Volver a la compra »</a></p>
			</div>
		</div>
<?php
	}
?>


