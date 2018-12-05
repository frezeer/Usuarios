<?php
error_reporting(0);
header('Content-type: application/json; charset=utf-8');
 
$nombre = $_POST['nombre'];

 
function validarDatos($nombre){
    if($nombre == ''){
        return false;
    } 
    return true;
}
 
if(validarDatos($nombre)){
    $conexion = new mysqli('localhost', 'root', 'root');
    $conexion->set_charset('utf8');
 
    if($conexion->connect_errno){
        $respuesta = ['error sin conexion' => true];
    } else {
        $statement = $conexion->prepare("CREATE DATABASE IF NOT EXISTS ? ");
        $statement->bind_param(1, $nombre);
        echo $statement;
        $statement->execute();
 
        if($conexion->affected_rows <= 0){
            $respuesta = ['error no creee' => true];
        }
 
        $respuesta = [];
    }
} else {
    $respuesta = ['error respuesta' => true];
}
 
echo json_encode($respuesta);