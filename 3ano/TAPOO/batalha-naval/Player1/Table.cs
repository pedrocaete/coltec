class Table
{
    char[,] table = new char[10, 10];
    int shipsNumber = 0;
    Ship[] ships;
    Random rand = new Random();

    public Table()
    {
        ships = new Ship[10];
    }

    public void CreateTableWithRandomShipsPositions()
    {
        Initialize();
        AddShipsRandomly();
        Show();
    }

    public void CreateTableWithManualShipPositions()
    {
        Initialize();
        AddShipsManually();
        Show();
    }

    public void Show()
    {
        MakeTable();
    }

    void MakeTable()
    {

        for (int i = 0; i < 11; i++)
        {
            for (int j = 0; j < 11; j++)
            {
                MakeTableCompenents(i, j);
            }
            if (IsHeader(i))
            {
                MakeHeaderLineSpacement();
            }
            MakeLineBreak();
        }
    }

    bool IsHeader(int row)
    {
        return row == 0 ? true : false;
    }

    void MakeHeaderLineSpacement()
    {
        Console.WriteLine();
    }

    void MakeLineBreak()
    {
        Console.WriteLine();
    }

    void MakeTableCompenents(int row, int column)
    {
        if (row == 0 && column == 0)
        {
            Console.Write("\t");
        }
        else if (row == 0)
        {
            char letter = (char)('A' + column - 1);
            Console.Write($"{letter} \t");
        }
        else if (column == 0)
        {
            Console.Write($"{row} \t");
        }
        else
        {
            Console.Write($"{table[row - 1, column - 1]} \t");
        }
    }

    void Initialize()
    {
        for (int i = 0; i < 10; i++)
        {
            for (int j = 0; j < 10; j++)
            {
                table[i, j] = '~';
            }
        }
    }

    void AddShipsRandomly()
    {
        while (shipsNumber < 10)
        {
            var shipCoord = GetRandomShipPosition();
            ships[shipsNumber] = new Ship(shipCoord);
            var ship = ships[shipsNumber];
            table[ship.Coords.Row, ship.Coords.Column] = '*';
            shipsNumber++;
        }
    }

    void AddShipsManually()
    {
        Console.WriteLine("Escreva as coordenadas dos 10 navios");
        while (shipsNumber < 10)
        {
            var shipCoord = GetManualShipPosition();
            ships[shipsNumber] = new Ship(shipCoord);
            var ship = ships[shipsNumber];
            table[ship.Coords.Row, ship.Coords.Column] = '*';
            shipsNumber++;
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
                Console.WriteLine("Erro: " + e.Message);
            }
        }
    }

    string ReadShipPosition()
    {
        while (true)
        {
            string? coordinate = Console.ReadLine();
            if (!string.IsNullOrWhiteSpace(coordinate) && coordinate.Length >= 2)
            {
                return coordinate;
            }
            Console.WriteLine("Coordenada inválida");
        }
    }

    Coordinate GetRandomShipPosition()
    {
        while (true)
        {
            int row = rand.Next(0, table.GetLength(0));
            int column = rand.Next(0, table.GetLength(1));
            var coordinate = new Coordinate((row, column));

            if (!IsShipPositionRepeated(coordinate))
            {
                return new Coordinate((row, column));
            }
        }
    }

    bool IsShipPositionRepeated(Coordinate position)
    {
        foreach (var ship in ships.Take(shipsNumber))
        {
            if (ship.Coords.Row == position.Row && ship.Coords.Column == position.Column)
                return true;
        }
        return false;
    }

    string ReceiveAttack(string attack)
    {
        Coordinate attackCoordinates = new Coordinate(attack);
        foreach (var ship in ships)
        {
            if (ship.IsHit(attackCoordinates))
            {
                table[ship.Coords.Row, ship.Coords.Column] = 'X';
                return IsGameWin() ? "WIN" : "HIT";
            }
        }
        return "MISS";
    }

    bool IsGameWin()
    {
        foreach (var ship in ships)
        {
            if (ship.Sink == false)
            {
                return false;
            }
        }
        return true;
    }
}
