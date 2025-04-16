using System.Threading;
using System.Threading.Tasks;

class Program
{
    static void Main(string[] args)
    {
        SemaphoreSlim[] forks = new SemaphoreSlim[5];
        Philosopher[] philosophers = new Philosopher[5];
        List<string> names = new(){
             "Tonhão",
             "Raiam Santos",
             "Lula",
             "Ryan SP",
             "MC Nego",
         };
        List<string> thoughts = new(){
             "A placa tectônica não tá nem aí pra se a menina é virgem",
             "Tem gente que paga pra ver mulher feia pelada",
             "Se tá caro não compra",
             "Nós come bosta",
             "Toma que toma que toma",
         };

        for(int i = 0; i < 5; i ++)
        {
            forks[i] = new SemaphoreSlim(1, 1); 
        }
        for (int i = 0; i < philosophers.Length; i++)
        {
            philosophers[i] = new Philosopher(names[i], thoughts[i], forks);
            philosophers[i].Start();
        }

        Thread.Sleep(10_000);

        ConsoleLock.Log(ConsoleColor.Black, "Número de refeições de cada filósofo após 10 segundos:");
        for (int i = 0; i < philosophers.Length; i++)
        {
            ConsoleLock.Log(ConsoleColor.DarkGreen, $"{philosophers[i].Name}: {philosophers[i].numberOfEatings} refeições");
        }
        ConsoleLock.Log(ConsoleColor.Black, "Tempo esgotado! Finalizando o programa...");
        Environment.Exit(0); // Encerra o programa
    }
}

