<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de datos</title>
</head>

<body>
    <a href="registrar.php">Registrar</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Genero</th>
        </tr>

        <?php
        include_once("datos.php");
        $conexion->conectar();
        $registros = $gestion->select();
        foreach ($registros as $filas) :
        ?>
            <tr>
                <td><?= $filas['id'] ?></td>
                <td><?= $filas['nombre'] ?></td>
                <td><?= $filas['telefono'] ?></td>
                <td><?= $filas['genero'] ?></td>
            
                <td>
                    <a href="modificar.php?id=<?= $filas['id'] ?>">Modificar</a>
                    <a href="datos.php?iddelete=<?= $filas['id'] ?>&banderaE=3">Eliminar</a>
                </td>
            </tr>
        <?php endforeach;
        ?>
    </table>

</body>

</html>
<?php
$conexion->desconectar();
?>