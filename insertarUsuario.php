<?php 
	session_start();
	require_once "bbdd/bbdd.php";
	require_once "inc/funciones.php";
	require_once "inc/encabezado.php";
?>

<?php
	function imprimirUsuario($nombre, $contrasena, $confirm_contrasena, $email, $telefono, $direccion){
?>

	<form method="POST">
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" class="form-control" id="nombre" nombre="nombre" value="<?php echo $nombre; ?>" />
		</div>
		
		<div class="form-group">
			<label for="contrasena">Contraseña</label>
			<input type="password" class="form-control" id="contrasena" nombre="contrasena" value="<?php echo $contrasena; ?>" />
			<label for="confirm_contrasena">Confirmar contraseña</label>
			<input type="password" class="form-control" id="confirm_contrasena" nombre="confirm_contrasena" />
		</div>
		
		<div class="form-group">
			<label for="email">Email</label>
			<input type="text" class="form-control" id="email" nombre="email" value="<?php echo $email; ?>" />
		</div>
		
		<div class="form-group">
			<label for="telefono">Telefono</label>
			<input type="number" class="form-control" id="telefono" nombre="telefono" value="<?php echo $telefono; ?>" pattern="[0-9]{9,9}" />
		</div>
		
		<div class="form-group">
			<label for="direccion">Dirección</label>
			<input type="text" class="form-control" id="direccion" nombre="direccion" value="<?php echo $direccion; ?>" />
		</div>

		 <button type="submit" class="btn btn-primary mb-2" nombre="guardar" value="guardar">Guardar</button>
		 
	</form>
	
		<a href="login.php" class="btn btn-primary mb-2">Volver al login</a>
<?php	
	}
?>

<main role="main" class="container">

    <h1 class="mt-5" align="center">Insertar nuevo Usuario</h1>
 
<?php
	if(!isset($_REQUEST['guardar'])){
		$nombre = "";
		$contrasena = "";
		$confirm_contrasena = "";
		$email = "";
		$telefono = "";
		$direccion = "";
		imprimirUsuario($nombre, $contrasena, $confirm_contrasena, $email, $telefono, $direccion);
	}
	else{
		$nombre = recoge('nombre');
		$contrasena = recoge('contrasena');
		$confirm_contrasena = recoge('confirm_contrasena');
		$email = recoge('email');
		$telefono = recoge('telefono');
		$direccion = recoge('direccion');
		$errores = recoge('');
		
		if($nombre == ""){
			$errores = $errores."<li>Es necesario añadir un nombre</li>";
		}
		if($contrasena == ""){
			$errores = $errores."<li>Es necesario añadir una contrasena</li>";
		}
		if($contrasena != $confirm_contrasena){
			$errores = $errores."<li>No coincide la contraseña y su confirmación</li>";
		}
		if($email == ""){
			$errores = $errores."<li>Es necesario añadir un correo</li>";
		}
		if($telefono == ""){
			$errores = $errores."<li>Es necesario añadir un nº de teléfono</li>";
		}
		if($errores != ""){
			echo "<h3>Errores:</h3> <ul> $errores </ul>";
			imprimirUsuario($nombre, $contrasena, $confirm_contrasena, $email, $telefono, $direccion);
		}
		else{
			$idUsuario = insertarUsuario($nombre, $contrasena, $email, $telefono, $direccion);
			if($idUsuario != 0){
				echo "<div class='alert alert-success' role='alert'>
						Usuario $idUsuario insertada correctamente
					  </div>";
				echo "<p><a href='login.php' class='btn btn-primary'>Volver al login</a></p>";
			}
			else{
				echo "<div class='alert alert-danger' role='alert'>
						ERROR: Usuario NO insertada
					  </div>";
				imprimirUsuario($nombre, $contrasena, $confirm_contrasena, $email, $telefono, $direccion);
			}
		}
	}	
?>

<?php require_once "inc/pie.php"; ?>