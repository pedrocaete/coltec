public class CoordinateTests
{
    [Fact]
    public void Construtor_WithTuple_SetsRowAndColumnCorrectly()
    {
        var coord = new Coordinate((2, 3));

        Assert.Equal(2, coord.Row);
        Assert.Equal(3, coord.Column);
        Assert.Equal((2, 3), coord.Value);
    }

    [Theory]
    [InlineData("A1", 0, 0)]
    [InlineData("B5", 4, 1)]
    [InlineData("J10", 9, 9)]
    [InlineData("c3", 2, 2)] // testando case-insensitivity
    public void Constructor_WithString_ParsesCorrectly(string input, int expectedRow, int expectedColumn)
    {
        var coord = new Coordinate(input);

        Assert.Equal(expectedRow, coord.Row);
        Assert.Equal(expectedColumn, coord.Column);
        Assert.Equal((expectedRow, expectedColumn), coord.Value);
    }

    [Theory]
    [InlineData("K1")]   // Letra fora do intervalo
    [InlineData("A0")]   // Número fora do intervalo
    [InlineData("Z100")] // Totalmente fora
    [InlineData("AA")]   // Formato inválido
    [InlineData("1A")]   // Ordem inválida
    public void Constructor_WithInvalidString_ThrowsArgumentException(string input)
    {
        Assert.Throws<ArgumentException>(() => new Coordinate(input));
    }

    [Fact]
    public void ImplicitConversion_ReturnsCorrectTuple()
    {
        var coord = new Coordinate((5, 7));
        (int row, int column) tuple = coord;

        Assert.Equal(5, tuple.row);
        Assert.Equal(7, tuple.column);
    }
}
