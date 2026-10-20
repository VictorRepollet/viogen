<?php
$datos_victima = [
    'nombre' => ''
];
if(isset($_POST['datos_victima'])){
    $datos_victima = json_decode($_POST['datos_victima'], true);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['ir_inicio'])) {
        require('index.php');
        die;
    }

    if (isset($_POST['ir_agresor'])) {
        require('formulario-agresor.php');
        die;
    }

    if (isset($_POST['ir_incidencia'])) {
        require('formulario-incidencia.php');
        die;
    }
    if (isset($_POST['guardar_formulario_victima'])) {
       $datos_victima['nombre'] = htmlspecialchars($_POST['nombre'] ?? ''); 
    }
    
 /* $datos_victima['dni'] = htmlspecialchars($_POST['dni'] ?? '');
    $datos_victima['email'] = htmlspecialchars($_POST['email'] ?? '');
    $datos_victima['direccion'] = htmlspecialchars($_POST['direccion']) ?? '');
    $datos_victima['datos-interes'] = htmlspecialchars($_POST['datos_victima-interes'] ?? '');
    $datos_victima['indicador[amenazas]'] = htmlspecialchars($_POST['indicador[amenazas]'] ?? '');
    $datos_victima['indicador[escalada]'] = htmlspecialchars($_POST['indicador[escalada]'] ?? '');
    $datos_victima['indicador[temor-inmediato]'] = htmlspecialchars($_POST['indicador[temor-inmediato]'] ?? '');
    $datos_victima['indicador[menores-a-cargo]'] = htmlspecialchars($_POST['indicador[menores-a-cargo]'] ?? '');
    $datos_victima['indicador[adicciones]'] = htmlspecialchars($_POST['indicador[adicciones]'] ?? '');
*/
var_dump($datos_victima);
}

require('html/victima.html');