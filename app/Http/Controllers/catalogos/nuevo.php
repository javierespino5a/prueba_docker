<?php

$arreglo=[5,6,7,8,41];
$contador=1;

for (int $i = 0; $i < $arreglo.count(); $i++) {
    for (int $j = $contador; $j < $arreglo.count(); $j++) {
        if ($arreglo[j] == $arreglo[i] + 1) {
            //System.out.println("Ascendente");
            var_dump("ascendente");
            $contador = $contador + 1;
            break;
        } if ($arreglo[j] == $arreglo[$i] - 1) {
            var_dump("descendente");

            //System.out.println("Descendente");
            break;
        }else {
            //System.out.println("No cumple con las condiciones");
            var_dump("desorden");
        }
    }