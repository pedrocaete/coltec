using System;
using System.Collections.Generic;
using System.Collections.Concurrent;
using System.Threading;
using System.Threading.Tasks;

public class Waiter{
    private readonly BlockingCollection<Order> _ordersQueue;
    private Random _random;
    private readonly string _name;

    public Waiter(string name, BlockingCollection<Order> ordersQueue)
    {
        _name = name;
        _ordersQueue = ordersQueue;
        _random = new Random();
    }

    public void Start()
    {
        Task.Run(() =>
        {
            while(true)
            {
                try
                {
                    int waitTime = _random.Next(1_000, 10_001);
                    Thread.Sleep(waitTime);
                    var selectedDish = TypeDish.All[_random.Next(TypeDish.All.Count)];
                    var order = new Order(selectedDish);
                    _ordersQueue.Add(order);
                    ConsoleLock.Log(ConsoleColor.Blue, $"[Garçom {_name}] - Envio de {order}");
                }
                catch(Exception e)
                {
                    ConsoleLock.Log(ConsoleColor.DarkRed, $"[{_name}] - ERRO: {e.Message}");
                }
            }
        });
    }
}
