<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>
    <p>Ingresa tus datos para iniciar sesion</p>
    <p>Si no tienes cuenta, puedes <a href="registrar.php">registrarte</a></p>

    <?php
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<p style="color: red;"> email/contraseña incorrecto</p>';
    }
    ?>

    <form action="datos.php" method="post">
        <input type="email" name="email" placeholder="Email" class="form-input">
        <input type="password" name="password" placeholder="Password" class="form-input">
        <input type="text" name="banderas" value="4" hidden>
        <button type="submit" class="form-button">Submit</button>
    </form>
</body>

</html>