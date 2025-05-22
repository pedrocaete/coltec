class Table
{
    char[,] table = new char[10, 10];
    int shipsNumber = 0;
    (int row, int column)[] ships = new (int, int)[10];
    Random rand = new Random();

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
        for (int i = 0; i < 11; i++)
        {
            for (int j = 0; j < 11; j++)
            {
                if (i == 0 && j == 0)
                {
                    Console.Write("\t");
                }
                else if (i == 0)
                {
                    char letter = (char)('A' + j - 1);
                    Console.Write($"{letter} \t");
                }
                else if (j == 0)
                {
                    Console.Write($"{i} \t");
                }
                else
                {
                    Console.Write($"{table[i - 1, j - 1]} \t");
                }
            }
            if (i == 0)
            {
                Console.WriteLine();
            }
            Console.WriteLine();
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
            ships[shipsNumber] = GetRandomShipPosition();
            var ship = ships[shipsNumber];
            table[ship.row, ship.column] = '*';
            shipsNumber++;
        }
    }

    void AddShipsManually()
    {
        Console.WriteLine("Escreva as coordenadas dos 10 navios");
        while (shipsNumber < 10)
        {
            ships[shipsNumber] = GetManualShipPosition();
            var ship = ships[shipsNumber];
            table[ship.row, ship.column] = '*';
            shipsNumber++;
        }
    }

    (int row, int column) GetManualShipPosition()
    {
        while (true)
        {
            bool shipIsRepeated = false;
            string coordinate = ReadShipPosition();
            try
            {
                var mappedCoordinate = MapCoordinate(coordinate);

                foreach (var ship in ships.Take(shipsNumber))
                {
                    if (ship.row == mappedCoordinate.row && ship.column == mappedCoordinate.column)
                    {
                        shipIsRepeated = true;
                        throw new ArgumentException("Coordenada repetida");
                    }
                }

                if (shipIsRepeated == false)
                {
                    return mappedCoordinate;
                }
            }
            catch (ArgumentException e)
            {
                Console.WriteLine("Erro: " + e.Message);
            }
        }
    }

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

    (int row, int column) GetRandomShipPosition()
    {
        while (true)
        {
            bool shipIsRepeated = false;
            int row = rand.Next(0, table.GetLength(0));
            int column = rand.Next(0, table.GetLength(1));

            foreach (var ship in ships.Take(shipsNumber))
            {
                if (ship.row == row && ship.column == column)
                {
                    shipIsRepeated = true;
                    break;
                }
            }

            if (shipIsRepeated == false)
            {
                return (row, column);
            }
        }
    }


}
