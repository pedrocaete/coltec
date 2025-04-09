public class DishType
{
    public string Name { get; }
    public Dictionary<Ingredient, int> Ingredients { get; }

    private static readonly Dictionary<string, DishType> _types = new();

    private DishType(string name, Dictionary<Ingredient, int> ingredients)
    {
        Name = name;
        Ingredients = ingredients;

        _types[name] = this;
    }

    public static readonly DishType Executive = new DishType(
            "Executive",
            new Dictionary<Ingredient, int>{
                {Ingredient.Arroz, 1},
                {Ingredient.Carne, 1}
            });
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
