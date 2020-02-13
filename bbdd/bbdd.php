<?php include_once "configuracion.php"; ?>

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

//Función para desconectar la BD
function desconectarBD($con){
	$con = NULL;
	return $con;
}

//Función para seleccionar todas las ofertas
function seleccionarOfertasPortada($numOfertas){
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM productos LIMIT :numOfertas";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':numOfertas', $numOfertas, PDO::PARAM_INT);
		
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOException $e){
		echo "Error: error al seleccionar los productos en la BD: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}

//Función para seleccionar todas las ofertas
function seleccionarTodasOfertas(){
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM productos";
		
		$stmt = $con->prepare($sql);
		
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOException $e){
		echo "Error: error al seleccionar los productos en la BD: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}

//Función para seleccionar un producto
function seleccionarProducto($idProducto){
	$con = conectarBD();
	
	try{
		
		$sql = "SELECT * FROM productos WHERE idProducto=:idProducto";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idProducto',$idProducto, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
	}catch(PDOException $e){
		echo "Error: error al seleccionar un producto en la BD: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $row;
}









//Función para insertar usuario
function insertarUsuario($email, $password, $nombre, $apellidos, $telefono, $direccion){
	
	
	$con = conectarBD();
	
	try{
		$sql = "INSERT INTO usuarios (email, password, nombre, apellidos, telefono, direccion) VALUES (:email, :password, :nombre, :apellidos, :telefono, :direccion)";
		$password = password_hash($password, PASSWORD_DEFAULT);
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':password',$password);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':apellidos',$apellidos);
		$stmt->bindParam(':telefono',$telefono);		
		$stmt->bindParam(':direccion',$direccion);

		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: error al insertar usuario en la BD: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $con->lastInsertId();
}

//Funcion para actualizar Usuario
function actualizarUsuario($idUsuario, $nombre, $password){
	$password = password_hash($password, password_DEFAULT);
	
	$con = conectarBD();
	
	try{
		$sql = "UPDATE usuarios SET nombre=:nombre, password=:password, email=:email, telefono=:telefono, country=:country, location=:location, direccion=:direccion, zipCode=:zipCode WHERE idUsuario=:idUsuario";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idUsuario',$idUsuario);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':password',$password);
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':telefono',$telefono);		
		$stmt->bindParam(':country',$country);
		$stmt->bindParam(':location',$location);
		$stmt->bindParam(':direccion',$direccion);
		$stmt->bindParam(':zipCode',$zipCode);
		$stmt->bindParam(':online',$online);
		
		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: error al actualizar Usuario en la BD: ".$e->getMessage();
		
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
function seleccionarUsuario($idUsuario){
	$con = conectarBD();
	
	try{
		
		$sql = "SELECT * FROM usuarios WHERE idUsuario=:idUsuario";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idUsuario',$idUsuario);
		
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
	}catch(PDOException $e){
		echo "Error: error al seleccionar una Usuario en la BD: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $row;
}


//Función para insertar usuario
function comprobarUsuario($nombre){
	
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM usuarios WHERE nombre=:nombre";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':nombre',$nombre);
		
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
function borrarUsuario($idUsuario){
	$con = conectarBD();
	
	try{
		$sql = "DELETE FROM usuarios WHERE idUsuario=:idUsuario";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idUsuario',$idUsuario);
		
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
function pagination($idUsuario){
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM usuarios";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idUsuario',$idUsuario);
		
		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: error al conectar datos de usuario en la BD: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $stmt->rowCount();
}


?>