using System.Threading;
using System.Collections.Concurrent;

public class Chef
{
    private readonly BlockingCollection<Order> _ordersqueue;
    private readonly IngredientsStock _stock;
    private readonly string _name;

    public Chef(string name, BlockingCollection<Order> ordersqueue, IngredientsStock stock)
    {
        _name = name;
        _ordersqueue = ordersqueue;
        _stock = stock;
    }

    private void PrepareIngredient(Ingredient ingredient)
    {
        Thread.Sleep(ingredient.PreparationTime);
        _stock.AddIngredient(ingredient, ingredient.PortionsByPreparation);
    }

    private void prepareOrder(Order order){
        int timeToPrepare = 0;
        foreach(var item in order.Dish.Ingredients)
        {
            timeToPrepare += 1000 * item.Value;
        }
        Thread.Sleep(timeToPrepare);
    }
}
