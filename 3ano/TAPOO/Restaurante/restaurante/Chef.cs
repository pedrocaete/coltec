public class Chef
{
    private readonly BlockingCollection<Order> _ordersqueue;
    private readonly IngredientsStock _stock;
    private readonly string _name;

    public Chef(string name, BlockingCollection<Order> ordersqueue, IngredientsStock stock)
    {
        _nome = name;
        _filaPedidos = ordersqueue;
        _stock = stock;
    }

    private int PrepareIngredient(Ingredient ingredient)
    {
        switch(ingredient){
            case Ingredient.Arroz:

            case ingredient.
        }
    }
}