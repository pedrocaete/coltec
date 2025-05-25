public class AttackTable : TableBase
{
    List<Coordinate> attackedCells = new();
    Client _client;
    string lastAttackStatus = "";

    public AttackTable(IConsole console, Client client) : base(console)
    {
        _client = client;
    }

    public void Play()
    {
        Show();
        while (lastAttackStatus != "WIN")
        {
            var coordinate = ReadAttackCoordinate();
            if (IsValidCoordinate(coordinate))
            {
                SendCoordinateToServer(coordinate);
                VerifyAttackStatus(coordinate);
            }
        }
    }

    public void VerifyAttackStatus(string position)
    {
        var attackStatus = _client.Receive();
        lastAttackStatus = attackStatus;
        var cell = new Coordinate(position);

        if (attackStatus == "HIT")
        {
            UpdateCell(cell, 'X');
            attackedCells.Add(cell);
            Show();
        }
        else if (attackStatus == "MISS")
        {
            UpdateCell(cell, 'O');
            attackedCells.Add(cell);
            Show();
        }
        else if (attackStatus == "WIN")
        {
            _console.WriteLine("Jogo Ganho!");
            Show();
        }
        else
        {
            _console.WriteLine("Você fez merda");
        }
    }

    void SendCoordinateToServer(string coordinate)
    {
        _client.Send(coordinate);
    }

    string ReadAttackCoordinate()
    {
        _console.WriteLine($"Escreva a coordenada de ataque");
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

    bool IsValidCoordinate(string coordinate)
    {
        try
        {
            Coordinate validCoordinate = new(coordinate);
            return true;
        }
        catch (ArgumentException e)
        {
            _console.WriteLine("Erro: " + e.Message);
        }
        return false;
    }

    bool IsAttackPositionRepeated(Coordinate position)
    {
        foreach (var cell in attackedCells)
        {
            if (cell.Row == position.Row && cell.Column == position.Column)
                return true;
        }
        return false;
    }
}
