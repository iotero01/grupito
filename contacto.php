<?php session_start();
	if(empty($_SESSION['usuario'])){
		header("Location: login.php?redirect=1");
	}
	else{
?>
<?php require_once "inc/funciones.php"; ?>
<?php $pagina = "contacto"; ?>
<?php $titulo = "Contacta con nosotros"; ?>
<?php require_once "inc/encabezado.php"; ?>


<main role="main">
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Contacto</h1>
      <p>Formulario de contacto</p>
	  <form>
		<p>
			<label for="contacto">Email de contacto:</label>
			<input type="text" id="contacto" name="contacto" />
		</p>

		<p>
			<label for="mensaje">Mensaje:</label>
			<input type="textarea" id="mensaje" name="mensaje" /> 
		</p>
		
	  </form>
	  
	  <p><a class="btn btn-primary btn-lg" href="index.php" role="button">Contacta con nosotros »</a></p>

    </div>
  </div>
</main>

<?php } ?>
<?php require_once "inc/pie.php"; ?>