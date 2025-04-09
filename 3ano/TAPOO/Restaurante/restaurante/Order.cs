using System;
using System.Threading;
public class Order{
    private static int _nextId = 0;
    public int Id {get;}
    public TypeDish Dish {get;}

    public Order(TypeDish dish)
    {
        Id = Interlocked.Increment(ref _nextId);
        Dish = dish;
    }

    public override string ToString()
    {
        return $"Pedido nº{Id} - {Dish.Name}";
    }
}