<?php
$datos = [];
if(isset($_POST['datos'])){
    $datos = json_decode($_POST['datos'], true);
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
/*
    $datos['nombre'] = htmlspecialchars($_POST['nombre']) ?? '';
    $datos['dni'] = htmlspecialchars($_POST['dni']) ?? '';
    $datos['email'] = htmlspecialchars($_POST['email']) ?? '';
    $datos['direccion'] = htmlspecialchars($_POST['direccion']) ?? '';
    $datos['datos-interes'] = htmlspecialchars($_POST['datos-interes']) ?? '';
    $datos['indicador[amenazas]'] = htmlspecialchars($_POST['indicador[amenazas]']) ?? '';
    $datos['indicador[escalada]'] = htmlspecialchars($_POST['indicador[escalada]']) ?? '';
    $datos['indicador[temor-inmediato]'] = htmlspecialchars($_POST['indicador[temor-inmediato]']) ?? '';
    $datos['indicador[menores-a-cargo]'] = htmlspecialchars($_POST['indicador[menores-a-cargo]']) ?? '';
    $datos['indicador[adicciones]'] = htmlspecialchars($_POST['indicador[adicciones]']) ?? '';
*/

}

require('html/victima.html');