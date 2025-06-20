using System.Text.RegularExpressions;

class Program
{
    static string? Password;
    public static void Main(string[] args)
    {
        string regexPattern = @"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()+=_\-{}\[\]:;""'?<>,.]).{7,16}$";
        while (true)
        {
            Console.WriteLine("Digite a senha a ser verificada:");
            Password = Console.ReadLine();
            if (Regex.IsMatch(Password, regexPattern))
            {
                Console.WriteLine("Senha forte!");
                return;
            }
            Console.WriteLine("Senha fraca, tente novamente");
        }
    }
}
