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

    if (($_POST['origen'] ?? '') === 'agresor') {
        $datos_agresor = [
            'agresor_id'    => $_POST['agresor_id'] ?? '',
            'nombre'        => $_POST['nombre'] ?? '',
            'dni'           => $_POST['dni'] ?? '',
            'email'         => $_POST['email'] ?? '',
            'direccion'     => $_POST['direccion'] ?? '',
            'datos-interes' => $_POST['datos-interes'] ?? '',
            'indicador'     => $_POST['indicador'] ?? []
        ];
        $_POST['datos_agresor'] = json_encode($datos_agresor);
    }

    if (isset($_POST['ir_inicio'])){
        require('index.php');
        die;
    }
    if (isset($_POST['ir_victima'])){
    require('formulario-victima.php');
    die;
    }
    if (isset($_POST['ir_incidencia'])){
        require('formulario-incidencia.php');
        die;
    }
}

require('html/agresor.html');