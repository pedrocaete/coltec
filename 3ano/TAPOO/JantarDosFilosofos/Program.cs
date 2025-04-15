using System.Threading;
using System.Threading.Tasks;

class Program
{
    static void Main(string[] args)
    {
        SemaphoreSlim semaphore = new SemaphoreSlim(3);
        Table table = new Table(semaphore);
        for (int i = 0; i < table.Philosophers.Length; i++)
        {
            table.Philosophers[i].Start(); // ✅ Correto agora!
        }
        Thread.Sleep(10000);


        ConsoleLock.Log(ConsoleColor.Black,"Número de garfos de cada filósofo após 10 segundos:");
        for (int i = 0; i < table.Philosophers.Length; i++)
        {
            ConsoleLock.Log(ConsoleColor.DarkGreen,$"{table.Philosophers[i].Name}: {table.Philosophers[i].Forks}");
        }
        ConsoleLock.Log(ConsoleColor.Black,"Número de refeições de cada filósofo após 10 segundos:");
        for (int i = 0; i < table.Philosophers.Length; i++)
        {
            ConsoleLock.Log(ConsoleColor.DarkGreen, $"{table.Philosophers[i].Name}: {table.Philosophers[i].numberOfEatings} refeições");
        }
        ConsoleLock.Log(ConsoleColor.Black,"Tempo esgotado! Finalizando o programa...");
        Environment.Exit(0); // Encerra o programa
    }
}

