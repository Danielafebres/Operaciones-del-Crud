<!DOCTYPE html>
<html>
<head>
  <title>Leer o borrar datos de los calzados registrados</title>
  <style>
    body {
      background-color: pink;
      
    }

    h1 {
      font-size: 36px;
      font-weight: bold;
      margin-top: 20px;
      margin-bottom: 40px;
      color: #444;
      text-align: center;
    }

    table {
          border-collapse: collapse;
      margin: 0 auto;
      
    
    }

    th, td {
      padding: 10px;
      text-align: left;
      ;
    }

    

    
    a {
      display: inline-block;
      padding: 10px 20px;
      margin: 10px;
      border-radius: 20px;
      background-color: blue;
      color: #fff;
      font-size: 20px;
      text-decoration: none;
      text-align: center;
      transition: background-color 0.3s;
      box-shadow: 0px 2px 5px rgba(0,0,0,0.2);
    }

    a:hover {
      background-color: blue;
    }

    a:active {
      background-color: pink;
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
  </style>
</head>
<body>
  <h1>Leer o borrar datos de los calzados registrados</h1>

  <table border="1">
    <tr>
      <th>Cédula</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>edad</th>
      <th>fecha de nacimiento</th>
      <th>Borrar</th>
    </tr>
    <?php
    // Conectarse a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "calzado");

    // Verificar si la conexión fue exitosa
    if (!$conexion) {
      die("Error de conexión: " . mysqli_connect_error());
    }

    // Verificar si se ha enviado un ID de registro para borrar
    if (isset($_GET["borrar"])) {
      $codigo = $_GET["borrar"];
      $consulta = "DELETE FROM calzado WHERE codigo = $codigo";
      $resultado = mysqli_query($conexion, $consulta);

      // Verificar si el borrado fue exitoso
      if ($resultado) {
        echo "<p style='text-align:center'>Registro borrado exitosamente.</p>";
      } else {
        echo "Error al borrar el registro: " . mysqli_error($conexion);
      }
    }

    // Consultar los datos de la tabla 
    $consulta = "SELECT codigo, tipo, modelo, marca, talla, precio FROM calzado";
    $resultado = mysqli_query($conexion, $consulta);
    // Verificar si la consulta fue exitosa
    if (!$resultado) {
      die("Error de consulta: " . mysqli_error($conexion));
    }

    // Mostrar los datos en una tabla HTML
    while ($fila = mysqli_fetch_assoc($resultado)) {
      echo "<tr>";
      
      echo "<td>" . $fila["codigo"] . "</td>";
      echo "<td>" . $fila["tipo"] . "</td>";
      echo "<td>" . $fila["modelo"] . "</td>";
      echo "<td>" . $fila["marca"] . "</td>";
      echo "<td>" . $fila["talla"] . "</td>";
      echo "<td>" . $fila["precio"] . "</td>";
      echo "<td><a href=\"?borrar=" . $fila["codigo"] . "\">Borrar</a></td>";
      echo "</tr>";
    }

    // Cerrar la conexión a la basede datos
    mysqli_close($conexion);
    ?>
  </table>

  <ul>
    <li><a href="menu.html">Volver al menú principal</a></li>
  </ul>
</body>
</html>