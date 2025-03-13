<?php

require_once "funciones.php";

$usuarios_f = fopen("../CSV_sucios/usuarios_rescatados.csv", "r");
if ($usuarios_f === false) {
    die("No se pudo abrir el archivo usuarios_rescatados.csv");
}

$empleados_f = fopen("../CSV_sucios/empleados_rescatados.csv", "r");
if($empleados_f === false) {
    die("No se pudo abrir el archivo empleados_rescatados.csv");
}
$descartados_f = fopen("../CSV_limpios/datos_descartados.csv", "w");
if ($descartados_f === false) {
    die("No se pudo abrir datos_descartados.csv");
}


$header_u = fgetcsv($usuarios_f, 0, ",", "\"", "\\");
$header_e = fgetcsv($empleados_f, 0, ",", "\"", "\\");

fputcsv($descartados_f, array_merge($header_u, ["Motivo"]), ",", "\"", "\\");

while (($fila = fgetcsv($usuarios_f, 0 , ",", "\"", "\\")) !== false) {
    if (nulo($fila)) {
        fputcsv($descartados_f, array_merge($fila, ["Campo vacio"]), ",", "\"", "\\");
    } else {
        if (runFilter($fila[1])) {
            fputcsv($descartados_f, array_merge($fila, ["Run Invalido!"]), ",", "\"", "\\");
        } else {
            if(dvFilter($fila[2])) {
                fputcsv($descartados_f, array_merge($fila, ["Dv Invalido!"]), ",", "\"", "\\");
            } else {
                if (mailFilter($fila[3])){
                    fputcsv($descartados_f, array_merge($fila, ["Mail Invalido!"]), ",", "\"", "\\");
                }
            }
        }
    }

    

}


fclose($usuarios_f);
fclose($empleados_f);
fclose($descartados_f);



?>