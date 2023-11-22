<?php
include('conexion.php');

$sql_leer = 'SELECT * FROM bible_verses';
$recibir = $pdo->prepare($sql_leer);
$recibir->execute();
$resultado = $recibir->fetchAll();
$i = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Versículos Bíblicos</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #2c3e50; /* Color de fondo más oscuro */
            color: #ecf0f1; /* Texto blanco */
            font-family: 'Arial', sans-serif;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh; /* Mínimo 100% del viewport height */
        }

        h1 {
            font-size: 3em;
            margin-bottom: 20px;
            color: #3498db; /* Azul más claro para el título */
        }

        p {
            font-size: 1.5em;
            margin: 10px 0;
        }

        h2 {
            font-size: 2em;
            font-weight: bold;
            margin-top: 0;
            color: #e74c3c; /* Rojo para el texto principal */
        }

        form {
            width: 80%;
            max-width: 600px; /* Ancho máximo para una mejor lectura en dispositivos grandes */
        }
        button {
            background-color: #3498db; /* Azul claro */
            color: #ffffff; /* Texto blanco */
            padding: 10px 20px;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9; /* Cambio de color al pasar el ratón sobre el botón */
        }
    </style>
</head>

<body>
    <h1>Versículo Aleatorio</h1>
    <?php
    $sql_leer = 'SELECT * FROM bible_verses ORDER BY RAND() LIMIT 1'; /* Usar ORDER BY RAND() para obtener un versículo aleatorio directamente desde la base de datos */
    $recibir = $pdo->prepare($sql_leer);
    $recibir->execute();
    $resultado = $recibir->fetch();

    $idbook = $resultado['idBook'];
    $sql_leer = "SELECT * FROM bible_books WHERE idBook = '{$idbook}'";
    $recibir = $pdo->prepare($sql_leer);
    $recibir->execute();
    $idDetalle = $recibir->fetch();
    ?>
    <form action="modificar.php" method="post">
        <p><?php echo $idDetalle['name'] . " " . $resultado['chapter'] . ":" . $resultado['verse']; ?></p>
        <h2><?php echo $resultado['text']; ?></h2>
    </form>
    <button onclick="location.reload()">Actualizar Página</button>
</body>

</html>
