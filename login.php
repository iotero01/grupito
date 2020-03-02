<?php session_start(); ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "bbdd/bbdd.php"; ?>
<?php $titulo = "Inicio de sesión"; ?>
<?php $pagina = "Inicio de sesión"; ?>
<?php require_once "inc/encabezado.php"; ?> 

<main role="main" class="container">
			
	<h1 class="mt-5" align="center">Inicio sesión</h1>

	<?php
		function inicioSesion($nombre, $password){
	?>
			
			<form method="POST">
				<div class="form-group"><strong>
					<label for="nombre">Nombre</label>
					<input type="text"  class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" />
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
			$password = "";
			inicioSesion($nombre, $password);
		}
		else{
			$nombre = recoge('nombre');
			$password = recoge('password');
			$errores = "";
		
			if($nombre == ""){
				$errores = $errores."<li>Tienes que añadir un nombre</li>";
			}
			if($password == ""){
				$errores = $errores."<li>Tienes que poner la contraseña</li>";
			}
			if($errores != ""){
				echo "<h3>Errores:</h3> <ul> $errores </ul>";
				inicioSesion($nombre, $password);
			}
			else{
				$usuario = comprobarUsuario($nombre);
				$verificar = password_verify($password,$usuario['password']);
				if(!$verificar){
					echo "<p>Wrong user or password<p>";
					echo "<a href='login.php'>Volver al login</a>";
				}
				else{
					$_SESSION['usuario'] = $usuario['nombre'];
					$_SESSION['email'] = $usuario['email'];
					if($usuario['admin'] == 1){
						$_SESSION['admin'] = $usuario['admin'];
					}
					header("Location: index.php"); 
				}
			}
		}
	?>

</main>
			
<?php require_once "inc/pie.php"; ?>