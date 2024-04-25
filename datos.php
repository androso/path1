<?php
$banderas = isset($_POST['banderas']) ? $_POST["banderas"] : "";
$banderaE = isset($_GET['banderaE']) ? $_GET["banderaE"] : "";
$name = isset($_POST['name']) ? $_POST["name"] : "";
$last_name = isset($_POST['last_name']) ? $_POST["last_name"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$courses = array();
for ($i = 1; $i <= 5; $i++) {
    $courseName = isset($_POST['course_name_' . $i]) ? $_POST['course_name_' . $i] : "";
    $courseDescription = isset($_POST['course_description_' . $i]) ? $_POST['course_description_' . $i] : "";
    $course = array(
        'name' => $courseName,
        'description' => $courseDescription
    );
    $courses[] = $course;
}
$ids = isset($_POST["id"]) ? $_POST["id"] : "";
$idd = isset($_GET["iddelete"]) ? $_GET["iddelete"] : "";

include_once "conf/conf.php";
class registros
{
    public $conexion;
    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }
    // public function select()
    // {
    //     $consultaSelect = "SELECT * FROM users";
    //     $ejecutar_consulta = $this->conexion->conexion->query($consultaSelect);
    //     return $ejecutar_consulta->fetch_all(MYSQLI_ASSOC);
    // }
    public function createUser($datos)
    {
        $campos = implode(',', array_keys($datos));
        $valores = "'" . implode("','", array_values($datos)) . "'";
        $consulta_insertar = "INSERT INTO users ($campos) VALUES ($valores)";
        $this->conexion->conexion->query($consulta_insertar);

        // Get the ID of the inserted user
        $id = $this->conexion->conexion->insert_id;
        return $id;
        // Retrieve the inserted user from the database
        // $consultaSelect = "SELECT * FROM users WHERE id = $id";
        // $ejecutar_consulta = $this->conexion->conexion->query($consultaSelect);
        // return $ejecutar_consulta->fetch_assoc();
    }
    public function login($email, $password)
    {
        $consultaSelect = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $ejecutar_consulta = $this->conexion->conexion->query($consultaSelect);
        return $ejecutar_consulta->fetch_assoc();
    }
    public function createCourse($datos)
    {
        $campos = implode(',', array_keys($datos));
        $valores = "'" . implode("','", array_values($datos)) . "'";
        $consulta_insertar = "INSERT INTO courses ($campos) VALUES ($valores)";
        $this->conexion->conexion->query($consulta_insertar);
    }
    public function selectUser($id)
    {
        $id = (int)$id;
        $consultaSelect = "SELECT * FROM users WHERE user_id = $id";
        $ejecutar_consulta = $this->conexion->conexion->query($consultaSelect);
        if ($ejecutar_consulta) {
            return $ejecutar_consulta->fetch_assoc();
        } else {
            return null;
        }
    }
    public function selectCourses($user_id)
    {
        if (empty($user_id)) {
            return [];
        }
        $consultaSelect = "SELECT * FROM courses WHERE user_id = $user_id";
        $ejecutar_consulta = $this->conexion->conexion->query($consultaSelect);
        $courses = $ejecutar_consulta->fetch_all(MYSQLI_ASSOC);

        foreach ($courses as &$course) {
            $course_id = $course['course_id'];
            $consultaSelectTasks = "SELECT * FROM tasks WHERE course_id = $course_id";
            $ejecutar_consulta_tasks = $this->conexion->conexion->query($consultaSelectTasks);
            $tasks = $ejecutar_consulta_tasks->fetch_all(MYSQLI_ASSOC);
            foreach ($tasks as &$task) {
                $task['due_date'] = date("Y-m-d", strtotime($task['due_date']));
            }
            $course['tasks'] = $tasks;
        }

        return $courses;
    }

    // public function insert($datos)
    // {
    //     $campos = implode(',', array_keys($datos));
    //     $valores = "'" . implode("','", array_values($datos)) . "'";
    //     $consulta_insertar = "INSERT INTO registros ($campos) VALUES ($valores)";
    //     $this->conexion->conexion->query($consulta_insertar);
    // }

    // public function selectupdate($id)
    // {
    //     $consultaSelect = "SELECT * FROM registros WHERE id=$id";
    //     $ejecutar_consulta = $this->conexion->conexion->query($consultaSelect);
    //     return $ejecutar_consulta->fetch_all(MYSQLI_ASSOC);
    // }
    // public function update($id, $datos)
    // {
    //     $set = [];
    //     foreach ($datos as $campo => $valor) {
    //         $set[] = "$campo = '$valor'";
    //     }
    //     $set = implode(',', $set);
    //     $consulta_actualizar = "UPDATE registros SET $set WHERE id = $id";
    //     $resultado = $this->conexion->conexion->query($consulta_actualizar);
    //     if ($resultado) {
    //         return true;
    //     } else {
    //         return $this->conexion->conexion->error;
    //     }
    // }
    // public function delete($id)
    // {
    //     $consultaDelete = "DELETE FROM registros WHERE id=$id";
    //     $ejecutar_delete = $this->conexion->conexion->query($consultaDelete);
    //     return $ejecutar_delete;
    // }
    public function createTask($course_id, $task_name, $due_date)
    {
        $due_date = date("Y-m-d", strtotime($due_date)); // Convert the date to a compatible format for SQL
        $datos = array(
            'course_id' => $course_id,
            'description' => $task_name,
            'due_date' => $due_date
        );
        $campos = implode(',', array_keys($datos));
        $valores = "'" . implode("','", array_values($datos)) . "'";
        $consulta_insertar = "INSERT INTO tasks ($campos) VALUES ($valores)";
        $resultado = $this->conexion->conexion->query($consulta_insertar);
        return $resultado ? true : false;
    }
}

