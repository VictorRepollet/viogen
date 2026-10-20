<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'){ 
    
    if (isset ($_POST['abrir_formulario_victima'])){ 
        require('formulario-victima.php');
        die;
    }
    if (isset ($_POST['abrir_formulario_agresor'])){ 
        require('formulario-agresor.php');
        die;
    }
    if (isset ($_POST['abrir_formulario_incidencia'])){
        require('formulario-incidencia.php');
        die;
    }
}
require('html/index.html');