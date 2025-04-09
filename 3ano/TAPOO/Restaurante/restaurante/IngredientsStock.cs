public class IngredientsStock
{
    public Dictionary<Ingredient, int> Stock { get; set; }

    public IngredientsStock()
    {
        Stock = new Dictionary<Ingredient, int>{
                {Ingredient.Arroz, 0},
                {Ingredient.Macarrao, 0},
                {Ingredient.Molho, 0},
                {Ingredient.Carne, 0},
                };
    }

    public bool HasSuficientStock(TypeDish dish)
    {
        foreach (var item in dish.Ingredients)
        {
            if (Stock[item.Key] < item.Value)
                return false;
        }
        return true;
    }

    public void ConsumeIngredient(){}

    public void ProduceIngredient(){}
}