$gestion = new registros($conexion);

if ($banderas == 1) {
    // registrar
    // $datosInsert = array('nombre' => $nombre, 'telefono' => $telefono, 'genero' => $genero);
    $conexion->conectar();
    $datosInsert = array(
        'name' => $name,
        'last_name' => $last_name,
        'email' => $email,
        'password' => $password
    );
    $user_id = $gestion->createUser($datosInsert);
    if (isset($user_id)) {
        foreach ($courses as $course) {
            $course['user_id'] = $user_id;
            if (!empty($course['name'])) {
                $gestion->createCourse($course);
            }
        }
    }
    header("Location: index.php?id=$user_id");
} else if ($banderas == 2) {
    // actualizar
    // $id = $ids;
    // $datosUpdate = array('nombre' => $nombre, 'telefono' => $telefono, 'genero' => $genero);
    // $conexion->conectar();
    // $gestion->update($id, $datosUpdate);
    // header("Location: index.php");
} else if ($banderaE == 3) {
    // eliminar
    // $conexion->conectar();
    // $prueba = $gestion->delete($idd);
    // if ($prueba) {
    //     header("Location: index.php");
    // }
} else if ($banderas == 4) {
    // login
    $conexion->conectar();
    $user = $gestion->login($email, $password);
    if ($user) {
        header("Location: index.php?id=" . $user['user_id']);
    } else {
        header("Location: login.php?error=1");
    }
} else if ($banderas == 5) {
    // Nueva tarea
    $conexion->conectar();
    $course_id = isset($_GET['course']) ? $_GET['course'] : null;
    $task_name = isset($_POST['task_name']) ? $_POST['task_name'] : null;
    $due_date = isset($_POST['due_date']) ? $_POST['due_date'] : null;
    $task_succes = $gestion->createTask($course_id, $task_name, $due_date);
    $user_id = isset($_GET['user']) ? $_GET['user'] : null;
    if ($task_succes) {
        header("Location: /sites/path1/index.php?id=$user_id");
    } else {
        header("Location: index.php?error=1");
    }
}
