using System;
using System.Collections.Generic;
using System.Collections.Concurrent;
using System.Threading;
using System.Threading.Tasks;

public class Waiter{
    private readonly BlockingCollection<Order> _ordersQueue;
    private readonly List<TypeDish> _menu;
    private Random _random;
    private readonly string _name;

    public Waiter(string name, BlockingCollection<Order> ordersQueue, List<TypeDish> menu)
    {
        _name = name;
        _ordersQueue = ordersQueue;
        _menu = menu;
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
                    var selectedDish = _menu[_random.Next(_menu.Count)];
                    var order = new Order(selectedDish);
                    _ordersQueue.Add(order);
                    ConsoleLock.Log(ConsoleColor.Blue, $"[{_name}] - Envio de {order}");
                }
                catch(Exception e)
                {
                    ConsoleLock.Log(ConsoleColor.DarkRed, $"[{_nome}] - ERRO: {ex.Message}");
                }
            }
        });
    }
}
