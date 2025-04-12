using System.Threading;
using System.Threading.Tasks;

class Program
{
    static void Main(string[] args)
    {
        SemaphoreSlim semaphore = new SemaphoreSlim(3);
        Philosopher[] philosophers = new Philosopher[5]; 
        int totalForks = philosophers.Length;
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
        for (int i = 0; i < philosophers.Length; i++)
        {
            philosophers[i] = new Philosopher(names[i], thoughts[i], totalForks, semaphore);
            philosophers[i].Start();
        }
        Console.ReadLine();
    }
}

