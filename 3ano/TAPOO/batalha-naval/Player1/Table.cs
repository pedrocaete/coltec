public class Table : TableBase
{
    private const int MaxShips = 10;
    private readonly Random _rand;
    int _shipsNumber = 0;
    Ship[] _ships;

    public Table(IConsole console, Random? random = null) : base(console)
    {
        _rand = random ?? new Random();
        _ships = new Ship[MaxShips];
    }

    public void CreateTableWithRandomShipsPositions()
    {
        AddShipsRandomly();
        Show();
    }

    public void CreateTableWithManualShipPositions()
    {
        AddShipsManually();
        Show();
    }

    void AddShipsRandomly()
    {
        while (_shipsNumber < MaxShips)
        {
            var shipCoord = GetRandomShipPosition();
            _ships[_shipsNumber] = new Ship(shipCoord);
            var ship = _ships[_shipsNumber];
            _table[ship.Coords.Row, ship.Coords.Column] = '*';
            _shipsNumber++;
        }
    }

    void AddShipsManually()
    {
        _console.WriteLine($"Escreva as coordenadas dos {MaxShips} navios");
        while (_shipsNumber < MaxShips)
        {
            var shipCoord = GetManualShipPosition();
            _ships[_shipsNumber] = new Ship(shipCoord);
            var ship = _ships[_shipsNumber];
            _table[ship.Coords.Row, ship.Coords.Column] = '*';
            _shipsNumber++;
        }
    }

    Coordinate GetManualShipPosition()
    {
        while (true)
        {
            try
            {
                Coordinate coordinate = new Coordinate(ReadShipPosition());
                if (IsShipPositionRepeated(coordinate))
                {
                    throw new ArgumentException("Coordenada repetida");
                }
                return coordinate;
            }
            catch (ArgumentException e)
            {
                _console.WriteLine("Erro: " + e.Message);
            }
        }
    }

    string ReadShipPosition()
    {
        while (true)
        {
            string? coordinate = _console.ReadLine();
            if (!string.IsNullOrWhiteSpace(coordinate) && coordinate.Length >= 2)
            {
                return coordinate;
            }
            _console.WriteLine("Coordenada inválida");
        }
    }

    Coordinate GetRandomShipPosition()
    {
        while (true)
        {
            int row = _rand.Next(0, _table.GetLength(0));
            int column = _rand.Next(0, _table.GetLength(1));
            var coordinate = new Coordinate((row, column));

            if (!IsShipPositionRepeated(coordinate))
            {
                return new Coordinate((row, column));
            }
        }
    }

    bool IsShipPositionRepeated(Coordinate position)
    {
        foreach (var ship in _ships.Take(_shipsNumber))
        {
            if (ship.Coords.Row == position.Row && ship.Coords.Column == position.Column)
                return true;
        }
        return false;
    }

    public string ReceiveAttack(string attack)
    {
        Coordinate attackCoordinates = new Coordinate(attack);
        foreach (var ship in _ships)
        {
            if (ship.IsHit(attackCoordinates))
            {
                _table[ship.Coords.Row, ship.Coords.Column] = 'X';
                Show();
                return IsGameWin() ? "WIN" : "HIT";
            }
        }
        _table[attackCoordinates.Row, attackCoordinates.Column] = 'O';
        Show();
        return "MISS";
    }

    public bool IsGameWin()
    {
        return _ships.Take(_shipsNumber).All(ship => ship.Sink);
    }
}
