using System;
using System.Threading.Tasks;
using System.Collections.Concurrent;

class Program
{
    static void Main(string[] args)
    {
        BlockingCollection<Order> ordersQueue = new();
        IngredientsStock stock = new();
        
        List<string> chefNames = new(){"Quaresma", "Reinaldo", "Jorge"};
        List<string> waiterNames = new(){"Rodrigo", "Sergio", "Alemão", "Mafeus", "LP"};

        Chef[] chefs = new Chef[3];
        Waiter[] waiters = new Waiter[5];

        for (int i = 0; i < 5; i++)
        {
            waiters[i] = new Waiter(waiterNames[i], ordersQueue);
            waiters[i].Start();
        }

        for (int i = 0; i < 3; i++)
        {
            chefs[i] = new Chef(chefNames[i], ordersQueue, stock);
            chefs[i].Start();
        }

        Console.ReadLine();
    }
}
