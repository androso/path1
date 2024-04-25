<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de datos</title>
</head>

<body>
    <?php
    include_once("datos.php");
    $conexion->conectar();
    $user_id = isset($_GET['id']) ? $_GET['id'] : null;
    $user = null;
    if (isset($user_id)) {
        $user = $gestion->selectUser($user_id);
    }
    ?>
    <?php
    if ($user) { ?>
        <!-- INTERFAZ PARA USUARIO -->
        <h1>Bienvenido, <?= $user['name'] ?></h1>
    <?php
    } else { ?>
        <!-- INTERFAZ PARA USUARIO NO LOGGEADO -->
        <h1>Bienvenido a tu aplicacion de tareas universitaria</h1>
        <div>
            <a href="registrar.php">Registrar</a>
            <a href="login.php">Iniciar Sesion</a>
        </div>
    <?php
    };
    // $courses = $gestion->selectCourses($user_id);
    ?>


    <table>
        <!-- <td>
                <a href="modificar.php?id=<?= $filas['user_id'] ?>">Modificar</a>
                <a href="datos.php?iddelete=<?= $filas['user_id'] ?>&banderaE=3">Eliminar</a>
            </td> -->
    </table>
</body>

</html>
<?php
$conexion->desconectar();
?>