<?php
var_dump($_POST); // Solo para depurar. Déjalo activo en un único archivo, o saldrá duplicado.

// 1. Recuperar las tres fichas que viajan en los campos ocultos
$datos_victima = json_decode($_POST['datos_victima'] ?? '', true) ?? [
    'victima_id' => '',
    'nombre' => '',
    'dni' => '',
    'email' => '',
    'direccion' => '',
    'datos-interes' => '',
    'indicador' => []
];
$datos_agresor    = json_decode($_POST['datos_agresor']    ?? '', true) ?? [
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

    // 2. Solo actualizo esta ficha si el POST viene de este formulario
    if (($_POST['origen'] ?? '') === 'victima') {
        $datos_victima = [
            'victima_id' => $_POST['victima_id'] ?? '',
            'nombre' => $_POST['nombre'] ?? '',
            'dni' => $_POST['dni'] ?? '',
            'email' => $_POST['email'] ?? '',
            'direccion' => $_POST['direccion'] ?? '',
            'datos-interes' => $_POST['datos-interes'] ?? '',
            'indicador' => $_POST['indicador'] ?? []
        ];
        // 3. Reescribo $_POST para que el archivo que se requiera lea los datos nuevos
        $_POST['datos_victima'] = json_encode($datos_victima);
    }

    if (isset($_POST['ir_inicio'])){
        require('index.php');
        die;
    }
    if (isset($_POST['ir_agresor'])){
        require('formulario-agresor.php');
        die;
    }
    if (isset($_POST['ir_incidencia'])){
        require('formulario-incidencia.php');
        die;
    }
}

require('html/victima.html');