<?php 
	session_start();
	require_once "bbdd/bbdd.php";
	require_once "inc/funciones.php";
	$pagina = "crearUsuario";
	$titulo = "Crear nuevo usuario";
	require_once "inc/encabezado.php";
?>

<?php
	function imprimirUsuario($email, $password, $confirm_password, $nombre, $apellidos, $telefono, $direccion){
?>

	<form method="POST">
	
		<div class="form-group">
			<label for="email">Email</label>
			<input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" />
		</div>
		
		<div class="form-group">
			<label for="password">Contraseña</label>
			<input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" />
			<label for="confirm_password">Confirmar contraseña</label>
			<input type="password" class="form-control" id="confirm_password" name="confirm_password" />
		</div>
		
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" />
		</div>
		
		<div class="form-group">
			<label for="apellidos">Apellidos</label>
			<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>" />
		</div>
		
		<div class="form-group">
			<label for="telefono">Telefono</label>
			<input type="number" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono; ?>" pattern="[0-9]{9,9}" />
		</div>
		
		<div class="form-group">
			<label for="direccion">Dirección</label>
			<input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion; ?>" />
		</div>
		
		<input type="hidden" name="recaptcha_response" id="recaptchaResponse">

		 <button type="submit" class="btn btn-primary mb-2" name="guardar" value="guardar">Guardar</button>
		 
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
		$apellidos = "";
		$password = "";
		$confirm_password = "";
		$email = "";
		$telefono = "";
		$direccion = "";
		imprimirUsuario($email, $password, $confirm_password, $nombre, $apellidos, $telefono, $direccion);
	}
	else{
		$nombre = recoge('nombre');
		$apellidos = recoge('apellidos');
		$password = recoge('password');
		$confirm_password = recoge('confirm_password');
		$email = recoge('email');
		$telefono = recoge('telefono');
		$direccion = recoge('direccion');
		$errores = "";
		
		
		//VALIDAR reCaptcha

		$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify'; 
		$recaptcha_secret = CLAVE_SECRETA; 
		$recaptcha_response = recoge('recaptcha_response'); 
		$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response); 
		$recaptcha = json_decode($recaptcha); 

		/*if($recaptcha -> score < 0.7){

		  $errores = $errores."<li>Detectado robot</li>";

		}*/
		
		
		if($email == ""){
			$errores = $errores."<li>Es necesario añadir un correo</li>";
		}
		if($password == ""){
			$errores = $errores."<li>Es necesario añadir una password</li>";
		}
		if($password != $confirm_password){
			$errores = $errores."<li>No coincide la contraseña y su confirmación</li>";
		}
		if($nombre == ""){
			$errores = $errores."<li>Es necesario añadir un nombre</li>";
		}
		if($telefono == ""){
			$errores = $errores."<li>Es necesario añadir un nº de teléfono</li>";
		}
		if($errores != ""){
			echo "<h3>Errores:</h3> <ul> $errores </ul>";
			imprimirUsuario($email, $password, $confirm_password, $nombre, $apellidos, $telefono, $direccion);
		}
		else{
			$idUsuario = insertarUsuario($email, $password, $nombre, $apellidos, $telefono, $direccion);
			if($idUsuario != 0){
				echo "<div class='alert alert-success' role='alert'>
						Usuario $idUsuario insertada correctamente
					  </div>";
				echo "<p><a href='login.php' class='btn btn-primary'>Volver al login</a></p>";
			}
			else{
				echo "<div class='alert alert-danger' role='alert'>
						ERROR: Usuario NO insertado
					  </div>";
				imprimirUsuario($email, $password, $confirm_password, $nombre, $apellidos, $telefono, $direccion);
			}
		}
	}	
?>

<?php require_once "inc/pie.php"; ?>