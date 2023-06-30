<!DOCTYPE html>
<html>
<head>
	<title>Registro de calzado</title>
	<style>
		body {
			background-color: 
			pink;
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}

		h1 {
			color: #444;
			font-size: 36px;
			font-weight: bold;
			margin-top: 20px;
			margin-bottom: 40px;
			text-align: center;
		}

		form {
			margin: 20px auto;
			padding: 20px;
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0px 1px 5px rgba(0,0,0,0.2);
			max-width: 400px;
			border: 1px solid #ccc;
		}

		label {
			display: block;
			margin-bottom: 5px;
			color: #444;
		}

		input[type=text] {
			width: 100%;
			padding: 5px;
			margin-bottom: 10px;
			border: 1px solid #ccc;
			border-radius: 3px;
			box-sizing: border-box;
		}

		input[type=submit] {
			background-color: pink;
			
			padding: 10px 20px;
			border: none;
			
			cursor: pointer;
			font-size: 20px;
			
			box-shadow: 0px 2px 5px rgba(0,0,0,0.2);
			display: block;
			margin: 0 auto;
			text-align: center;
		}

		input[type=submit]:hover {
			background-color: pink;
		}

		ul {
			list-style: none;
			padding: 0;
			margin: 0;
			display: flex;
			flex-direction: column;
			align-items: center;
		}

		li {
			margin: 10px;
		}

		a {
			
			padding: 10px 20px;
			margin: 10px;
			
			background-color: #3366cc;
			color: #fff;
			font-size: 20px;
			text-decoration: none;
			text-align: center;
			
			
		}

		
		
	</style>
</head>
<body>
	<h1>Registrar Calzado </h1>

	<form method="post">
		<label>codigo:</label>
		<input type="text" name="codigo" required>
		<label>Tipo:</label>
		<input type="text" name="tipo" required>
		<label>Modelo:</label>
		<input type="text" name="modelo" required>
		<label>Marca:</label>
		<input type="text" name="marca" required>
		<label>Talla:</label>
		<input type="text" name="talla" required>
		<label>Precio:</label>
		<input type="text" name="precio" required>
		<input type="submit" value="Registrar" class="btn register">
	</form>

	<ul>
		<li><a href="menu.html" class="btn">Volver al menú principal</a></li>
	</ul>

	<?php
	// Parámetros de la conexión a la base de datos
	$host = "localhost";
	$dbname = "calzado";
	$username = "root";
	$password = "";

	// Crear una conexión a la base de datos utilizando PDO
	try {
	    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	    // Establecer el modo de error de PDO a excepción
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
	    echo "Error en la conexión a la base de datos: " . $e->getMessage();
	}

	// Si se ha enviado el formulario, insertar los datos en la base de datos
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		try {
			// Preparar la consulta SQL para insertar los datos en la tabla 
			$stmt = $conn->prepare("INSERT INTO calzado (codigo, tipo, modelo, marca, talla, precio) VALUES (:codigo, :tipo, :modelo, :marca, :talla, :precio)");

			// Vincular los parámetros de la consulta con los valores enviados en el formulario
			$stmt->bindParam(':codigo', $_POST['codigo']);
			$stmt->bindParam(':tipo', $_POST['tipo']);
			$stmt->bindParam(':modelo', $_POST['modelo']);
			$stmt->bindParam(':marca', $_POST['marca']);
			$stmt->bindParam(':talla', $_POST['talla']);
			$stmt->bindParam(':precio', $_POST['precio']);

			// Ejecutar la consulta
			$stmt->execute();

			// Mostrar un mensaje de éxito
			echo "Calzado ingresado con exito.";
		} catch(PDOException $e) {
			// Mostrar un mensaje de error en caso de que la consulta falle
			echo "Error al ingresar el calzado:" . $e->getMessage() ;
		}
	}

	// Cerrar la conexión a la base de datos
	$conn = null;
	?>
</body>
</html>