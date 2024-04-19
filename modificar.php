<?php

include_once("datos.php");

$id = isset($_GET['id'])  ? $_GET['id'] : "";

$conexion->conectar();

$registros = $gestion->selectupdate($id);
foreach ($registros as $filas) : ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <form action="datos.php" method="post">
            <label for="">Nombre</label>
            <input type="text" name="banderas" value="2" hidden>
            <input type="text" name="id" value="<?= $filas["id"] ?>" hidden>
            <input type="text" name="nombre" id="" value="<?= $filas["nombre"] ?>">
            <br>
            <label for="">Telefono</label>
            <input type="text" name="telefono" id="" value="<?= $filas["telefono"] ?>">
            <br>
            <label for="">Genero</label>
            <input type="text" name="genero" id="" value="<?= $filas["genero"] ?>">
            <br>
            <input type="submit" value="enviar">
        </form>
    </body>

    </html>
<?php
endforeach;
?>