<?php
// var_dump($_POST);

$datos_victima = json_decode($_POST['datos_victima'] ?? '', true) ?? [
    'victima_id' => '',
    'nombre' => '',
    'dni' => '',
    'email' => '',
    'direccion' => '',
    'datos-interes' => '',
    'indicador' => []
];
$datos_agresor = json_decode($_POST['datos_agresor'] ?? '', true) ?? [
    'agresor_id' => '',
    'nombre' => '',
    'dni' => '',
    'email' => '',
    'direccion' => '',
    'datos-interes' => '',
    'indicador' => []
];
$datos_incidencia = json_decode($_POST['datos_incidencia'] ?? '', true) ?? [
    'fecha' => '',
    'hora' => '',
    'lugar' => '',
    'descripcion' => '',
    'indicador' => []
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (($_POST['origen'] ?? '') === 'incidencia') {
        $datos_incidencia = [
            'fecha'       => $_POST['fecha'] ?? '',
            'hora'        => $_POST['hora'] ?? '',
            'victima_id'  => $_POST['victima_id'] ?? '',
            'agresor_id'  => $_POST['agresor_id'] ?? '',
            'lugar'       => $_POST['lugar'] ?? '',
            'descripcion' => $_POST['descripcion'] ?? '',
            'indicador'   => $_POST['indicador'] ?? []
        ];
        $_POST['datos_incidencia'] = json_encode($datos_incidencia);
    }

    if (isset($_POST['ir_inicio']))   { require('index.php');              die; }
    if (isset($_POST['ir_agresor']))  { require('formulario-agresor.php'); die; }
    if (isset($_POST['ir_victima']))  { require('formulario-victima.php'); die; }
}

require('html/incidencia.html');