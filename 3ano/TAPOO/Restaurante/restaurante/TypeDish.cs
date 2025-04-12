public class TypeDish
{
    public string Name { get; }
    public Dictionary<Ingredient, int> Ingredients { get; }

    private static readonly Dictionary<string, TypeDish> _types = new();

    private TypeDish(string name, Dictionary<Ingredient, int> ingredients)
    {
        Name = name;
        Ingredients = ingredients;

        _types[name] = this;
    }

    public static readonly TypeDish Executive = new TypeDish(
            "Executive",
            new Dictionary<Ingredient, int>{
                {Ingredient.Arroz, 1},
                {Ingredient.Carne, 1}
            });
    public static readonly TypeDish Italian = new TypeDish(
            "Italian",
            new Dictionary<Ingredient, int>{
                {Ingredient.Macarrao, 1},
                {Ingredient.Molho, 1},
            });

    public static readonly TypeDish Special = new TypeDish(
            "Special",
            new Dictionary<Ingredient, int>{
                {Ingredient.Arroz, 1},
                {Ingredient.Carne, 1},
                {Ingredient.Molho, 1}
            });

    public static readonly List<TypeDish> All = new()
    {
        Executive,
        Italian,
        Special,
    };

    public static TypeDish? FromName(string name)
    {
        _types.TryGetValue(name, out var type);
        return type;
    }

    public static bool IsValid(string name) => _types.ContainsKey(name);

    public override string ToString() => Name;


}
