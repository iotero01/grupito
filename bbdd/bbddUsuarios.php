<?php include "configuracionUsuarios.php"; ?>

<?php
//Función para conectarnos a la BD
function conectarBD(){
	try{
		$con = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8", USER, PASS);
		
		$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo "Error: error al conectar la BD: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $con;
}

//Función para insertar usuario
function insertarUsuario($name, $password){
	$password = password_hash($password, PASSWORD_DEFAULT);
	
	$con = conectarBD();
	
	try{
		$sql = "INSERT INTO usuarios (name, password) VALUES (:name, :password, :email, :telephone, :country, :location, :address, :zipCode, :online)";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':name',$name);
		$stmt->bindParam(':password',$password);
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':telephone',$telephone);		
		$stmt->bindParam(':country',$country);
		$stmt->bindParam(':location',$location);
		$stmt->bindParam(':address',$address);
		$stmt->bindParam(':zipCode',$zipCode);
		$stmt->bindParam(':online',$online);
		
		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: error al insertar usuario en la BD: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $con->lastInsertId();
}

//Funcion para actualizar Usuario
function actualizarUsuario($idUser, $name, $password){
	$password = password_hash($password, PASSWORD_DEFAULT);
	
	$con = conectarBD();
	
	try{
		$sql = "UPDATE usuarios SET name=:name, password=:password, email=:email, telephone=:telephone, country=:country, location=:location, address=:address, zipCode=:zipCode WHERE idUser=:idUser";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idUser',$idUser);
		$stmt->bindParam(':name',$name);
		$stmt->bindParam(':password',$password);
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':telephone',$telephone);		
		$stmt->bindParam(':country',$country);
		$stmt->bindParam(':location',$location);
		$stmt->bindParam(':address',$address);
		$stmt->bindParam(':zipCode',$zipCode);
		$stmt->bindParam(':online',$online);
		
		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: error al actualizar User en la BD: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $stmt->rowCount();
}


//Función para seleccionar todos los usuarios
function seleccionarUsuarios(){
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM usuarios";
		
		$stmt = $con->query($sql);

		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	}catch(PDOException $e){
		echo "Error: error al seleccionar todos los usuarios en la BD: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}


//Función para seleccionar un usuario
function seleccionarUsuario($idUser){
	$con = conectarBD();
	
	try{
		
		$sql = "SELECT * FROM usuarios WHERE idUser=:idUser";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idUser',$idUser);
		
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
	}catch(PDOException $e){
		echo "Error: error al seleccionar una User en la BD: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $row;
}


//Función para insertar usuario
function comprobarUsuario($name){
	
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM usuarios WHERE name=:name";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':name',$name);
		
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
	}catch(PDOException $e){
		echo "Error: error al comprobar usuario en la BD: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $row;
}


//Función para borrar usuario
function borrarUsuario($idUser){
	$con = conectarBD();
	
	try{
		$sql = "DELETE FROM usuarios WHERE idUser=:idUser";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idUser',$idUser);
		
		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: error al eliminar usuario en la BD: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $stmt->rowCount();
}


//Función para contar todos los usuarios
function contarUsuarios(){
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM usuarios";
		
		$stmt = $con->prepare($sql);
		
		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: error al contar a los usuarios de la BD: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $stmt->rowCount();
}


//Función paginacion
function pagination($idUser){
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM usuarios";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idUser',$idUser);
		
		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: error al conectar datos de usuario en la BD: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $stmt->rowCount();
}



?>