<?php
$banderas = isset($_POST['banderas']) ? $_POST["banderas"] : "";
$banderaE = isset($_GET['banderaE']) ? $_GET["banderaE"] : "";
$nombre = isset($_POST['nombre']) ? $_POST["nombre"] : "";
$telefono = isset($_POST['telefono']) ? $_POST["telefono"] : "";
$genero = isset($_POST["genero"]) ? $_POST["genero"] : "";
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
    public function select()
    {
        $consultaSelect = "SELECT * FROM registros";
        $ejecutar_consulta = $this->conexion->conexion->query($consultaSelect);
        return $ejecutar_consulta->fetch_all(MYSQLI_ASSOC);
    }
    public function insert($datos)
    {
        $campos = implode(',', array_keys($datos));
        $valores = "'" . implode("','", array_values($datos)) . "'";
        $consulta_insertar = "INSERT INTO registros ($campos) VALUES ($valores)";
        $this->conexion->conexion->query($consulta_insertar);
    }
    public function selectupdate($id)
    {
        $consultaSelect = "SELECT * FROM registros WHERE id=$id";
        $ejecutar_consulta = $this->conexion->conexion->query($consultaSelect);
        return $ejecutar_consulta->fetch_all(MYSQLI_ASSOC);
    }
    public function update($id, $datos)
    {
        $set = [];
        foreach ($datos as $campo => $valor) {
            $set[] = "$campo = '$valor'";
        }
        $set = implode(',', $set);
        $consulta_actualizar = "UPDATE registros SET $set WHERE id = $id";
        $resultado = $this->conexion->conexion->query($consulta_actualizar);
        if ($resultado) {
            return true;
        } else {
            return $this->conexion->conexion->error;
        }
    }
    public function delete($id)
    {
        $consultaDelete = "DELETE FROM registros WHERE id=$id";
        $ejecutar_delete = $this->conexion->conexion->query($consultaDelete);
        return $ejecutar_delete;
    }
}

$gestion = new registros($conexion);
if ($banderas == 1) {
    $datosInsert = array('nombre' => $nombre, 'telefono' => $telefono, 'genero' => $genero);
    $conexion->conectar();
    $gestion->insert($datosInsert);
    header('Location:index.php');
} else if ($banderas == 2) {
    $id = $ids;
    $datosUpdate = array('nombre' => $nombre, 'telefono' => $telefono, 'genero' => $genero);
    $conexion->conectar();
    $gestion->update($id, $datosUpdate);
    header("Location: index.php");
} else if ($banderaE == 3) {
    $conexion->conectar();
    $prueba = $gestion->delete($idd);
    if ($prueba) {
        header("Location: index.php");
    }
}
