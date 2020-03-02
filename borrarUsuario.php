<?php 
	session_start();
	if(empty($_SESSION['usuario'])){
		header("Location: login.php?redirect=1");
	}
	require_once "bbdd/bbdd.php";
	require_once "inc/funciones.php";
	require_once "inc/encabezado.php";
?>

<main role="main" class="container">

    <h1 class="mt-5" align="center">Borrar usuario</h1>

<?php
	if(!isset($_REQUEST['guardar'])){
		$idUser = recoge('idUser');
		
		if($idUser == ""){
			header("Location: index.php");
			exit();
		}
		
		$ok = borrarUsuario($idUser);
			
		if($ok){
			echo "<div class='alert alert-success' role='alert'>
					Usuario $idUser borrada correctamente
				  </div>";
			echo "<p><a href='login.php' class='btn btn-primary'>Volver al login</a></p>";
		}
		else{
			echo "<div class='alert alert-danger' role='alert'>
					ERROR: Usuario NO borrada correctamente
				  </div>";
		  echo "<p><a href='index.php' class='btn btn-primary'>Volver al menú principal</a></p>";
		}	
	}
?>
</main>

<?php require_once "inc/pie.php"; ?>