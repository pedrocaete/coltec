public class Menu
{
    static Table table = new Table();

    public static void Show()
    {
        ShowInitialMessages();
        ProcessOption();
    }

    public static void ShowInitialMessages()
    {
        Console.WriteLine("Bem-vindo à Batalha Naval!");
        Console.WriteLine("Escolha uma das opções para o posicionamento dos navios");
        Console.WriteLine("1. Posicionamento Aleatório");
        Console.WriteLine("2. Posicionamento Manual");

    }

    static void ProcessOption()
    {
        while (true)
        {
            int selectedOption = ReadOption();
            if (selectedOption == 1)
            {
                table.CreateTableWithRandomShipsPositions();
                return;
            }
            else if (selectedOption == 2)
            {
                table.CreateTableWithManualShipPositions();
                return;
            }
            else
            {
                Console.WriteLine("Digite uma opção válida");
            }
        }

    }

    static public int ReadOption()
    {
        while (true)
        {
            string? entry = Console.ReadLine();
            if (int.TryParse(entry, out int selectedOption))
            {
                return selectedOption;
            }
            Console.WriteLine("Digite um número");
        }
    }


}
