<?php

include_once("datos.php");

$task_id = isset($_GET['id'])  ? $_GET['id'] : "";
$user_id = isset($_GET['user']) ? $_GET['user'] : "";
$conexion->conectar();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Tarea</title>
</head>

<body>
    <?php
    $task = $gestion->selectUpdate($task_id);
    ?>
    <h1>Editar Tarea</h1>
    <p>Actualiza los datos de esta tarea</p>
    <form action="datos.php?user=<?= $user_id ?>" method="POST">
        <label for="task-name">Tarea:</label>
        <input type="text" value="<?= $task['description'] ?>" id="task-name" name="task_name" required><br><br>
        <input type="text" value="2" name="banderas" hidden>
        <input type="text" value="<?= $task['course_id'] ?>" name="course_id" hidden>
        <input type="text" value="<?= $task['task_id'] ?>" name="id" hidden>
        <label for="due-date">Fecha limite:</label>
        <input type="date" id="due-date" name="due_date" value="<?= $task['due_date'] ?>" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>