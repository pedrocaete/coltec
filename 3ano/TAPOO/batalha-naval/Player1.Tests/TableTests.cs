public class TableTests
{
    [Fact]
    public void ReceiveAttack_Miss_ReturnsMiss()
    {
        var coords = Enumerable.Range(0, 10).Select(i => $"{(char)('A' + i)}1").ToList();
        var fakeConsole = new TestConsole(coords);
        var table = new Table(fakeConsole);

        table.CreateTableWithManualShipPositions();

        var actual = table.ReceiveAttack("A2");

        Assert.Equal("MISS", actual);
    }

    [Fact]
    public void ReceiveAttack_Hit_ReturnsHit()
    {
        var coords = Enumerable.Range(0, 10).Select(i => $"{(char)('A' + i)}1").ToList();
        var fakeConsole = new TestConsole(coords);
        var table = new Table(fakeConsole);

        table.CreateTableWithManualShipPositions();

        var actual = table.ReceiveAttack("A1");

        Assert.Equal("HIT", actual);
    }

    [Fact]
    public void ReceiveAttack_AllShipsHit_ReturnsWin()
    {
        var coords = Enumerable.Range(0, 10).Select(i => $"{(char)('A' + i)}1").ToList();
        var fakeConsole = new TestConsole(coords);
        var table = new Table(fakeConsole);

        table.CreateTableWithManualShipPositions();
        string actual = "";

        foreach (var coord in coords)
        {
            actual = table.ReceiveAttack(coord);
        }

        Assert.Equal("WIN", actual);
    }
}
