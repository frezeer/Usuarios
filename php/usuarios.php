<?php
header('Content-type: application/json; charset=utf-8');
//echo '[{"nombre":"carlos"},{"nombre":"Alejandro"}]';
$respuesta = [
[
'id'     => '5bf7706d6c55a8dc74f26477',
'nombre' => 'Patterson Kaufman',
'edad'   => '34',
'pais'   => 'correo@correo',
'correo' => 'pattersonkaufman@nspire.com'
],
[
'id'     => '5bf7706d6c55a8dc74f26477',
'nombre' => 'Patterson morales',
'edad'   => '24',
'pais'   => 'correo@correo.com',
'correo' => 'pattersonkaufman@nspire.com'
]

];

//var_dump($respuesta)
echo json_encode($respuesta);
?>