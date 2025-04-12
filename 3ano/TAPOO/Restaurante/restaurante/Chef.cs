using System.Threading;
using System.Collections.Concurrent;

public class Chef
{
    private readonly BlockingCollection<Order> _ordersQueue;
    private readonly IngredientsStock _stock;
    private readonly string _name;

    public Chef(string name, BlockingCollection<Order> ordersqueue, IngredientsStock stock)
    {
        _name = name;
        _ordersQueue = ordersqueue;
        _stock = stock;
    }

    public void Start()
    {
        Task.Run(() =>
        {
            while (true)
            {
                try
                {
                    var order = _ordersQueue.Take();
                    ProcessOrder(order);
                }
                catch (Exception e)
                {
                    ConsoleLock.Log(ConsoleColor.DarkRed, $"[{_name}] - ERRO: {e.Message}");
                }
            }
        });
    }

    private void ProcessOrder(Order order)
    {
        Dictionary<Ingredient, int> missingIngredients = _stock.ConsumeIngredient(order.Dish);
        ConsoleLock.Log(ConsoleColor.DarkRed, $"[Chef {_name}] - Inicio da Preparacao do Pedido {order.Id}");
        foreach (var (ingredient, missingAmount) in missingIngredients)
        {
            int portionsToProduce = CalculatePortionsToProduce(missingAmount, ingredient.PortionsByPreparation);
            PrepareIngredient(ingredient, portionsToProduce);
        }
        AssembleDish(order);
        ConsoleLock.Log(ConsoleColor.DarkRed, $"[Chef {_name}] - Fim da Preparação do Pedido {order.Id}");
    }

    private int CalculatePortionsToProduce(int missingAmount, int portionsByPreparation)
    {
        double exactPortions = (double) missingAmount / portionsByPreparation;
        return (int)Math.Ceiling(exactPortions);
    }

    private void PrepareIngredient(Ingredient ingredient, int portions)
    {
        ConsoleLock.Log(ConsoleColor.DarkRed, $"[Chef {_name}] - Inicio da Producao de {ingredient.Name}");
        Thread.Sleep(ingredient.PreparationTime);
        _stock.AddIngredient(ingredient, portions * ingredient.PortionsByPreparation);
        ConsoleLock.Log(ConsoleColor.DarkRed, $"[Chef {_name}] - Fim da Producao de {ingredient.Name}. Estoque atualizado para {_stock.Stock[ingredient]} unidades");
    }

    private void AssembleDish(Order order)
    {
        int timeToAssemble = 0;
        foreach (var (ingredient, quantity) in order.Dish.Ingredients)
        {
            timeToAssemble += 1000 * quantity;
        }
        Thread.Sleep(timeToAssemble);
    }
}
