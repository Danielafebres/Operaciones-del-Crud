<!DOCTYPE html>
<html>
<head>
  <style>
   body {
      background-color: pink;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    h1 {
      font-size: 36px;
      font-weight: bold;
      margin-top: 20px;
      margin-bottom: 40px;
      color: pink;
      text-align: center;
    }

    table {
      border-collapse: collapse;
      margin: 0 auto;
      background-color : white;
      box-shadow: 0px 2px 5px rgba(0,0,0,0.2);
    }

    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ccc;
    }

    th {
      
      color: grey;
      font-weight: bold;
      border-top: 2px solid #f39c12;
    }

    td {
      border-top: 1px solid #ccc;
    }

    a {
      display: inline-block;
      padding: 10px 20px;
      margin: 10px;
      border-radius: 20px;
      background-color: pink;
      
      font-size: 20px;
      text-decoration: none;
      text-align: center;
      transition: background-color 0.3s;
      box-shadow: 0px 2px 5px rgba(0,0,0,0.2);
    }

    a:hover {
      background-color: yellow;
    }

    a:active {
      background-color: green;
      transform: translateY(2px);
      box-shadow: none;
    }

    ul {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      justify-content: center;
    }

    li {
      margin: 10px;
    }
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: purple;
    }

    /* Estilos para el título del menú */
      .title {
      font-size: 36px;
      font-weight: bold;
      margin-bottom: 20px;
      color: black;
      text-align: center;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      border: 1px solid black;
      padding: 5px;
    }

    

  </style>
  </style>
</head>
<body>
  <ul>
<li><a href="menu.html">volver al menu principal</a></li>
</ul>
</body>
</html>
<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calzado";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos de la tabla "doc"
$sql = "SELECT * FROM calzado";
$result = $conn->query($sql);

// Crear la tabla y los botones de actualizar
if ($result->num_rows > 0) {
  echo "<table>";
  echo "<tr><th>codigo</th><th>Tipo</th><th>Modelo</th><th>Marca</th><th>Talla</th><th>precio</th><th>Actualizar</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>".$row["codigo"]."</td>";
    echo "<td>".$row["tipo"]."</td>";
    echo "<td>".$row["modelo"]."</td>";
    echo "<td>".$row["marca"]."</td>";
    echo "<td>".$row["talla"]."</td>";
        echo "<td>".$row["precio"]."</td>";
    echo "<td><form action='' method='post'>
              <input type='hidden' name='codigo' value='".$row["codigo"]."'>
              <input type='submit' name='update' value='Actualizar'>
          </form></td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "No se encontraron registros.";
}

// Cerrar la conexión a la base de datos
$conn->close();

// Si se ha pulsado el botón de actualizar, mostrar el formulario
if(isset($_POST['update'])){
  $codigo = $_POST['codigo'];
  $conn = new mysqli($servername, $username, $password, $dbname);
  $sql = "SELECT * FROM calzado WHERE codigo='$codigo'";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>Actualizar registro</h2>";
    echo "<form action='' method='post'>";
    echo "<label>Codigo:</label><br>";
    echo "<input type='text' name='codigo' value='".$row["codigo"]."'><br>";
    echo "<label>tipo</label><br>";
    echo "<input type='text' name='tipo' value='".$row["tipo"]."'><br>";
    echo "<label>modelo:</label><br>";
    echo "<input type='text' name='modelo' value='".$row["modelo"]."'><br>";
    echo "<label>marca</label><br>";
    echo "<input type='text' name='marca' value='".$row["marca"]."'><br>";
    echo "<label>talla:</label><br>";
    echo "<input type='text' name='talla' value='".$row["talla"]."'><br>";
        echo "<label>precio:</label><br>";
    echo "<input type='text' name='precio' value='".$row["precio"]."'><br>";
    echo "<input type='submit' name='submit' value='Actualizar'>";
    echo "</form>";
  }
  $conn->close();
}

// Si se ha enviado el formulario de actualización, actualizar los datos en la base de datos
if(isset($_POST['submit'])){
  $codigo = $_POST['codigo'];
  $tipo= $_POST['tipo'];
  $modelo = $_POST['modelo'];
  $marca = $_POST['marca'];
  $talla = $_POST['talla'];
  $precio = $_POST['precio'];
  $conn = new mysqli($servername, $username, $password, $dbname);
  $sql = "UPDATE calzado SET tipo='$tipo', modelo='$modelo', marca='$marca', talla='$talla',precio='$precio'";
  if ($conn->query($sql) === TRUE) {
    echo "Registro actualizado correctamente.Actualiza la pagina si no se han cambiado los valores";
  } else {
    echo "Error al actualizar el registro: " . $conn->error;
  }
  $conn->close();
}
?>