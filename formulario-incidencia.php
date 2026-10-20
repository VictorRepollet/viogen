<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['ir_inicio'])) { 
        require('index.php');
        die;
    }

    if (isset ($_POST['ir_agresor'])){ 
        require('formulario-agresor.php');
        die;
    }
    
    if (isset ($_POST['ir_victima'])){ 
        require('formulario-victima.php');
        die;
    }

    $datos = [];
    $datos['fecha'] = htmlspecialchars($_POST['fecha']) ?? '';
    $datos['hora'] = htmlspecialchars($_POST['hora']) ?? '';
    $datos['lugar'] = htmlspecialchars($_POST['lugar']) ?? '';
    $datos['indicador[asfixia]'] = htmlspecialchars($_POST['indicador[asfixia]']) ?? '';
    $datos['indicador[arma]'] = htmlspecialchars($_POST['indicador[arma]']) ?? '';
    $datos['indicador[lesiones]'] = htmlspecialchars($_POST['indicador[lesiones]']) ?? '';
    $datos['indicador[personas-expuestas]'] = htmlspecialchars($_POST['indicador[personas-expuestas]']) ?? '';
    $datos['indicador[sexo-forzado]'] = htmlspecialchars($_POST['indicador[sexo-forzado]']) ?? '';
    $datos['indicador[celos]'] = htmlspecialchars($_POST['indicador[celos]']) ?? '';
}

require('html/incidencia.html');