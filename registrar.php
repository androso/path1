<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Registro de usuario</h1>

    <form action="datos.php" method="post">
        <label for="">Nombre</label>
        <input type="text" name="banderas" value="1" hidden>
        <input type="text" name="name" id="" required>
        <br>
        <label for="">Apellido</label>
        <input type="text" name="last_name" id="" required>
        <br>
        <label for="">Email</label>
        <input type="email" name="email" id="" required>
        <br>
        <label for="">Password</label>
        <input type="password" name="password" id="" required>
        <br>
        <h2>Registro de materias</h2>
        <?php
        for ($i = 0; $i < 5; $i++) : ?>
            <h3>Materia <?= $i + 1 ?></h3>
            <label for="">Nombre</label>
            <input type="text" name="course_name_<?= $i + 1 ?>" id="" <?= $i == 0 ? "required" : "" ?>>
            <br>
            <label for="">Descripción</label>
            <textarea name="description_<?= $i + 1 ?>" id="" cols="30" rows="10"></textarea>
            <br>
        <?php
        endfor;
        ?>
        <input type="submit" value="enviar">
    </form>
</body>

</html>