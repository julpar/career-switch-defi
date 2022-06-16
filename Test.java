import java.util.Arrays;

public class Test {
    private static String[] check(String[] blocks, String token) {
        /**
         * Escribe aqui tu solucion leyendo los argumentos que recibe,
         * y retorna el resultado correctamente ordenado.
         */
        return new String[]{"abc", "def", "ghi"};
    }

    public static void main(String[] args) {
        // Enviamos datos desordenados para testear el resultado
        String[] result = check(new String[]{"f319", "3720", "4e3e", "46ec", "c7df", "c1c7", "80fd", "c4ea"}, "b93ac073-eae4-405d-b4ef-bb82e0036a1d");

        // Esperamos que el resultado sea como este array
        String[] expected = new String[]{"f319", "46ec", "c1c7", "3720", "c7df", "c4ea", "4e3e", "80fd"};

        if (Arrays.equals(result, expected)) {
            System.out.println("Lo resolviste correctamente!");
        } else {
            System.out.println("El test falló. ¡Todavia puedes intentarlo!");
        }

    }
}
