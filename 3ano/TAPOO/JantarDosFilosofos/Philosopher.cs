using System.Threading;
using System.Threading.Tasks;

public class Philosopher
{
    const int NUMBER_OF_PHILOSOPHERS = 5;
    private static int _nextId = 0;
    private static object _lock = new();
    private SemaphoreSlim[] Forks;
    public int numberOfEatings = 0;

    public string Name { get; }
    public string Thought { get; set; }
    public int Id { get; }


    public Philosopher(string name, string thought, SemaphoreSlim[] forks)
    {
        Name = name;
        Thought = thought;
        Id = Interlocked.Increment(ref _nextId);
        Forks = forks;
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
        Think();
        Eat();
    }

    public void Think()
    {
        ConsoleLock.Log(ConsoleColor.DarkBlue, $"Filosofo {Name} está pensando:{Thought}");
        Thread.Sleep(100);
    }

    public void Eat()
    {
        GetFork();
        ConsoleLock.Log(ConsoleColor.Green, $"Filosofo {Name} está comendo");
        numberOfEatings++;
        Thread.Sleep(100);
        ReleaseForks();
    }

    public void GetFork()
    {
        var leftFork = getLeftFork();
        var rightFork = getRightFork();
        if (leftFork > rightFork)
        {
            var temp = leftFork;
            leftFork = rightFork;
            rightFork = temp;
        }
        Forks[leftFork].Wait();
        Forks[rightFork].Wait();
    }

    public void ReleaseForks()
    {
        var leftFork = getLeftFork();
        var rightFork = getRightFork();
        Forks[leftFork].Release();
        Forks[rightFork].Release();
    }

    public int getLeftFork()
    {
        return (Id - 1 + NUMBER_OF_PHILOSOPHERS) % NUMBER_OF_PHILOSOPHERS;
    }

    public int getRightFork()
    {
        return (Id + 1) % NUMBER_OF_PHILOSOPHERS;
    }
}
