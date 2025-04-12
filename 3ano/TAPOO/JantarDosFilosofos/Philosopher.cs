using System.Threading;
using System.Threading.Tasks;

public class Philosopher
{
    private static int _nextId = 0;
    public static int TotalForks{ get; set; }
    private static object _lock = new();
    private SemaphoreSlim Semaphore;

    public string Name { get; }
    public string Thought { get; set; }
    public int Forks { get; set; }
    public int Id { get; }


    public Philosopher(string name, string thought, int totalForks, SemaphoreSlim semaphore)
    {
        Name = name;
        Thought = thought;
        TotalForks = totalForks;
        Id = Interlocked.Increment(ref _nextId);
        Semaphore = semaphore;
    }

    public void Start()
    {
        Task.Run(async() =>
        {
            while(true)
            {
                try
                {
                    Live();
                }
                catch(Exception e)
                {
                    ConsoleLock.Log(ConsoleColor.DarkRed, $"[{Name}] - ERRO: {e.Message}");
                }
            }
        });

        
    }

    public void Live()
    {
        if (Forks < 2)
        {
            Think();
        }
        else
        {
            Eat();
        }
    }

    public async void Think()
    {
        ConsoleLock.Log(ConsoleColor.DarkBlue, $"Filosofo { Name } está pensando:{ Thought }");
        Thread.Sleep(3000);
        await Semaphore.WaitAsync();
        GetFork();
    }
    
    public void Eat()
    {
        ConsoleLock.Log(ConsoleColor.Green, $"Filosofo { Name } está comendo");
        Thread.Sleep(3000);
        lock (_lock)
        {
            TotalForks += Forks;
            ConsoleLock.Log(ConsoleColor.Yellow, $"Filosofo { Name } devolveu { Forks } garfos. Garfos na mesa agora: { TotalForks }");
            Forks = 0;
        }
        Semaphore.Release();
    }

    public void GetFork()
    {
        ConsoleLock.Log(ConsoleColor.DarkYellow, $"Filosofo { Name } está com { Forks } garfos");
        while(Forks < 2)
        {
            lock(_lock)
            {
                if(TotalForks > 0)
                {
                    Forks ++;
                    TotalForks --;
                    ConsoleLock.Log(ConsoleColor.DarkYellow, $"Filosofo { Name } está com { Forks } garfos");
                    Thread.Sleep(2000);
                }
            }
        }
        Eat();
    }

}
