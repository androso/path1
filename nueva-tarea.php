<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Tarea</title>
</head>

<body>
    <?php
    $course_id = isset($_GET['course']) ? $_GET['course'] : null;
    $user_id = isset($_GET['user']) ? $_GET['user'] : null;
    ?>
    <h1>Nueva Tarea</h1>
    <p>Ingresa los datos de la nueva tarea</p>
    <form action="datos.php/?course=<?= $course_id ?>&user=<?= $user_id ?>" method="POST">
        <label for="task-name">Tarea:</label>
        <input type="text" id="task-name" name="task_name" required><br><br>
        <input type="text" value="5" name="banderas" hidden>
        <label for="due-date">Fecha limite:</label>
        <input type="date" id="due-date" name="due_date" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>

</html>