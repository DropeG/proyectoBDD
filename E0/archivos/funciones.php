<?php
    function nulo($fila) {
        for ($i = 1; $i < 7; $i++) {
            if (!isset($fila[$i]) || trim($fila[$i]) === "") {
                return true;
            }
        }
        return false;
    }

    function runFilter($run) {
        $runSinFormato = str_replace(['.', '-'], '', $run);
        if (!(ctype_digit($runSinFormato))) {
            return true;
        } else {
            $numero = (int)$runSinFormato;
            if (!($numero >= 1 && $numero <= 99999999)) {
                return true;
            }
        }
    }

    function dvFilter($dv) {
        if (strlen($dv) === 1 ) {
            if (ctype_digit($dv) || $dv === 'k' || $dv === 'K') {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    function mailFilter($mail) {
        $dominios_permitidos = ['tourket.com', 'wass.com', 'marmol.com', 'outluc.com', 'edubus.cal', 'viajesanma.com'];
        $pos = strpos($mail, '@');
        if ($pos !== false && $pos > 0 && substr_count($mail, '@') === 1) {
            $parteAntesDelArroba = substr($mail, 0, $pos);
            $tieneLetra = false;
            for ($i = 0; $i<strlen($parteAntesDelArroba); $i++) {
                if(ctype_alpha($parteAntesDelArroba[$i])) {
                    $tieneLetra = true;
                    break;
                }
            }
            if ($tieneLetra) {
                $dominio = substr($mail, $pos +1);
                if (in_array($dominio, $dominios_permitidos)) {
                    return false;
                }else {
                    return true;
                }
            } else{
                return true;
            }
        }else {
            return true;
        }
    }


?>