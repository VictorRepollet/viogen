<?php

$contador_indicadores = 0;

$datos_victima = json_decode($_POST['datos_victima'] ?? '', true) ?? [
    'victima_id' => '',
    'nombre' => '',
    'dni' => '',
    'email' => '',
    'direccion' => '',
    'datos-interes' => '',
    'indicador' => []
];
$datos_agresor = json_decode($_POST['datos_agresor'] ?? '', true) ?? [
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (($_POST['origen'] ?? '') === 'incidencia') {
        $datos_incidencia = [
            'fecha' => $_POST['fecha'] ?? '',
            'hora' => $_POST['hora'] ?? '',
            'victima_id' => $_POST['victima_id'] ?? '',
            'agresor_id' => $_POST['agresor_id'] ?? '',
            'lugar' => $_POST['lugar'] ?? '',
            'descripcion' => $_POST['descripcion'] ?? '',
            'indicador' => $_POST['indicador'] ?? []
        ];
        $_POST['datos_incidencia'] = json_encode($datos_incidencia);
    }

    if(isset($_POST['borrar_datos_incidencia'])){
        $datos_incidencia =  [
            'fecha' => '',
            'hora' => '',
            'lugar' => '',
            'descripcion' => '',
            'indicador' => []
        ];
    }

    if (isset($_POST['guardar_formulario_incidencia'])) {
        $datos_a_guardar = [
            'datos/victimas.json' => $datos_victima,
            'datos/agresor.json' => $datos_agresor,
            'datos/incidencias.json' => $datos_incidencia
        ];

        foreach ($datos_a_guardar as $archivo => $datos) {
            // Si la víctima o el agresor están vacíos, no se pisa el JSON que ya había
            if ($archivo !== 'datos/incidencias.json' && empty($datos['nombre'])) {
                continue;
            }
            $contenido_json = json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            if ($contenido_json === false) {
                throw new RuntimeException('No se pudo convertir ' . $archivo . ' a JSON: ' . json_last_error_msg());
            }

            if (file_put_contents($archivo, $contenido_json . PHP_EOL, LOCK_EX) === false) {
                throw new RuntimeException('No se pudo guardar el archivo ' . $archivo);
            }
        }
    }

    if (isset('generar_informe')) {
        global $contador_indicadores;
        foreach ($datos_victima['indicador'] as $key => $valor) {
            if($valor === 'si'){
                $contador_indicadores++;
            }
        }
        foreach ($datos_agresor['indicador'] as $key => $valor) {
            if($valor === 'si'){
                $contador_indicadores++;
            }
        }
        foreach ($datos_incidencia['indicador'] as $key => $valor) {
            if($valor === 'si'){
                $contador_indicadores++;
            }
        }

        switch ($contador_indicadores) {
            case 0:
                echo '<p>No hay riesgo</p>';
                break;
            case 1:
            case 2:
            case 3:
            case 4:
                echo '<p>Riesgo Leve</p>';
                break;
            case 5:
            case 6:
            case 7:
            case 8:
                echo '<p>Riesgo Moderado</p>';
                break;
            case 9:
            case 10:
            case 11:
            case 12:
                echo '<p>Riesgo Alto</p>';
                break;
            case 13:
            case 14:
            case 15:
            case 16:
                echo '<p><style> color: red</style>Riesgo Extremo</p>';
                break;
            default:
                echo '<p>Error a la hora de calcular el riesgo</p>';
                break;
        }
        require('html/informe-final.html')
    }

    if (isset($_POST['ir_inicio'])){
        require('index.php');
        die;
    }
    if (isset($_POST['ir_agresor'])){
        require('formulario-agresor.php');
        die;
    }
    if (isset($_POST['ir_victima'])){
        require('formulario-victima.php');
        die;
    }
}

// Leer la víctima registrada desde el JSON
$lista_victimas = [];
if (file_exists('datos/victimas.json')) {
    $registrada = json_decode(file_get_contents('datos/victimas.json'), true);
    if (!empty($registrada['nombre'])) {
        $lista_victimas[1] = $registrada;
    }
}

// Leer el agresor registrado desde el JSON
$lista_agresores = [];
if (file_exists('datos/agresor.json')) {
    $registrado = json_decode(file_get_contents('datos/agresor.json'), true);
    if (!empty($registrado['nombre'])) {
        $lista_agresores[1] = $registrado;
    }
}

require('html/incidencia.html');