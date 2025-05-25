public class GameUI
{
    readonly IConsole _console;

    public GameUI(IConsole console)
    {
        _console = console;
    }

    public void Initalize()
    {
        InitalMessage();
    }

    public void InitalMessage()
    {
        _console.WriteLine("Bem vindo ao jogo Batalha Naval!");
    }

}
