<?php 
	session_start();
	if(empty($_SESSION['name'])){
		header("Location: login.php?redirect=1");
	}
	
	require_once "bbdd/bbdd.php";
	require_once "inc/funciones.php";
	require_once "inc/encabezado.php";
?>

<?php
	function imprimirUsuario($idUser, $name, $old_password, $new_password, $confirm_password){
?>

	<form method="POST">
		<div class="form-group">
			<label for="idUser">ID</label>
			<input type="text" class="form-control" id="idUser" name="idUser" value="<?php echo $idUser; ?>" disabled />
		</div>
		
		<div class="form-group">
			<label for="name">Nombre</label>
			<input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" />
		</div>
		
		<div class="form-group">
			<label for="old_password">Contraseña antigua</label>
			<input type="password" class="form-control" id="old_password" name="old_password" value="<?php echo $old_password; ?>" />
		</div>

		<div class="form-group">
			<label for="new_password">Nueva contraseña</label>
			<input type="password" class="form-control" id="new_password" name="new_password" />
			<label for="confirm_password">Confirmar contraseña</label>
			<input type="password" class="form-control" id="confirm_password" name="confirm_password" />
		</div>

		<button type="submit" class="btn btn-primary mb-2" name="save" value="save">Guardar</button>

	</form>
	
		<a href="index.php" class="btn btn-primary mb-2">Volver al menú principal</a>
<?php	
	}
?>

<main role="main" class="container">

    <h1 class="mt-5" align="center">Actualizar usuario</h1>
 
<?php
	if(!isset($_REQUEST['save'])){
		$idUsuario = recoge('idUser');
		
		if($idUsuario == ""){
			header("Location: index.php");
			exit();
		}
		
		$usuario = seleccionarUsuario($idUsuario);
		
		if(empty($usuario)){
			header("Location: login.php");
			exit();
		}
		
		$nombre = $usuario['name'];
		$contrasena_antigua = "";
		$contrasena_nueva = "";
		$contrasena_confirmar = "";
		
		imprimirUsuario($idUsuario, $nombre, $contrasena_antigua, $contrasena_nueva, $contrasena_confirmar);
	}
	else{	
		$idUsuario = recoge('idUser');
		$nombre = recoge('name');
		$contrasena_antigua = recoge('old_password');
		$contrasena_nueva = recoge('new_password');
		$contrasena_confirmar = recoge('confirm_password');
		$errores = "";
					
		if($nombre == ""){
			$errores = $errores."<li>Tienes que añadir un nombre</li>";
		}
		if($contrasena_antigua == ""){
			$errores = $errores."<li>Tienes que poner la contraseña</li>";
		}
		if(!$contrasena_antigua){
			$errores = $errores."<li>La anterior contraseña no corresponde</li>";
		}
		if($contrasena_nueva != $contrasena_confirmar){
			$errores = $errores."<li>No coincide la contraseña nueva y su confirmación</li>";
		}
		if($errores != ""){
			echo "<h3>Errores:</h3> <ul> $errores </ul>";
			imprimirUsuario($idUsuario, $nombre, $contrasena_antigua, $contrasena_nueva, $contrasena_confirmar);
		}
		
		else{
			$ok = actualizarUsuario($idUsuario, $nombre, $contrasena_nueva);
			if($ok){
				echo "<div class='alert alert-success' role='alert'>
					Tarea $idUsuario actualizado correctamente
				  </div>";
				echo "<p><a href='index.php' class='btn btn-primary'>Volver al login</a></p>";
			}
			else{
				echo "<div class='alert alert-danger' role='alert'>
					ERROR: Usuario NO actualizado correctamente
				  </div>";
				imprimirUsuario($idUsuario, $nombre, $contrasena, $contrasena_nueva, $contrasena_confirmar);
			}
		}
	}
?>

</main>

<?php require_once "inc/pie.php"; ?>