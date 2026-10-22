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

    if (isset($_POST['generar_informe'])) {

        date_default_timezone_set('Europe/Madrid');

        $informe_victima = [];
        if (file_exists('datos/victimas.json')) {
            $informe_victima = json_decode(file_get_contents('datos/victimas.json'), true) ?? [];
        }
        $informe_agresor = [];
        if (file_exists('datos/agresor.json')) {
            $informe_agresor = json_decode(file_get_contents('datos/agresor.json'), true) ?? [];
        }
        $informe_incidencia = [];
        if (file_exists('datos/incidencias.json')) {
            $informe_incidencia = json_decode(file_get_contents('datos/incidencias.json'), true) ?? [];
        }

        $sin_datos = empty($informe_victima) && empty($informe_agresor) && empty($informe_incidencia);

        $si_victima = 0;
        $si_agresor = 0;
        $si_incidencia = 0;

        $indicadores_victima = $informe_victima['indicador'] ?? [];
        foreach ($indicadores_victima as $valor) {
            if ($valor === 'si') {
                $si_victima++;
            }
        }
        $indicadores_agresor = $informe_agresor['indicador'] ?? [];
        foreach ($indicadores_agresor as $valor) {
            if ($valor === 'si') {
                $si_agresor++;
            }
        }
        $indicadores_incidencia = $informe_incidencia['indicador'] ?? [];
        foreach ($indicadores_incidencia as $valor) {
            if ($valor === 'si') {
                $si_incidencia++;
            }
        }

        $contador_indicadores = $si_victima + $si_agresor + $si_incidencia;
        $total_indicadores = 16;

        switch ($contador_indicadores) {
            case 0:
                $nivel_riesgo = 'Sin indicadores de riesgo';
                $clase_riesgo = 'riesgo-ninguno';
                break;
            case 1:
            case 2:
            case 3:
            case 4:
                $nivel_riesgo = 'Riesgo leve';
                $clase_riesgo = 'riesgo-leve';
                break;
            case 5:
            case 6:
            case 7:
            case 8:
                $nivel_riesgo = 'Riesgo moderado';
                $clase_riesgo = 'riesgo-moderado';
                break;
            case 9:
            case 10:
            case 11:
            case 12:
                $nivel_riesgo = 'Riesgo alto';
                $clase_riesgo = 'riesgo-alto';
                break;
            case 13:
            case 14:
            case 15:
            case 16:
                $nivel_riesgo = 'Riesgo extremo';
                $clase_riesgo = 'riesgo-extremo';
                break;
            default:
                $nivel_riesgo = 'Error al calcular el riesgo';
                $clase_riesgo = '';
                break;
        }

        $fecha_incidencia = '';
        if (!empty($informe_incidencia['fecha'])) {
            $fecha_incidencia = date('d/m/Y', strtotime($informe_incidencia['fecha']));
        }

        $respuestas = [
            'si' => 'Sí',
            'no' => 'No',
            'no-consta' => 'No consta'
        ];

        $preguntas_victima = [
            'amenazas' => '¿Ha recibido amenazas recientes de causar daño grave?',
            'escalada' => '¿Ha aumentado recientemente la frecuencia o gravedad de las agresiones?',
            'temor-inmediato' => '¿La persona manifiesta temor por su seguridad inmediata?',
            'menores-a-cargo' => '¿La persona tiene a cargo menores de edad?',
            'adicciones' => '¿Presenta algun tipo de adicción de drogas o algun tóxico?'
        ];
        $preguntas_agresor = [
            'antecedentes-violencia' => '¿Constan antecedentes de violencia hacia la pareja u otras personas?',
            'incumplimiento-medidas' => '¿Consta el incumplimiento de medidas de protección o alejamiento?',
            'control-acoso' => '¿Se describen conductas de control, acoso o vigilancia persistente?',
            'menores-a-cargo' => '¿La persona tiene a cargo menores de edad?',
            'adicciones' => '¿Presenta algun tipo de adicción de drogas o algun tóxico?'
        ];
        $preguntas_incidencia = [
            'asfixia' => '¿Se produjo estrangulamiento o intento de asfixia?',
            'arma' => '¿Se utilizó o amenazó con utilizar un arma u objeto peligroso?',
            'lesiones' => '¿Hubo lesiones que requirieron atención sanitaria?',
            'personas-expuestas' => '¿Había menores u otras personas dependientes presentes o expuestas?',
            'sexo-forzado' => '¿Hubo sexo forzado?',
            'celos' => '¿Mostró celos el agresor en los últimos seis meses?'
        ];

        require('html/informe-final.html');
        die;
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

$lista_victimas = [];
if (file_exists('datos/victimas.json')) {
    $registrada = json_decode(file_get_contents('datos/victimas.json'), true);
    if (!empty($registrada['nombre'])) {
        $lista_victimas[1] = $registrada;
    }
}

$lista_agresores = [];
if (file_exists('datos/agresor.json')) {
    $registrado = json_decode(file_get_contents('datos/agresor.json'), true);
    if (!empty($registrado['nombre'])) {
        $lista_agresores[1] = $registrado;
    }
}

require('html/incidencia.html');