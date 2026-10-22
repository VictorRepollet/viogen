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

// Leer la víctima registrada desde el JSON
$lista_victimas = [];
if (file_exists('datos/victimas.json')) {
    $registrada = json_decode(file_get_contents('datos/victimas.json'), true);
    if (!empty($registrada['nombre'])) {
        $lista_victimas[1] = $registrada;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
        $_POST['datos_victima'] = json_encode($datos_victima);
    }

    // Si pulsa "Cargar datos", se rellena la ficha con la víctima guardada en el JSON
    if (isset($_POST['cargar_victima'])) {
        $id = $_POST['victima_id'] ?? '';
        if (isset($lista_victimas[$id])) {
            $datos_victima = $lista_victimas[$id];
            $datos_victima['victima_id'] = $id;
        }
    }

    if(isset($_POST['borrar_datos_victima'])){
        $datos_victima =  [
            'victima_id' => '',
            'nombre' => '',
            'dni' => '',
            'email' => '',
            'direccion' => '',
            'datos-interes' => '',
            'indicador' => []
        ];
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