<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){ // Comprobamos el método que sea POST
    
    if (isset ($_POST['abrir_formulario_victima'])){ // Comprobamos que al pulsar el botón de la página 2 nos lleve al poc2.php
        header('Location: formulario-victima.php');
        exit;
    }
    if (isset ($_POST['abrir_formulario_agresor'])){ // Comprobamos que all pulsar el botón de la página 3 nos lleve al poc3.php
        header('Location: formulario-agresor.php');
        exit;
    }
    if (isset ($_POST['abrir_formulario_incidencia'])){ // Comprobamos que all pulsar el botón de la página 3 nos lleve al poc3.php
        header('Location: formulario-incidencia.php');
        exit;
    }
}
require __DIR__ . '/html/index.html';