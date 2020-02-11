<?php session_start(); ?>
<?php require_once('bbdd/bbdd.php'); ?>
<?php require_once('inc/funciones.php'); ?>
<?php $pagina = "productos"; ?>
<?php $titulo = "Todas nuestras ofertas"; ?>
<?php require_once('inc/encabezado.php'); ?> 

<main role="main" class="container">
			
	<h1 class="mt-5" align="center">Inicio sesión</h1>

	<?php
		function inicioSesion($name,$password){
	?>
			
			<form method="POST">
				<div class="form-group"><strong>
					<label for="name">Nombre</label>
					<input type="text"  class="form-control" id="name" name="name" value="<?php echo $name; ?>" />
				</div>
				
				<div class="form-group">
					<label for="password">Contraseña</label>
					<input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" />
				</div>
				
					<button type="submit" class="btn btn-primary btn-lg btn-block" name="entry" value="entry">Iniciar sesión</button>

			</form>
			
			<a href="insertarUsuario.php" class="btn btn-info btn-lg btn-block">Registrar usuario</a>
		
	<?php
		}
		if(empty($_REQUEST['entry'])){
			$nombre = "";
			$contrasena = "";
			inicioSesion($nombre, $contrasena);
		}
		else{
			$nombre = recoge('name');
			$contrasena = recoge('password');
			$errores = "";
		
			if($nombre == ""){
				$errores = $errores."<li>Tienes que añadir un nombre</li>";
			}
			if($contrasena == ""){
				$errores = $errores."<li>Tienes que poner la contraseña</li>";
			}
			if($errores != ""){
				echo "<h3>Errores:</h3> <ul> $errores </ul>";
				inicioSesion($nombre, $contrasena);
			}
			else{
				$user = comprobarUsuario($nombre);
				$verificar = password_verify($contrasena,$user['password']);
				if(!$verificar){
					echo "<p>Wrong user or password<p>";
					echo "<a href='login.php'>Volver al login</a>";
				}
				else{
					$_SESSION['name'] = $nombre;
					header("Location: index.php"); 
				}
			}
		}
	?>

</main>
			
<?php require_once "inc/pie.php"; ?>