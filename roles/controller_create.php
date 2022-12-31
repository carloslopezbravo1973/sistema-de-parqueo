<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 5/9/2022
 * Time: 17:25
 */
include('../app/config.php');

$nombre = $_GET['nombre'];


date_default_timezone_set("America/La_Paz");
$fechaHora = date("Y-m-d h:i:s");

$sentencia = $pdo->prepare("INSERT INTO tb_roles 
        (nombre,  fyh_creacion, estado) 
VALUES (:nombre, :fyh_creacion,:estado)");

$sentencia->bindParam('nombre',$nombre);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_del_registro);

if($sentencia->execute()){
    echo "Registro Satisfactorio";
    //header('index.php');
    ?>
    <script>location.href = "index.php";</script>
    <?php
}else{
    echo "No se pudo Registrar en la Base de Datos";
}