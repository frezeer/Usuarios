<?php
//error_reporting(0);
header('Content-type: application/json; charset=utf-8');
//$conexion = new mysqli('localhost','root','erika#$18','curso_php_ajax');
//INSERT INTO `usuarios` (`id`, `nombre`, `edad`, `pais`, `correo`) VALUES (NULL, 'Sergio Alberto', '23', 'México', 'sis@century21tamayo.com');

$nombre = $_POST['nombre'];
$edad   = $_POST['edad'];
$pais   = $_POST['pais'];
$correo = $_POST['correo'];

function ValidarDatos($nombre , $edad, $pais , $correo){
	if($nombre == ''){
		return false;
	}elseif($edad == '' || is_int($edad)){
		return false;
	}elseif($pais == ''){
		return false;
	}elseif($correo == ''){
		return false;
	}
	return true;
}

if(validarDatos($nombre, $edad, $pais, $correo))
{

    $conexion = new mysqli('localhost','root','erika#$18', 'curso_php_ajax');
    $conexion->set_charset('utf8');
 
    if($conexion->connect_errno){
        $respuesta = ['error sin conexion' => true];

    } else {

        $statement = $conexion->prepare("INSERT INTO personas (nombre ,edad  ,pais, correo )  VALUES (?,?,?,?) ");
		$statement->bind_param("siss" , $nombre ,$edad, $pais, $correo);
        
		//echo $statement;
 		$statement->execute();
 
        if($conexion->affected_rows <= 1){
             $respuesta = ['se inserto inserto 1 filas correctamente' => true];
           }else{ 
            $respuesta = ['error no inserto filas' => true];
        }
 
        $respuesta = [];//limpiamos la variable
    }
} else {
    $respuesta = ['error de validacion' => true];
}
echo json_encode($respuesta);
?>