package main

import (
	"fmt"
	"reflect"
)

// Esta funcion emula el comportamiento de la API
func isNext(x string, y string) bool {
	var blocks map[string]int
	blocks = make(map[string]int)

	/**
     * Puedes cambiar esta lista si quieres probar otros ejemplos
     * Siempre debes respetar que sea un array de strings
     * El resto de la funcionalidad se mantiene igual
     */
	blocks["abc"] = 0
	blocks["def"] = 1
	blocks["ghi"] = 2

	return blocks[x]+1 == blocks[y]
}

func check(blocks map[string]string) map[string]string {
	/**
     * Escribe aqui tu solucion leyendo el argumento que recibe
     * Y retorna el resultado correctamente ordenado
     * Segun el ejemplo provisto, seria...
     */
	return map[string]string{
		"0": "abc",
		"1": "def",
		"2": "ghi",
	}
}

func main() {
	expected := map[string]string{
		"0": "abc",
		"1": "def",
		"2": "ghi",
	}

	result := check(expected)

	if reflect.DeepEqual(result, expected) {
		fmt.Println("Lo resolviste correctamente")
	} else {
		fmt.Println("Todavia puedes intentarlo")
	}
}
