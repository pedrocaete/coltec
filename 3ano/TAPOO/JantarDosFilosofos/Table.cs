public class Table
{
    public Philosopher[] Philosophers { get; set;} = new Philosopher[5]; 
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

    public Table(SemaphoreSlim semaphore)
    {
        for (int i = 0; i < Philosophers.Length; i++)
        {
            Philosophers[i] = new Philosopher(names[i], thoughts[i], semaphore);
        }
        foreach (var p in Philosophers)
        {
            p.SetTable(this);
        }
    }

    public Philosopher GetLeftPhiloshoper(int philosopherId)
    {
        return Philosophers[(philosopherId - 1 + Philosophers.Length) % Philosophers.Length];
    }

    public Philosopher GetRightPhiloshoper(int philosopherId)
    {
        return Philosophers[(philosopherId + 1) % Philosophers.Length];
    }

}
