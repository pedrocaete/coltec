using System.Collections.Generic;
using System.Linq;

public class IngredientsStock
{
    public Dictionary<Ingredient, int> Stock { get; set; }
    private readonly Dictionary<Ingredient, object> _locks;
    public IngredientsStock()
    {
        Stock = new Dictionary<Ingredient, int>{
                {Ingredient.Arroz, 0},
                {Ingredient.Macarrao, 0},
                {Ingredient.Molho, 0},
                {Ingredient.Carne, 0},
                };
        _locks = new Dictionary<Ingredient, object>{
                {Ingredient.Arroz, new object()},
                {Ingredient.Macarrao, new object()},
                {Ingredient.Molho, new object()},
                {Ingredient.Carne, new object()},
            };
    }

    public bool HasSuficientStock(TypeDish dish)
    {
        foreach (var item in GetOrderedIngredients(dish))
        {
            lock (_locks[item.Key])
            {
                if (Stock[item.Key] < item.Value)
                    return false;
            }

        }
        return true;
    }

    public Dictionary<Ingredient, int> ConsumeIngredient(TypeDish dish)
    {
        var missing = new Dictionary<Ingredient, int>;
        foreach (var item in GetOrderedIngredients(dish))
        {
            lock (_locks[item.Key])
            {
                if (Stock[item.Key] < item.Value)
                {
                    missing[item.Key] = Stock[item.Key] - item.Value;
                }
                else
                {
                    Stock[item.Key] -= item.Value;
                }
            }
        }
        return missing;
    }

    public void AddIngredient(Ingredient ingredient, int amount)
    {
        lock (_locks[ingredient])
        {
            Stock[ingredient] += amount;
        }
    }

    private IEnumerable<KeyValuePair<Ingredient, int>> GetOrderedIngredients(TypeDish dish)
    {
        return dish.Ingredients.OrderBy(i => (int)i.Key.Order);
    }
}
