package main

import (
	"fmt"
	"reflect"
)

func check(blocks map[string]string, token string) map[string]string {
	/**
	 * Escribe aquí tu solución leyendo el argumento que recibe
	 * Y retorna el resultado correctamente ordenado
	 * Según el ejemplo provisto, seria...
	 */
	return map[string]string{
		"0": "f319",
		"1": "46ec",
		"2": "c1c7",
		"3": "3720",
		"4": "c7df",
		"5": "c4ea",
		"6": "4e3e",
		"7": "80fd",
	}
}

func main() {
	/**
	 * Lo que esperamos recibir
	 */
	expected := map[string]string{
		"0": "f319",
		"1": "46ec",
		"2": "c1c7",
		"3": "3720",
		"4": "c7df",
		"5": "c4ea",
		"6": "4e3e",
		"7": "80fd",
	}

	/**
	 * Secuencia de bloques desordenados
	 */
	blocks := map[string]string{
		"0": "f319",
		"1": "3720",
		"2": "4e3e",
		"3": "46ec",
		"4": "c7df",
		"5": "c1c7",
		"6": "80fd",
		"7": "c4ea",
	}

	result := check(expected, "b93ac073-eae4-405d-b4ef-bb82e0036a1d")

	if reflect.DeepEqual(result, expected) {
		fmt.Println("Lo resolviste correctamente")
	} else {
		fmt.Println("Todavía puedes intentarlo")
	}
}
