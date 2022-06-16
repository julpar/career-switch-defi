<?php

/**
 * Esta funcion emula el comportamiento de la API
 *
 * @param int $x
 * @param int $y
 * @return boolean
 */
function isNext($x,$y) {
    /**
     * Puedes cambiar esta lista si quieres probar otros ejemplos
     * Siempre debes respetar que sea un array de strings
     * El resto de la funcionalidad se mantiene igual
     */
    $original = [
        "abc", "def", "ghi",
    ];

    $flipped = array_flip($original);
    $xIndex = $flipped[$x];
    $yIndex = $flipped[$y];

    return ($xIndex+1) == $yIndex;
}

function check($blocks = []) {
    /**
     * Escribe aqui tu solucion leyendo el argumento que recibe
     * Y retorna el resultado correctamente ordenado
     * Segun el ejemplo provisto, seria...
     */
    return ["abc", "def", "ghi"];
}

// Enviamos datos desordenados para testear el resultado
$result = check(["abc", "ghi", "def"]);

// Esperamos que el resultado sea como este array
$expected = ['abc', 'def', 'ghi'];

if ($result == $expected) {
    echo "Lo resolviste correctamente!";
} else {
    echo "Todavia puedes intentarlo!";
}
