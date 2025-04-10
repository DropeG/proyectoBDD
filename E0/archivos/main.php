<?php

require_once "funciones.php";

$usuarios_ruta = "../CSV_sucios/usuarios_rescatados.csv"; 
$empleados_ruta = "../CSV_sucios/empleados_rescatados.csv"; 

$usuarios_array = leer_csv($usuarios_ruta);
$empleados_array = leer_csv($empleados_ruta);

$datos_limpios = limpieza_datos($usuarios_array, $empleados_array, $reglas);

?>