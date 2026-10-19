<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['ir_inicio'])) { 
        // Envía una cabecera HTTP que indica al navegador que debe dirigirse a index.php.
        header('Location: index.php');
        exit;
    }

    if (isset ($_POST['ir_agresor'])){ 
        header('Location: formulario-agresor.php');
        exit;
    }
    if (isset ($_POST['ir_victima'])){ 
        header('Location: formulario-victima.php');
        exit;
    }
}

// __DIR__ es una constante mágica de PHP que contiene la ruta del directorio en el que está el archivo PHP actual.

require __DIR__ . '/html/incidencia.html';