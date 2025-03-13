<?php
    function nulo($fila) {
        for ($i = 0; $i < 7; $i++) {
            if (!isset($fila[$i]) || trim($fila[$i]) === "") {
                return true;
            }
        }
        return false;
    }

    
?>