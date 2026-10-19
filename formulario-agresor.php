<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ir_inicio'])) {
        header('Location: index.php');
        exit;
    }

    if (isset($_POST['ir_victima'])){
        header('Location: formulario-victima.php');
        exit;
    }

    if (isset($_POST['ir_incidencia'])) {
        header('Location: formulario-incidencia.php');
        exit;
    }
}

require __DIR__ . '/html/agresor.html';