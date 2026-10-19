<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ir_inicio'])) {
        header('Location: index.php');
        exit;
    }

    if (isset($_POST['ir_agresor'])) {
        header('Location: formulario-agresor.php');
        exit;
    }

    if (isset($_POST['ir_incidencia'])) {
        header('Location: formulario-incidencia.php');
        exit;
    }
}

require __DIR__ . '/html/victima.html';