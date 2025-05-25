public class Ship
{
    public Coordinate Coords { get; set; }
    public bool Sink { get; set; }

    public Ship(Coordinate coordinate)
    {
        Coords = coordinate;
        Sink = false;
    }

    public bool IsHit(Coordinate attackCoordinates)
    {
        if (Coords.Equals(attackCoordinates))
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
