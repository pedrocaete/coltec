class Ship
{
    public Coordinate Coords { get; set; }
    public bool Sink { get; set; }

    public Ship((int row, int column) coordinate)
    {
        Coords = new Coordinate(coordinate);
        Sink = false;
    }

    public Ship(string coordinate)
    {
        Coords = new Coordinate(coordinate);
        Sink = false;
    }

    public bool IsHit(Coordinate attackCoordinates)
    {
        if (Coords == attackCoordinates)
        {
            Sink = true;
            return true;
        }
        else
        {
            return false;
        }
    }
}
