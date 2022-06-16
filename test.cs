using System;
using System.Linq;


public class Solution {
    private static string[] Check(string[] block, string token) {
        return new string[]{"abc", "def", "ghi"};
    }

    public static void Main() {
        string[] result = Solution.Check(new string[]{"f319", "3720", "4e3e", "46ec", "c7df", "c1c7", "80fd", "c4ea"}, "b93ac073-eae4-405d-b4ef-bb82e0036a1d");

        // Esperamos que el resultado sea como este array
        string[] expected = {"f319", "46ec", "c1c7", "3720", "c7df", "c4ea", "4e3e", "80fd"};

        
        if (Enumerable.SequenceEqual(result, expected)) {
            Console.WriteLine("Lo resolviste correctamente!");
        } else {
            Console.WriteLine("El test falló. ¡Todavia puedes intentarlo!");
        }
    }
}
