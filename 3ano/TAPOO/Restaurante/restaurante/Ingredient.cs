public enum Ingredient {
    Arroz,
    Macarrao,
    Molho,
    Carne
}

public class Ingredient
{
    public int PreparationTime {get;}
    public string Name {get;}

    private Ingredient(string name)
    {
        Name = name;

        _types[name] = this;
    }

    public static readonly Ingredient Arroz = new Ingredient(
            "Arroz",
            );
    public static readonly DishType Italian = new DishType(
            "Italian",
            new Dictionary<Ingredient, int>{
                {Ingredient.Macarrao, 1},
                {Ingredient.Molho, 1},
            });

    public static readonly DishType Special = new DishType(
            "Special",
            new Dictionary<Ingredient, int>{
                {Ingredient.Arroz, 1},
                {Ingredient.Carne, 1},
                {Ingredient.Molho, 1}
            });

    public static DishType? FromName(string name)
    {
        _types.TryGetValue(name, out var type);
        return type;
    }

    public static bool IsValid(string name) => _types.ContainsKey(name);

    public override string ToString() => Name;


}

