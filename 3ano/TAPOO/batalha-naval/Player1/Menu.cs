public class Menu
{
    IConsole _console;
    Table _table;

    public Menu(IConsole console, Table table)
    {
        _console = console;
        _table = table;
    }

    public void Show()
    {
        ShowInitialMessages();
        ProcessOption();
    }

    public void ShowInitialMessages()
    {
        _console.WriteLine("Bem-vindo à Batalha Naval!");
        _console.WriteLine("Escolha uma das opções para o posicionamento dos navios");
        _console.WriteLine("1. Posicionamento Aleatório");
        _console.WriteLine("2. Posicionamento Manual");

    }

    void ProcessOption()
    {
        while (true)
        {
            int selectedOption = ReadOption();
            if (selectedOption == 1)
            {
                _table.CreateTableWithRandomShipsPositions();
                return;
            }
            else if (selectedOption == 2)
            {
                _table.CreateTableWithManualShipPositions();
                return;
            }
            else
            {
                _console.WriteLine("Digite uma opção válida");
            }
        }

    }

    public int ReadOption()
    {
        while (true)
        {
            string? entry = _console.ReadLine();
            if (int.TryParse(entry, out int selectedOption))
            {
                return selectedOption;
            }
            _console.WriteLine("Digite um número");
        }
    }


}
