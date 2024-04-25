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
    if (!empty($user_id)) {
        $user = $gestion->selectUser($user_id);
        $courses = $gestion->selectCourses($user_id);
    }
    $error = isset($_GET['error']) ? $_GET['error'] : null;
    ?>
    <?php
    if ($user) { ?>
        <!-- INTERFAZ PARA USUARIO -->
        <h1>Bienvenido, <?= $user['name'] ?></h1>
        <?php
        if ($error) {
            echo "<p style='color:red'>Ha ocurrido un error en la anterior transaccion</p>";
        }
        if (count($courses) == 0) {
            echo "<p>No tienes cursos registrados</p>";
        } else { ?>
            <p>Tus cursos registrados son:</p>
            <?php foreach ($courses as $course) : ?>
                <table border="1" style="min-width: 300px;">
                    <caption>Course: <?= $course["name"]; ?>
                        <a role="button" href="nueva-tarea.php?course=<?= $course['course_id'] ?>&user=<?= $user_id ?>">Nueva Tarea</a>
                    </caption>
                    <tr>
                        <th>Tarea</th>
                        <th>Fecha de finalizacion</th>
                        <th>Acciones</th>
                    </tr>
                    <?php foreach ($course['tasks'] as $task) : ?>
                        <tr>
                            <td><?= $task['description']; ?></td>
                            <td><?= $task['due_date']; ?></td>
                            <td>
                                <a href="modificar.php?id=<?= $task['task_id'] ?>&user=<?= $user_id ?>">Modificar</a>
                                <a href="datos.php?iddelete=<?= $filas['task_id'] ?>&banderaE=3">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <br><br>
            <?php endforeach; ?>
        <?php } ?>

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
    ?>
</body>

</html>
<?php
$conexion->desconectar();
?>