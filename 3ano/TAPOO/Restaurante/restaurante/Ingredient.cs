using System;
using System.Collections.Concurrent;

public class Ingredient
{
    private static int _nextOrder = 0;

    public int Order {get;}
    public int PreparationTime { get; }
    public int PortionsByPreparation { get; }
    public string Name { get; }

    private static readonly ConcurrentDictionary<string, Ingredient> _types;

    static Ingredient()
    {
        _types = new ConcurrentDictionary<string, Ingredient>();

        Arroz = new Ingredient("Arroz", 3);
        Macarrao = new Ingredient("Macarrao", 4);
        Molho = new Ingredient("Molho", 2);
        Carne = new Ingredient("Carne", 2);
    }

    private Ingredient(string name, int portionsByPreparation)
    {
        Name = name;
        PortionsByPreparation = portionsByPreparation;
        PreparationTime = portionsByPreparation * 2;
        Order = _nextOrder++;

        _types[name] = this;
    }

    public static readonly Ingredient Arroz;
    public static readonly Ingredient Macarrao;
    public static readonly Ingredient Molho;
    public static readonly Ingredient Carne;

    public static Ingredient? FromName(string name) =>
        _types.TryGetValue(name, out var ingredient) ? ingredient : null;

    public static bool IsValid(string name) => _types.ContainsKey(name);

    public override string ToString() => Name;
}
