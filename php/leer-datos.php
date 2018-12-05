<?php
//error_reporting(0);
header('Content-type: application/json; charset=utf-8');
$conexion = new mysqli('localhost','root','erika#$18','curso_php_ajax');
//INSERT INTO `usuarios` (`id`, `nombre`, `edad`, `pais`, `correo`) VALUES (NULL, 'Sergio Alberto', '23', 'México', 'sis@century21tamayo.com');
if($conexion->connect_errno){
	$respuesta = [
		'error' => true
	];
	}else{
	$conexion->set_charset("utf8");
	$statement = $conexion->prepare("select * from personas");
	$statement->execute();
	$resultados = $statement->get_result();	
	$respuesta = [];
	while($fila = $resultados->fetch_assoc()){
		$usuario = [
			'id'     => $fila['id'],
			'nombre' => $fila['nombre'],
			'edad'   => $fila['edad'],
			'pais'   => $fila['pais'],
			'correo' => $fila['correo']
		];	

		array_push($respuesta, $usuario);
	}
}
echo json_encode($respuesta);
?>