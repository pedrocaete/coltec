using System.Threading;
using System.Threading.Tasks;

public class Philosopher
{
    private static int _nextId = 0;
    private static object _lock = new();
    private SemaphoreSlim Semaphore;
    private Table? _table;
    public int numberOfEatings = 0;

    public string Name { get; }
    public string Thought { get; set; }
    public int Forks { get; set; }
    public int Id { get; }


    public Philosopher(string name, string thought, SemaphoreSlim semaphore)
    {
        Name = name;
        Thought = thought;
        Forks = 1;
        Id = Interlocked.Increment(ref _nextId);
        Semaphore = semaphore;
    }

    public void SetTable(Table table)
    {
        _table = table;
    }

    public void Start()
    {
        Task.Run(() =>
        {
            while (true)
            {
                try
                {
                    Live();
                }
                catch (Exception e)
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
            Semaphore.Wait();
            GetFork();
        }
        else
        {
            Eat();
        }
    }

    public void Think()
    {
        ConsoleLock.Log(ConsoleColor.DarkBlue, $"Filosofo {Name} está pensando:{Thought}");
        Thread.Sleep(400);
    }

    public void Eat()
    {
        if (Forks < 2)
        {
            return;
        }

        ConsoleLock.Log(ConsoleColor.Green, $"Filosofo {Name} está comendo");
        numberOfEatings ++;
        Thread.Sleep(400);
        Semaphore.Release();
    }

    public void GetFork()
    {
        var leftPhilosopher = _table?.GetLeftPhiloshoper(Id);
        var rightPhilosopher = _table?.GetRightPhiloshoper(Id);
        if (leftPhilosopher?.Forks >= 1 && Forks < 2)
        {
            leftPhilosopher.Forks--;
            Forks++;
        }
        if (rightPhilosopher?.Forks >= 1 && Forks < 2)
        {
            rightPhilosopher.Forks--;
            Forks++;
        }
        ConsoleLock.Log(ConsoleColor.DarkYellow, $"Filosofo {Name} está com {Forks} garfos");
    }
}
