public class ShipTests
{
    [Fact]
    public void Ship_Created_SetsValidCoordinate()
    {
        var ship = new Ship((1, 1));

        Coordinate coordinate = ship.Coords;

        Assert.Equal<Coordinate>(coordinate, (1, 1));
    }

    [Fact]
    public void Ship_Created_SetsSinkAsFalse()
    {
        var ship = new Ship((1, 1));

        var actual = ship.Sink;

        Assert.False(actual);
    }

    [Fact]
    public void IsHit_Hit_ReturnsTrue()
    {
        var ship = new Ship((1, 1));

        var actual = ship.IsHit((1, 1));

        Assert.True(actual);
    }

    [Fact]
    public void IsHit_Hit_SetSinkAsTrue()
    {
        var ship = new Ship((1, 1));

        ship.IsHit((1, 1));
        var actual = ship.Sink;

        Assert.True(actual);
    }

    [Fact]
    public void IsHit_Miss_ReturnsFalse()
    {
        var ship = new Ship((1, 1));

        var actual = ship.IsHit((1, 2));

        Assert.False(actual);
    }

}
