<?php
    $reglas = [
        'personasOK.csv' => [
            'encabezado' => ['nombre', 'run', 'dv', 'correo', 'contrasena', 'nombre_usuario', 'telefono_contacto'],
            'filtros' => [
                'run' => 'runFilter',
                'dv' => 'dvFilter',
                'correo' => 'mailFilter',
                'telefono_contacto' => 'fonoFilter'
            ],
            'fuentes' => ['usuarios', 'empleados']
        ],
        'usuariosOK.csv' => [
            'encabezado' => ['nombre', 'run', 'dv', 'correo', 'contrasena', 'nombre_usuario', 'telefono_contacto', 'puntos'],
            'filtros' => [
                'run' => 'runFilter',
                'dv' => 'dvFilter',
                'correo' => 'mailFilter',
                'telefono_contacto' => 'fonoFilter',
                'puntos' => 'puntosFilter'
            ],
            'fuentes' => ['usuarios']
        ],
        'empleadosOK.csv' => [
            'encabezado' => ['nombre', 'run', 'dv', 'correo', 'nombre_usuario', 'contrasena', 'telefono_contacto', 'jornada', 'isapre', 'contrato'],
            'filtros' => [
                'run' => 'runFilter',
                'dv' => 'dvFilter',
                'correo' => 'mailFilter',
                'contrasena' => 'contrasenaEmpleadosFilter',
                'telefono_contacto' => 'fonoFilter',
            ],
            'fuentes' => ['empleados']
        ],
        'agendasOK.csv' => [
            'encabezado' => ['correo_usuario', 'codigo_agenda', 'etiqueta'],
            'filtros' => [
                'correo' => 'mailFilter',
                'codigo_agenda' => 'codigoFilter',
            ],
            'fuentes' => ['usuarios']
        ],
        'reservasOK.csv' => [
            'encabezado' => ['codigo_agenda', 'codigo_reserva', 'fecha', 'monto', 'cantidad_personas', 'estado_disponibilidad'],
            'filtros' => [
                'codigo_agenda' => 'codigoFilter',
                'codigo_reserva' => 'codigoFilter',
                'fecha' => 'fechaFilter',
                'monto' => 'montoFilter',
                'cantidad_personas' => 'cantidadPersonasFilter'
            ],
            'fuentes' => ['empleados']
        ],
        'transportesOK.csv' => [
            'encabezado' => ['correo', 'codigo_reserva', 'numero_viaje', 'lugar_origen', 'lugar_llegada', 'capacidad', 'tiempo_estimado', 'precio_asiento', 'empresa', 'fecha_salida', 'fecha_llegada'],
            'filtros' => [
                'correo' => 'mailFilter',
                'codigo_reserva' => 'codigoFilter',
                'numero_viaje' => 'numeroViajeFilter',
                'lugar_origen' => 'lugarFilter',
                'lugar_llegada' => 'lugarFilter',
                'capacidad' => 'capacidadFilter',
                'tiempo_estimado' => 'tiempoEstimadoFilter',
                'precio_asiento' =>'precioAsientoFilter',
                'fecha_salida' => 'fechaFilter',
                'fecha_llegada' => 'fechaLlegadaFilter'
            ],
            'fuentes' => ['empleados']
        ],
        'busesOK.csv' => [
            'encabezado' => ['correo', 'codigo_reserva', 'numero_viaje', 'lugar_origen', 'lugar_llegada', 'capacidad', 'tiempo_estimado', 'precio_asiento', 'empresa', 'tipo', 'comodidades', 'fecha_salida', 'fecha_llegada'],
            'filtros' => [
                'correo' => 'mailFilter',
                'codigo_reserva' => 'codigoFilter',
                'numero_viaje' => 'numeroViajeFilter',
                'lugar_origen' => 'lugarFilter',
                'lugar_llegada' => 'lugarFilter',
                'capacidad' => 'capacidadFilter',
                'tiempo_estimado' => 'tiempoEstimadoFilter',
                'precio_asiento' =>'precioAsientoFilter',
                'fecha_salida' => 'fechaFilter',
                'fecha_llegada' => 'fechaLlegadaFilter'
            ],
            'fuentes' => ['empleados']
        ],
        'trenesOK.csv' => [
            'encabezado' => ['correo', 'codigo_reserva', 'numero_viaje', 'lugar_origen', 'lugar_llegada', 'capacidad', 'tiempo_estimado', 'precio_asiento', 'empresa', 'comodidades', 'paradas', 'fecha_salida', 'fecha_llegada'],
            'filtros' => [
                'correo' => 'mailFilter',
                'codigo_reserva' => 'codigoFilter',
                'numero_viaje' => 'numeroViajeFilter',
                'lugar_origen' => 'lugarFilter',
                'lugar_llegada' => 'lugarFilter',
                'capacidad' => 'capacidadFilter',
                'tiempo_estimado' => 'tiempoEstimadoFilter',
                'precio_asiento' =>'precioAsientoFilter',
                'fecha_salida' => 'fechaFilter',
                'fecha_llegada' => 'fechaLlegadaFilter'
            ],
            'fuentes' => ['empleados']
        ],
        'avionesOK.csv' => [
            'encabezado' => ['correo', 'codigo_reserva', 'numero_viaje', 'lugar_origen', 'lugar_llegada', 'capacidad', 'tiempo_estimado', 'precio_asiento', 'empresa', 'escalas', 'clase', 'fecha_salida', 'fecha_llegada'],
            'filtros' => [
                'correo' => 'mailFilter',
                'codigo_reserva' => 'codigoFilter',
                'numero_viaje' => 'numeroViajeFilter',
                'lugar_origen' => 'lugarFilter',
                'lugar_llegada' => 'lugarFilter',
                'capacidad' => 'capacidadFilter',
                'tiempo_estimado' => 'tiempoEstimadoFilter',
                'precio_asiento' =>'precioAsientoFilter',
                'fecha_salida' => 'fechaFilter',
                'fecha_llegada' => 'fechaLlegadaFilter'
            ],
            'fuentes' => ['empleados']
        ]

    ];

    function leer_csv($ruta){
        $datos = [];
        $archivo_abierto = fopen($ruta, "r");
        if ($archivo_abierto == false){
            echo "El Archivo con ruta $ruta no se pudo abrir!!";
        } else {
            $encabezado = fgetcsv($archivo_abierto, 0, ',', '"', '\\' );
            while (($fila = fgetcsv($archivo_abierto, 0, ',', '"', '\\')) !== false){
                $datos[] = array_combine($encabezado, $fila);
            }

            fclose($archivo_abierto);
        }
        return $datos;
    }

    function limpieza_datos($usuarios_sucios, $empleados_sucios, $reglas){
        $archivos = [];
        foreach ($reglas as $r => $info) {
            $fp = fopen("../CSV_limpios/$r", 'w');
            fputcsv($fp, $info['encabezado'], ',', '"', '\\');
            $archivos[$r] = $fp;
        }
        $fp_descartados_usuarios = fopen("../CSV_limpios/datos_descartados_usuarios.csv", 'w');
        fputcsv($fp_descartados_usuarios, encabezado_usuarios_descartados(), ',', '"', '\\');
        $fp_descartados_empleados = fopen("../CSV_limpios/datos_descartados_empleados.csv", 'w');
        fputcsv($fp_descartados_empleados, encabezado_empleados_descartados(), ',', '"', '\\');

        foreach ($reglas as $r => $info) {
            $filtros = $info['filtros'];

            if (in_array('usuarios', $info['fuentes'])) {
                foreach ($usuarios_sucios as $u) {
                    $pasaFiltros = true;
                    foreach ($filtros as $campo => $funcion) {
                        if (!isset($u[$campo]) || !$funcion($u[$campo])) {
                            $pasaFiltros = false;
                            fputcsv($fp_descartados_usuarios, extraer('datos_descartados_usuarios.csv', $u), ',', '"', '\\');
                            break; 
                        }
                    }
                    if ($pasaFiltros) {
                        fputcsv($archivos[$r], extraer($r, $u), ',', '"', '\\');
                    }
                }
            }

            if (in_array('empleados', $info['fuentes'])) {
                foreach ($empleados_sucios as $e) {
                    $pasaFiltros = true;
                    foreach ($filtros as $campo => $funcion) {
                        if (!isset($e[$campo]) || !$funcion($e[$campo])) {
                            $pasaFiltros = false;
                            fputcsv($fp_descartados_empleados, extraer('datos_descartados_empleados.csv', $e), ',', '"', '\\');
                            break;  
                        }
                    }
                    if ($pasaFiltros) {
                        fputcsv($archivos[$r], extraer($r, $e), ',', '"', '\\');
                    }
                }
            }
        }

        foreach ($archivos as $fp) {
            fclose($fp);
        }
        fclose($fp_descartados_usuarios);
        fclose($fp_descartados_empleados);

        return true;
    }

    function escribir_csv($ruta, $datos, $encabezado) {
        $fp = fopen($ruta, 'w');
        fputcsv($fp, $encabezado, ',', '"', '\\');
        foreach ($datos as $fila) {
            fputcsv($fp, $fila, ',', '"', '\\');
        }
        fclose($fp);
    }

    function extraer($nombre_archivo, $u) {
        if ($nombre_archivo == 'personasOK.csv'){
            return [
                'nombre' => $u['nombre'],
                'run' => $u['run'],
                'dv' => $u['dv'],
                'correo' => $u['correo'],
                'contrasena' => $u['contrasena'],
                'nombre_usuario' => $u['nombre_usuario'],
                'telefono_contacto' => $u['telefono_contacto']
            ];
        } else if ($nombre_archivo == 'usuariosOK.csv') {
            return [
                'nombre' => $u['nombre'],
                'run' => $u['run'],
                'dv' => $u['dv'],
                'correo' => $u['correo'],
                'contrasena' => $u['contrasena'],
                'nombre_usuario' => $u['nombre_usuario'],
                'telefono_contacto' => $u['telefono_contacto'],
                'puntos' => $u['puntos']
            ];
        } else if ($nombre_archivo == 'empleadosOK.csv'){
            return [
                'nombre' => $u['nombre'],
                'run' => $u['run'],
                'dv' => $u['dv'],
                'correo' => $u['correo'],
                'contrasena' => $u['contrasena'],
                'nombre_usuario' => $u['nombre_usuario'],
                'telefono_contacto' => $u['telefono_contacto'],
                'jornada' => $u['jornada'],
                'isapre' => $u['isapre'],
                'contrato' => $u['contrato']
            ];
        } else if ($nombre_archivo == 'agendasOK.csv'){
            return [
                'correo' => $u['correo'],
                'codigo_agenda' => $u['codigo_agenda'],
                'etiqueta' => $u['etiqueta']
            ];
        } else if ($nombre_archivo == 'reservasOK.csv'){
            return [
                'codigo_agenda' => $u['codigo_agenda'],
                'codigo_reserva' => $u['codigo_reserva'],
                'fecha' => $u['fecha'],
                'monto' => $u['monto'],
                'cantidad_personas' => $u['cantidad_personas'],
                'estado_disponibilidad' => $u['estado_disponibilidad']
            ];
        } else if ($nombre_archivo == 'transportesOK.csv'){
            return [
                'correo' => $u['correo'],
                'codigo_reserva' => $u['codigo_reserva'],
                'numero_viaje' => $u['numero_viaje'],
                'lugar_origen' => $u['lugar_origen'],
                'lugar_llegada' => $u['lugar_llegada'],
                'capacidad' => $u['capacidad'],
                'tiempo_estimado' => $u['tiempo_estimado'],
                'precio_asiento' => $u['precio_asiento'],
                'empresa' => $u['empresa'],
                'fecha_salida' => $u['fecha_salida'],
                'fecha_llegada' => $u['fecha_llegada']
            ];
        } else if ($nombre_archivo == 'busesOK.csv'){
            return [
                'correo' => $u['correo'],
                'codigo_reserva' => $u['codigo_reserva'],
                'numero_viaje' => $u['numero_viaje'],
                'lugar_origen' => $u['lugar_origen'],
                'lugar_llegada' => $u['lugar_llegada'],
                'capacidad' => $u['capacidad'],
                'tiempo_estimado' => $u['tiempo_estimado'],
                'precio_asiento' => $u['precio_asiento'],
                'empresa' => $u['empresa'],
                'tipo' => $u['tipo_de_bus'],
                'comodidades' => $u['comodidades'],
                'fecha_salida' => $u['fecha_salida'],
                'fecha_llegada' => $u['fecha_llegada']
            ];
        } else if ($nombre_archivo == 'trenesOK.csv'){
            return [
                'correo' => $u['correo'],
                'codigo_reserva' => $u['codigo_reserva'],
                'numero_viaje' => $u['numero_viaje'],
                'lugar_origen' => $u['lugar_origen'],
                'lugar_llegada' => $u['lugar_llegada'],
                'capacidad' => $u['capacidad'],
                'tiempo_estimado' => $u['tiempo_estimado'],
                'precio_asiento' => $u['precio_asiento'],
                'empresa' => $u['empresa'],
                'comodidades' => $u['comodidades'],
                'paradas' => $u['paradas'],
                'fecha_salida' => $u['fecha_salida'],
                'fecha_llegada' => $u['fecha_llegada']
            ];
        } else if ($nombre_archivo == 'avionesOK.csv'){
            return [
                'correo' => $u['correo'],
                'codigo_reserva' => $u['codigo_reserva'],
                'numero_viaje' => $u['numero_viaje'],
                'lugar_origen' => $u['lugar_origen'],
                'lugar_llegada' => $u['lugar_llegada'],
                'capacidad' => $u['capacidad'],
                'tiempo_estimado' => $u['tiempo_estimado'],
                'precio_asiento' => $u['precio_asiento'],
                'empresa' => $u['empresa'],
                'escalas' => $u['escalas'],
                'clase' => $u['clase'],
                'fecha_salida' => $u['fecha_salida'],
                'fecha_llegada' => $u['fecha_llegada']
            ];
        } else if ($nombre_archivo =='datos_descartados_usuarios.csv'){
            return [
                'nombre' => $u['nombre'],
                'run' => $u['run'],
                'dv' => $u['dv'],
                'correo' => $u['correo'],
                'contrasena' => $u['contrasena'],
                'nombre_usuario' => $u['nombre_usuario'],
                'telefono_contacto' => $u['telefono_contacto'],
                'puntos' => $u['puntos'], 
                'codigo_agenda' => $u['codigo_agenda'], 
                'etiqueta' => $u['etiqueta'],
                'codigo_reserva' => $u['codigo_reserva'],
                'fecha' => $u['fecha'],
                'monto' => $u['monto'],
                'cantidad_personas' => $u['cantidad_personas'] 
            ];
        } else if ($nombre_archivo =='datos_descartados_empleados.csv'){
            return [
                'nombre' => $u['nombre'],
                'run' => $u['run'],
                'dv' =>$u['dv'], 
                'correo'=>$u['correo'],
                'nombre_usuario'=>$u['nombre_usuario'], 
                'contrasena'=>$u['contrasena'],
                'telefono_contacto'=>$u['telefono_contacto'], 
                'jornada'=>$u['jornada'], 
                'isapre'=>$u['isapre'], 
                'contrato'=>$u['contrato'],
                'codigo_reserva'=>$u['codigo_reserva'], 
                'codigo_agenda'=>$u['codigo_agenda'], 
                'fecha'=>$u['fecha'],
                'monto'=>$u['monto'], 
                'cantidad_personas'=>$u['cantidad_personas'], 
                'estado_disponibilidad'=>$u['estado_disponibilidad'], 
                'numero_viaje'=>$u['numero_viaje'], 
                'lugar_origen'=>$u['lugar_origen'], 
                'lugar_llegada'=>$u['lugar_llegada'], 
                'fecha_salida'=>$u['fecha_salida'], 
                'fecha_llegada'=>$u['fecha_llegada'], 
                'capacidad'=>$u['capacidad'], 
                'tiempo_estimado'=>$u['tiempo_estimado'], 
                'precio_asiento'=>$u['precio_asiento'],
                'empresa'=>$u['empresa'], 
                'tipo_de_bus'=>$u['tipo_de_bus'], 
                'comodidades'=>$u['comodidades'], 
                'escalas'=>$u['escalas'], 
                'clase'=>$u['clase'], 
                'paradas'=>$u['paradas']
            ];
        }
    }

    function encabezado_usuarios_descartados(){
        return ['nombre', 'run', 'dv', 'correo', 'contrasena', 'nombre_usuario', 'telefono_contacto', 'puntos', 'codigo_agenda', 'etiqueta', 'codigo_reserva', 'fecha', 'monto', 'cantidad_personas' ];
    }

    function encabezado_empleados_descartados(){
        return [
            'nombre', 'run', 'dv',
            'correo', 'nombre_usuario', 
            'contrasena','telefono_contacto', 'jornada', 
            'isapre', 'contrato','codigo_reserva', 
            'codigo_agenda', 'fecha','monto', 
            'cantidad_personas', 'estado_disponibilidad', 'numero_viaje', 
            'lugar_origen', 'lugar_llegada', 'fecha_salida', 
            'fecha_llegada', 'capacidad', 'tiempo_estimado', 
            'precio_asiento','empresa', 'tipo_de_bus', 
            'comodidades', 'escalas', 'clase', 
            'paradas'
        ];
    }

    /* FUNCIONES DE FILTRO */

    function nulo($celda) {
        if(!isset($celda) || trim($celda) === ""){
            return true; 
        }
        return false; 
    }

    function runFilter(&$run) {
        $runGenerico = str_replace(['.', '-'], '', $run);
        $num = (int)$runGenerico;
        if(!nulo($run) && ($num >= 1) && ($num <= 999999999999) && ctype_digit($runGenerico)){
            $run = $runGenerico;
            return true; 
        } 
        return false; 
    }

    function dvFilter(&$dv) {
        if (!nulo($dv) && strlen($dv) === 1 && (ctype_digit($dv) || $dv === 'k' || $dv === 'K')) {
            $dv = strtolower($dv);
            return true;
        }
        return false;
    }

    function mailFilter(&$mail) {
        $dominios_permitidos = [
        'viajes.cl','tourket.com', 'wass.com', 
        'marmol.com', 'outluc.com', 'edubus.cal', 
        'viajesanma.com'
        ];
        if (nulo($mail)){
            return false;
        }

        $mail = trim($mail);
        $mail = preg_replace('/@+/', '@', $mail);

        $tieneLetra = false;
        $separado = explode('@', $mail);
        
        for ($i = 0; $i < strlen($separado[0]); $i++){
            if (ctype_alpha($separado[0][$i])){
                $tieneLetra = true;
                break;
            }
        }
        if (count($separado) < 2){
            print_r($separado);
        }
        if ($tieneLetra){

            $dominio = $separado[1];

            if (in_array($dominio, $dominios_permitidos)){
                return true;
            } else{
                return false;
            }
        } else {
            return false;
        }
        
    }
 
    function contrasenaEmpleadosFilter($contrasena){
        if (nulo($contrasena)) {
            return false;
        }
        else{
            return true;
        }
    }

    function fonoFilter(&$fono) {
        if (nulo($fono)) {
            return false;
        }

        $fono = str_replace(" ", "", $fono); 
        $fono = str_replace("-", "", $fono); 

        $numeroCompleto = substr($fono, 1); 
        
        if (strlen($numeroCompleto) != 11){
            return false;
        }
        else{
            $numero = substr($numeroCompleto, -9);
        }

        return true; 
    }

    function puntosFilter($puntos) {
        return (nulo($puntos) || ctype_digit($puntos));
    }

    function codigoFilter($codigo) {
        return ((!nulo($codigo)) && ctype_digit($codigo));
    }

    function fechaFilter(&$fecha) {
        if (nulo($fecha)){
            return true;
        }

        if (preg_match('/^\d{4}\/\d{2}\/\d{2}$/', $fecha)) {
            $fecha = str_replace('/', '-', $fecha);
        } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
            return false;
        }

        [$ano, $mes, $dia] = explode('-', $fecha);

        $ano = (int)$ano;
        $mes = (int)$mes;
        $dia = (int)$dia;

        return checkdate($mes, $dia, $ano);
    }

    function fechaLlegadaFilter(&$fecha) {
        if (nulo($fecha)) {
            return false;
        }
        if (preg_match('/^\d{4}\/\d{2}\/\d{2}$/', $fecha)) {
            $fecha = str_replace('/', '-', $fecha);
        } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
            return false;
        }
        [$ano, $mes, $dia] = explode('-', $fecha);
        $ano = (int)$ano;
        $mes = (int)$mes;
        $dia = (int)$dia;
        return checkdate($mes, $dia, $ano);
    }

    function montoFilter(&$monto) {
        if (nulo($monto) || !is_numeric($monto)) {
            return false;
        }

        $valor = (float)$monto;

        if ($valor < 0) {
            return false;
        }

        $monto = number_format($valor, 2, '.', '');

        return true;
    }

    function cantidadPersonasFilter($cantidad) {
        if (nulo($cantidad)) {
            return true;
        }

        if (!ctype_digit($cantidad)) {
            return false;
        }
        return true;
    
    }

    function numeroViajeFilter($numero) {
        if (nulo($numero) || !ctype_digit($numero)) {
            return false;
        }
        return true;
    }

    function lugarFilter(&$lugar) {
        if (nulo($lugar)){
            return true;
        }
        $caracteres = str_split($lugar);

        $letras = array_filter($caracteres, 'ctype_alpha');

        $lugar = implode('', $letras);
    }
        
    function capacidadFilter($cap) {
        if (nulo($cap) || ctype_digit($cap)) {
            return true;
        } else{
            return false;
        }
    }

    function tiempoEstimadoFilter($tiempo) {
        if (nulo($tiempo) || ctype_digit($tiempo)){
            return true;
        } else{
            return false;
        }
    }

    function precioAsientoFilter($precio){
        if ((!nulo($precio)) && ctype_digit($precio)) {
            return true;
        } else{
            return false;
        }
    }

?>