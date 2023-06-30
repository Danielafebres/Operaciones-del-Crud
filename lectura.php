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

</head>
<body>
  <ul>
    <li><a href="menu.html">volver al menu principal</a></li>
  </ul>
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

  // Obtener los datos de la tabla
  $sql = "SELECT * FROM calzado";
  $result = $conn->query($sql);

  // Crear la tabla HTML para mostrar los datos
  if ($result->num_rows > 0) {
    echo '<div class="container">';
    echo '<h1 class="title"> Lista de Sandalias</h1>';
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Codigo</th>';
    echo '<th>Tipo</th>';
    echo '<th>Modelo</th>';
    echo '<th>Marca</th>';
    echo '<th>Talla</th>';
    echo '<th>Precio</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    // Recorrer los resultados y mostrarlos en la tabla
    while($row = $result->fetch_assoc()) {
      echo '<tr>';
      echo '<td>' . $row["codigo"] . '</td>';
      echo '<td>' . $row["tipo"] . '</td>';
      echo '<td>' . $row["modelo"] . '</td>';
      echo '<td>' . $row["marca"] . '</td>';
      echo '<td>' . $row["talla"] . '</td>';
      echo '<td>' . $row["precio"] . '</td>';
      echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
  } else {
    echo '<p>No se encontraron tipos de calzados.</p>';
  }
  $conn->close();
  ?>
</body>
</html>