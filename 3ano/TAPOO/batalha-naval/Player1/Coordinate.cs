class Coordinate
{
    public (int row, int column) Value {get; set;}
    public int Row {get; set;}
    public int Column {get; set;}

    public Coordinate((int row, int column) value)
    {
        Value = value;
        Row = Value.row;
        Column = Value.column;
    }

    public Coordinate(string value)
    {
        Value = MapCoordinate(value);
        Row = Value.row;
        Column = Value.column;
    }

    public static implicit operator (int row, int column)(Coordinate c)
        => c.Value;

    (int row, int column) MapCoordinate(string coordinate)
    {
        char letter = char.ToUpper(coordinate[0]);

        if (letter < 'A' || letter > 'J')
        {
            throw new ArgumentException("Coordenada fora do intervalo A-J");
        }

        string numberPart = coordinate.Substring(1);

        if (!int.TryParse(numberPart, out int number) || number < 1 || number > 10)
        {
            throw new ArgumentException("Coordenada fora do intervalo 1-10");
        }

        int column = letter - 'A';
        int row = number - 1;

        return (row, column);
    }
}
