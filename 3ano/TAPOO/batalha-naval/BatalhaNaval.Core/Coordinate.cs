public readonly struct Coordinate : IEquatable<Coordinate>
{
    public (int row, int column) Value { get; }
    public int Row => Value.row;
    public int Column => Value.column;

    public Coordinate((int row, int column) value)
    {
        Value = value;
    }

    public Coordinate(string value)
    {
        Value = MapCoordinate(value);
    }

    public static implicit operator (int row, int column)(Coordinate c)
        => c.Value;

    public static implicit operator Coordinate((int row, int column) tuple)
        => new Coordinate(tuple);

    private static (int row, int column) MapCoordinate(string coordinate)
    {
        if (string.IsNullOrWhiteSpace(coordinate) || coordinate.Length < 2)
            throw new ArgumentException("Coordenada inválida");

        char letter = char.ToUpper(coordinate[0]);

        if (letter < 'A' || letter > 'J')
            throw new ArgumentException("Coordenada fora do intervalo A-J");

        string numberPart = coordinate.Substring(1);

        if (!int.TryParse(numberPart, out int number) || number < 1 || number > 10)
            throw new ArgumentException("Coordenada fora do intervalo 1-10");

        int column = letter - 'A';
        int row = number - 1;

        return (row, column);
    }

    public bool Equals(Coordinate other)
    {
        return Row == other.Row && Column == other.Column;
    }

    public bool Equals((int row, int column) tuple)
    {
        return Row == tuple.row && Column == tuple.column;
    }

    public override bool Equals(object? obj)
    {
        if (obj is Coordinate c)
            return Equals(c);
        if (obj is ValueTuple<int, int> t)
            return Equals(t);
        return false;
    }

    public override int GetHashCode()
    {
        return HashCode.Combine(Row, Column);
    }

    public static bool operator ==(Coordinate left, Coordinate right)
        => left.Equals(right);
    public static bool operator !=(Coordinate left, Coordinate right)
        => !(left == right);
}
