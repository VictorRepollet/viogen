<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ir_inicio'])) {
        require('index.php');
        die;
    }

    if (isset($_POST['ir_victima'])){
        require('formulario-victima.php');
        die;
    }

    if (isset($_POST['ir_incidencia'])) {
        require('formulario-incidencia.php');
        die;
    }
    $datos = [];
    $datos['nombre'] = htmlspecialchars($_POST['nombre'] ?? '');
 /* $datos['dni'] = htmlspecialchars($_POST['dni']) ?? '';
    $datos['email'] = htmlspecialchars($_POST['email']) ?? '';
    $datos['direccion'] = htmlspecialchars($_POST['direccion']) ?? '';
    $datos['datos-interes'] = htmlspecialchars($_POST['datos-interes']) ?? '';
    $datos['indicador[antecedentes-violencia]'] = htmlspecialchars($_POST[indicador[antecedentes-violencia]]) ?? '';
    $datos['indicador[incumplimiento-medidas'] = htmlspecialchars($_POST[indicador[incumplimiento-medidas]]) ?? '';
    $datos['indicador[control-acoso'] = htmlspecialchars($_POST[indicador[control-acoso]]) ?? '';
    $datos['indicador[menores-a-cargo'] = htmlspecialchars($_POST[indicador[menores-a-cargo]]) ?? '';
*/
}

require('html/agresor.html');